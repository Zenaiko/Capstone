<?php
require_once("../db_api/db_root_conn.php");
(session_status() === PHP_SESSION_NONE)?session_start():null;

class class_customer_transaction_database extends class_database {
    public function __construct() {
        parent::__construct('root', '');
    }
}

