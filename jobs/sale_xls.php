<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("memory_limit", "-1");
set_time_limit(0);
include("../config.php");
include("../function.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$pr_nm=$_REQUEST['prnm'];
$tp1=$_REQUEST['tp1'];
$gst_no=$_REQUEST['gstin'];
$godown=$_REQUEST['godown'];
$brncd=$_REQUEST['brncd'];
$stat=$_REQUEST['stat'];
$cat=$_REQUEST['cat'];
$scat=$_REQUEST['scat'];
$sale_per=$_REQUEST['sale_per'];
$delv=$_REQUEST['delv'];
$einv_stat="";
if(isset($_REQUEST['einv_stat'])){
$einv_stat=$_REQUEST['einv_stat'];
}
$custType='cid';
if(isset($_REQUEST['custType'])){
$custType=$_REQUEST['custType'];
}
$blno="";
if(isset($_REQUEST['blno'])){
$blno=$_REQUEST['blno'];
}

if($blno!=""){$blno_scarch=" and blno like '%$blno%'";}else{$blno_scarch="";}

if($einv_stat==""){$einv_stat1="";}else{$einv_stat1=" and einv_stat='$einv_stat'";}

if($einv_stat=="Null"){$einv_stat1=" and einv_stat is null";}

if($stat!=""){$cstat1=" and cstat='$stat'";}else{$cstat1="";}
if($delv==""){$delv1="";}else{$delv1=" and dstat='$delv'";}

if($sale_per==""){$sale_per1="";}else{$sale_per1=" and sale_per='$sale_per'";}
if($scat==""){$scat1="";}else{$scat1=" and scat='$scat'";}
if($cat==""){$cat1="";}else{$cat1=" and cat='$cat'";}
$gst_no1="";
if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($godown==""){$godown1="";}else{$godown1=" and bcd='$godown'";}
if($gst_no=="1"){$gst_no1=" and gstin!=''";}if($gst_no=="2"){$gst_no1=" and gstin=''";}
if($snm!=""){$snm1=" and ".$custType."='$snm'";}else{$snm1="";}
if($pr_nm!=""){$pr_nm1=" and sl='$pr_nm'";}else{$pr_nm1="";}
if($tp1!=""){$tp11=" and cust_typ='$tp1'";}else{$tp11="";}

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}

$bqr="";
 $dd = "SELECT sl FROM main_product WHERE  sl>0 $cat1 $scat1 $pr_nm1";
$ddc = mysqli_query($conn,$dd) or die (mysqli_error($conn) );
while($DX=mysqli_fetch_array($ddc))
{
$prod_sl=$DX['sl'];	
if($bqr=="")
{
$bqr.=" and ( prsl='$prod_sl'";
}
else
{
$bqr.=" or prsl='$prod_sl'";
}
}
$bqr.=")";
//echo $bqr;


$dis1=0;

/*header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
*/
ob_start();
$dis1=0;
?>
<style> .phone{ mso-number-format:\@; } </style>
 <table  width="100%" class="advancedtable" border="1"  >
