<?php 
 class cado{
	  function conectar(){
	   try {
		//date_default_timezone_set('America/Lima');

	   $db = new PDO('mysql:host=localhost;dbname=contable','root','');
	   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	   $db->query("SET NAMES 'utf8'");
		 return $db;
		 }catch (PDOException $e) {
			 //print "¡Error!: " . $e->getMessage();die('ok');
			 
	       echo $e->getMessage();
          }
	  }
	  function ejecutar($isql){
		  $conexion=$this->conectar();
	      $ejecutar=$conexion->prepare($isql);
		  $ejecutar->execute();
		  $conexion=null;
		  return $ejecutar;
	  }
	 

   }
?>