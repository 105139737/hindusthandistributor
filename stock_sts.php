<?php
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$pnm=$_REQUEST[pnm];
$y=$_REQUEST[y];
$m=$_REQUEST[m];
$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}

$tdt=$y."-".$m."-01";
$fdt=$y."-".$m."-31";
if($pnm!="")
{
	$all1=" and sl='$pnm'";
}
else
{
$all1="";	
}





?>

  <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
			  <td  align="center" >
			<b>Sl</b>
			</td>
			 <td  align="left" >
			<b>Product Name</b>
			</td>
			<td  align="center" >
			<b>Opening Balance</b>
			</td>
			<td  align="center" >
			<b>IN</b>
			</td>
			<td  align="center" >
			<b>OUT</b>
			</td>
		   <td  align="center" >
			<b>Balance</b>
			</td>
			<td  align="right" >
			<b>Rate</b>
			</td>
			<td  align="right" >
			<b>Value (Rs.)</b>
			</td>
		     </tr>
<?

$sl=$start;
$c1='odd';
$c3=0;
$sln=0;
$open1=0;
$stkf=0;
$stin1=0;
$stout1=0;
 $data= mysqli_query($conn,"select * from  main_product where sl!='' $all1 order by pnm")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	$c3++;
$slno=$row['sl'];
$pcd=$row['sl'];
$sln++;
$ptu="1"; 
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
$stkf=$stck;
  $query6="Select sum(opst+stin-stout) as open from ".$DBprefix."stock where pcd='$pcd' and dt<'$tdt'".$brncd1;
$result6 = mysqli_query($conn,$query6);
  while ($R6 = mysqli_fetch_array ($result6))
{
$open=$R6['open'];
}
$open1=$open;

$result7 = mysqli_query($conn,$query7);
  while ($R7 = mysqli_fetch_array ($result7))
{
$stin=$R7['stin'];
}
$stin1=$stin;
$query8="Select sum(stout) as stout from ".$DBprefix."stock where pcd='$pcd' and dt between '$tdt' and '$fdt' and stat='1'".$brncd1;
$result8 = mysqli_query($conn,$query8);
while ($R8 = mysqli_fetch_array ($result8))
{
$stout=$R8['stout'];
}
$stout1=$stout;
$to=0;

if($stkf!=0)
{
$stkf1=$stkf;
$ret1=$ret;
$sv=$stkf1*$ret1;
}


$to=$to+$sv;
		 
		
			 ?>
		   <tr  >
		   
		    <td  align="center" >
			<?=$sln;?>
			</td>
			 <td  align="left" style="cursor:pointer" >
<?=$pnm;?> - <?=$cnm;?> - <?=$brand;?> - <?=$mnm;?>
			</td>
			 <td  align="center" >
			<?echo $open1;?>
			</td>
            <td  align="center" >
			<?=$stin1;?>
			</td>
			 <td  align="center" >
			<?=$stout1;?>
			</td>
			<td  align="center" >
		<?=$stkf;?>
			</td>
			<td  align="right" >
		<?=number_format($ret,2);;?>
			</td>
			<td  align="right" >
		<?=number_format($sv,2);?>
			</td>
	
		
		     </tr>	 
<?
$to1=$to+$to1;
$stkf=0;
$stout1=0;
$stin1=0;
$open1=0;
  $sv=0;   
}?>
<tr>
<td colspan="8" align="right">
<b>Total Value </b>
</td>
<td align="right" >
<b><?=number_format($to1,2);?></b>
</td>
</tr>

	  </table>