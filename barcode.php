


<?php
echo '
';
include "conn.php";
include "functions.php";
session_start();
$fyearh = $_SESSION["fyearh"];
$famID = $_GET["famID"];
$company = $_SESSION["company"];
//error_reporting(0);
if (!($fp = fopen(__DIR__."/barcode/"."datan.dat", "w"))) {
}
//SELECT *  FROM item INNER JOIN pricetable ON item.ino=pricetable.code where ino

$logo = "SELECT *  FROM company where cid";

($logoresults = $link->query($logo)) or die($mysqli->error . __LINE__);
while ($rows1 = $logoresults->fetch_assoc()) {
    $logo = $rows1["logo"];
    $cname = $rows1["cname"];
    
}
$logoresults->close();

$querys = "SELECT *  FROM item where ino='$famID'";
($results = $link->query($querys)) or die($mysqli->error . __LINE__);
while ($rows = $results->fetch_assoc()) {
    $code = $rows["code"];
    $name = $rows["name"];
    $retail = $rows["retail"];
    $dealer = $rows["dealer"];
    $mrp = $rows["mrp"];
    $aqty = $rows["aqty"];
    $discount = $rows["discount"];
    $uqc = $rows["uqc"];
    $pieces = $rows["pieces"];
    $hsn = $rows["hsn"];
    $tax = $rows["tax"];
    $igroup = $rows["igroup"];
    $notes = $rows["notes"];
}
$results->close();
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="fam_id">  Item Barcode</h4>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color:orange;">

<div class="container">
  <div style="margin: 2%;">
    <form class="form-horizontal" method="post" action="barcode_new.php" target="_blank">
        <div class="form-group">
      <div class="col-sm-2">
                                        <label class="control-label " for="item_code">Bar Code:</label>
                                        <input type="text" name="code" class="form-control" id="code"  placeholder="Item Code" autofocus value=<?php echo ' "';
 echo $code;
echo '" required onBlur="findsrc(this.value,\'code\',';
if (!empty($famID)) {
    echo $famID;
} else {
    echo $famID = 0;
}
echo ');" '?>  > 
                                  </div> 
   
                                    <div class="col-sm-2a">
                                        <label class="control-label " for="item_name">Item Name:</label>
                                        <input type="text" class="form-control" id="name" name="Name" placeholder="Item Name"  value=<?php echo ' "';
echo $name;
echo '" required onBlur="findsrc(this.value,\'name\',';
if (!empty($famID)) {
    echo $famID;
} else {
    echo $famID = 0;
}
echo ');" '?> >
                                    </div>
                                      <div class="col-lg-2">
                                     <label class="control-label " for="item_name">Choose Batch:</label>
                                    <select id="betch" name="betch" onChange="getSubcat(this.value);" class="chosen-select form-control" required>
                          
                            <?php 
                            
$query = "SELECT * FROM pricetable where code ='$code' and  pid ORDER BY batch DESC";
($result = $link->query($query)) or die($mysqli->error . __LINE__);
while ($row1 = mysqli_fetch_array($result)) {
    
        echo '<option value="' .
            $row1["pid"] .
            '"selected>' .
            $row1["batch"] .
            "</option>";
    
}
echo '                          </select> '?>


                  </div> 

                                    <div class="col-sm-2">
                                      <input type="checkbox"  id="itemmrp" name="itemmrp" value="1" checked>
                                        <label class="control-label " for="item_name">MRP:</label>
                                        <input type="text" class="form-control" id="mrp" name="mrp" placeholder="MRP"  required value=<?php

                                        $querym = "SELECT batch,pid,mrp,retail,wrate,prate,barcode,discount,active FROM pricetable where code ='$code'  group by batch DESC ";
