<?php
//transportation bill fetch.php
include('db_connection.php');
include('function.php');
$column = array('file_sub_cat_id');
$query = "SELECT * FROM  file_sub_cat 
INNER JOIN file_cat ON file_cat.file_cat_id = file_sub_cat.file_cat_id";
if(isset($_POST['search']['value'])){
 $query .= '
 WHERE file_sub_cat.file_sub_cat_id LIKE "%'.$_POST["search"]["value"].'%"  
 OR file_sub_cat.file_sub_cat_name LIKE "%'.$_POST["search"]["value"].'%"    
 ';
}
if(isset($_POST['order'])){
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else{
 $query .= 'ORDER BY file_sub_cat.file_sub_cat_id DESC';
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
 $sub_array = array();
 $sub_array[] = $row['file_sub_cat_id'];
 $sub_array[] = $row['category_name'];
 $sub_array[] = $row['file_sub_cat_name'];
 $sub_array[] = '<div class="text-center"><button type="button" name="update" id="'.$row["file_sub_cat_id"].'" class="btn btn-primary btn-sm update mr-2"><i class="fas fa-edit"></i></button></div>';
 $data[] = $sub_array;
}
function count_all_data($pdo_conn){
 $query = "SELECT * FROM file_sub_cat";
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