<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";

$ssl=$_REQUEST['sl'];
$gsl=$_REQUEST['gsl'];

$eget=mysqli_query($conn,"select * from main_product where sl='$ssl'") or die(mysqli_error($conn));
while($erow=mysqli_fetch_array($eget))
{
	$psl=$erow['sl'];
	$cat=$erow['cat'];
	$scat=$erow['scat'];
	$pnm=$erow['pnm'];
	$ret=$erow['mrp'];
	
	$mdvlu=$erow['mdvlu'];
	$smvlu=$erow['smvlu'];
	$bgvlu=$erow['bgvlu'];
	$hsn=$erow['hsn'];
	$ean=$erow['ean'];
	
}
/*
$get=mysqli_query($conn,"select * from main_unit where cat='$psl'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	//sun	mun	bun	smvlu	mdvlu	bgvlu	
	$sun=$row['sun'];
	$mun=$row['mun'];
	$bun=$row['bun'];
	$smvlu1=$row['smvlu'];
	$mdvlu1=$row['mdvlu'];
	$bgvlu1=$row['bgvlu'];
}
*/
	$dsql=mysqli_query($conn,"select * from main_gst where sl='$gsl'")or die(mysqli_error($conn));
		while($drow=mysqli_fetch_array($dsql))
		{
			$gsl=$drow['sl'];
			$cgst=$drow['cgst'];
			$sgst=$drow['sgst'];
			$igst=$drow['igst'];
			$fdt=date('d-m-Y',strtotime($drow['fdt']));
			$tdt=date('d-m-Y',strtotime($drow['tdt']));
		}

?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;
color:#FFF;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
#boxpopup{

left:100%;
position:fixed;
}

select.sc {
	width: 450px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 7px;
}
</style> 
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
/* 
  function get_catcal()  
 { 
	 var cat=document.getElementById('cat').value;
   $.get('get_units.php?cid='+cat, function(data) {
                var str= data;
				var stra = str.split("@@") 
                var mdval = stra.shift() 
				var bgval = stra.shift()
				var smval = stra.shift()  
    $('#mdval').html('<font color="red">'+mdval+'</font>');
    $('#bgval').html('<font color="red">'+bgval+'</font>');
    $('#smval').html('<font color="red">'+smval+'</font>');
}); 
 } 
 
function unit()
{
var sun=document.getElementById('sun').value;   
var mun=document.getElementById('mun').value;   
var bun=document.getElementById('bun').value; 
$("#su").html('<font color="red"><b>'+sun+'</b></font>');
$("#mu").html('<font color="red"><b>'+mun+'</b></font>');
$("#bu").html('<font color="red"><b>'+bun+'</b></font>');
 }
 */
function get_scat(brnd)  
{
$("#scat_div").load("get_sub_cat.php?cat="+brnd).fadeIn('fast');
}
function get_igst()  
{
scat=document.getElementById('scat').value;
$("#igdiv").load("get_igst.php?scat="+scat).fadeIn('fast');
}
function get_hsn(scat)  
{
$("#hsndiv").load("get_hsn.php?scat="+scat).fadeIn('fast');
}

