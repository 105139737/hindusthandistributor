<?php
include("membersonly.inc.php");
//catch the sent data
	$sl=0;
	
	$acgrp = $_POST['acgrp'];
	$acldgr = $_POST['acldgr'];
	   
		
	$sl = $_POST['updt'];
	
	if($sl!=0)
	{
	if($acldgr=='' or $acgrp=='')
	{
	?>
<script language="javascript">
alert('Please Fill All The Fields Properly.');
window.history.go(-1);
</script>
<?	}
	else
	{
  
$sql = "UPDATE main_ledg set gcd='$acgrp',nm='$acldgr' where sl='$sl'";
$result = mysqli_query($conn,$sql)or die (mysqli_error($conn));
?>
<script language="javascript">
alert('Updated Successfully. Thank You...');
document.location = "acldgr_form.php";
</script>
<?
	
	}
	}
	else
	{
if($acldgr=='' or $acgrp=='' )
	{
	?>
<script language="javascript">
alert('Please Fill All The Fields Properly.');
window.history.go(-1);
</script>
<?	}
	else
	{	

		$query4 = "SELECT * FROM main_ledg where nm='$acldgr'";
		$result4 = mysqli_query($conn,$query4);
		$cnt=0;
		while ($R = mysqli_fetch_array ($result4))
		{
		$cnt++;
		}
if($cnt>0)
{
?>
<script language="javascript">
alert('Sorry!! Ledger-Head Already Exist.');
window.history.go(-1);
</script>
<?
}
else
{

$query2 = "INSERT INTO main_ledg (gcd,nm,stat) VALUES ('$acgrp','$acldgr','1')";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));



?>
<script language="javascript">
alert('Ledger-Haed Added Successfully. Thank You.....');
document.location = "acldgr_form.php";
</script>
<?
}}}
?>

