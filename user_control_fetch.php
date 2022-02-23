<?php
// user_control_fetch.php
include('db_connection.php');
$column = array('user_id','user_name');
$query = "SELECT * FROM `user_details` WHERE `user_type` IN('Standard User','End User');";
if(isset($_POST['search']['value'])){
 $query .= '
 WHERE user_details.user_id LIKE "%'.$_POST["search"]["value"].'%"  
 OR user_details.user_name LIKE "%'.$_POST["search"]["value"].'%"     
 ';
}
if(isset($_POST['order'])){
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else{
 $query .= 'ORDER BY user_details.user_id DESC';
}
$query1 = '';
if($_POST['length'] != -1){
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $pdo_conn->prepare($query);
$statement->execute();
$number_filter_row = $statement->rowCount();
$statement = $pdo_conn->prepare($query . $query1);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
foreach($result as $row){
	$user_image = '';
	if ($row['user_image'] !='') {
		$user_image = '<img src="img/user_image/'.$row["user_image"].'" class="rounded-circle" width="50" height="50" />';
	}else{
		$user_image = '';
	}
	$status = '';
	 if($row['user_status'] == 'active'){
	  $status = '<span class="badge badge-success">Active</span>';
	 }else{
	  $status = '<span class="badge badge-danger">Inactive</span>';
	 }	
 $sub_array = array();
 $sub_array[] = $row['user_id_num'];
 $sub_array[] = '<div class="text-center">'.$user_image.'</div>';
 $sub_array[] = $row['user_name'];
 $sub_array[] = $row['user_email'];
 $sub_array[] = $row['user_mobile'];
 $sub_array[] = $row['user_department'];
 $sub_array[] ='<div class="text-center">'.$status.'</div>';
 $sub_array[] = '<div class="text-center"><button type="button" name="view" id="'.$row["user_id"].'" class="btn btn-info btn-sm view mr-2"><i class="fas fa-eye"></i></button>'.'<button type="button" name="update" id="'.$row["user_id"].'" class="btn btn-primary btn-sm update mr-2"><i class="fas fa-edit"></i></button>'.'<button type="button" name="active_inactive_btn" id="'.$row["user_id"].'" class="btn btn-info btn-sm btn_active_inactive" data-status="'.$row["user_status"].'"><i class="fas fa-check-circle"></i></button></div>';
 $data[] = $sub_array;
}
function count_all_data($pdo_conn){
 $query = "SELECT * FROM user_details";
 $statement = $pdo_conn->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}
$output = array(
 'draw'    => intval($_POST['draw']),
 'recordsTotal'  => count_all_data($pdo_conn),
 'recordsFiltered' => $number_filter_row,
 'data'    => $data
);
echo json_encode($output);
?>