<?php

error_reporting(0);
include "conn.php";

		include 'barcode128.php';

$itemmrp =$_POST['itemmrp'];

$companylogo =$_POST['companylogo'];

$itemdis =$_POST['itemdis'];
$itemretail =$_POST['itemretail'];

$itemcom =$_POST['itemcom'];
		$Name = $_POST['Name'];
		$code = $_POST['code'];
		$mrp = $_POST['mrp'];
		$logo = $_POST['logo'];

		$retail = $_POST['retail'];

		$disc = $_POST['disc'];

		$cname = $_POST['cname'];
		//  
?>
<html>
<head>
<style>
p.inline {display: inline-block; 
    width: 50mm;
    height:25mm;}
span { font-size: 10px;}
   #code {
    font-weight: 700;
    font-size: 17px;
    text-align: justify;
    text-align-last: justify;
}
#img{
    height: 9vh;
    max-width: 100%

    	
}
		div {
    margin-left: 5%;
   
}

</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }
/* height: 50mm;width: 25mm  style="margin-left: 5%;"*/
</style>
</head>
<body onload="window.print();">
	<div >
		<?php

		for($i=1;$i<=$_POST['print_qty'];$i++){
			?>
		<span>
			<?php 
			if ($companylogo ==1) {

			?>
			<img class="inline" name="logo" style="height: 150px; width: 110px" src="logo/<?php echo $logo?> ">

			</span >
<?php }
			if ($itemcom ==1) {

			?>
			<p class='inline'><span ><b> <?php echo  $cname; ?> </b><span><b><br>
    

		<?php }
			echo "<span ><b> $Name</b></span>".bar128(stripcslashes($_POST['code'])).""; ?>
			<?php 
			if ($itemmrp ==1) {

			?>
			<span ><b> Mrp:<?php echo  $mrp; ?> </b><span><b><br>
     <?php } ?>

			
               <?php 
			if ($itemretail ==1) {

			?>             
			Price: <?php echo $retail ?> </b><span><b><br> <?php }?>

               <?php 
			if ($itemdis ==1) {

			?>    
			Discount:<?php echo $disc ?> </b><span></p>&nbsp&nbsp&nbsp&nbsp;


		<?php } }

		?>
	</div>
</body>
</html>