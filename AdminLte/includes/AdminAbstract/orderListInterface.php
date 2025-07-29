
<?php 

interface OrderListInterface{
      public function fetchNewOrders();
      public function fetchOldOrders();
      public function markasundelivered($id);
      public function markasdelivered($id);
      public function countOrderList();
}