<tr bgcolor="000">
<td colspan="23"><font size="5" color="#fff">Sale Details</font></td>
</tr>		
			<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Sl</b></td>		
			<td  align="center"><b>Date</b></td>
			<td  align="center"><b>Branch</b></td>
			<td  align="center"><b>Sales Person</b></td>
			<td  align="center" ><b>Invoice</b></td>
			<td  align="center" ><b>Customer Name</b></td>
			<td  align="center" ><b>Mobile</b></td>
			<td  align="center" ><b>Type</b></td>
			<td  align="center" ><b>GSTIN</b></td>
			<td  align="center" ><b>GTM </b></td>
			<td  align="center" ><b>EAN </b></td>
			<td  align="center" ><b>Brand </b></td>
			<td  align="center" ><b>Category </b></td>
			<td  align="center" ><b>Product Name</b></td>
			<td  align="center" ><b>HSN</b></td>
			<td  align="center" ><b>Serial No.</b></td>
			<td  align="center" ><b>Quantity</b></td>
			<td  align="center" ><b>S.Rate</b></td>
			<td  align="center" ><b>Total</b></td>
			<td  align="center" ><b>Disc.%</b></td>
			<td  align="center" ><b>Disc.Am</b></td>
			<td  align="center" ><b>Taxable Amt.</b></td>
			<td  align="center" ><b>CGST%</b></td>
			<td  align="center" ><b>CGST </b></td>
			<td  align="center" ><b>SGST%</b></td>
			<td  align="center" ><b>SGST </b></td>
			<td  align="center" ><b>IGST%</b></td>
			<td  align="center" ><b>IGST </b></td>
			<td  align="center" ><b>Rate(After GST)</b></td>
			<td  align="center" ><b>Dis Am.</b></td>
			<td  align="center" ><b>Net Payable</b></td>
			</tr>
			 <?
		$sln=0;
		$tota=0;
$tq=0;
$tslrt=0;
$tamm1=0;	
$car1=0;	
$vatamm1=0;
$ttpoint=0;
$ttsret=0;
$paid1=0;
$wgamm1=0;
$igst1=0;
$cgst1=0;
$sgst1=0;
$vall1=0;
$data1= mysqli_query($conn,"select * from  main_billing where sl>0".$blno_scarch.$einv_stat1.$todts.$snm1.$brncd1.$gst_no1.$cstat1.$tp11.$sale_per1.$delv1." order by dt,sl")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$blno=$row1['blno'];
$dt=$row1['dt'];
$edt1=$row1['edt'];
$vat=$row1['vat'];
$vatamm=$row1['vatamm'];
$car=$row1['car'];
$sid=$row1['cid'];
$invto=$row1['invto'];
$pdts=$row1['pdts'];
$dis=$row1['dis'];
$paid=$row1['paid'];
$gstin=$row1['gstin'];
$cust_typ=$row1['cust_typ'];
$sale_per=$row1['sale_per'];
$bcd=$row1['bcd'];
$odamm=$row1['damm'];
$oamm=$row1['amm'];
$brncd_nm=get_branch_name_($bcd);
$cust_typp=get_typ($cust_typ);
if($car==""){$car=0;}
if($dis==""){$dis=0;}
$dt=date('d-m-Y', strtotime($dt));

$qtyt=0;
$asd=0;
$tamm=0;
$tpoint=0;
$wgamm=0;
$drt=0;
if($odamm>0)
{
$drt=$odamm/$oamm;
}
$gtm="";
$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
$gtm=$rowd['gtm'];
}
$invnm="";

