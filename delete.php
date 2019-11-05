<?php
	include_once 'conn.php';
	$ma = $_GET['ma'];
	$q = "DELETE FROM `contactdata` WHERE ma=$ma " ;
	mysqli_query($con,$q);
	header('location:contact.php');
 ?>