</script>
<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
</style>
<script type="text/javascript" language="javascript">
   $(document).ready(function()
{

   var jQueryDatePicker2Opts =
   {
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   
   $("#fdt").datepicker(jQueryDatePicker2Opts);
   $("#tdt").datepicker(jQueryDatePicker2Opts);
   });
	function isNumber(evt) 
 {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if(iKeyCode < 46 || iKeyCode > 57)
		{
            return false;
        }
        return true;
 }
   </script>
   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
</head>
<body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Model
                        <small>Update</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Model</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

<form name="f" method="post" action="prod_list_edits.php">
<input type="hidden" id="sl" name="sl" value="<?echo $ssl;?>">
<input type="hidden" name="gsl" id="gsl" value="<?echo $gsl;?>">
        <div class="box box-success" >
		
<table border="0"  class="table table-hover table-striped table-bordered" >
<tr>
<td align="right" style="padding-top:17px" width="20%"><b>Brand :</b></td>
<td align="left" width="30%">
	<select name="cat" class="form-control" size="1" id="cat" tabindex="8"  onchange="get_scat(this.value)" required >
	<Option value="">---Select---</option>
	<?
		$data1=mysqli_query($conn,"Select * from main_catg order by cnm");
		while($row1=mysqli_fetch_array($data1))
		{
			$csl=$row1['sl'];
			$cnm=$row1['cnm'];
			?>
			<option value="<?echo $csl;?>" <?=$csl==$cat ? 'selected' : ''?>><?echo $cnm;?></option>
			<?
		}
	?>
	</select>
</td>
<td align="right" style="padding-top:17px" width="20%"><b>Category:</b></td>
<td  align="left" width="30%">
<div id="scat_div">
	<select name="scat" class="form-control" size="1" id="scat" tabindex="8" onchange="get_igst()">
	<Option value="">---Select---</option>
	<?
	$data1=mysqli_query($conn,"Select * from main_scat where cat='$cat' order by nm");
	while($row1=mysqli_fetch_array($data1))
	{
		$sc_sl=$row1['sl'];
		$sc_nm=$row1['nm'];
		?>
		<Option value="<?=$sc_sl;?>"<?if($scat==$sc_sl){echo 'selected';}?>><?=$sc_nm;?></option>
		<?
	}
	?>
	</select>
</div>
</td>
</tr>
<tr>
	<td  align="right" style="padding-top:17px"><font color="red">*</font><b>Model Name :</b></td>
	<td  align="left" colspan="">
	<input type="text" class="form-control" id="pnm"  name="pnm" value="<?php echo $pnm;?>"  placeholder="Model Name... "  required>
	</td>
	<td  align="right" style="padding-top:17px" hidden><b> Sale Rate</b> :</td>
	<td  align="left" hidden>
	<input type="text" class="form-control" name="ret" id="ret" value="<?php echo $ret;?>" style="width:100%" onkeypress="return isNumber(event)" placeholder="0.00">
	</td>
	<td align="right" style="padding-top:15px;"><b>HSN:</b></td>
	<td align="left">
	<div id="hsndiv">
	<input type="text" name="hsn" id="hsn" class="form-control" placeholder="Enter HSN" value="<?php echo $hsn;?>">
	</div>
	</td>
</tr>

<tr style="display:none;">
    <td align="right" width="20%" style="padding-top:15px;" ><b>Small Unit :</b></td>
	<td  align="left" width="30%">
	<input type="text" class="form-control" name="sun" id="sun" value="PCS" onblur="unit()" style="width:100%"  size="40" placeholder="Enter Small Unit....">
	</td>
	<td align="right" width="20%" style="padding-top:15px;" ><b>Small Value :</b></td>
	<td  align="left" width="30%">
	<input type="text" class="form-control" name="smvlu" id="smvlu" value="1" size="40" readonly placeholder="Enter Small Value....">
	</td>
</tr>
<tr style="display:none;"> 
	<td align="right" width="20%" style="padding-top:15px;" ><b>Midle Unit :</b></td>
	<td  align="left" width="30%">

	<input type="text" class="form-control" name="mun" id="mun" onblur="unit()"  size="40" placeholder="Enter Midle Unit...." >
	</td>
	<td align="right" width="20%" style="padding-top:15px;" ><b>Midle Value :</b></td>
	<td  align="left" width="30%">
	<input type="text" class="form-control" name="mdvlu" id="mdvlu"  size="40" placeholder="Enter Midle Value...." >
	</td>
</tr>
<tr style="display:none;">
	<td align="right" width="20%" style="padding-top:15px;" ><b>Big Unit :</b></td>
	<td  align="left" width="30%">
	<input type="text" class="form-control" name="bun" onblur="unit()" id="bun"  size="40" placeholder="Enter Big Unit...." >
	</td>

	<td align="right" width="20%" style="padding-top:15px;" ><b>Big Value :</b></td>
	<td  align="left" width="30%">
	<input type="text" class="form-control" name="bgvlu" id="bgvlu"  size="40" placeholder="Enter Big Value...." >
	</td>
</tr>		
<tr style="display:none;">
	<td  align="right" style="padding-top:17px">	<span id="su"></span><b> Per Sale Rate</b> :</td>
	<td  align="left">
	<input type="text" class="form-control" name="sret" id="sret" style="width:100%"  size="40">
	</td>

	<td  align="right" style="padding-top:17px">	<span id="mu"></span><b> Per Sale Rate</b> :</td>
	<td  align="left">
	<input type="text" class="form-control" name="mret" id="mret" style="width:100%"  size="40" >
	</td>
	<td  align="right" style="padding-top:17px">	<span id="bu"></span><b> Per Sale Rate</b> :</td>
	<td  align="left">
	<input type="text" class="form-control" name="bret" id="bret" style="width:100%"  size="40" >
	</td>
</tr>

<tr>

	
	<td  align="right" style="padding-top:15px"><font color="red">*</font><b>I-GST :</b></td>
	<td  align="left">
	<div id="igdiv">
	<input type="text" class="form-control" id="igst" name="igst" value="<?php echo $igst;?>" placeholder="Enter IGST" required onkeypress="return isNumber(event)">
	</div>
	</td>
	<td  align="right" style="padding-top:15px"><font color="red"></font><b>EAN :</b></td>
	<td  align="left">
	<input type="text" class="form-control" id="ean"  name="ean" value="<?php echo $ean;?>"  placeholder="Enter EAN">
	</td>
</tr>
<tr>
	<td colspan="4" align="right"  style="padding-right: 8px;">
	<input type="submit" class="btn btn-success" id="Button1" name="" value="Update" >
	<input type="reset" class="btn btn-warning" id="Button2" name="" value="Reset" >
	</td>    
</tr>

<tr style="display:none;">
	<td  align="right" style="padding-top:15px"><font color="red">*</font><b>S-GST :</b></td>
	<td  align="left">
	<input type="text" class="form-control" id="sgst"  name="sgst" value="<?php echo $sgst;?>" placeholder="Enter SGST" required>
	</td>
	<td  align="right" style="padding-top:15px"><font color="red">*</font><b>C-GST :</b></td>
	<td  align="left">
	<input type="text" class="form-control" id="cgst" name="cgst" value="<?php echo $cgst;?>" placeholder="Enter CGST" required>
	</td>

</tr>

<tr style="display:none;">
<td  align="right" style="padding-top:15px"><font color="red">*</font><b>From Date :</b></td>
<td  align="left">
<input type="text" class="form-control" id="fdt" name="fdt" value="<?php echo $fdt;?>" readonly >
</td>
<td  align="right" style="padding-top:15px"><font color="red">*</font><b>To Date :</b></td>
<td  align="left">
<input type="text" class="form-control" id="tdt"  name="tdt" value="<?php echo $tdt;?>"  readonly>
</td>

</tr>


		
</table>

</div> 
</form>

</center>
	 
                                </div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                  
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     

    </body>
</html>