# Multi-stage build para optimizar imagen
FROM node:18-alpine AS builder

# Instalar dependencias del sistema
RUN apk add --no-cache python3 make g++

# Crear directorio de trabajo
WORKDIR /app

# Copiar archivos de dependencias
COPY package*.json ./

# Instalar dependencias
RUN npm ci --only=production && npm cache clean --force

# Etapa de producción
FROM node:18-alpine AS production

# Instalar dependencias del sistema para producción
RUN apk add --no-cache dumb-init postgresql-client

# Crear usuario no-root
RUN addgroup -g 1001 -S nodejs && \
    adduser -S cross -u 1001

# Crear directorio de trabajo
WORKDIR /app

# Copiar dependencias desde builder
COPY --from=builder --chown=cross:nodejs /app/node_modules ./node_modules

# Copiar código de la aplicación
COPY --chown=cross:nodejs . .

# Crear directorios necesarios
RUN mkdir -p storage/logs storage/uploads storage/temp && \
    chown -R cross:nodejs storage

# Cambiar a usuario no-root
USER cross

# Exponer puerto
EXPOSE 3000

# Variables de entorno por defecto
ENV NODE_ENV=production
ENV PORT=3000

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
  CMD node -e "require('http').get('http://localhost:3000/health', (res) => { process.exit(res.statusCode === 200 ? 0 : 1) })"

# Comando de inicio con dumb-init
ENTRYPOINT ["dumb-init", "--"]
CMD ["node", "server.js"]