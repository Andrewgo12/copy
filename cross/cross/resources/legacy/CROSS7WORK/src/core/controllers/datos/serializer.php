<?php

require_once "PEAR.php";

class Serializer {

    function save($obj, $filename) {

        if (!is_object($obj) && !is_array($obj)) {
            return PEAR::raiseError("trying to serialize a non-object");
        } else {

            $SerializedObj = serialize($obj);

            $fp = @fopen($filename, "w");
            if (!$fp) {
                return PEAR::raiseError("cannot open file $filename");
            }

            $write =  @fwrite ( $fp, $SerializedObj );
            if (!$write) {
                return PEAR::raiseError("error writing serialized data to $filename");
            }

            $close = fclose ( $fp);
            if(!$close) {
                return PEAR::raiseError("error closing the serialisation file $filename");
            }
            
            return true;
        }
    }
    
    function &load($filename) {
        $fp = @fopen($filename, "r");
        if (!$fp) {
            return PEAR::raiseError("cannot open file $filename");
        }

        $read =  @fread ( $fp, filesize ($filename));
        if(!$read) {
            return PEAR::raiseError("error reading file $filename");
        }

        @$obj = unserialize ($read);
        if(!$obj) {
            return PEAR::raiseError("error deserialising file $filename");
        }

        $close = fclose ( $fp);
        if(!$close) {
            return PEAR::raiseError("error closing the serialisation file $filename");
        }

        return $obj;
    }

}

?>
