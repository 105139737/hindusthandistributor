<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "function.php";
set_time_limit(0);
$cid=$_REQUEST['cid'];
$blno=$_REQUEST['blno'];
$stat=$_REQUEST['stat'];
$fn=$_REQUEST['fn'];
$tn=$_REQUEST['tn'];
$paid1="";
$limit="";
$limit=" limit $fn,$tn";
if($cid!=''){$cid1=" and cid='$cid'";}
if($blno!=''){$blno1=" and cbill like '%$blno%'";}
if($stat==0){$paid1="and paid='0'";$limit=" limit $fn,$tn";}
if($stat==2){$paid1="and paid='1'";$limit=" limit $fn,$tn";}
//echo "select * from  main_drcr where  cbill!='' $paid1 $cid1 $blno1 group by cbill order by sl $limit";
$data11= mysqli_query($conn,"select * from  main_drcr where  cbill!='' $paid1 $cid1 $blno1 group by cbill order by sl $limit")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$blno=$row1['cbill'];
$T=0;
$t1=0;
$t2=0;

$T=0;
$result416 = mysqli_query($conn,"SELECT  (SUM(IF(dldgr='4', amm, 0)) - SUM(IF(cldgr='4', amm, 0))) AS amm FROM main_drcr where  cbill='$blno' ")or die(mysqli_error($conn));
while ($R16 = mysqli_fetch_array ($result416))
{
$T=$R16['amm'];
}

$T=round($T);
if($T==0)
{
echo " Success $blno'<br>";	
$qr=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$blno'") or die(mysqli_error($conn));
}
else
{
echo " Restore Success $blno'<br>";		
$qr=mysqli_query($conn,"update main_drcr set paid='0' where cbill='$blno'") or die(mysqli_error($conn));	
}
}
?>
<p><h1>Success Your Request....</h1></p>