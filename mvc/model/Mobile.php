<?php 
class Mobile {
   //attributes
   public $name;
   public $brand;
   public $price;
   public $color;
   public $year;

   //constructor
   public function __construct($n, $b, $p, $c, $y) {
      $this->name = $n;
      $this->brand = $b;
      $this->price = $p;
      $this->color = $c;
      $this->year = $y;
   }
}
?>