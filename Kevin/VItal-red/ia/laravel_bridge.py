#!/usr/bin/env python3
"""
Laravel Bridge para Sistema de IA
Conecta el sistema de procesamiento de emails con la aplicación Laravel
"""

import os
import sys
import json
import requests
import logging
from datetime import datetime
from typing import Dict, List, Any, Optional
import time

# Configurar logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
    handlers=[
        logging.FileHandler('laravel_bridge.log'),
        logging.StreamHandler()
    ]
)

logger = logging.getLogger(__name__)

class LaravelBridge:
    """
    Bridge para comunicación entre el sistema de IA y Laravel
    """
    
    def __init__(self, laravel_base_url: str = "http://localhost:8000", api_token: str = None):
        """
        Inicializar el bridge
        
        Args:
            laravel_base_url: URL base de la aplicación Laravel
            api_token: Token de API para autenticación (opcional)
        """
        self.laravel_base_url = laravel_base_url.rstrip('/')
        self.api_token = api_token
        self.session = requests.Session()
        
        # Configurar headers
        if api_token:
            self.session.headers.update({
                'Authorization': f'Bearer {api_token}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            })
        else:
            self.session.headers.update({
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            })
    
    def test_connection(self) -> bool:
        """
        Probar la conexión con Laravel
        
        Returns:
            bool: True si la conexión es exitosa
        """
        try:
            response = self.session.get(f"{self.laravel_base_url}/admin/ia/stats")
            
            if response.status_code == 200:
                logger.info("✅ Conexión con Laravel exitosa")
                return True
            else:
                logger.error(f"❌ Error de conexión: {response.status_code}")
                return False
                
        except requests.exceptions.RequestException as e:
            logger.error(f"❌ Error de conexión: {e}")
            return False
    
    def send_processed_emails(self, ia_path: str) -> Dict[str, Any]:
        """
        Enviar emails procesados a Laravel para importación
        
        Args:
            ia_path: Ruta al directorio del sistema de IA
            
        Returns:
            Dict con los resultados de la importación
        """
        try:
            logger.info(f"📤 Enviando emails procesados desde: {ia_path}")
            
            payload = {
                'ia_path': ia_path
            }
            
            response = self.session.post(
                f"{self.laravel_base_url}/admin/ia/import",
                json=payload,
                timeout=300  # 5 minutos timeout
            )
            
            if response.status_code == 200:
                result = response.json()
                logger.info(f"✅ Importación exitosa: {result.get('message', '')}")
                return result
            else:
                error_msg = f"Error HTTP {response.status_code}: {response.text}"
                logger.error(f"❌ {error_msg}")
                return {
                    'success': False,
                    'message': error_msg
                }
                
        except requests.exceptions.RequestException as e:
            error_msg = f"Error de conexión: {e}"
            logger.error(f"❌ {error_msg}")
            return {
                'success': False,
                'message': error_msg
            }
    
    def trigger_auto_import(self) -> Dict[str, Any]:
        """
        Activar importación automática en Laravel
        
        Returns:
            Dict con los resultados
        """
        try:
            logger.info("🔄 Activando importación automática...")
            
            response = self.session.post(
                f"{self.laravel_base_url}/admin/ia/auto-import",
                timeout=300
            )
            
            if response.status_code == 200:
                result = response.json()
                logger.info(f"✅ Importación automática exitosa: {result.get('message', '')}")
                return result
            else:
                error_msg = f"Error HTTP {response.status_code}: {response.text}"
                logger.error(f"❌ {error_msg}")
                return {
                    'success': False,
                    'message': error_msg
                }
                
        except requests.exceptions.RequestException as e:
            error_msg = f"Error de conexión: {e}"
            logger.error(f"❌ {error_msg}")
            return {
                'success': False,
                'message': error_msg
            }
    
    def get_laravel_stats(self) -> Optional[Dict[str, Any]]:
        """
        Obtener estadísticas desde Laravel
        
        Returns:
            Dict con las estadísticas o None si hay error
        """
        try:
            response = self.session.get(f"{self.laravel_base_url}/admin/ia/stats")
            
            if response.status_code == 200:
                return response.json()
            else:
                logger.error(f"Error obteniendo estadísticas: {response.status_code}")
                return None
                
        except requests.exceptions.RequestException as e:
            logger.error(f"Error de conexión obteniendo estadísticas: {e}")
            return None
    
    def notify_new_emails(self, email_count: int, urgent_count: int = 0) -> bool:
        """
        Notificar a Laravel sobre nuevos emails procesados
        
        Args:
            email_count: Número de emails procesados
            urgent_count: Número de emails urgentes
            
        Returns:
            bool: True si la notificación fue exitosa
        """
        try:
            payload = {
                'email_count': email_count,
                'urgent_count': urgent_count,
                'timestamp': datetime.now().isoformat()
            }
            
            response = self.session.post(
                f"{self.laravel_base_url}/admin/ia/notify",
                json=payload
            )
            
            return response.status_code == 200
            
        except requests.exceptions.RequestException as e:
            logger.error(f"Error enviando notificación: {e}")
            return False
    
    def sync_with_laravel(self, ia_path: str, auto_process: bool = True) -> Dict[str, Any]:
        """
        Sincronización completa con Laravel
        
        Args:
            ia_path: Ruta al directorio del sistema de IA
            auto_process: Si procesar automáticamente emails médicos válidos
            
        Returns:
            Dict con los resultados de la sincronización
        """
        logger.info("🔄 Iniciando sincronización completa con Laravel...")
        
        results = {
            'connection_test': False,
            'import_result': None,
            'auto_process_result': None,
            'final_stats': None,
            'success': False
        }
        
        try:
            # 1. Probar conexión
            results['connection_test'] = self.test_connection()
            if not results['connection_test']:
                return results
            
            # 2. Importar emails
            results['import_result'] = self.send_processed_emails(ia_path)
            if not results['import_result'].get('success', False):
                return results
            
            # 3. Procesar emails pendientes si está habilitado
            if auto_process:
                logger.info("🤖 Procesando emails médicos válidos...")
                response = self.session.post(f"{self.laravel_base_url}/admin/ia/process-pending")
                
                if response.status_code == 200:
                    results['auto_process_result'] = response.json()
                    logger.info(f"✅ Procesamiento automático: {results['auto_process_result'].get('message', '')}")
                else:
                    logger.warning(f"⚠️ Error en procesamiento automático: {response.status_code}")
            
            # 4. Obtener estadísticas finales
            results['final_stats'] = self.get_laravel_stats()
            
            results['success'] = True
            logger.info("✅ Sincronización completa exitosa")
            
        except Exception as e:
            logger.error(f"❌ Error en sincronización: {e}")
            results['error'] = str(e)
        
        return results
    
    def monitor_and_sync(self, ia_path: str, check_interval: int = 300) -> None:
        """
        Monitorear el directorio de IA y sincronizar automáticamente
        
        Args:
            ia_path: Ruta al directorio del sistema de IA
            check_interval: Intervalo de verificación en segundos (default: 5 minutos)
        """
        logger.info(f"👁️ Iniciando monitoreo automático cada {check_interval} segundos...")
        
        last_sync = 0
        
        while True:
            try:
                current_time = time.time()
                
                # Verificar si es hora de sincronizar
                if current_time - last_sync >= check_interval:
                    logger.info("🔄 Ejecutando sincronización programada...")
                    
                    result = self.sync_with_laravel(ia_path, auto_process=True)
                    
                    if result['success']:
                        last_sync = current_time
                        
                        # Mostrar estadísticas
                        if result['final_stats'] and result['final_stats'].get('success'):
                            stats = result['final_stats']['stats']
                            logger.info(f"📊 Estadísticas: {stats['total_emails']} emails, "
                                      f"{stats['medical_emails']} médicos, "
                                      f"{stats['urgent_emails']} urgentes")
                    else:
                        logger.error("❌ Error en sincronización programada")
                
                # Esperar antes de la siguiente verificación
                time.sleep(60)  # Verificar cada minuto si es hora de sincronizar
                
            except KeyboardInterrupt:
                logger.info("🛑 Monitoreo detenido por el usuario")
                break
            except Exception as e:
                logger.error(f"❌ Error en monitoreo: {e}")
                time.sleep(60)  # Esperar un minuto antes de reintentar

def main():
    """
    Función principal para ejecutar el bridge desde línea de comandos
    """
    import argparse
    
    parser = argparse.ArgumentParser(description='Laravel Bridge para Sistema de IA')
    parser.add_argument('--url', default='http://localhost:8000', help='URL base de Laravel')
    parser.add_argument('--token', help='Token de API para autenticación')
    parser.add_argument('--ia-path', default='./ia', help='Ruta al directorio del sistema de IA')
    parser.add_argument('--action', choices=['test', 'import', 'sync', 'monitor'], 
                       default='sync', help='Acción a ejecutar')
    parser.add_argument('--interval', type=int, default=300, 
                       help='Intervalo de monitoreo en segundos (solo para --action monitor)')
    
    args = parser.parse_args()
    
    # Crear bridge
    bridge = LaravelBridge(args.url, args.token)
    
    if args.action == 'test':
        success = bridge.test_connection()
        sys.exit(0 if success else 1)
        
    elif args.action == 'import':
        result = bridge.send_processed_emails(args.ia_path)
        print(json.dumps(result, indent=2))
        sys.exit(0 if result.get('success', False) else 1)
        
    elif args.action == 'sync':
        result = bridge.sync_with_laravel(args.ia_path)
        print(json.dumps(result, indent=2))
        sys.exit(0 if result.get('success', False) else 1)
        
    elif args.action == 'monitor':
        bridge.monitor_and_sync(args.ia_path, args.interval)

if __name__ == '__main__':
    main()
