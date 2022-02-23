<?php
include_once("db_connection.php");
if($_REQUEST['student_id']) {
	$query = "SELECT * FROM students WHERE student_id='".$_REQUEST['student_id']."'";
	$statement = $pdo_conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$data = array();
	foreach($result as $rows) {
		$data = $rows;
	}
	echo json_encode($data);
} else {
	echo 0;	
}
?>