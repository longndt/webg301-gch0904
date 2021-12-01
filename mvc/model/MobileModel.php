<?php 
require_once "model/Mobile.php";

class MobileModel {
   //show list of mobiles
   public function getMobileList() {
      //create an array of Mobile (as sample data)
      $mobileList = array (
         "iPhone 13 Pro Max" => new Mobile("iPhone 13 Pro Max", "Apple", 1200, "Black", 2021),
         "Galaxy S21 Ultra" => new Mobile("Galaxy S21 Ultra", "Samsung", 1100, "White", 2021),
         "Find X" => new Mobile("Find X", "Oppo", 1000, "Blue", 2021)
      );
      return $mobileList;
   }

   //show 1 mobile detail
   public function getMobile($name) {
      $mobiles = $this->getMobileList();
      return $mobiles[$name];
   }
}
?>