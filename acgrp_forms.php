<?php
include("config.php");
//catch the sent data
	$sl=0;
	$pac = $_POST['pac'];
	$acgrp = $_POST['acgrp'];
	
	$sl = $_POST['updt'];
	
	if($sl!=0)
	{
	if($pac=='' or $acgrp=='')
	{
	?>
<script language="javascript">
alert('Please Fill All The Fields.');
window.history.go(-1);
</script>
<?	}
	else
	{
	
$sql = "UPDATE main_group set pcd='$pac',nm='$acgrp' where sl='$sl'";
$result = mysqli_query($conn,$sql)or die (mysqli_error($conn));
?>
<script language="javascript">
alert('Updated Successfully. Thank You...');
document.location = "acgrp_form.php";
</script>
<?
	
	}
	}
	else
	{
	

if($pac=='' or $acgrp=='')
	{
	?>
<script language="javascript">
alert('Please Fill All The Fields.');
window.history.go(-1);
</script>
<?	}
	else
	{	

$query4 = "SELECT * FROM main_group where nm='$acgrp'";
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
alert('Sorry!! Group Already Exist.');
window.history.go(-1);
</script>
<?
}
else
{

$query2 = "INSERT INTO main_group (pcd,nm) VALUES ('$pac','$acgrp')";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));

?>
<script language="javascript">
alert('Group Added Successfully. Thank You.....');
document.location = "acgrp_form.php";
</script>
<?

}}}
?>

