<?php 
    function valName($name){
        if ($name == "" || !preg_match("/^[A-Z][a-zA-Z ]*$/", $name)) {
            return false;
        }else{
            return true;
        }
    }

    function valEmail($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }else{
            return true;
        }
    }
    





?>