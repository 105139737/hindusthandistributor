<?php
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST[sl];
$pno=$_REQUEST[pno];
$cid=$_REQUEST[cid];
$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($cid!="")
{
$cid1=" and cid='$cid' ";
}
else 
{
$cid1="";
}
$dld=" and dldgr='$sl'";
$cld=" and cldgr='$sl'";

$blano2="";
$blano2=" and  (cbill!=''";	
$query100 = "SELECT * FROM main_credit where eby='$user_currently_loged' and cid='$cid' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$blno=$R100['blno'];

$blano2.=" and  cbill!='$blno'";	

}
$blano2.=")";
?>
<select id="blno"  name="blno"   tabindex="2" class="form-control"  onchange="gtcrvl1()" >
<!--<option value="Opening">Opening</option>-->
<?
$data11= mysqli_query($conn,"select * from  main_drcr where brncd='$brncd' and cid='$cid' and cbill!='' and paid='0' $blano2 group by  cbill order by dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$blno=$row1['cbill'];
$dt=$row1['dt'];
$dt=date('d-m-Y', strtotime($dt));
$invto="";
$data2= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$invto=$row2['invto'];
$sfno=$row2['sfno'];
$bill_no=$row2['bill_no'];
}
$nm="";
$query="select * from main_cust  WHERE sl='$invto'";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$nm=$rw['nm'];
}
$query3="select * from main_cust  WHERE sl='$cid'";
$result3=mysqli_query($conn,$query3);
while($rw=mysqli_fetch_array($result3))
{
$typ=$rw['typ'];
}
$log=0;
$T=1;
if($typ==2)
{
$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cbill='$blno'".$cid1.$brncd1.$dld);
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cbill='$blno'".$cid1.$brncd1.$cld);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=$t1-$t2;
$log=1;
}
if($T>0)
{
?>
<option value="<?=$blno?>"><?=$bill_no?> <?=$blno?> <?=$nm;?> <?=$sfno;?> Due Am. : <?php if($log==0){echo '>1';}else{echo round($T,2);}?>/- (Date : <?=$dt;?>) </option>
<?
}
else
{
$qr=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$blno'") or die(mysqli_error($conn));	
}
?>

<?}?>

<?
$data11= mysqli_query($conn,"select * from  main_addon where brncd='$brncd' and cid='$cid'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$blno=$row1['blno'];
$dt=$row1['dt'];
$dt=date('d-m-Y', strtotime($dt));
$T=1;
if($typ==2)
{
$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cbill='$blno'".$cid1.$brncd1.$dld);
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cbill='$blno'".$cid1.$brncd1.$cld);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=$t1-$t2;
}
if($T>0)
{
?>
<option value="<?=$blno?>"><?=$blno?> (Date : <?=$dt;?>)</option>
<?
}
else
{
$qr=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$blno'") or die(mysqli_error($conn));	
}
?>

<?}?>
</select>
<script type="text/javascript">
   $('#blno').chosen({
  no_results_text: "Oops, nothing found!",
  
  });
  gtcrvl1();
</script>