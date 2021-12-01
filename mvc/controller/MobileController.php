<?php 
require_once "model/MobileModel.php";

class MobileController {
   public $model;

   public function __construct()
   {
      $this->model = new MobileModel();
   }

   public function execute() {
      //case 1: view mobile list (no parameter in URL)
      if (!isset($_GET['name'])) {
         //call to model
         $mobiles = $this->model->getMobileList();
         //render view
         require_once "view/MobileList.php";
      }
      //case 2: view mobile detail (has parameter in URL)
      else {
         $mobile = $this->model->getMobile($_GET['name']);
         //render view
         require_once "view/MobileDetail.php";
      }
   }
}
?>