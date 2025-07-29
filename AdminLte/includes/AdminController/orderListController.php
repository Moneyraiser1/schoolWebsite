<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once __DIR__ . "/../AdminAbstract/OrderListInterface.php";
    require_once __DIR__ . "/../Model/Database.php";

    class orderListController implements OrderListInterface{
        private $username;
        private $userid;
        private $phone;
        private $class;
        private $userPassword;
        private $db;
        public function __construct(){
            $this->db =  new Database();
        }
        public function fetchNewOrders() {
            $this->db->query("SELECT * FROM paystack_payment WHERE delivered = 'undelivered' ORDER BY created_at DESC");
            $rows = $this->db->resultSetObj();

            
            if(count($rows) > 0){
                return $rows;
            }else{
                return false;
            }
        }

        public function fetchOldOrders(){
            $this->db->query("SELECT * FROM paystack_payment WHERE delivered = 'delivered' ORDER BY created_at DESC");
            return $this->db->resultSetObj();
        }
        public function markasdelivered($id) {
            $this->db->query("UPDATE paystack_payment SET delivered = 'delivered' WHERE id = :id");
            $this->db->bind(":id", $id);
            if($this->db->execute()){
                return true;
            }

        }
        public function markasundelivered($id) {
            $this->db->query("UPDATE paystack_payment SET delivered = 'undelivered' WHERE id = :id");
            $this->db->bind(":id", $id);
            if($this->db->execute()){
                return true;
            }

        }
      public function countOrderList() {
            $this->db->query("SELECT COUNT(*) as num_orders FROM paystack_payment WHERE delivered = 'undelivered'");
            return $this->db->singleRecordObj(); // Make sure you return the result
        }

}