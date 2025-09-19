<?php
/**
* @copyright Copyright 2004 &copy; FullEngine
*
* crea y envia e-mail
* @author creyes <cesar.reyes@parquesoft.com>
* @date 12-may-2005 16:48:41
* @location Cali-Colombia
*/

include("smtp.php");
class smtpSendMail extends smtp_class{

    function smtpSendMail() {
        $this->parts = array();
        $this->to =  array();
        $this->from = "";
        $this->subject =  "";
        $this->body =  "";
        $this->headers =  array();
        $this->boundary = '==Multipart_Boundary_x'.md5(uniqid(rand())); 
        $this->host_name="";
        $this->localhost="";      
        $this->direct_delivery=0;          
        $this->timeout=0;                  
        $this->data_timeout=0;             
        $this->debug=0;                     
        $this->html_debug=0;               
        $this->pop3_auth_host="";           
        $this->user="";                   
        $this->realm="";  
        $this->password="";  
        $this->workstation="";   
        $this->authentication_mechanism="";
        
        
        $tmpVal = ini_get('upload_max_filesize');
        if(!$tmpVal)
            $tmpVal = "2M";
        $this->maxFileSize = $this->return_bytes($tmpVal);
        
        $tmpVal = ini_get('memory_limit');
        if(!$tmpVal)
            $tmpVal = "8M";
        $this->memoryLimit = $this->return_bytes($tmpVal);
        $this->typeBody = "html"; 
    }
    
//    * @copyright Copyright 2004 &copy; FullEngine
//    *
//    * Adiciona archivos al correo
//    * @param string $file path del archivo
//    * @param string $name nombre del archivo
//    * @author creyes <cesar.reyes@parquesoft.com>
//    * @date 13-may-2005 09:25:41
//    * @location Cali-Colombia
    
    function add_attachment($file, $name = "") {
        if(!is_readable($file) || !is_file($file) || filesize($file) > $this->maxFileSize) 
            return false; 
        //Comprueba el limite de memoria
        if(!$this->setMemoryLimit(filesize($file)))  
            return false;
            
        $this->parts[] = array (
            "ctype" => mime_content_type($file),
            "file" => $file,
            "encode" => "base64",
            "name" => $name
        ); 
       return true; 
    }
    
    
//    * @copyright Copyright 2004 &copy; FullEngine
//    *
//    * Ajusta el limite de uso de memoria y valida su tamaño
//    * @param integer $fileSize
//    * @author creyes <cesar.reyes@parquesoft.com>
//    * @date 13-may-2005 09:25:41
//    * @location Cali-Colombia
    
    function setMemoryLimit($fileSize){
        if($this->memoryLimit == -1)
            return true;
            
        $this->memoryLimit -=  $fileSize;
        if($this->memoryLimit < 0)
            return false;
        return true;   
    } 
//    
//    * @copyright Copyright 2004 &copy; FullEngine
//    *
//    * Convierte la salida de php.ini de los valores de file
//    * @param string $val
//    * @author creyes <cesar.reyes@parquesoft.com>
//    * @date 13-may-2005 09:25:41
//    * @location Cali-Colombia
    
    function return_bytes($val) {
        $val = trim($val);
        $ultimo = $val{strlen($val)-1};
        switch($ultimo) {
            case 'k':
            case 'K':
                return (int) $val * 1024;
                break;
            case 'm':
            case 'M':
                return (int) $val * 1048576;
                break;
            default:
                return (int) $val;
        } 
    }
     
//    
//    * @copyright Copyright 2004 &copy; FullEngine
//    *
//    * Construye las cabeceras para los adjuntos
//    * @param array $part
//    * @author creyes <cesar.reyes@parquesoft.com>
//    * @date 13-may-2005 09:25:41
//    * @location Cali-Colombia
    
    function build_message($part) {
        $attachment = chunk_split(base64_encode(fread(fopen($part["file"], "r"), filesize($part["file"]))));
        $message .= "Content-Type: {$part["ctype"]}; name=\"{$part["name"]}\"\n"; 
        $message .= "Content-Disposition: attachment; filename=\"{$part["name"]}\"\n";
        $message .= "Content-Transfer-Encoding: {$part["encode"]}\n\n"; 
        $message .= "$attachment\n\n";
        return $message;  
    }

    
//    * @copyright Copyright 2004 &copy; FullEngine
//    *
//    * Construye las cabeceras para el correo
//    * @author creyes <cesar.reyes@parquesoft.com>
//    * @date 13-may-2005 09:25:41
//    * @location Cali-Colombia
    
    function build_multipart() {
        $this->headers = array("From: ".$this->from,
                                "Subject: ".$this->subject,
                                "To :".$this->to[0], 
                                "Date: ".strftime("%a, %d %b %Y %H:%M:%S %Z"),
                                "MIME-Version: 1.0",
                                'Content-Type: multipart/mixed; boundary="'.$this->boundary.'"');
        //Construye el mensaje
        $message = "--".$this->boundary."\n"; 
        $message .= "Content-Type: text/".$this->typeBody."; charset=iso-8859-1\n";
        $message .= "Content-Transfer-Encoding: 7bit\n\n";
        $message .= $this->body."\n\n";
        foreach($this->parts as $key => $rcAttach){
            $rcMessage[$key] = $this->build_message($rcAttach);
        }
        if(is_array($rcMessage)){
            $message .= "--".$this->boundary."\n";
            $message .= implode("--".$this->boundary."\n", $rcMessage); 
            unset($rcMessage); 
        } 
        return $message."--".$this->boundary."--\n"; 
    }

    
//    * @copyright Copyright 2004 &copy; FullEngine
//    *
//    * Envia el correo
//    * @author creyes <cesar.reyes@parquesoft.com>
//    * @date 13-may-2005 09:25:41
//    * @location Cali-Colombia
    
    function send() {
        if(!$this->from || !$this->to[0] || !$this->subject || !$this->body){ 
            if($smtp->html_debug == 1)
                echo "they lack parameters to make the mail.\n<br>";  
            return false;    
        }
        $message = $this->build_multipart(); 
        $result = $this->SendMessage($this->from,$this->to,$this->headers,$message); 
        if($result == 1)
            return true;
        return false;
    }
}

?>