<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";

$sa=date('d-m-Y');
$saa="01-".date('m-Y');
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
color:red;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
<script>
function get_brnc()
{
var brncd= document.getElementById('brncd').value;
$('#main_cust').load('get_customerr.php?bcd='+brncd).fadeIn('fast');
}

function show1()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var snm= document.getElementById('snm').value;
var btyp= document.getElementById('btyp').value;
var brncd= document.getElementById('brncd').value;

$('#data8').load('c_sales.php?fdt='+fdt+'&tdt='+tdt+'&snm='+snm+'&btyp='+btyp+'&brncd='+brncd).fadeIn('fast');
}

function exl()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var snm= document.getElementById('snm').value;
var btyp= document.getElementById('btyp').value;
var brncd= document.getElementById('brncd').value;

document.location='c_sales_exl.php?fdt='+fdt+'&tdt='+tdt+'&snm='+snm+'&btyp='+btyp+'&brncd='+brncd;
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
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
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

$("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

$("#fdt").datepicker(jQueryDatePicker2Opts);
$("#tdt").datepicker(jQueryDatePicker2Opts);
});
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
               Sale Statment
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Sale Statment</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="post" action="sale_xls.php" name="form1"  id="form1">
<div class="box box-success" >
<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr>

<td align="left" width="25%" ><b>Branch:</b><br>
<select name="brncd" class="form-control czn" size="1" id="brncd" onchange="get_brnc()">
<?
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<!-- <option value="">---All---</option>
 --><?
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>
</td>

<td align="left"  width="20%"><b>Customer:</b><br>
<div id="main_cust"> 
<select name="snm" class="form-control"  id="snm"> 
<option value="">---All---</option>
<!-- <?
$query="Select * from  main_cust group by cont";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sid=$R['sl'];
$nm=$R['nm'];
$cont=$R['cont'];
?>
<option value="<? echo $cont;?>"><? echo $nm;?> - <? echo $cont;?></option>
<?
}
?> -->
</select>
</div>
</td>

<td  align="left"  width="20%"><b>Bill Type :</b>
<select name="btyp" class="form-control" size="1" id="btyp" tabindex="8" onchange="get_scat(this.value)"  >
<Option value="">---Select---</option>
<?
$qr=mysqli_query($conn,"select * from main_billtype where inv_typ='0'") or die(mysqli_error($conn));
while($R=mysqli_fetch_array($qr))
{
$ssl1=$R['sl'];
$als1=$R['als'];
$tp1=$R['tp'];
$ssn1=$R['ssn'];
?>
<option value="<?php echo $ssl1;?>" ><?php echo $als1;?></option>
<?	
}
?>
</select>
</td>
<td align="left" width="20%"><b>Form:</b><br>
<input type="text" id="fdt" name="fdt" size="13" value="<?echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > 
</td>
<td align="left" width="20%"><b>To:</b><br>
<input type="text" id="tdt" name="tdt" size="13" value="<?echo $sa;?>" class="form-control" placeholder="Please Enter To Date">
</td>
</tr>
<tr>
<td align="right" colspan="5">
<input type="button" class="btn btn-success" value="Excel Export" onclick="exl()">&nbsp;&nbsp;
<input type="button" class="btn btn-info" value="Show" onclick="show1()">
</td>
</tr>
</thead>



</table>
<div id="data8" style="overflow-x:auto;">
</div>
<div id="can88"></div>
<div id="can99"></div>
	 
                                </div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>
$('#snm').chosen({no_results_text: "Oops, nothing found!",});
$('#btyp').chosen({no_results_text: "Oops, nothing found!",});
$('.czn').chosen({no_results_text: "Oops, nothing found!",});
get_brnc();
</script>
</body>
</html>