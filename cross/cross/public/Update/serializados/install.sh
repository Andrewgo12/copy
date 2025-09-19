
cp -r ../ASAP/applications/general/config/SaveConstantFile.php old_files/ASAP_applications_general_config_SaveConstantFile.php
cp 12 ../ASAP/applications/general/config/SaveConstantFile.php


cp 13 ../ASAP/applications/general/data/Pgsql/FeGePgsqlArchivoaux.class.php
mkdir ../ASAP/applications/general/data/anexos
cp 15 ../ASAP/applications/general/domain/FeGeArchivosManager.class.php


# Coloca las notas de la version
cat ../VERSION spacer README > VERSION2
mv ../VERSION old_files/
mv VERSION2 ../VERSION

echo 'Directorios creados : 1'
echo 'Archivos leidos : 20'
echo 'Archivos eliminados : 0'
echo ' '
echo '**** Archivos serializados ****'
echo ' - ASAP/applications/general/config/SaveConstantFile.php'
