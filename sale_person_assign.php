<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$yrs = date('Y');

$sl1=$_REQUEST['sl'];

if($sl1==''){
    $val='Submit';
    $clr='primary';
}
else{
    $val='Update';
    $clr='warning';
}
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;
color:#000;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
#sfdtl
{
	border : none;
	border-radius: 3px;
	background-image: url(images/bg1.png);
	width : 195px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 6%;
	top : 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
}
</style> 
<script>
function get_assign_spid()
{
var spid= document.getElementById('spid').value;
$('#custdv').load('get_assign_spid.php?spid='+spid).fadeIn('fast');
}
</script>


            <!-- Right side column. Contains the navbar and content of the page -->
           
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Sales Person Assign 
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Sales Person Assign </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body onload="show(),get_assign_spid()">
<div class="box box-success " >
<form method="post" action="sale_person_assigns.php" id="form1" onSubmit="return check1()" name="form1">                    
<table border="0" class="table table-hover table-striped table-bordered" >
<tr>
<td align="right" width="10%"><b>Main Sales Person :</b></td>
<td  align="left" width="40%">
<select name="spid" class="form-control" id="spid" required onchange="get_assign_spid(),show()">
<Option value="">---Select---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_sale_per order by spid");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$spid=$row1['spid'];
?>
<Option value="<?=$spid;?>" <?php if($spid==$sl1){echo 'selected';}?>><?=$spid;?></option>
<?}?>
</select>
</td>
<td align="right" width="10%"><b>Sales Person Assign :</b></td>
<td  align="left" width="40%">
<div id="custdv">
<select name="assign_spid[]"  multiple class="form-control" id="assign_spid" required>
<?
$data13 = mysqli_query($conn,"Select * from main_sale_per order by spid");
while ($row13 = mysqli_fetch_array($data13))
{
$sl2=$row13['sl'];
$spid2=$row13['spid'];
?>
<Option value="<?=$spid2;?>"><?=$spid2;?></option>
<?}?>
</select>
</div>
</td>
</tr>
<tr>
<td align="right" colspan="4">
<input type="submit" class="btn btn-primary" value="Submit" name="B1" >
</td>
</tr>
</table>
</div>
</form>
<div class="box box-success" id="sgh">
</div>	
</body>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>

function show()
 {
 var spid= document.getElementById('spid').value;
 $('#sgh').load('sale_person_assign_list.php?spid='+spid).fadeIn('fast');
 }
 function pagnt(pno){
var ps=document.getElementById('ps').value;
var spid=document.getElementById('spid').value;
$('#sgh').load("sale_person_assign_list.php?ps="+ps+"&pno="+pno+"&spid="+spid).fadeIn('fast');
$('#pgn').val=pno;
}
function pagnt1(pno){
pno=document.getElementById('pgn').value;
pagnt(pno);
}
$('#spid').chosen({no_results_text: "Oops, nothing found!",});	
$('#assign_spid').chosen({no_results_text: "Oops, nothing found!",});	
</script>