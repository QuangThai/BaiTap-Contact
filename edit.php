<?php
	include_once "conn.php";
	if(isset($_POST['update']))
	{
		$ma = $_GET['ID'];
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];	

		$query = "UPDATE contactdata SET name='".$name."',phone='".$phone."',email='".$email."' WHERE ma='".$ma."'";
		$result = mysqli_query($con,$query);

		if($result) 
		{
			header('location:contact.php');
		}
		else 
		{
			echo  "Vui lòng xem lại" ;
		}
	} 
	else 
	{
		header('location:contact.php') ;
	}
 ?>