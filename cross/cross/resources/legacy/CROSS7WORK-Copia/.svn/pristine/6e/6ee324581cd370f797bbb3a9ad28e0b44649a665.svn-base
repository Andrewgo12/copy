<?php
    //Extrae una copia de seguridad para postgres
    class backup{

        function backup(){
            $this->pgUser = "";
            $this->pgPassword = "";
            $this->hostname = "127.0.0.1";
            $this->port = "5432";
            $this->database = "";
            $this->program = '"/usr/bin/pg_dump"';
            $this->cmd = "";
            $this->output = "show";
            $this->nameFile = "dump.sql";
        }
        //ajusta el tablespaces
        function settableSpace($tableSpace){
            $this->tableSpace = $tableSpace;
        }
        //Ajusta el path del pg_dump
        function setProgram($program){
            $this->program = '"'.$program.'"';
        }
        //Ajusta el nombre de la base de datos
        function setDatabase($dbName){
            $this->database = $dbName;
        }
        //Ajusta el puerto
        function setPort($port){
            $this->port = $port; 
        }
        //Ajusta el hostname
        function setHostname($hostname){
            $this->hostname = $hostname;
        }
        //Ajusta los datos del usuario
        function setUser($user,$password){
            $this->pgUser = $user;
            $this->pgPassword = $password;
        }
        //Ajusta el modo de salida
        function setOutput($output, $nameFile = null){
            if($output)
                $this->output = $output;
            if($nameFile)
                $this->nameFile = $nameFile;
        }
        //Crea las cabeceras http adecuadas para ejecutar
        function _setHeader(){
            // Make it do a download, if necessary
            switch($this->output){
                case 'show':
                    header('Content-Type: text/plain');
                    break;
                case 'download':
                    header("Pragma: public");
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Cache-Control: private",false);
                    header("Content-Type: application/force-download");
                    header("Content-Disposition: attachment; filename=\"".$this->nameFile.".sql\";");
                    header("Content-Transfer-Encoding: binary");
                    break;
                case 'tar':
                    //Command: ./pg_restore -d [dbname] -F t -O -x [filename.tar]
                    header("Pragma: public");
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Cache-Control: private",false);
                    header("Content-Type: application/force-download");
                    header("Content-Disposition: attachment; filename=\"".$this->nameFile.".tar\";");
                    header("Content-Transfer-Encoding: binary");
                    break;
            }
        }
        //Crea el comando para ejecutarlo en db
        function _makeCommad(){
            $tblSpace = '';
            if($this->tableSpace)
                $tblSpace = "-n ".$this->tableSpace;
            $this->cmd = "{$this->program} -i -x -a -d -O $tblSpace -h {$this->hostname} -p {$this->port} {$this->database}";
            if ($this->output == 'tar') {
                $this->cmd .= " -F t";
            }
        }
        
        //ejecuta el comando
        function exec(){
            //Ajusta las variables de ambiente para el usuario y la clave en el uso de pg_dump
            putenv('PGPASSWORD='.$this->pgPassword);
            putenv('PGUSER='.$this->pgUser);
            //Crea las cabeceras
            $this->_setHeader();
            //Crea el comando
            $this->_makeCommad();
            // Execute command and return the output to the screen
            passthru($this->cmd);
        }
    }
?>