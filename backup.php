<?php
echo '   <style>
  .panel-default{
    width: 20%;
    margin: 0 auto;
    }
</style>  
';
global $notesbk;
if (!defined("Myheader")) {
    header("Location: 404.html");
    exit("If File Not direct Access !");
}
$errs = "";
$emsg = "";
if (isset($_REQUEST["action"])) {
    if ($_REQUEST["action"] == "delete") {
        $eid = $_REQUEST["eid"];
     
        include "import.php";
    }
    if ($_REQUEST["action"] == "backup") {
        $notesbk = $_REQUEST["notes"];
        $dtime = date("d-m-Y") . "-" . date("H-i-s");
      mysqli_query($link,"insert into `bacup` (`notes`,`date`) values ('$notesbk','$dtime')") ;
        include "export.php";
    }
}
echo '        <section id="content">
          <section class="vbox">
           <header class="header bg-white b-b b-light">
            <div  style="width:50%;  float:left; margin-top: -11px;">
                <a href="#" class="block padder-v hover hidelink">
                              <span class="i-s i-s-3x pull-left m-r-sm">
                                <i class=" hover-rotate"></i>
                                <i class="fa fa-chevron-circle-right fa-1x text-info hover-rotate"></i> 
                              </span>
                           
                            <h3 class="font-thin">Backup - List</h3>
                              
                            </a></div>
               <div  style="width:50%; float:right; ">
                <h3 class="m-b-none" style="text-align:right;">
          <input type="text" id="notes" value="" placeholder="type backup Notes" >
          <a href="#" onClick="backups();" class="btn btn-s-md btn-info btn-rounded hidelink"><i class="fa fa-css3"></i> Backup Now</a></h3>
              </div>
        </header>
            <section class="scrollable padder">
     
              <section class="panel panel-default" style="width: 50%;">
                ';
if ($emsg != "") {
    echo '<div class="alert ';
    echo $errs;
    echo '">
  <a class="close" data-dismiss="danger">Ã—</a>
  <strong>';
    echo $emsg;
    echo '</strong>.
      ';
}
echo '    
               
                
                
                </div>
      
                <div class="table-responsive">
                     
                 <button type="button" id="closeButton" >x</button>
                <table width="100%" class="table table-striped m-b-none" id="tax-grid">
                    <thead>
                      <tr>
                        <th>No</th>
            
               <th>Date</th>
                     
                        <th>Notes</th>
                       
                        <th>action</th>

                      
                      </tr>
                    </thead>
                    <tbody>
                    ';
$no = 0;
$query = "SELECT * FROM bacup ORDER BY date ASC ";
($result = $link->query($query)) or die($mysqli->error . __LINE__);
while ($row = $result->fetch_assoc()) {
    $date = $row["date"];
    $id = $row["id"];
    $notes = $row["notes"];
    echo '            <tr>
                      <td >';
    echo $no = $no + 1;
    echo '</td>
                       <td >';
    echo $date;
    echo '</td>
                     
                          <td >';
    echo $notes;
    echo '</td>
                       
                          
                      
                        <td  align="center"> <button class="delete-photo btn btn-sm btn-default" data-photo-id="';
    echo $date;
    echo '"><i class="fa fa-plus"></i> Restore</button>                     </td>
                      
                      </tr>
                      ';
}
echo '                    </tbody>
                  </table>
                </div>
              </section>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->

   <!-- parsley -->


  <!-- App -->
<link rel="stylesheet" type="text/css" href="js/datatables/jquery.dataTables.min.css">

<script type="text/javascript" language="javascript" src="ajax/jquery.dataTables.min.js"></script>
<script src="js/dist/sweetalert.min.js"></script> 
<link rel="stylesheet" type="text/css" href="js/dist/sweetalert.css">
      <!-- datatables -->
<script type="text/javascript" charset="uft-8">
$(document).ready(function(){
$(\'#tax-grid\').dataTable({
"sPaginationType":"full_numbers",
"aaSorting":[[0, "asc"]],
"sDom": \'<"bottom"fl>rt<"clear"><"top"ip>\',
"bJqueryUI":true
});
})
</script>


  
  <script>
  $(\'button.delete-photo\').click(function() {
    var photoId = $(this).attr("data-photo-id");
    deletePhoto(photoId);
  });

  function deletePhoto(photoId) {
    swal({
      title: "Are you sure?", 
      text: "Are you sure that you want to Retore this ?", 
      type: "warning",
      showCancelButton: true,
      closeOnConfirm: false,
      confirmButtonText: "Yes, Restore it!",
      confirmButtonColor: "#ec6c62"
    }, 
    
  function() {
      $.ajax({
        url: "index?java=backup&action=delete&eid=" + photoId,
        type: "DELETE",
    method: "POST"

      })
    
      .done(function(data) {
        swal("Deleted!", "Your file was successfully Restore!", "success"),
    
    window.location.href = "index?java=backup";
    
      })
      .error(function(data) {
        swal("Oops", "We couldn\'t connect to the server!", "error");
      });
  
        });
  }
  </script>
<script>
 function backups() {
var notes = $(\'#notes\').val();

      $.ajax({
        url: "index?java=backup&action=backup&notes=" + notes,
        type: "DELETE",
    method: "POST"

      })
    
      .done(function(data) {
        swal("Success!", "successfully Backup!", "success"),
    
    window.location.href = "index?java=backup";
    
      })
      .error(function(data) {
        swal("Oops", "We couldn\'t connect to the server!", "error");
      });
  
    
  }
</script>
';
?>
