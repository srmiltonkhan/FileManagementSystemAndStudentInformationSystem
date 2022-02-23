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
              <h2 class="no-margin-bottom">File Information</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <!-- Alert Section -->     
              <p id="alert_action" class="mb-0"></p>     
              <!-- Table Section -->
               <div class="row border">
                <div class="col p-1" >File List</div>
                <div class="col p-1" align="right">
                <button class="btn btn-primary btn-sm launch-modal" data-toggle="modal" data-target="#file_mgt_modal" id="add_button"><i class="fas fa-plus-square"></i> Add File</button>
                </div>
               </div>
              <div class="row bg-light border border-top-0 p-2">
                  <div class="table-responsive">
                    <table id="file_data_table" class="table table-bordered table-hover table-striped table-sm" >
                      <thead class="thead-dark">
                        <tr>
                          <th>SL</th>
                          <th>File ID</th>
                          <th>File Name</th>
                          <th>Category</th>
                          <th>Sub-Catg</th>
                          <th>Sup-Catg</th>
                          <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
               </div>
            </div>                
          </section> 
<div class="modal fade" id="file_mgt_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
           <h6 class="modal-title"></h6>
           <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
         </div>
        <form method="post" id="file_mgt_form" enctype="multipart/form-data">
           <div class="modal-body">
               <div class="row p-1">
                  <label class="col-sm-3" align="right">File ID:</label>
                  <div class="col-sm-9">
                    <input type="text" name="file_id_num" id="file_id_num" class="form-control form-control-sm" autocomplete="off" required>
                  </div>
               </div> 
               <div class="row p-1">
                  <label class="col-sm-3" align="right">Category:</label>
                  <div class="col-sm-9">
                    <select name="file_cat_id" id="file_cat_id" class="form-control form-control-sm" required>
                      <option value="">Please Choose Category</option>
                      <?php echo fill_file_category_list($pdo_conn);?>
                    </select>
                  </div>
               </div> 
               <div class="row p-1">
                  <label class="col-sm-3" align="right">Sub-Category:</label>
                  <div class="col-sm-9">
                    <select name="file_sub_cat_id" id="file_sub_cat_id" class="form-control form-control-sm" required>
                      <option value="">Select Sub-Category</option>
                    </select>
                  </div>
               </div>
               <div class="row p-1">
                  <label class="col-sm-3" align="right">Sup-Category:</label>
                  <div class="col-sm-9">
                    <select name="file_sup_cat_id" id="file_sup_cat_id" class="form-control form-control-sm" required>
                      <option value="">Select Sup-Category</option>
                    </select>
                  </div>
               </div> 
               <div class="row p-1">
                  <label class="col-sm-3" align="right">File Name:</label>
                  <div class="col-sm-9">
                    <input type="text" name="file_name" id="file_name" class="form-control form-control-sm" autocomplete="off" pattern="^[a-zA-Z\s].{1,100}" title="All characters are allowed, length should be 1-100 characters"  autocomplete="off" required>
                  </div>
               </div> 
                <div class="row p-1">
                  <label class="col-sm-3" align="right">File Name:</label>
                  <div class="col-sm-9">
                    <input type="file" name="upld_file" id="upld_file" class="form-control form-control-sm" required>
                  </div>
               </div>                                                                                     
           </div>
           <div class="modal-footer">
              <input type="hidden" name="file_id" id="file_id" >
              <input type="hidden" name="action_hidden" id="action_hidden">
              <input type="submit" name="action_submit" id="action_submit" class="btn btn-primary btn-sm">
              <button type="button" class="btn btn-info btn-sm mb-0" class="close" data-dismiss="modal" id="close">Close</button>        
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
//Retrive Data in Sub-category Dropdown
    $('#file_cat_id').change(function(){
        var file_cat_id = $('#file_cat_id').val();
        var btn_action_hidden = 'load_sub_category';
        $.ajax({
            url:"file_mgt_action.php",
            method:"POST",
            data:{file_cat_id:file_cat_id, btn_action_hidden:btn_action_hidden},
            success:function(data){
                $('#file_sub_cat_id').html(data);

            }
        });
    });
//Retrive Data in Sup-category Dropdown
$('#file_sub_cat_id').change(function(){
    var file_sub_cat_id = $('#file_sub_cat_id').val();
    var btn_action_hidden = 'load_sup_catgory';
    $.ajax({
        url:"file_mgt_action.php",
        method:"POST",
        data:{file_sub_cat_id:file_sub_cat_id, btn_action_hidden:btn_action_hidden},
        success:function(data){
            $('#file_sup_cat_id').html(data);

        }
    });
});  
$(document).ready(function(){
  $('#add_button').click(function(){
    $('.modal-title').html("Add File Information");
    $('#file_mgt_form')[0].reset();
    $('#action_hidden').val('Add');
    $('#action_submit').val('Save');
    $('#alert_action').empty();
  });
  //Insert Section
   $(document).on('submit','#file_mgt_form',function(event){
      event.preventDefault();
      $.ajax({
      url:"file_mgt_action.php",
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data){
        $('#file_mgt_modal').modal("hide");
        $('#alert_action').fadeIn().html('<div class = "alert alert-success">'+data+'</div>');
        dataTable.ajax.reload(); 
      }
    });             
  });
// fetch data from database
    var dataTable = $('#file_data_table').DataTable({
     "processing" : true,
     "serverSide" : true,
     "order": [[ 0, "desc" ]],
     "ajax" : {
      url:"file_mgt_fetch.php",
      type:"POST"   
     },
     "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });  
     //Update section  
     $(document).on('click', '.update', function(){
      var file_id = $(this).attr("id");
      var action_hidden = 'fetch_single';
      $.ajax({
       url:"file_mgt_action.php",
       method:"POST",
       data:{file_id:file_id, action_hidden:action_hidden},
       dataType:"json",
       success:function(data){
        $('#file_mgt_modal').modal('show');
        $('.modal-title').html("Edit File Information");    
        $('#file_id_num').val(data.file_id_num);
        $('#file_cat_id').val(data.file_cat_id);
        $('#file_sub_cat_id').html(data.sub_select_box); // html() should be before
        $('#file_sub_cat_id').val(data.file_sub_cat_id);
        $('#file_sup_cat_id').html(data.sup_select_box);// html() should be before
        $('#file_sup_cat_id').val(data.file_sup_cat_id);
        $('#file_name').val(data.file_name);
        $('#upld_file').html(data.upld_file);
        $('#file_id').val(file_id);
        $('#action_submit').val('Edit');
        $('#action_hidden').val("Edit");
        $('#alert_action').empty();
       }
      });
     });           
  });
</script>         
