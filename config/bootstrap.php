<?php
 
 
 
require __DIR__."/../vendor/autoload.php";
 
use Illuminate\Database\Capsule\Manager as Capsule;
 
 
 
$capsule = new Capsule;
 
 
 
$capsule->addConnection([
 
   "driver" => "mysql",
 
   "host" =>"localhost",
 
   "database" => "zegprogr_vmk",
 
   "username" => "zegprogr_vmk",
 
   "password" => "itfnwGbxM"
 
]);
 
$capsule->setAsGlobal();
 
$capsule->bootEloquent();


