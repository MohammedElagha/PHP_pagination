<?php
include_once ('connection.php');
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<table class="table table-bordered">
					<thead>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
					</thead>
					<tbody>
<?php

$query = "SELECT * FROM students";

if (isset($_GET['page'])) {
	$page = $_GET['page'];

	$offet = 0;

	if ($page > 1) {
		$offet = (($page-1)*10)-1;
	}

	$query = $query . " LIMIT 10 OFFSET " . $offet;
} else {
	$query = $query . " LIMIT 10 OFFSET 0";
}

$result = mysqli_query($connection, $query);

if ($result != false) {
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$id = $row["id"];
			echo '<tr>
				<td>'.$row["name"].'</td>
				<td>'.$row["email"].'</td>
				<td>'.$row["phone"].'</td>
			</tr>';
		}
	}
}
?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<?php
				$count_query = "SELECT COUNT(*) as count FROM students";
				$count_result = mysqli_query($connection, $count_query);

				if ($count_result != false) {
					$count_row = $count_result->fetch_assoc();
					$count = $count_row["count"];

					$pages_no = ceil($count/10);

					echo '<nav aria-label="Page navigation">';
					echo '<ul class="pagination">';
					for ($i = 1 ; $i <= $pages_no ; $i++) {
						echo '<li class="page-item"><a class="page-link" href="table.php?page='.$i.'">'.$i.'</a></li>';
					}
					echo '</ul>';
					echo '</nav>';
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>

