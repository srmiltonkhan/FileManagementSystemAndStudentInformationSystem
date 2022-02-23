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
              <h2 class="no-margin-bottom">Change Password</h2>
            </div>
          </header>

          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <!-- Alert Section -->     
              <p id="alert_action" class="mb-0"></p>     
              <!-- Table Section -->
               <div class="row border">
                <div class="col p-1" >Change Password</div>
                <div class="col p-1" align="right">
                </div>
               </div>
              <div class=" bg-light border border-top-0 p-5">
                  <form method="post" id="change_password_form">
                    <div class="form-group">
                      <label>Enter Password</label>
                      <input type="password" name="user_password" id="user_password" class="form-control" />
                      <div id="invalid_feedback_user_password" class="reset_label"></div>
                  </div>
                  <div class="form-group">
                      <label>Enter Confirm Password</label>
                      <input type="password" name="confirm_user_password" id="confirm_user_password" class="form-control" />
                  <div id="invalid_feedback_confirm_user_password" class="reset_label"></div>    
                  </div>
                  <br />
                  <div class="form-group" align="center">
                    <input type="hidden" name="page" value="change_password" />
                    <input type="hidden" name="action" value="change_password" />
                    <input type="submit" name="user_password" id="user_password" class="btn btn-info" value="Change" />
                  </div>
                  </form>
              </div>
            </div>
          </section>
          <!-- end Page Side Navbar Content Inner and Page Footer Section-->
    <?php echo $end_page_sidenav_content_footer_section; ?>
    <!-- End Body and HTML TaqJavaScript Section-->
    <?php echo $end_body_html_and_java_script_section; ?>
<script>
$(document).ready(function(){
    $(document).on('submit','#change_password_form',function(event){
        event.preventDefault();

  var user_password = $('#user_password').val();
  var confirm_user_password = $('#confirm_user_password').val();

  if (user_password == '') {
    $('#invalid_feedback_user_password').html('Please Enter New Password.').css('color','red');
  }else if(confirm_user_password == ''){
    $('#invalid_feedback_confirm_user_password').html('Please Enter New Confirm Password.').css('color','red');
  }else if(user_password != confirm_user_password){
    $('#invalid_feedback_confirm_user_password').html("Password doesn't match.").css('color','red');
  }else{
        var form_data = $(this).serialize();
          $.ajax({
          url:"change_password_update.php",
          method: "POST",
          data: form_data,
          success:function(data){
            $('#change_password_form')[0].reset();
            $('.reset_label').empty();
            $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
            alert("Password has been changed. Please login again.");
            location.reload(true);
          }
        });
  }
  });

});
</script>
