<?php
	require_once("db_connection.php");
	function upload_image(){
		if(isset($_FILES["user_image"])){
			$extension = explode('.', $_FILES['user_image']['name']);
			$new_name = rand() . '.' . $extension[1];
			$destination = './img/user_image/' . $new_name;
			move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
			return $new_name;
		}
	}	
	if (isset($_POST['action_hidden'])) {
		if ($_POST['action_hidden'] == 'Add') {
				$user_email = $_POST['user_email'];
				$user_mobile = $_POST['user_mobile'];
				$finder_query = "SELECT * FROM user_details WHERE user_email = '$user_email' OR user_mobile ='$user_mobile'";
				$statement = $pdo_conn->prepare($finder_query);
				$statement->execute();
				$row_count = $statement->fetch();
				if ($row_count > 0) {
				echo "Your Email: "."<span class = 'badge badge-warning'>".$_POST['user_email']."</span>"." and Mobile Number: "."<span class='badge badge-warning'>".$_POST['user_mobile']."</span>"." already exist.";	
				}else{
	      				date_default_timezone_set('Asia/Dhaka');
	      				$currentDateTime=date('m/d/Y H:i:s');
	     				$user_reg_date = date("Y-m-d", strtotime($currentDateTime));
					$user_image = '';
				if($_FILES["user_image"]["name"] != ''){
					$user_image = upload_image();
				}
				$statement = $pdo_conn->prepare("INSERT INTO `user_details`(`user_id_num`, `user_name`, `user_email`, `user_mobile`, `user_department`, `user_designation`, `user_password`, `user_type`, `user_reg_date`, `user_image`) VALUES (:user_id_num,:user_name,:user_email,:user_mobile,:user_department,:user_designation,:user_password,:user_type,:user_reg_date,:user_image)");
				$result = $statement->execute(
					array(
				':user_id_num'=> $_POST['user_id_num'],
	            ':user_name' => $_POST["user_name"],
	            ':user_email' => $_POST["user_email"],
	            ':user_mobile' => $_POST["user_mobile"],
	            ':user_department' => $_POST["user_department"],
	            ':user_designation' => $_POST["user_designation"],
	            ':user_password' => password_hash($_POST["user_password"], PASSWORD_DEFAULT),
	            ':user_type' => $_POST["user_type"],
	            ':user_reg_date' => $user_reg_date,
	            ':user_image' => $user_image  
					)
				);
				$result = $statement->fetchAll();
				if (isset($result)) {
					echo "User Account has been created successfully.";
				}
			}

		}
	}
		//Fetch Data from DB in Modal
		if ($_POST['action_hidden']=='fetch_single') {
			$query = "SELECT * FROM user_details WHERE user_id = :user_id LIMIT 1";
			$statement = $pdo_conn->prepare($query);
			$statement->execute(
				array(':user_id' => $_POST['user_id'])
			);
			$result = $statement->fetchAll();
			foreach ($result as $row) {
				$output['user_id_num'] = $row['user_id_num'];
				// $output['user_name'] = $row['user_name'];
				// $output['user_email'] = $row['user_email'];
				// $output['user_mobile'] = $row['user_mobile'];
				// $output['user_department'] = $row['user_department'];
				// $output['user_designation'] = $row['user_designation'];
				// $output['user_password'] = $row['user_password'];
				// $output['user_type'] = $row['user_type'];
				// $output['user_image'] = $row['user_image'];

			}
			echo json_encode($output);
		}	
?>