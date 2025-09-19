"""
Interfaz de línea de comandos para el agente local
"""
import asyncio
import click
import json
from pathlib import Path
from rich.console import Console
from rich.panel import Panel
from rich.syntax import Syntax
from rich.table import Table
from rich.progress import Progress, SpinnerColumn, TextColumn
from rich.prompt import Confirm
from loguru import logger

from ..core.agent import LocalAgent, AgentConfig


console = Console()


class CLIInterface:
    """Interfaz de línea de comandos rica e interactiva"""
    
    def __init__(self, agent: LocalAgent):
        self.agent = agent
        self.console = console
        self.session_active = True
    
    async def start_interactive_session(self):
        """Inicia una sesión interactiva con el agente"""
        self.console.print(Panel.fit(
            "[bold blue]🤖 Agente Local Iniciado[/bold blue]\n"
            f"Sesión: {self.agent.session_id}\n"
            "Escribe 'help' para ver comandos disponibles\n"
            "Escribe 'quit' para salir",
            title="Bienvenido"
        ))
        
        while self.session_active:
            try:
                # Prompt del usuario
                user_input = self.console.input("\n[bold green]Usuario:[/bold green] ")
                
                if user_input.lower() in ['quit', 'exit', 'bye']:
                    break
                elif user_input.lower() == 'help':
                    await self._show_help()
                    continue
                elif user_input.lower() == 'status':
                    await self._show_status()
                    continue
                elif user_input.lower() == 'tools':
                    await self._show_tools()
                    continue
                elif user_input.lower() == 'memory':
                    await self._show_memory()
                    continue
                elif user_input.lower().startswith('clear'):
                    await self._clear_session()
                    continue
                
                if not user_input.strip():
                    continue
                
                # Procesar solicitud
                await self._process_user_request(user_input)
                
            except KeyboardInterrupt:
                self.console.print("\n[yellow]Sesión interrumpida por el usuario[/yellow]")
                break
            except Exception as e:
                self.console.print(f"[red]Error: {e}[/red]")
                logger.error(f"Error en CLI: {e}")
        
        await self._shutdown()
    
    async def _process_user_request(self, user_input: str):
        """Procesa una solicitud del usuario con indicador de progreso"""
        
        with Progress(
            SpinnerColumn(),
            TextColumn("[progress.description]{task.description}"),
            console=self.console
        ) as progress:
            
            task = progress.add_task("Procesando solicitud...", total=None)
            
            try:
                # Procesar con el agente
                response_data = await self.agent.process_request(user_input)
                
                progress.update(task, description="Generando respuesta...")
                
                # Mostrar respuesta
                await self._display_response(response_data)
                
            except Exception as e:
                progress.stop()
                self.console.print(f"[red]Error procesando solicitud: {e}[/red]")
    
    async def _display_response(self, response_data: Dict[str, Any]):
        """Muestra la respuesta del agente de forma estructurada"""
        
        if response_data.get("error"):
            self.console.print(Panel(
                f"[red]{response_data['response']}[/red]",
                title="❌ Error",
                border_style="red"
            ))
            return
        
        # Respuesta principal
        self.console.print(Panel(
            response_data["response"],
            title="🤖 Respuesta del Agente",
            border_style="blue"
        ))
        
        # Mostrar plan ejecutado si está disponible
        if "plan" in response_data and response_data["plan"]:
            await self._display_execution_plan(response_data["plan"])
        
        # Mostrar metadatos si están disponibles
        if "metadata" in response_data:
            await self._display_metadata(response_data["metadata"])
    
    async def _display_execution_plan(self, plan: Dict[str, Any]):
        """Muestra el plan de ejecución"""
        table = Table(title="📋 Plan de Ejecución")
        table.add_column("Acción", style="cyan")
        table.add_column("Herramienta", style="magenta")
        table.add_column("Descripción", style="white")
        table.add_column("Estado", style="green")
        
        for action in plan.get("actions", []):
            table.add_row(
                action.get("id", ""),
                action.get("tool_name", ""),
                action.get("description", ""),
                "✅ Completado"
            )
        
        self.console.print(table)
    
    async def _display_metadata(self, metadata: Dict[str, Any]):
        """Muestra metadatos de la ejecución"""
        info_text = f"""
📊 **Estadísticas de Ejecución:**
• Acciones ejecutadas: {metadata.get('actions_executed', 0)}
• Contexto utilizado: {metadata.get('context_used', 0)} elementos
• Verificaciones de seguridad: {metadata.get('safety_checks', {})}
        """
        
        self.console.print(Panel(
            info_text.strip(),
            title="📈 Metadatos",
            border_style="dim"
        ))
    
    async def _show_help(self):
        """Muestra ayuda de comandos"""
        help_text = """
[bold]Comandos Especiales:[/bold]
• help     - Muestra esta ayuda
• status   - Estado del agente
• tools    - Lista herramientas disponibles  
• memory   - Resumen de memoria
• clear    - Limpia la sesión actual
• quit     - Sale del programa

[bold]Uso Normal:[/bold]
Simplemente escribe tu solicitud en lenguaje natural.

[bold]Ejemplos:[/bold]
• "Lee el archivo main.py"
• "Busca información sobre Python asyncio"
• "Crea un archivo con código de ejemplo"
• "Lista los archivos en el directorio src"
        """
        
        self.console.print(Panel(
            help_text.strip(),
            title="🆘 Ayuda",
            border_style="yellow"
        ))
    
    async def _show_status(self):
        """Muestra el estado actual del agente"""
        memory_summary = await self.agent.get_memory_summary()
        
        status_table = Table(title="🔍 Estado del Agente")
        status_table.add_column("Propiedad", style="cyan")
        status_table.add_column("Valor", style="white")
        
        status_table.add_row("Sesión ID", self.agent.session_id)
        status_table.add_row("Conversaciones", str(len(self.agent.conversation_history)))
        status_table.add_row("Memoria activa", "✅ Habilitada" if self.agent.config.memory_enabled else "❌ Deshabilitada")
        status_table.add_row("Sandbox", "✅ Activo" if self.agent.config.sandbox_mode else "❌ Inactivo")
        status_table.add_row("Modelo LLM", f"{self.agent.config.llm_provider}:{self.agent.config.llm_model}")
        
        self.console.print(status_table)
    
    async def _show_tools(self):
        """Muestra herramientas disponibles"""
        tools = await self.agent.get_available_tools()
        
        tools_table = Table(title="🛠️ Herramientas Disponibles")
        tools_table.add_column("Nombre", style="cyan")
        tools_table.add_column("Categoría", style="magenta")
        tools_table.add_column("Riesgo", style="yellow")
        tools_table.add_column("Descripción", style="white")
        
        for tool in tools:
            risk_color = {
                "safe": "green",
                "low": "yellow", 
                "medium": "orange",
                "high": "red",
                "critical": "bright_red"
            }.get(tool.get("risk_level", "medium"), "white")
            
            tools_table.add_row(
                tool.get("name", ""),
                tool.get("category", ""),
                f"[{risk_color}]{tool.get('risk_level', 'medium')}[/{risk_color}]",
                tool.get("description", "")
            )
        
        self.console.print(tools_table)
    
    async def _show_memory(self):
        """Muestra resumen de memoria"""
        memory_summary = await self.agent.get_memory_summary()
        
        memory_panel = Panel(
            json.dumps(memory_summary, indent=2),
            title="🧠 Resumen de Memoria",
            border_style="purple"
        )
        
        self.console.print(memory_panel)
    
    async def _clear_session(self):
        """Limpia la sesión actual"""
        if Confirm.ask("¿Estás seguro de que quieres limpiar la sesión actual?"):
            await self.agent.clear_session()
            self.console.print("[green]✅ Sesión limpiada[/green]")
    
    async def _shutdown(self):
        """Cierra la interfaz y el agente"""
        self.console.print("\n[yellow]Cerrando agente...[/yellow]")
        await self.agent.shutdown()
        self.console.print("[green]✅ Agente cerrado correctamente[/green]")


