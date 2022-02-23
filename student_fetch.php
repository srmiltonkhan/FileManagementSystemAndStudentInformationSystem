<?php
//student_fetch.php
include('db_connection.php');
$query = '';
$output = array('stud_bsc_info.stud_id');
$query .= "SELECT * FROM stud_bsc_info INNER JOIN department ON department.department_id = stud_bsc_info.department_id ";
if(isset($_POST["search"]["value"])){
	 $query .= 'WHERE stud_bsc_info.stud_id LIKE "%'.$_POST["search"]["value"].'%" ';
	 $query .= 'OR stud_bsc_info.stud_id_num LIKE "%'.$_POST["search"]["value"].'%" ';
	 $query .= 'OR stud_bsc_info.stud_name LIKE "%'.$_POST["search"]["value"].'%" ';
	 $query .= 'OR stud_bsc_info.email LIKE "%'.$_POST["search"]["value"].'%" ';
	 $query .= 'OR department.department_id LIKE "%'.$_POST["search"]["value"].'%" ';
	 $query .= 'OR stud_bsc_info.batch LIKE "%'.$_POST["search"]["value"].'%" ';
	 $query .= 'OR stud_bsc_info.reg_date LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST['order'])){
 	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}else{
 	$query .= 'ORDER BY stud_bsc_info.stud_id DESC ';
}
if($_POST['length'] != -1){
 	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $pdo_conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row){
	$profile_image = '';
	if ($row['profile_image'] !='') {
		$profile_image = '<img src="img/stud_image/'.$row["profile_image"].'" class="rounded-circle" width="30" height="30" />';
	}else{
		$profile_image = '';
	}
	 $sub_array = array();
	 $sub_array[] = '<div class="text-center">'.$row['stud_id'].'</div>';
	 $sub_array[] = '<div class="ml-1">'.$row['stud_id_num'].'</div>';
	  $sub_array[] = '<div class="text-center">'.$profile_image.'</div>';
	 $sub_array[] = '<div class="ml-1">'.$row['stud_name'].'</div>';
	 $sub_array[] = '<div class="ml-1">'.$row['email'].'</div>';
	 $sub_array[] = '<div class="ml-1">'.$row['dep_name'].'</div>';
	 $sub_array[] = '<div class="ml-1">'.$row['batch'].'</div>';
	 $sub_array[] = '<div class="ml-1">'.$row['reg_date'].'</div>';
	 $sub_array[] = '<div class="text-center"><button type="button" name="view" id="'.$row["stud_id"].'" class="btn btn-info btn-sm view mr-2"><i class="fas fa-eye"></i></button>'.'<button type="button" name="update" id="'.$row["stud_id"].'" class="btn btn-primary btn-sm update mr-2"><i class="fas fa-edit"></i></button>'.'<a href = "student_pdf.php?pdf=1&stud_id='.$row['stud_id'].'"><button type="button" class = "btn btn-primary btn-sm"><i class="fas fa-file-pdf text-white"></i></button></a></div>';
	 $data[] = $sub_array;
}
$output = array(
 "draw"=> intval($_POST["draw"]),
 "recordsTotal"=>  $filtered_rows,
 "recordsFiltered"=>  get_total_all_records($pdo_conn),
 "data"=> $data
);
function get_total_all_records($pdo_conn){
 $statement = $pdo_conn->prepare("SELECT * FROM stud_bsc_info");
 $statement->execute();
 return $statement->rowCount();
}
echo json_encode($output);
?>