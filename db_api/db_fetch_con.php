<?php 
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents("php://input"), true);

    class class_get_contact_database extends class_database{
        public function __construct()
        {
            parent::__construct('root' , '');
        }

        
    }


?>