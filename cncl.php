<?
$reqlevel=3; 
include("membersonly.inc.php");

$sl=$_REQUEST['sl'];
$qr=mysqli_query($conn,"update main_recv set cstat='1' where sl='$sl'") or die(mysqli_error($conn));

$data1=mysqli_query($conn,"SELECT * FROM main_recv where sl='$sl'")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($data1))
{
$blno=$row1['blno'];

}
if($blno!='')
{
$qr=mysqli_query($conn,"update main_billing set damm='0' where blno1='$blno'") or die(mysqli_error($conn));
mysqli_query($conn,"DELETE FROM main_drcr WHERE blno='$blno' ") or die(mysqli_error($conn));
$qr=mysqli_query($conn,"update main_recv_app set stat='2' where blno='$blno'") or die(mysqli_error($conn));
}
?>
<script>
show1();
</script>