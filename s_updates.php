<?PHP 
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');

$spn=$_POST['spnm'];
$nm=$_POST['cnm'];
$addr=$_POST['addr'];
$email=$_POST['email'];
$mob1=$_POST['mob1'];
$mob2=$_POST['mob2'];
$sl=$_POST['sl'];
$queryx=mysqli_query($conn,"select * from ".$DBprefix."suppl where spn='$spn' and sl!='$sl'")or die(mysqli_error($conn));
if($cntx>0)
$query6 = "Update ".$DBprefix."suppl set spn='$spn',nm='$nm',addr='$addr',mob1='$mob1',mob2='$mob2',email='$email',pan='$pan',gstin='$gstin' where sl='$sl'";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));
?>
<Script language="JavaScript">
alert('Update Successfully. Thank You...');
document.location="s_show.php";
</script>
<?
}
?>