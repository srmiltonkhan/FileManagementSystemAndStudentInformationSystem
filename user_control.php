<?php 
  include("db_connection.php");
  if (!isset($_SESSION['type'])) {
    header("location:index.php");
  }
?>
<!-- Add Dashboard Parent File -->
<?php require 'dashboard_parent_file.php';?>
 <!-- HTML and Head Taq Section -->
<?php echo $html_and_head_section; ?>
      <!-- Body and Header Section -->
       <?php echo $body_and_header_section_start; ?>
    <!-- Navigation Menu Bar -->
    <?php include("navigation_bar_menu.php"); ?>
    <?php echo $body_and_header_section_end; ?>
      <!-- Side Navbar Section -->
    <?php echo $side_nabar_and_content_inner_section; ?>
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">User Information</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <!-- Alert Section -->     
              <p id="alert_action" class="mb-0"></p>     
              <!-- Table Section -->
               <div class="row border">
                <div class="col p-1" >User List</div>
                <div class="col p-1" align="right">
                  <button class="btn btn-primary btn-sm launch-modal" data-toggle="modal" data-target="#user_modal" id="add_button"><i class="fas fa-plus-square"></i> Add User</button>
                </div>
               </div>
              <div class="row bg-light border border-top-0 p-2">
                  <div class="table-responsive">
                    <table id="user_data_table" class="table table-bordered table-hover table-striped table-sm">
                      <thead class="thead-dark">
                        <tr>
                          <th>User ID</th>
                          <th>Image</th>
                          <th>User Name</th>
                          <th>Email</th>
                          <th>Mobile Number</th>
                          <th>Department Name</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
               </div>
            </div>
            <div class="modal fade" id="user_modal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                        
                            <div class="modal-header">
                              <h6 class="modal-title"></h6>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form method="post" id="user_form" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-row p-1">
                                  <div class="col">
                                    <label for="user_id_num">User ID Number</label>
                                    <input type="text" name="user_id_num" id="user_id_num" class="form-control form-control-sm" pattern="^[0-9]{2,13}$" title="Student ID Only 13 digits are allowed">
                                    <div id="invalid_feedback_user_id_num" class="text-danger reset_label"></div>
                                  </div>
                                </div> 
                                 <div class="form-row p-1">
                                  <div class="col">
                                    <label for="user_name">User Name</label>
                                    <input type="text" name="user_name" id="user_name" class="form-control form-control-sm">
                                    <div id="invalid_feedback_user_name" class="text-danger reset_label"></div>
                                  </div>
                                </div>   
                              <div class="form-row p-1">
                                <div class="col">
                                  <label for="user_email">User Email</label>
                                  <input type="email" name="user_email" id="user_email" class="form-control form-control-sm">
                                  <div id="invalid_feedback_user_email" class="text-danger reset_label"></div>
                                </div>
                                <div class="col">
                                  <label for="user_mobile">User Mobile</label>
                                  <input type="text" name="user_mobile" id="user_mobile" class="form-control form-control-sm">
                                  <div id="invalid_feedback_user_mobile" class="text-danger reset_label"></div>
                                </div>
                              </div>   
                              <div class="form-row p-1">
                                <div class="col">
                                <label for="user_department">Department Name<span class="text-red">*</span></label>
                                <select name="user_department" id="user_department" class="form-control form-control-sm selectpicker border" data-size = '5' data-live-search="true">
                                    <?php include("department_select_option_data.php");?>
                                </select>
                                <div id="invalid_feedback_user_department" class="text-danger reset_label"></div>
                                </div>
                                <div class="col">
                                  <label for="user_designation">User Designation</label>
                                  <input type="text" name="user_designation" id="user_designation" class="form-control form-control-sm">
                                  <div id="invalid_feedback_user_designation" class="text-danger reset_label"></div>
                                </div>
                              </div> 
                              <div class="form-row p-1">
                              <div class="col">
                                <label for='user_password'>Password <span class="text-red">*</span></label>
                                <input type="password" name="user_password" id="user_password" class="form-control form-control-sm" minlength="8" maxlength="50">
                                <div id="invalid_feedback_user_password" class="text-danger reset_label"></div>
                              </div>
                                <div class="col">
                                  <label for='user_confirm_password'>Confirm Password <span class="text-red">*</span></label>
                                  <input type="password" name="user_confirm_password" id="user_confirm_password" class="form-control form-control-sm">
                                  <div id="invalid_feedback_user_confirm_password" class="text-danger reset_label"></div>
                                  <div id="invalid_feedback_password_match" class="reset_label"></div>
                                </div>
                              </div> 
                              <div class="form-row p-1">
                                <div class="col">
                                  <label for="user_type">User Type</label>
                                  <select name="user_type" id="user_type" class="form-control form-control-sm">
                                    <option value="">Please Select User Type</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Standard User">Standard User</option>
                                    <option value="End User">End User</option>
                                  </select>
                                  <div id="invalid_feedback_user_type" class="text-danger reset_label"></div>
                                </div>
                              </div>
                               <div class="form-row p-1">
                                <div class="col-md-6">
                                    <label for='user_image'>Profile Image<span class="text-red">*</span></label>
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control-sm" id="user_image" name="user_image" maxlength="50" onchange="loadFile(event)"style="cursor: pointer;">
                                    <label class="custom-file-label" id="user_image" name="user_image" for="customFile" class="reset_label" style="cursor: pointer;">Choose Image File</label>
                                    <div id="invalid_feedback_user_image" class="text-danger reset_label mt-2"></div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                   <img id="user_uploaded_image" width="100" height="100" class="img-thumbnail" />
                                </div>
                                 <script type="text/javascript">
                                    $(".custom-file-input").on("change",function(){
                                      var user_image = $(this).val().split("\\").pop();
                                      $(this).siblings(".custom-file-label").addClass("selected").html(user_image)
                                    });
                                    var loadFile = function(event) {
                                      var image = document.getElementById('user_uploaded_image');
                                      image.src = URL.createObjectURL(event.target.files[0]);
                                    };
                                  </script>                                
                              </div>                                                                                        
                            </div>                            
                              <div class="modal-footer">
                              <input type="hidden" name="user_id" id="user_id" >
                              <input type="hidden" name="action_hidden" id="action_hidden" >
                              <input type="submit" name="action_submit" id="action_submit" value="Save" class="btn btn-primary btn-sm mb-0">
                              <button type="button" class="btn btn-info btn-sm mb-0" class="close" data-dismiss="modal" id="close_btn_category">Close</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
          </section>
        <div id="user_view_modal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <form method="post" id="user_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">User Information</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <Div id="user_details_data"></Div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>      
          <!-- end Page Side Navbar Content Inner and Page Footer Section-->
    <?php echo $end_page_sidenav_content_footer_section; ?>
    <!-- End Body and HTML TaqJavaScript Section-->
    <?php echo $end_body_html_and_java_script_section; ?>