@click.group()
def cli():
    """Agente de IA Local - Interfaz de línea de comandos"""
    pass


@cli.command()
@click.option('--model', default='gpt-4', help='Modelo LLM a usar')
@click.option('--provider', default='openai', help='Proveedor LLM (openai, anthropic, local)')
@click.option('--no-sandbox', is_flag=True, help='Deshabilitar sandbox')
@click.option('--no-memory', is_flag=True, help='Deshabilitar memoria persistente')
def interactive(model, provider, no_sandbox, no_memory):
    """Inicia una sesión interactiva con el agente"""
    
    config = AgentConfig(
        llm_model=model,
        llm_provider=provider,
        sandbox_mode=not no_sandbox,
        memory_enabled=not no_memory,
        enable_human_loop=True
    )
    
    async def run_session():
        agent = LocalAgent(config)
        cli_interface = CLIInterface(agent)
        await cli_interface.start_interactive_session()
    
    asyncio.run(run_session())


@cli.command()
@click.argument('request')
@click.option('--model', default='gpt-4', help='Modelo LLM a usar')
@click.option('--output', help='Archivo para guardar la respuesta')
def single(request, model, output):
    """Ejecuta una sola solicitud y muestra el resultado"""
    
    async def run_single():
        config = AgentConfig(llm_model=model)
        agent = LocalAgent(config)
        
        console.print(f"[cyan]Procesando:[/cyan] {request}")
        
        response_data = await agent.process_request(request)
        
        console.print(Panel(
            response_data["response"],
            title="🤖 Respuesta",
            border_style="blue"
        ))
        
        if output:
            with open(output, 'w', encoding='utf-8') as f:
                json.dump(response_data, f, indent=2, ensure_ascii=False)
            console.print(f"[green]Respuesta guardada en: {output}[/green]")
        
        await agent.shutdown()
    
    asyncio.run(run_single())


