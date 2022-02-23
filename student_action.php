 <?php include("db_connection.php");
include 'function.php';
		if(isset($_POST['btn_action_hidden'])){
		   if($_POST['btn_action_hidden'] == 'load_department'){
		    echo fill_department_list($pdo_conn, $_POST['faculty_id']);
		   }
		}
		if(isset($_POST['btn_action_hidden'])){
		   if($_POST['btn_action_hidden'] == 'load_program'){
		    echo fill_program_list($pdo_conn, $_POST['department_id']);
		   }
		}
		// Start Date and Time in PHP 
		date_default_timezone_set('Asia/Dhaka');
		$currentDateTime=date('m/d/Y H:i:s');
		$time = date("h:i A", strtotime($currentDateTime));
		$date = date("Y-m-d", strtotime($currentDateTime));
		$filename = "";
	if (isset($_POST['action_hidden'])) {
		//Insert Data in DB
		if ($_POST['action_hidden'] == 'Add') {
			$stud_id_num = $_POST['stud_id_num'];
			$mobile = $_POST['mobile'];
			// unique attribute should not be null
			$finder_query = "SELECT * FROM stud_bsc_info WHERE stud_id_num = '$stud_id_num' OR mobile = '$mobile' ";
			$statement = $pdo_conn->prepare($finder_query);
			$statement->execute();
			$row_count = $statement->fetch();
			if ($row_count > 0) {
				echo "Student ID "."<span class = 'badge badge-warning'>".$_POST['stud_id_num']."</span> "."or "."<span class='badge badge-warning'>".$_POST['mobile']."</span>"." already exist.";	
			}else{
					$profile_image = '';
					if($_FILES["profile_image"]["name"] != ''){
						$profile_image = upload_image();
					}
				$query_sbi = "INSERT INTO `stud_bsc_info`(`user_id`, `stud_id_num`, `stud_name`, `email`, `mobile`, `faculty_id`, `department_id`, `program_id`, `batch`, `gender`,`bld_grp`,`dob`, `reg_time`, `reg_date`, `profile_image`) VALUES (:user_id,:stud_id_num,:stud_name,:email,:mobile,:faculty_id,:department_id,:program_id,:batch,:gender,:bld_grp,:dob,:reg_time,:reg_date,:profile_image)";
				$query_sai = "INSERT INTO `stud_ape_info`(`stud_id`, `user_id`, `ad_form_num`, `waiver_perctg`, `ad_semester`, `ad_semester_y`, `stud_status`, `sibling_id`, `nid`, `brth_regst_num`, `marital_sts`, `prst_addr`, `per_addr`, `citizenship`, `father_nm`, `father_occpt`, `mother_nm`, `mother_occpt`, `gardn_mobile`, `ssc_exm_deg_tle`, `ssc_con_mjr_grp`, `ssc_board`, `ssc_institue`, `ssc_roll`, `ssc_registration`, `ssc_y_passing`, `ssc_result`, `hsc_exm_deg_tle`, `hsc_con_mjr_grp`, `hsc_board`, `hsc_institue`, `hsc_roll`, `hsc_registration`, `hsc_y_passing`, `hsc_result`) VALUES (LAST_INSERT_ID(),:user_id,:ad_form_num,:waiver_perctg,:ad_semester,:ad_semester_y,:stud_status,:sibling_id,:nid,:brth_regst_num,:marital_sts,:prst_addr,:per_addr,:citizenship,:father_nm,:father_occpt,:mother_nm,:mother_occpt,:gardn_mobile,:ssc_exm_deg_tle,:ssc_con_mjr_grp,:ssc_board,:ssc_institue,:ssc_roll,:ssc_registration,:ssc_y_passing,:ssc_result,:hsc_exm_deg_tle,:hsc_con_mjr_grp,:hsc_board,:hsc_institue,:hsc_roll,:hsc_registration,:hsc_y_passing,:hsc_result)";
					$statement = $pdo_conn->prepare($query_sbi);
					$statement_sai = $pdo_conn->prepare($query_sai);
					$statement->execute(array(
					':user_id' => $_SESSION["user_id"],
					':stud_id_num'=>$_POST['stud_id_num'],
					':stud_name'=>$_POST['stud_name'],
					':email'=>$_POST['email'],
					':mobile'=>$_POST['mobile'],
					':faculty_id'=>$_POST['faculty_id'],
					':department_id'=>$_POST['department_id'],
					':program_id'=>$_POST['program_id'],
					':batch'=>$_POST['batch'],
					':gender'=>$_POST['gender'],
					':bld_grp'=>$_POST['bld_grp'],
					':dob'=>$_POST['dob'],
					':reg_time'=>$time,
					':reg_date'=>$date,
					':profile_image'=>$profile_image
				));
				$statement_sai->execute(array(
					':user_id' => $_SESSION["user_id"],
					':ad_form_num'=>$_POST['ad_form_num'],
					':waiver_perctg'=>$_POST['waiver_perctg'],
					':ad_semester'=>$_POST['ad_semester'],
					':ad_semester_y'=>$_POST['ad_semester_y'],
					':stud_status'=>$_POST['stud_status'],
					':sibling_id'=>$_POST['sibling_id'],
					':nid'=>$_POST['nid'],
					':brth_regst_num'=>$_POST['brth_regst_num'],
					':marital_sts'=>$_POST['marital_sts'],
					':prst_addr'=>$_POST['prst_addr'],
					':per_addr'=>$_POST['per_addr'],
					':citizenship'=>$_POST['citizenship'],
					':father_nm'=>$_POST['father_nm'],
					':father_occpt'=>$_POST['father_occpt'],
					':mother_nm'=>$_POST['mother_nm'],
					':mother_occpt'=>$_POST['mother_occpt'],
					':gardn_mobile'=>$_POST['gardn_mobile'],
					':ssc_exm_deg_tle'=>$_POST['ssc_exm_deg_tle'],
					':ssc_con_mjr_grp'=>$_POST['ssc_con_mjr_grp'],
					':ssc_board'=>$_POST['ssc_board'],
					':ssc_institue'=>$_POST['ssc_institue'],
					':ssc_roll'=>$_POST['ssc_roll'],
					':ssc_registration'=>$_POST['ssc_registration'],
					':ssc_y_passing'=>$_POST['ssc_y_passing'],
					':ssc_result'=>$_POST['ssc_result'],
					':hsc_exm_deg_tle'=>$_POST['hsc_exm_deg_tle'],
					':hsc_con_mjr_grp'=>$_POST['hsc_con_mjr_grp'],
					':hsc_board'=>$_POST['hsc_board'],
					':hsc_institue'=>$_POST['hsc_institue'],
					':hsc_roll'=>$_POST['hsc_roll'],
					':hsc_registration'=>$_POST['hsc_registration'],
					':hsc_y_passing'=>$_POST['hsc_y_passing'],
					':hsc_result'=>$_POST['hsc_result']
				));	
				$result = $statement->fetchAll();
				if (isset($result)) {
					echo "Student Information has been saved successfully.";
				}
			}
		}
				//Fetch Data from DB in Modal
		if ($_POST['action_hidden']=='fetch_single') {
			$query = "SELECT * FROM stud_bsc_info INNER JOIN stud_ape_info ON stud_ape_info.stud_id = stud_bsc_info.stud_id WHERE stud_bsc_info.stud_id = :stud_id LIMIT 1";
			$statement = $pdo_conn->prepare($query);
			$statement->execute(
				array(':stud_id' => $_POST['stud_id'])
			);
			$result = $statement->fetchAll();
			foreach ($result as $row) {
				$output['stud_id_num'] = $row['stud_id_num'];
				$output['stud_name'] = $row['stud_name'];
				$output['email'] = $row['email'];
				$output['mobile'] = $row['mobile'];
				$output['faculty_id'] = $row['faculty_id'];
				$output['department_id'] = $row['department_id'];
				$output["department_select_box"] = fill_department_list($pdo_conn, $row["faculty_id"]);
				$output['program_id'] = $row['program_id'];
				$output["program_select_box"] = fill_program_list($pdo_conn, $row["department_id"]);	
				$output['batch'] = $row['batch'];			
				$output['gender'] = $row['gender'];			
				$output['bld_grp'] = $row['bld_grp'];					
				$output['dob'] = $row['dob'];						
				if($row["profile_image"] != '')
				{
					$output['image_view'] = '<img src="img/stud_image/'.$row["profile_image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_profile_image" value="'.$row["profile_image"].'" />';
				}
				else
				{
					$output['image_view'] = '<input type="hidden" name="hidden_profile_image" value="" />';
				}						
				$output['profile_image'] = $row['profile_image'];			
				$output['ad_form_num'] = $row['ad_form_num'];			
				$output['waiver_perctg'] = $row['waiver_perctg'];			
				$output['ad_semester'] = $row['ad_semester'];			
				$output['ad_semester_y'] = $row['ad_semester_y'];			
				$output['stud_status'] = $row['stud_status'];			
				$output['sibling_id'] = $row['sibling_id'];			
				$output['nid'] = $row['nid'];			
				$output['brth_regst_num'] = $row['brth_regst_num'];			
				$output['marital_sts'] = $row['marital_sts'];			
				$output['prst_addr'] = $row['prst_addr'];			
				$output['per_addr'] = $row['per_addr'];			
				$output['citizenship'] = $row['citizenship'];			
				$output['father_nm'] = $row['father_nm'];			
				$output['father_occpt'] = $row['father_occpt'];			
				$output['mother_nm'] = $row['mother_nm'];			
				$output['mother_occpt'] = $row['mother_occpt'];			
				$output['gardn_mobile'] = $row['gardn_mobile'];			
				$output['ssc_exm_deg_tle'] = $row['ssc_exm_deg_tle'];			
				$output['ssc_con_mjr_grp'] = $row['ssc_con_mjr_grp'];			
				$output['ssc_board'] = $row['ssc_board'];			
				$output['ssc_institue'] = $row['ssc_institue'];			
				$output['ssc_roll'] = $row['ssc_roll'];			
				$output['ssc_registration'] = $row['ssc_registration'];			
				$output['ssc_y_passing'] = $row['ssc_y_passing'];			
				$output['ssc_result'] = $row['ssc_result'];			
				$output['hsc_exm_deg_tle'] = $row['hsc_exm_deg_tle'];			
				$output['hsc_con_mjr_grp'] = $row['hsc_con_mjr_grp'];			
				$output['hsc_board'] = $row['hsc_board'];			
				$output['hsc_institue'] = $row['hsc_institue'];			
				$output['hsc_roll'] = $row['hsc_roll'];			
				$output['hsc_registration'] = $row['hsc_registration'];			
				$output['hsc_y_passing'] = $row['hsc_y_passing'];			
				$output['hsc_result'] = $row['hsc_result'];	
					
			}
			echo json_encode($output);
		}
//Update Data from Database
      if ($_POST['action_hidden'] == 'Edit') {
		$profile_image = '';
		if($_FILES["profile_image"]["name"] != '')
		{
			
			if ($_POST['stud_id']) {
				$query = "SELECT * FROM stud_bsc_info WHERE stud_bsc_info.stud_id = :stud_id LIMIT 1";
				$statement = $pdo_conn->prepare($query);
				$statement->execute(
					array(':stud_id' => $_POST['stud_id'])
				);
				$result = $statement->fetchAll();
				foreach ($result as $row) {
					$filename = 'img/stud_image/'.$row['profile_image'].'';	
					if (file_exists($filename) == true) {
						unlink($filename);
						$profile_image = upload_image();
					}else{
						$profile_image = upload_image();
					}
										
				}
			}
		}
		else
		{
			$profile_image = $_POST["hidden_profile_image"];
		}      	
      $query = "UPDATE `stud_bsc_info` INNER JOIN stud_ape_info ON stud_ape_info.stud_id = stud_bsc_info.stud_id SET stud_bsc_info.user_id=:user_id,stud_bsc_info.stud_id_num=:stud_id_num,stud_bsc_info.stud_name=:stud_name,stud_bsc_info.email=:email,stud_bsc_info.mobile=:mobile,stud_bsc_info.faculty_id=:faculty_id,stud_bsc_info.department_id=:department_id,stud_bsc_info.program_id=:program_id,stud_bsc_info.batch=:batch,stud_bsc_info.gender=:gender,stud_bsc_info.bld_grp=:bld_grp,stud_bsc_info.dob=:dob,stud_bsc_info.profile_image = :profile_image, stud_bsc_info.reg_time=:reg_time,stud_bsc_info.reg_date=:reg_date, stud_ape_info.ad_form_num =:ad_form_num,stud_ape_info.waiver_perctg = :waiver_perctg, stud_ape_info.ad_semester = :ad_semester,stud_ape_info.ad_semester_y = :ad_semester_y, stud_ape_info.stud_status = :stud_status, stud_ape_info.sibling_id = :sibling_id,stud_ape_info.nid = :nid,stud_ape_info.brth_regst_num = :brth_regst_num,stud_ape_info.marital_sts = :marital_sts, stud_ape_info.prst_addr = :prst_addr, stud_ape_info.per_addr = :per_addr, stud_ape_info.citizenship = :citizenship,stud_ape_info.father_nm = :father_nm, stud_ape_info.father_occpt = :father_occpt, stud_ape_info.mother_nm = :mother_nm, stud_ape_info.mother_occpt = :mother_occpt, stud_ape_info.gardn_mobile = :gardn_mobile,stud_ape_info.ssc_exm_deg_tle = :ssc_exm_deg_tle,stud_ape_info.ssc_con_mjr_grp = :ssc_con_mjr_grp, stud_ape_info.ssc_board = :ssc_board, stud_ape_info.ssc_institue = :ssc_institue, stud_ape_info.ssc_roll = :ssc_roll, stud_ape_info.ssc_registration = :ssc_registration, stud_ape_info.ssc_y_passing = :ssc_y_passing, stud_ape_info.ssc_result = :ssc_result,stud_ape_info.hsc_exm_deg_tle = :hsc_exm_deg_tle, stud_ape_info.hsc_con_mjr_grp = :hsc_con_mjr_grp, stud_ape_info.hsc_board = :hsc_board, stud_ape_info.hsc_institue = :hsc_institue, stud_ape_info.hsc_roll = :hsc_roll, stud_ape_info.hsc_registration = :hsc_registration, stud_ape_info.hsc_y_passing = :hsc_y_passing, stud_ape_info.hsc_result = :hsc_result WHERE stud_bsc_info.stud_id=:stud_id";
      $statement = $pdo_conn->prepare($query);
      $statement->execute(
         array(
         ':stud_id' => $_POST['stud_id'],
          ':user_id' => $_SESSION['user_id'],
          ':stud_id_num' => $_POST['stud_id_num'],
          ':stud_name' => $_POST['stud_name'],
          ':email' => $_POST['email'],
          ':mobile' => $_POST['mobile'],
          ':faculty_id' => $_POST['faculty_id'],
          ':department_id' => $_POST['department_id'],
          ':program_id' => $_POST['program_id'],
          ':batch' => $_POST['batch'],
          ':gender' => $_POST['gender'],
          ':bld_grp' => $_POST['bld_grp'],
          ':dob' => $_POST['dob'],
          ':profile_image' => $profile_image,
		  ':reg_time'=>$time,
		  ':reg_date'=>$date,
		  ':ad_form_num' => $_POST['ad_form_num'],
		  ':waiver_perctg' => $_POST['waiver_perctg'],
		  ':ad_semester' => $_POST['ad_semester'],
		  ':ad_semester_y' => $_POST['ad_semester_y'],
		  ':stud_status' => $_POST['stud_status'],
		  ':sibling_id' => $_POST['sibling_id'],
		  ':nid' => $_POST['nid'],
		  ':brth_regst_num' => $_POST['brth_regst_num'],
		  ':marital_sts' => $_POST['marital_sts'],
		  ':prst_addr' => $_POST['prst_addr'],
		  ':per_addr' => $_POST['per_addr'],
		  ':citizenship' => $_POST['citizenship'],
		  ':father_nm' => $_POST['father_nm'],
		  ':father_occpt' => $_POST['father_occpt'],
		  ':mother_nm' => $_POST['mother_nm'],
		  ':mother_occpt' => $_POST['mother_occpt'],
		  ':gardn_mobile' => $_POST['gardn_mobile'],
		  ':ssc_exm_deg_tle' => $_POST['ssc_exm_deg_tle'],
		  ':ssc_con_mjr_grp' => $_POST['ssc_con_mjr_grp'],
		  ':ssc_board' => $_POST['ssc_board'],
		  ':ssc_institue' => $_POST['ssc_institue'],
		  ':ssc_roll' => $_POST['ssc_roll'],
		  ':ssc_registration' => $_POST['ssc_registration'],
		  ':ssc_y_passing' => $_POST['ssc_y_passing'],
		  ':ssc_result' => $_POST['ssc_result'],
		  ':hsc_exm_deg_tle' => $_POST['hsc_exm_deg_tle'],
		  ':hsc_con_mjr_grp' => $_POST['hsc_con_mjr_grp'],
		  ':hsc_board' => $_POST['hsc_board'],
		  ':hsc_institue' => $_POST['hsc_institue'],
		  ':hsc_roll' => $_POST['hsc_roll'],
		  ':hsc_registration' => $_POST['hsc_registration'],
		  ':hsc_y_passing' => $_POST['hsc_y_passing'],
		  ':hsc_result' => $_POST['hsc_result']
       ));
      $result = $statement->fetchAll();
      if (isset($result)) {
        echo "Student Information has been edited.";
      		}
    	} 		
	}
?>
