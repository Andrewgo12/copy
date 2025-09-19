#!/bin/sh

#-----------------------------------#
# Copyrigth FullEngine 2005         #
# Script instalador de Cross G      #
#                                   #
# by Creyes <cesar.reyes@parquesoft>#
#-----------------------------------#

echo "# Copyrigth FullEngine 2005           #"
echo "# Script generico instalador de Cross #"
echo "#                                     #"
echo "# by Creyes <cesar.reyes@parquesoft>  #"
echo "#-------------------------------------#"
echo "                                       "

echo -e "Digite el path de Cross (Sin barra diagonal al final): \c"
read path
if test ! -d "$path"
    then 
        echo "$path no existe"
        exit 0
    fi

echo -e "Digite el nombre de la base de datos: \c"
read database
if test -n "$database"
    then
        params="name=$database"
    fi

echo -e "Digite el host: \c"
read host
if test -n "$host"
    then
        params="$params host=$host"
    fi

echo -e "Digite el puerto: \c"
read port
if test -n "$port"
    then
        params="$params port=$port"
    fi

echo -e "Digite el nombre del usuario de base de datos: \c"
read user
if test -n "$user"
    then
        params="$params user=$user"
        schemas="user=$user"
    fi

echo "Digite la clave de base de datos:"
stty -echo
read password
stty echo
if test -n "$password"
    then
        params="$params password=$password"
        schemas="$schemas password=$password"
    fi

echo -e "Digite el driver de base de datos: \c" 
read driver
if test -n "$driver"
    then
        params="$params driver=$driver"
    fi

echo "Configurando ......"
comando="SaveConfigurationFile.php $params"
cmdschema="SaveSchemaFile.php $schemas" 
# ORDENES
cd "$path/ASAP/applications/cross300/config/"
php $comando
php SaveConstantFile.php
php SaveNavigationFile.php
chmod 777 "$path/ASAP/applications/cross300/templates_c/"
chmod 777 "$path/ASAP/applications/cross300/data/cache/"
chmod 777 "$path/ASAP/applications/cross300/data/anexos/"
chmod -R 777 "$path/ASAP/applications/cross300/tmp/"
chmod 777 "$path/ASAP/applications/cross300/config/application.constant.data"

# CLIENTES
cd "$path/ASAP/applications/customers/config/"
php $comando
php SaveConstantFile.php
php SaveNavigationFile.php
chmod 777 "$path/ASAP/applications/customers/templates_c/"
chmod 777 "$path/ASAP/applications/customers/data/cache/"
chmod 777 "$path/ASAP/applications/customers/config/application.constant.data"

# GENERAL
cd "$path/ASAP/applications/general/config/"
php $comando
php SaveConstantFile.php
php SaveNavigationFile.php
php SaveParams.php
chmod 777 "$path/ASAP/applications/general/templates_c/"
chmod 777 "$path/ASAP/applications/general/data/cache/"
chmod 777 "$path/ASAP/applications/general/config/"
chmod -R 777 "$path/ASAP/applications/general/tmp/"
chmod 777 "$path/ASAP/applications/general/config/application.constant.data"
chmod 777 "$path/ASAP/applications/general/config/application.params.data"

# RECURSOS HUMANOS
cd "$path/ASAP/applications/human_resources/config/"
php $comando
php SaveConstantFile.php
php SaveNavigationFile.php
chmod 777 "$path/ASAP/applications/human_resources/templates_c/"
chmod 777 "$path/ASAP/applications/human_resources/data/cache/"
chmod 777 "$path/ASAP/applications/human_resources/config/application.constant.data"

# PERFILES
cd "$path/ASAP/applications/profiles/config/"
php $comando
php SaveConstantFile.php
php SaveNavigationFile.php
#php SaveSchemaFile.php
php $cmdschema
chmod 777 "$path/ASAP/applications/profiles/templates_c/"
chmod 777 "$path/ASAP/applications/profiles/data/cache/"
chmod -R 777 "$path/ASAP/applications/profiles/config/profiles/"
chmod 777 "$path/ASAP/applications/profiles/config/schema.data"

# ALMACEN
cd "$path/ASAP/applications/storage/config/"
php $comando
php SaveConstantFile.php
php SaveNavigationFile.php
chmod 777 "$path/ASAP/applications/storage/templates_c/"
chmod 777 "$path/ASAP/applications/storage/data/cache/"
chmod 777 "$path/ASAP/applications/storage/config/application.constant.data"

# PROCESOS
cd "$path/ASAP/applications/workflow/config/"
php $comando
php SaveConstantFile.php
php SaveNavigationFile.php
chmod 777 "$path/ASAP/applications/workflow/templates_c/"
chmod 777 "$path/ASAP/applications/workflow/data/cache/"
chmod 777 "$path/ASAP/applications/workflow/config/application.constant.data"

# AGENDA
cd "$path/ASAP/applications/schedule/config/"
php $comando
php SaveConstantFile.php
php SaveNavigationFile.php
chmod 777 "$path/ASAP/applications/schedule/templates_c/"
chmod -R 777 "$path/ASAP/applications/schedule/tmp/"
chmod 777 "$path/ASAP/applications/schedule/config/application.constant.data"

# MEDICION
cd "$path/ASAP/applications/encuestas/config/"
php $comando
php SaveConstantFile.php
php SaveNavigationFile.php
chmod 777 "$path/ASAP/applications/encuestas/templates_c/"
chmod 777 "$path/ASAP/applications/encuestas/config/application.constant.data"

# PRODUCTO
cd "$path/ASAP/applications/products/config/"
php $comando
php SaveConstantFile.php
php SaveNavigationFile.php
chmod 777 "$path/ASAP/applications/products/templates_c/"
chmod 777 "$path/ASAP/applications/products/config/application.constant.data"