@cli.command()
def setup():
    """Configura el agente por primera vez"""
    console.print(Panel.fit(
        "[bold blue]🔧 Configuración Inicial del Agente Local[/bold blue]",
        title="Setup"
    ))
    
    # Crear directorios necesarios
    directories = [
        "data/vector_db",
        "data/cache", 
        "data/logs",
        "data/backups"
    ]
    
    for dir_path in directories:
        Path(dir_path).mkdir(parents=True, exist_ok=True)
        console.print(f"✅ Directorio creado: {dir_path}")
    
    # Crear archivo de configuración
    env_content = """# Configuración del Agente Local
OPENAI_API_KEY=your_openai_key_here
ANTHROPIC_API_KEY=your_anthropic_key_here

# Configuración de la base de datos
VECTOR_DB_PATH=./data/vector_db
CACHE_DB_PATH=./data/cache

# Configuración de seguridad
ENABLE_SANDBOX=true
REQUIRE_CONFIRMATION=true
MAX_EXECUTION_TIME=300

# Configuración de logging
LOG_LEVEL=INFO
LOG_FILE=./data/logs/agent.log
"""
    
    env_file = Path(".env")
    if not env_file.exists():
        with open(env_file, 'w') as f:
            f.write(env_content)
        console.print("✅ Archivo .env creado")
    else:
        console.print("⚠️ Archivo .env ya existe")
    
    console.print(Panel(
        "[green]✅ Configuración completada[/green]\n\n"
        "[bold]Próximos pasos:[/bold]\n"
        "1. Edita el archivo .env con tus claves API\n"
        "2. Ejecuta: python -m local_agent.interfaces.cli interactive\n"
        "3. ¡Comienza a usar tu agente local!",
        title="🎉 Setup Completado"
    ))


if __name__ == "__main__":
    cli()