$datad1= mysqli_query($conn,"select * from main_cust where sl='$invto'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad1))
{
$invnm="(".$rowd['nm'].")";
$mob1=$rowd['cont'];

}
if($bcd=='2')//MBO KGR
{
//$nm='HINDUSTAN DISTRIBUTORS-MBO';
$gtm='DUR1598';   
}
if($bcd=='3')//RANAGHAT
{
//$nm='HINDUSTAN DISTRIBUTORS-MBO';
$gtm='DUR1796';   
}
if($bcd=='4')//SHOPPE
{
//$nm='HINDUSTAN DISTRIBUTOR';
$gtm='DUR0986';   
}

if($bcd=='5')//BURDWAN
{
//$nm='HINDUSTAN DISTRIBUTORS-MBO';
$gtm='DUR2910';   
}
if($bcd=='6')//BETHUA
{
//$nm='HINDUSTAN DISTRIBUTORS-MBO';
$gtm='DUR2960';   
}
if($bcd=='7')//KARIMPUR
{
//$nm='HINDUSTAN DISTRIBUTORS-MBO';
$gtm='DUR2987';   
}
$tslrt=0;
$igst=0;
$cgst=0;
$sgst=0;
$total_am=0;
$disa_am=0;
$data= mysqli_query($conn,"select * from  main_billdtls where sl>0 and blno='$blno'".$bqr.$godown1)or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$cat=$row['cat'];
$scat=$row['scat'];	
$pcd=$row['prsl'];
$prc=$row['prc'];
$afgst=$row['rate'];
$blno1=$row['blno'];
$unit=$row['unit'];
$kg=$row['kg'];
$grm=$row['grm'];
$pcs=$row['pcs'];
$cgst_rt=$row['cgst_rt'];
$cgst_am=$row['cgst_am'];
$sgst_rt=$row['sgst_rt'];
$sgst_am=$row['sgst_am'];
$igst_rt=$row['igst_rt'];
$igst_am=$row['igst_am'];
$total=$row['total'];
/*$ttl=$row['ttl'];
$net_am=round($row['net_am']);
*/
$disp=$row['disp'];
$disa=$row['disa'];
$betno=$row['betno'];



if($disp==0)
{
if($disa>0)
{
    $disp=round(($disa*100)/$total,2);
}
}

$igst=$igst+$igst_am;
$cgst=$cgst+$cgst_am;
$sgst=$sgst+$sgst_am;
$pgst=$cgst_am+$sgst_am+$igst_am;

$gst=$cgst_rt+$sgst_rt+$igst_rt;
$gst_rate=round($prc/($gst+100),4);
$rate=round($gst_rate*100,2);
$total=round($rate*$pcs,2);
$disa=round(($total*$disp)/100,2);
$ttl=round($total-$disa,2);

$net_am=$ttl+$pgst;

$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$cat'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}
if($unit=='sun'){$unit_nm=$sun;}
if($unit=='mun'){$unit_nm=$mun;}
if($unit=='bun'){$unit_nm=$bun;}

$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
$scat=$row['scat'];
$hsn=$row['hsn'];
$ean=$row['ean'];
}

$cnm="";				
$data12= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$cnm=$row1['cnm'];
}
$scat_nm="";				
$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$scat_nm=$row1['nm'];
$hsn1=$row1['hsn'];
}
if($hsn==''){$hsn=$hsn1;}
$vall=$drt*$net_am;
$net_am=$net_am-$vall;

	if($blno==$blno1)
	{
		$asd++;
	}
	$sln++;
		 ?>
		<tr title="<?=$pcd." S Sl".$sl;?>">
		<?if($asd==1){?>
		<td  align="center"  ><?=$sln;?>
		</td>
		<td  align="center" ><?=$dt;?></td>
		<td  align="center" ><?=$brncd_nm;?></td>
		<td  align="center" ><?=$sale_per;?></td>
		<td  align="center"  class="phone"><?=$blno;?></td>
		<td  align="left" ><?echo $nm;if($invnm!=''){?> <b><?=$invnm;?></b><?php }?></td>
		<td  align="left" ><?=$mob1;?></td>
		<td  align="center" ><?php echo $cust_typp;?></td>
		<td  align="center" ><?=$gstin;?></td>
		<td  align="center" ><?=$gtm;?></td>
		<?}
		else
		{
		?>
		<td  align="center"  ><?=$sln;?></td>		
		<td  align="center" ><?=$dt;?></td>
		<td  align="center" ><?=$brncd_nm;?></td>
		<td  align="center" ><?=$sale_per;?></td>
		<td  align="center" ><?=$blno;?></td>
		<td  align="left" ><?=$nm;if($invnm!=''){?> <b><?=$invnm;?></b><?php }?></b></td>
		<td  align="left" ><?=$mob1;?></td>
		<td  align="center" ><?php echo $cust_typp;?></td>
		<td  align="center" ><?=$gstin;?></td>
		<td  align="center" ><?=$gtm;?></td>
<?
}
?>
			<td  align="left" title="<?=$pcd;?>" ><?=$ean;?></td>
			<td  align="left" title="<?=$pcd;?>" ><?=$cnm;?></td>
			<td  align="left" title="<?=$pcd;?>" ><?=$scat_nm;?></td>
			<td  align="left" title="<?=$pcd;?>" ><a <? /*onclick="document.location='swip_bno.php?b1=<?=$blno;?>&b2=<?=$blno;?>'"*/ ?>><?=$pnm;?></a></td>
			<td  align="center" ><?=$hsn;?></td>
			<td  align="center" class="phone"><?=$betno;?></td>
			<td  align="center" ><?=$pcs;?> <?=$unit_nm?></td>
			<td  align="right" ><?=number_format($rate,2);?></td>
			<td  align="right" ><?=number_format($total,2);?></td>
			<td  align="center" ><?=$disp;?></td>
			<td  align="right" ><?=number_format($disa,2);?></td>
			<td  align="right" ><?=number_format($ttl,2);?></td>
			<td  align="center" ><?=$cgst_rt;?></td>
			<td  align="center" ><?=number_format($cgst_am,2);?></td>
			<td  align="center" ><?=$sgst_rt;?></td>
			<td  align="center" ><?=number_format($sgst_am,2);?></td>
			<td  align="center" ><?=$igst_rt;?></td>
			<td  align="center" ><?=number_format($igst_am,2);?></td>
			<td  align="center" ><?=number_format($afgst,2);?></td>
			<td  align="right" ><?=number_format($vall,2);?></td>
			<td  align="right" ><?=number_format($net_am,2);?></td>
			</tr>	 

	<?


