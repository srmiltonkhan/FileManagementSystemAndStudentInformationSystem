<!-- file_mgt -->
<?php 
  include("db_connection.php");
  if (!isset($_SESSION['type'])) {
    header("location:index.php");
  }
?>
<?php require 'function.php';?>
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
              <h2 class="no-margin-bottom">Sub Category Information</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <!-- Alert Section -->     
              <p id="alert_action" class="mb-0"></p>     
              <!-- Table Section -->
               <div class="row border">
                <div class="col p-1" >Sub Category List</div>
                <div class="col p-1" align="right">
                  <button class="btn btn-primary btn-sm launch-modal" data-toggle="modal" data-target="#sub_cat_modal" id="add_button"><i class="fas fa-plus-square"></i> Add</button>
                </div>
               </div>
              <div class="row bg-light border border-top-0 p-2">
                  <div class="table-responsive">
                    <table id="sub_cat_mgt_dtable" class="table table-bordered table-hover table-striped table-sm">
                      <thead class="thead-dark">
                        <tr>
                          <th>SL</th>
                          <th>Sub-Category</th>
                          <th>Category</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
               </div>
            </div>          
          </section> 
            <div class="modal fade" id="sub_cat_modal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h6 class="modal-title"></h6>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                          <form method="post" id="sub_cat_mgt_form" enctype="multipart/form-data">
                          <div class="modal-body">
                                <div class="row p-1">
                                  <label class="col-sm-3" align = "right">Category: </label>
                                  <div class="col-sm-9">
                                     <select id="file_cat_id" name="file_cat_id" class="form-control form-control-sm" required>
                                        <option value="">Select File Category</option>
                                        <?php echo fill_file_category_list($pdo_conn);?>
                                     </select> 
                                  </div>
                                </div>
                                <div class="row p-1">
                                  <label class="col-sm-3" align="right">Sub-Category:</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="file_sub_cat_name" id="file_sub_cat_name" class="form-control form-control-sm" autocomplete="off" maxlength="70" required>
                                  </div>
                                </div>                                                                                                  
                            </div>                                                                                                          
                            <div class="modal-footer">
                            <input type="hidden" name="file_sub_cat_id" id="file_sub_cat_id" >
                            <input type="hidden" name="action_hidden" id="action_hidden">
                            <input type="submit" name="action_submit" id="action_submit"  class="btn btn-primary btn-sm mb-0">
                            <button type="button" class="btn btn-info btn-sm mb-0" class="close" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                </div>
            </div>
          </div> 
          <!-- end Page Side Navbar Content Inner and Page Footer Section-->
    <?php echo $end_page_sidenav_content_footer_section; ?>
    <!-- End Body and HTML TaqJavaScript Section-->
    <?php echo $end_body_html_and_java_script_section; ?>
<script>
  $(document).ready(function(){
        $("#add_button").click(function(){
        $('.modal-title').html("Add Sub Category");
        $('#sub_cat_mgt_form')[0].reset();
        $('#action_hidden').val('Add')
        $('#action_submit').val('Save')
        $('#alert_action').empty();
      });
    $(document).on('submit','#sub_cat_mgt_form',function(event){
       event.preventDefault();
             $.ajax({
            url:"file_sub_cat_mgt_action.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){
              $('#sub_cat_modal').modal("hide");
              $('#alert_action').fadeIn().html('<div class = "alert alert-success">'+data+'</div>');
              dataTable.ajax.reload(); 
            }
          });      
    });
 // fetch data from database
    var dataTable = $('#sub_cat_mgt_dtable').DataTable({
     "processing" : true,
     "serverSide" : true,
     "order": [[ 0, "desc" ]],
     "ajax" : {
      url:"file_sub_cat_mgt_fetch.php",
      type:"POST"   
     },
     "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    }); 
 // Update Section
 $(document).on('click', '.update', function(){
  var file_sub_cat_id = $(this).attr("id");
  var action_hidden = 'fetch_single';
  $.ajax({
   url:"file_sub_cat_mgt_action.php",
   method:"POST",
   data:{file_sub_cat_id:file_sub_cat_id, action_hidden:action_hidden},
   dataType:"json",
   success:function(data)
   {
    $('#sub_cat_modal').modal('show');
    $('.modal-title').html("Edit Sub Category Information");    
    $('#file_cat_id').val(data.file_cat_id);
    $('#file_sub_cat_name').val(data.file_sub_cat_name);
    $('#file_sub_cat_id').val(file_sub_cat_id);
    $('#action_submit').val('Edit');
    $('#action_hidden').val("Edit");
    $('#alert_action').empty();
   }
  })
 });         
  });

</script>
