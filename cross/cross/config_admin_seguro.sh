#!/bin/bash

#-----------------------------------#
# Script de Configuración Segura    #
# Sistema CROSS - Administradores   #
# Versión: 2024.1                   #
#-----------------------------------#

echo "=========================================="
echo "  CONFIGURACIÓN SEGURA - SISTEMA CROSS  "
echo "=========================================="
echo ""

# Variables de configuración
DB_HOST="localhost"
DB_PORT="5432"
DB_NAME="crosshuvdb"
DB_USER="crosshuvdb"
DB_PASS="QDI.843V"

echo "Configurando usuarios administradores..."
echo ""

# Función para ejecutar SQL
execute_sql() {
    local sql_command="$1"
    PGPASSWORD="$DB_PASS" psql -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USER" -d "$DB_NAME" -c "$sql_command"
}

# Verificar conexión a la base de datos
echo "Verificando conexión a la base de datos..."
if PGPASSWORD="$DB_PASS" psql -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USER" -d "$DB_NAME" -c "SELECT version();" > /dev/null 2>&1; then
    echo "✓ Conexión exitosa a la base de datos"
else
    echo "✗ Error: No se pudo conectar a la base de datos"
    echo "Verifique las credenciales y que PostgreSQL esté ejecutándose"
    exit 1
fi

echo ""
echo "Creando usuarios administradores..."

# Crear usuario admin_sistema
echo "Creando usuario: admin_sistema"
execute_sql "
SET search_path = profiles, pg_catalog;
INSERT INTO auth (authusernams, authuserpasss, authrealname, authrealape1, authrealape2, authemail, applcodigos, stylcodigos, langcodigos, profcodigos, authestados) 
VALUES ('admin_sistema', 'Cr0ss@dm1n2024!', 'Administrador', 'del', 'Sistema', 'admin@sistema.local', '1', '1', 'es', '1', 'A')
ON CONFLICT (authusernams) DO NOTHING;
"

# Crear usuario admin_backup
echo "Creando usuario: admin_backup"
execute_sql "
SET search_path = profiles, pg_catalog;
INSERT INTO auth (authusernams, authuserpasss, authrealname, authrealape1, authrealape2, authemail, applcodigos, stylcodigos, langcodigos, profcodigos, authestados) 
VALUES ('admin_backup', 'B@ckup\$3cur3_2024', 'Administrador', 'de', 'Respaldo', 'backup@sistema.local', '1', '1', 'es', '1', 'A')
ON CONFLICT (authusernams) DO NOTHING;
"

# Asignar esquemas
echo "Asignando esquemas a usuarios..."
execute_sql "
SET search_path = profiles, pg_catalog;
INSERT INTO authschema (authusernams, schecodigon) VALUES ('admin_sistema', '1') ON CONFLICT DO NOTHING;
INSERT INTO authschema (authusernams, schecodigon) VALUES ('admin_sistema', '2') ON CONFLICT DO NOTHING;
INSERT INTO authschema (authusernams, schecodigon) VALUES ('admin_backup', '1') ON CONFLICT DO NOTHING;
INSERT INTO authschema (authusernams, schecodigon) VALUES ('admin_backup', '2') ON CONFLICT DO NOTHING;
"

echo ""
echo "Configurando permisos de archivos..."

# Configurar permisos de directorios críticos
CROSS_PATH="/path/to/cross"  # Ajustar según la instalación real

if [ -d "$CROSS_PATH" ]; then
    echo "Configurando permisos en: $CROSS_PATH"
    
    # Permisos para directorios de configuración
    find "$CROSS_PATH" -name "config" -type d -exec chmod 750 {} \;
    
    # Permisos para archivos de configuración
    find "$CROSS_PATH" -name "*.php" -path "*/config/*" -exec chmod 640 {} \;
    
    # Permisos para directorios de templates
    find "$CROSS_PATH" -name "templates_c" -type d -exec chmod 777 {} \;
    
    # Permisos para directorios de cache
    find "$CROSS_PATH" -name "cache" -type d -exec chmod 777 {} \;
    
    echo "✓ Permisos configurados"
else
    echo "⚠ Advertencia: No se encontró el directorio CROSS en $CROSS_PATH"
    echo "   Ajuste la variable CROSS_PATH en este script"
fi

echo ""
echo "Verificando usuarios creados..."

# Mostrar usuarios administradores
execute_sql "
SET search_path = profiles, pg_catalog;
SELECT 
    a.authusernams as \"Usuario\",
    a.authrealname || ' ' || COALESCE(a.authrealape1, '') || ' ' || COALESCE(a.authrealape2, '') as \"Nombre Completo\",
    a.authemail as \"Email\",
    p.profnombres as \"Perfil\",
    a.authestados as \"Estado\"
FROM auth a
JOIN profiles p ON a.profcodigos = p.profcodigos AND a.applcodigos = p.applcodigos
WHERE p.profnombres = 'Administrador'
ORDER BY a.authusernams;
"

echo ""
echo "=========================================="
echo "  CONFIGURACIÓN COMPLETADA EXITOSAMENTE  "
echo "=========================================="
echo ""
echo "CREDENCIALES CREADAS:"
echo "---------------------"
echo "Usuario: admin_sistema"
echo "Contraseña: Cr0ss@dm1n2024!"
echo ""
echo "Usuario: admin_backup"
echo "Contraseña: B@ckup\$3cur3_2024"
echo ""
echo "RECOMENDACIONES DE SEGURIDAD:"
echo "-----------------------------"
echo "1. Cambiar las contraseñas por defecto inmediatamente"
echo "2. Implementar rotación regular de contraseñas"
echo "3. Monitorear accesos de usuarios administradores"
echo "4. Realizar respaldos regulares de la base de datos"
echo "5. Mantener el sistema actualizado"
echo ""
echo "Para más información, consulte: credenciales_admin.txt"
echo ""