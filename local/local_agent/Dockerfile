# Dockerfile para el agente local
FROM python:3.11-slim

# Metadatos
LABEL maintainer="Local Agent Developer"
LABEL description="Agente de IA local con capacidades completas"
LABEL version="1.0.0"

# Variables de entorno
ENV PYTHONUNBUFFERED=1
ENV PYTHONDONTWRITEBYTECODE=1
ENV DEBIAN_FRONTEND=noninteractive

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    curl \
    wget \
    git \
    build-essential \
    sqlite3 \
    docker.io \
    && rm -rf /var/lib/apt/lists/*

# Crear usuario no-root para seguridad
RUN groupadd -r agent && useradd -r -g agent agent

# Crear directorios de trabajo
WORKDIR /app
RUN mkdir -p /app/data /app/logs /app/config && \
    chown -R agent:agent /app

# Copiar requirements y instalar dependencias Python
COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

# Copiar código fuente
COPY . .
RUN chown -R agent:agent /app

# Cambiar a usuario no-root
USER agent

# Exponer puertos
EXPOSE 8000 8501

# Comando por defecto
CMD ["python", "main.py"]

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:8000/health || exit 1