<script>
  $(document).ready(function(){
    $('#add_button').click(function(){
      $('.modal-title').html('Add User Information');
      $('#user_form')[0].reset();
      $('#alert_action').empty();
      $('#action_hidden').val('Add');
      $('#action_submit').val('Save');
      $('#user_department').selectpicker("refresh");
      $('.reset_label').empty();
      $('.custom-file-label').html('');
      $("#user_uploaded_image").attr('src', '');
    });
  //Password Matched verification
  $("#user_confirm_password").keyup(function(){
      if ($("#user_password").val() != $("#user_confirm_password").val()) {
        $("#invalid_feedback_password_match").html("Password doesn't match").css("color","red");
      }else{
        $("#invalid_feedback_password_match").html("Password has been matched").css("color","green");
      }
    });
     // insert data into Database
        $(document).on('submit','#user_form',function(event){
        event.preventDefault(); 
        var user_id_num = $('#user_id_num').val();
        var user_name = $('#user_name').val();
        var user_email = $('#user_email').val();
        var user_mobile = $('#user_mobile').val();
        var user_department = $('#user_department').val();
        var user_designation = $('#user_designation').val();
        var user_password = $('#user_password').val();
        var user_confirm_password = $('#user_confirm_password').val();
        var user_type = $('#user_type').val();
        var user_image = $('#user_image').val();
        var extension = $('#user_image').val().split('.').pop().toLowerCase();
        // var file_sizes = $('#user_image')[0].files[0].size;
        if (user_id_num == '') {
          $('#invalid_feedback_user_id_num').html('Please Enter User Id Number.').css("color","red");
        }else if (user_name == '') {
          $('#invalid_feedback_user_name').html('Please Enter User Name.').css("color","red");
          $('#invalid_feedback_user_id_num').empty();
      }else if (user_email == '') {
        $('#invalid_feedback_user_email').html('Please Enter User Email Address.').css("color","red");
        $('#invalid_feedback_user_name').empty();
      }else if (user_mobile == '') {
        $('#invalid_feedback_user_mobile').html('Please Enter User Mobile Number.').css("color","red");
        $('#invalid_feedback_user_email').empty();
      }else if (user_department == '') {
        $('#invalid_feedback_user_department').html('Please Select User Department Name.').css("color","red");
        $('#invalid_feedback_user_mobile').empty();
      }else if (user_designation == '') {
        $('#invalid_feedback_user_designation').html('Please Enter User Designation.').css("color","red");
        $('#invalid_feedback_user_department').empty();
      }else if (user_password == '') {
        $('#invalid_feedback_user_password').html('Please Enter User Password.').css("color","red");
        $('#invalid_feedback_user_designation').empty();
      }else if (user_confirm_password == '') {
        $('#invalid_feedback_user_confirm_password').html('Please Enter User Confirm Password.').css("color","red");
        $('#invalid_feedback_user_password').empty();
      }else if (user_password != user_confirm_password) {
        $('#invalid_feedback_password_match').html("Password doesn't match.").css("color","red");
      }else if (user_type == '') {
        $('#invalid_feedback_user_type').html('Please Select User Type.').css("color","red");
        $('#invalid_feedback_user_confirm_password').empty();
      }else if (user_image == '') {
        $('#invalid_feedback_user_image').html('Please Choose User Image.').css("color","red");
        $('#invalid_feedback_user_type').empty();
      }else if (jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1) {
        $('#invalid_feedback_user_image').html('Please Choose Valid Profile Image.').css("color","red");
      }
      // else if (file_sizes => 30721) {
      //       $("#invalid_feedback_user_image").html("File size is greater than 15 KB").css("color","red");
      // }
      else{
          $.ajax({
            url:"user_control_action.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){
              $('#user_modal').modal("hide");
              $('#alert_action').fadeIn().html('<div class = "alert alert-success">'+data+'</div>'); 
              $('#invalid_feedback_user_image').empty(); 
              dataTable.ajax.reload();
            }
          });
     }
      });
// fetch data from database
    var dataTable = $('#user_data_table').DataTable({
     "processing" : true,
     "serverSide" : true,
     "order": [[ 0, "desc" ]],
     "ajax" : {
      url:"user_control_fetch.php",
      type:"POST"   
     },
     "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    }); 
 // view data from Database 
      $(document).on('click', '.view', function(){
          var user_id = $(this).attr("id");
          var btn_action = 'btn_user_details';
          $.ajax({
              url:"user_control_view_&_active_inactive.php",
              method:"POST",
              data:{user_id:user_id, btn_action:btn_action},
              success:function(data){
                  $('#user_view_modal').modal('show');
                  $('#user_details_data').html(data);
              }
          })
      });

   // Category delete Section
      $(document).on('click', '.btn_active_inactive', function(){
      var user_id = $(this).attr('id');
      var status = $(this).data("status");
      var btn_action = 'active_inactive';
      if(confirm("Are you sure you want to active this account?")){
         $.ajax({
          url:"user_control_view_&_active_inactive.php",
          method:"POST",
          data:{user_id:user_id, status:status, btn_action:btn_action},
          success:function(data){
            $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
             dataTable.ajax.reload();
          }
         })
      }
      else{
       return false;
      }
     });            
  });
    //Update section  
 $(document).on('click', '.update', function(){
  var user_id = $(this).attr("id");
  var action_hidden = 'fetch_single';
  $.ajax({
   url:"user_control_action.php",
   method:"POST",
   data:{user_id:user_id, action_hidden:action_hidden},
   dataType:"json",
   success:function(data)
   {
    $('#user_modal').modal('show');
    $('.modal-title').html("Edit User Information");    
    $('#user_id_num').val(data.user_id_num);
    // $('#user_name').val(data.user_name);
    // $('#user_email').val(data.user_email);
    // $('#user_mobile').val(data.user_mobile);
    // $('#user_department').val(data.user_department);
    // $('#user_designation').val(data.user_designation);
    // $('#user_password').val(data.user_password);
    // $('#user_type').val(data.user_type);
    // $('#user_image').val(data.user_image);
    $('#user_id').val(user_id);
    $('#action_submit').val('Edit');
    $('#action_hidden').val("Edit");
    $('#alert_action').empty();
   }
  });
 });
</script>