($resultm = $link->query($querym)) or die($mysqli->error . __LINE__);
while ($row = $resultm->fetch_assoc()) {
    $batch = $row["batch"];
    $barcodes = $row["barcode"];
    $pid = $row["pid"];
    $mrps = $row["mrp"];
    $retails = $row["retail"];
    $wrate = $row["wrate"];
    $prate = $row["prate"];
    $disc = $row["discount"];
    $active = $row["active"];

}

                                         echo ' "';
echo $mrps;
echo '"  ' ?> >   
                                    </div>

                                    
                                  </div>
 <div class="form-group">

    <div class="col-sm-2">
                                        
                                        <input type="checkbox"  id="itemretail" name="itemretail" value="1" checked>
                                        <label class="control-label " for="item_sub_category">Price</label>
                                       <input type="text" class="form-control" id="retail" name="retail" value=<?php echo ' "';
echo $retails;
echo '" placeholder="Price" '?> >
                                    </div>

                                      <div class="col-sm-2">
                                        <input type="checkbox"  id="itemdis" name="itemdis" value="1" checked>
                                        <label class="control-label " for="item_sub_category">Discount</label>
                                       <input type="text" class="form-control" id="disc" name="disc" value=<?php echo ' "';
echo $disc;
echo '" placeholder="Discount" '?> >
                                    </div>

                                      <div class="col-sm-2">
                                        <input type="checkbox"  id="itemcom" name="itemcom" value="1" checked>
                                        <label class="control-label " for="item_sub_category">Company Name</label>
                                       <input type="text" class="form-control" id="cname" name="cname" value=<?php echo ' "';
echo $cname;
echo '" placeholder="Comany Name" '?> >
                                    </div>
                                    <div class="col-sm-2">
                                      <input type="checkbox"  id="itemretail" name="companylogo" value="1" checked>
                                        <label class="control-label " for="item_sub_category">Company Logo</label>
                                        <img class="form-control" name="logo" style="height: 60px; width: 140px" src="logo/<?php echo $logo; ?>">
                                 <input type="hidden" class="form-control" id="logo" name="logo" value=<?php echo ' "';
echo $logo;
echo '" placeholder="logo" &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '?> > 
                                    </div>

                                     
                                  </div>

                                  <div class="form-group">
<div class="col-sm-2">
                                      <label class="control-label" for="item_name">No of Sticker</label>
                                      <input type="text" class="form-control" id="nos" name="print_qty" placeholder="No of Sticker" required  >
                                    </div>
                                  </div>




    <div class="form-group">        
      <div class="col-sm-offset-5 col-sm-8">
        <button type="submit" class="btn btn-primary btn-s-md btn-rounded" >Print Barcode</button>
        <button type="button" class="btn btn-warning btn-s-md btn-rounded" data-dismiss="modal"> Cancel</button>
      </div>
    </div>
  </form>
  </div>
</div>

</body>
</html>






    <script src="js/bootstrap.js"></script>
    <script src="js/app.js"></script>
    <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/datepicker/bootstrap-datepicker.js"></script>
    <script src="js/chosen/chosen.jquery.min.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/shortcut.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/calculator.js"></script>
    <script src="js/dist/sweetalert.min.js"></script>
    <script src="js/knockout-2.2.1.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="js/datatables/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="js/datatables/jquery.dataTables.min.js">  </script>
        <link rel="stylesheet" type="text/css" href="js/datatables/buttons.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="js/datatables/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/datatables/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/datatables/buttons.colVis.min.js"></script> 
    <script type="text/javascript" charset="uft-8"> </script>
     <script>


function getSubcat(val) {
    $.ajax({
    type: "POST",
    dataType: "json",
    url: "select_betch.php",
    data:'pid='+val,
    success: function(data){
      console.log(`MRP: ${data[0]}, Retail: ${data[1]}`)
      
        $("#retail").val(data[1]);
        $("#disc").val(data[2]);
         $("#mrp").val(data[0]);
    }
    });
}

</script>



</script>
    <script src="js/jquery.min.js"></script>