$tamm=$ttl+$tamm;
$wgamm=$net_am+$wgamm;
$total_am+=$total;
$disa_am+=$disa;
$vall1+=$vall;
}
/*
	if($ttl!=0)
	{
	?>
	<tr bgcolor="#e8ecf6">
	<td colspan="9" align="right"><b>Total</b></td>

	<td align="center"><b></td>
	<td></td>
	<td  align="right" ><b><?=number_format($total_am,2);?></b></td>
	<td  align="right" ><b></b></td>
	<td  align="right" ><b><?=number_format($disa_am,2);?></b></td>
	<td  align="right" ><b><?=number_format($tamm,2);?></b></td>
	<td align="right" colspan="2"><b><?=number_format($cgst,2);?></b></td>
	<td align="right" colspan="2"><b><?=number_format($sgst,2);?></b></td>
	<td align="right" colspan="2"><b><?=number_format($igst,2);?></b></td>
	<td  align="right" ><b></b></td>
	<td  align="right" ><b><?=number_format($wgamm,2);?></b></td>
	
	</tr>
	<?


		}
		*/
		$dis1=$dis+$dis1;
		$tamm1=$tamm+$tamm1;
		$car1=$car1+$car;
		$paid1=$paid1+$paid;
		$wgamm1=$wgamm1+$wgamm;
		
		$igst1=$igst+$igst1;
		$cgst1=$cgst+$cgst1;
		$sgst1=$sgst+$sgst1;
		}?>
		<tr>
	<td colspan="16" align="right"><b>Total</b></td>
	
	<td align="center"><b></b></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td align="right"><b><?=sprintf('%0.2f',$tamm1);?></b></td>
	<td align="right" colspan="2"><b><?=number_format($cgst1,2);?></b></td>
	<td align="right" colspan="2"><b><?=number_format($sgst1,2);?></b></td>
	<td align="right" colspan="2"><b><?=number_format($igst1,2);?></b></td>
	<td  align="right" ><b></b></td>
	<td  align="right" ><b><?=number_format($vall1,2);?></b></td>
	<td align="right"><b><?=number_format($wgamm1,2);?></b></td>
</tr>
</table>
<?php 
$imgbinary = ob_get_clean();
$filename="jobs_report/".$_GET['file_name'].".xls";
file_put_contents($filename, $imgbinary);

?>