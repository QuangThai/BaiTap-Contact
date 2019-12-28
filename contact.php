<?php 
include_once 'conn.php';
$result = mysqli_query($con, 'SELECT count(ma) as total FROM contactdata');
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 5;

$total_page = ceil($total_records / $limit);

if ($current_page > $total_page){
	$current_page = $total_page;
}
else if ($current_page < 1){
	$current_page = 1;
}

$start = ($current_page - 1) * $limit;



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Thông tin sinh viên</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
	<style type="text/css">
		body {
			font-size: 15px;
			font-family: sans-serif;
		}
		.pagination > a:hover {
			text-decoration: none;
		}
		.pagination > a {
			margin: 0 15px;
			color: #4254f5;

			
		}
		span {
			color : #f54242;
		}
		i.fas {
			font-size: 13px;
		}
		th , tr {
			text-align: center;
		}
		.cbr-pagination ul {
			margin: 0;
		}

		.cbr-pagination ul li {
			display: inline-block;
			padding: 0;
		}

		.cbr-pagination ul li .page-numbers {
			display: inline-block;
			font-size: 12px;
			line-height: 36px;
			width: 36px;
			height: 36px;
			text-align: center;
			background-color: #fff;
			color: #757575;
			border: 1px solid #d7d7d7;
			-webkit-transition: all ease 0.3s;
			-moz-transition: all ease 0.3s;
			transition: all ease 0.3s;
		}

		.cbr-pagination ul li a.page-numbers:hover,
		.cbr-pagination ul li .page-numbers.current {
			background-color: #151935;
			color: #fff;
			text-decoration: none;
		}
		
	</style>
</head>
<body>
	<div class="container pt-3">
		<h3 class="text-center text-monospace pb-2">Contact - PHP</h3>
		<a class="text-white btn btn-success" href="insert.php"><i class="fas fa-plus-circle"></i> Thêm</a>
		<form action="#" method="POST">
			<div class="input-group mb-3 w-50 ml-auto">
				<input type="text" class="form-control" name="search" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
				<div class="input-group-append">
					<button type="submit" class="btn btn-primary" id="button-addon2">Search</button>
				</div>
			</div>
		</form>
		<div class="shadow">
			<table class="table table-bordered mt-4" id="myTable">
				<thead class="thead-dark">
					<tr>
						<th scope="col"></th>
						<th scope="col">Name</th>
						<th scope="col">Phone</th>
						<th scope="col">Email</th>
						<th scope="col">Thao Tác</th>
						<th scope="col">
							<form action="delete_checkbox.php" method="POST">
							<button  type ="submit" class="btn badge badge-danger" name="delete_multiple">Xóa
							</button> 
							</form>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					include_once 'conn.php';
					if (isset($_POST['search'])) {
						$searchKey = $_POST['search'];
						$sql = "SELECT * FROM contactdata WHERE name LIKE '%$searchKey%' ";
					} 
					else {
						$sql = "SELECT * FROM contactdata ORDER BY name LIMIT $start, $limit";
						$searchKey = "";
					}										
					$query = mysqli_query($con,$sql);
					while ($row = mysqli_fetch_assoc($query)) {  
						?>
						<tr>								
							<td><?php echo $row['name'][0]; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['phone']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td>
								<div class="d-flex justify-content-center">
									<a class="text-white btn btn-warning mr-3" href="update.php?ma=<?php echo $row['ma']; ?>"><i class="fas fa-edit"></i> </a>
									<a onclick="return confirm('Bạn có thực sự muốn xóa nó')"; class="text-white btn btn-danger" href="delete.php?ma=<?php echo $row['ma']; ?>"><i class="fas fa-trash-alt"></i> </a>
								</div>
							</td>
							<td>
								<input type="checkbox" onclick="toogleCheckbox(this)" value="<?php echo $row['ma'] ?>"<?php echo $row['visible'] == 1 ? "checked" : "" ?>>
							</td>
						</tr>
						<?php 
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="cbr-pagination clearfix text-center">
			<ul>
				<li>
					<?php
					if ($current_page > 1 && $total_page > 1){
						echo '<a class="shadow page-numbers" href="contact.php?page='.($current_page-1).'"><i class="fas fa-angle-double-left"></i></a>  ';
					}

					for ($i = 1; $i <= $total_page; $i++){
						if ($i == $current_page){
							echo '<span class="shadow current page-numbers">'.$i.'</span>  ';
						}
						else{
							echo '<a class="shadow page-numbers" href="contact.php?page='.$i.'">'.$i.'</a>  ';
						}
					}

					if ($current_page < $total_page && $total_page > 1){
						echo '<a class="shadow next page-numbers"  href="contact.php?page='.($current_page+1).'"><i class="fas fa-angle-double-right"></i></a>  ';
					}
					?> 
				</li>
			</ul>
		</div>
	</div>


	<script
	src="https://code.jquery.com/jquery-3.4.1.js"
	integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.3/lib/darkmode-js.min.js"></script>
	<script>
		var options = {
  bottom: '64px', // default: '32px'
  right: 'unset', // default: '32px'
  left: '32px', // default: 'unset'
  time: '0.5s', // default: '0.3s'
  mixColor: '#fff', // default: '#fff'
  backgroundColor: '#fff',  // default: '#fff'
  buttonColorDark: '#100f2c',  // default: '#100f2c'
  buttonColorLight: '#fff', // default: '#fff'
  saveInCookies: false, // default: true,
  label:  '🌓', // default: ''
  autoMatchOsTheme: true // default: true
}

const darkmode = new Darkmode(options);
darkmode.showWidget();
</script>
<script type="text/javascript">
	function toogleCheckbox(box) {
		var id = $(box).attr('value');
		if($(box).prop('checked') == true)
		{
			var visible = 1;
		}
		else {
			var visible = 0;
		}
		var data = {
			"search_data" : 1,
			"ma" : id,
			"visible" : visible
		};
		$.ajax({
			url: 'delete_checkbox.php',
			type: 'POST',
			data: data,
			sussess:function(response) {
			}
		});		
	}
</script>
</body>

</html>