<?php 
$reqlevel = 1;
include("membersonly.inc.php");

set_time_limit(0);

$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";$bcd=" and bcd='$brncd'";}
$fdt=$_REQUEST[fdt];
$tdt=$_REQUEST[tdt];
$brand=$_REQUEST[brand];
$xls=$_REQUEST[xls];
if($brand==""){$brand1="";}else{$brand1=" and brand='$brand'";$brnd_sl=" and sl='$brand'";}

if($fdt=="" or $tdt=="")
{ 
echo 'Please Enter Valid Date Range.';
}
else
{
date_default_timezone_set('Asia/Kolkata');
$dt3 = date('y-m-d');
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$qry1=" and (dt between '$fdt' and '$tdt')";
}
$m=date('m', strtotime($fdt));

$y=date('y', strtotime($fdt));;
if($m>=4)
{
$ssn="%/".$y."-".($y+1)."%";	
	
}
elseif($m<=3)
{
$ssn="%/".($y-1)."-".$y."%";	
}
$ssn1=" and ssn like '$ssn'";
if($xls=='1')
{
$file=date('Ymdh').".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file");    
}
?>

<table <?php if($xls!='1'){?> width="100%"<?php }?> border="1">

<tr>
<th colspan="6" align="left" >
<font color="#000000" size="3">
Report 1 <?echo $dt?> As On  <?echo $fdt?> to <?echo $tdt?>
</font>
</th>
</tr>
<tr>
  <td  >
 <font color="#000000"><b>BRAND
</b></font>
  </td>

   <td >
  <font color="#000000"><b>DISTRIBUTION COLLECTION</b></font>
  </td>
 
  <td  >
  <font color="#000000"><b>RETAIL SALE/COLLECTION</b></font>
  </td>  
    <td  >
  <font color="#000000"><b>Paid To Supplier</b></font>
  </td>  
  <td  >
  <font color="#000000"><b>Diff</b></font>
  </td>
    <td  >
  <font color="#000000"><b>Supplier Due</b></font>
  </td>
</tr>  

<?php 
 
$bslar=array();
$da1= mysqli_query($conn,"SELECT * FROM main_billtype where sl>0 and inv_typ='0' and tp='1' $ssn1  $brncd1 ");
while ($rw1 = mysqli_fetch_array($da1))
{	
$bsl1=$rw1['sl'];
$bslar[]=$bsl1;
}
$ld=implode(",",$bslar);
$blno=array();
$data1232= mysqli_query($conn,"SELECT * FROM main_billing where sl>0 and cstat='1' $qry1 $bcd  ");
while ($row123= mysqli_fetch_array($data1232))
{	
$blno[]=$row123['blno'];
}
$blno1="";
if(count($blno)>0)
{
$blno1=implode(",",$blno);	
}
$amnt1=0;
$data1= mysqli_query($conn,"SELECT * FROM main_catg where cnm!='' $brnd_sl ");
while ($row1 = mysqli_fetch_array($data1))
{	

$cnm1=$row1['cnm'];
$catsl=$row1['sl'];
		$bsl=array();
		$als="";
		$data11= mysqli_query($conn,"SELECT * FROM main_billtype where sl>0 and inv_typ='77' and tp='2' and find_in_set('$catsl',brand)>0 $ssn1");
		while ($row11= mysqli_fetch_array($data11))
		{	
			$bsl[]=$row11['sl'];
			$als=$row11['als'];
		}
		$bsl=implode(",",$bsl);
		$amnt1=0;
		$data12= mysqli_query($conn,"SELECT sum(amm) as amnt1 FROM main_drcr where sl>0 and typ='77' and (cldgr='4' or cldgr='7') and dldgr!='5' and dldgr!='7' and find_in_set(bill_typ,'$bsl')>0  $qry1 $brncd1");
		while ($row12= mysqli_fetch_array($data12))
		{	
		$amnt1=$row12['amnt1'];
		}
		if($amnt1==''){$amnt1=0;}
		$amnt2=0;
		$data123= mysqli_query($conn,"SELECT sum(net_am) as amnt2 FROM main_billdtls where sl>0 $qry1  and cat='$catsl' and find_in_set(bill_typ,'$ld')>0 and find_in_set(blno,'$blno1')=0");
		while ($row123= mysqli_fetch_array($data123))
		{	
		$amnt2=$row123['amnt2'];
		}
		if($amnt2==''){$amnt2=0;}
	/*	$sbsl=array();
		$data11s= mysqli_query($conn,"SELECT * FROM main_billtype where sl>0 and inv_typ='0' and tp='2' and find_in_set('$catsl',brand)>0 $ssn1");
		while ($row11= mysqli_fetch_array($data11s))
		{	
			$sbsl[]=$row11['sl'];
		
		}
		$sbsl=implode(",",$sbsl);
		$dis_sale=0;
		$data1232= mysqli_query($conn,"SELECT sum(payam) as amnt2 FROM main_billing where sl>0 and find_in_set(bill_typ,'$sbsl')>0  and tp='2' and cstat='0' $qry1 $bcd  ");
		while ($row123= mysqli_fetch_array($data1232))
		{	
		$dis_sale=$row123['amnt2'];
		}
		if($dis_sale==''){$dis_sale=0;}*/
		
$sup_due=0;
$paid_to_sup=0;
$data8= mysqli_query($conn,"SELECT * FROM main_supplier_tag where sl>0 and find_in_set('$catsl',brand)>0 ");
while ($row8 = mysqli_fetch_array($data8))
{	
$supsl=$row8['sup'];
	

		$data12= mysqli_query($conn,"SELECT sum(amm) as amnt1 FROM main_drcr where sl>0 and sid='$supsl' and typ='88' $qry1 $brncd1");
		while ($row12= mysqli_fetch_array($data12))
		{	
		$paid_to_sup+=$row12['amnt1'];
		}


$datad= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and dldgr='12' and sid='$supsl' and dt<='$tdt'".$brncd1);
while ($row = mysqli_fetch_array($datad))
{
$t1 = $row['t1'];
}
$data1d= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where stat='1' and  cldgr='12' and sid='$supsl' and dt<='$tdt' ".$brncd1);
while ($row1 = mysqli_fetch_array($data1d))
{
$t2 = $row1['t2'];
}
$sup_due+=round($t2-$t1,2);		
}		
if($amnt1>0){$amnt1=$amnt1-(($amnt1*7)/100);}
if($amnt2>0){$amnt2=$amnt2-(($amnt2*7)/100);}

$diff=round(($amnt1+$amnt2)-$paid_to_sup,2);
?>

<tr>
  <td ><?php echo $cnm1;?></td>
  <td align="right"><?php echo $amnt1;?></td>  
  <td align="right"><?php echo $amnt2;?></td>  
  <td align="right"><?php echo $paid_to_sup;?></td>
  <td align="right"><?php echo $diff;?></td>
  <td align="right"><?php echo $sup_due;?></td>
</tr>  
<?php 
 $Mtotamnt1=$Mtotamnt1+$amnt1;
 $Mtotamnt2=$Mtotamnt2+$amnt2;
 $Mtotamnt3=$Mtotamnt3+$paid_to_sup;
 $tdiff=$tdiff+$diff;
 $tsup_due=$tsup_due+$sup_due;
}
?>
<tr>
<td align="right">Total:</td>
<td align="right"><?php echo $Mtotamnt1;?></td>
<td align="right"><?php echo $Mtotamnt2;?></td>
<td align="right"><?php echo $Mtotamnt3;?></td>
<td align="right"><?php echo $tdiff;?></td>
<td align="right"><?php echo $tsup_due;?></td>
</tr>
</table>
