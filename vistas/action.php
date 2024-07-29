<?php
session_start();
include '../controller/Product.php';
$product = new Product();
if(isset($_POST["action"])){
	$html = $product->searchProducts($_POST);
	$data = array(
		"html"	=> $html,	
	);
	echo json_encode($data);	
}

?>