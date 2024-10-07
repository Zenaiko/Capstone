<?php 
    class class_order_accept_database extends class_database{

        public function __construct(){
            parent::__construct('root' , '');
        }
    }

    class class_order_accept_info{
        private $cus_id;
        private $order_ids = array();

    }

    public function set_cus_id($cus_id){
        $this->cus_id = $cus_id;
    }
?>