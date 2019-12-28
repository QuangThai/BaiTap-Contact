<?php 
include_once 'conn.php';
if(isset($_POST['search_data']))
{
	$ma = $_POST['ma'];
	$visible = $_POST['visible'];
	$query = "UPDATE contactdata SET visible ='$visible' WHERE ma ='$ma' ";
	$result = mysqli_query($con,$query);
}

if(isset($_POST['delete_multiple']))
{
	$id = 1;
	$query = "DELETE FROM contactdata WHERE visible='$id'";
	$result = mysqli_query($con,$query);
	if($result) {
		echo "<script>alert('Xóa thành công')</script>";
		echo "<script>window.location.href='contact.php'</script>";
	}
}
?>