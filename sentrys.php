<?PHP $reqlevel = 3; 
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
$spn=$_POST['spnm'];
$cprsn=$_POST['cprsn'];
$addr=$_POST['addr'];
$email=$_POST['email'];
$mob1=$_POST['mob1'];
$mob2=$_POST['mob2'];$gstin=$_POST['gstin'];$pan=$_POST['pan'];
$err=="";if($spn==''){?><script>alert('Please Fill All The Fields.');history.go(-1);</script><?	}else{
$queryx="select * from ".$DBprefix."suppl where spn='$spn'";
$resultx = mysqli_query($conn,$queryx) or die(mysqli_error($conn));
$cntx=mysqli_num_rows($resultx);
if($cntx>0){$err="Data Already Exist";
}
if($err==""){
$query6 = "INSERT INTO ".$DBprefix."suppl (spn,nm,addr,mob1,mob2,email,edt,edtm,eby,gstin,pan) VALUES ('$spn','$cprsn','$addr','$mob1','$mob2','$email','$dt','$dttm','$user_currently_loged','$gstin','$pan')";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));
?>
<Script language="JavaScript">
alert('Submitted Successfully. Thank You...');
document.location="sentry.php";
</script>
<?
}
else
{
?>
<Script language="JavaScript">
alert('<? echo $err;?>');
window.history.go(-1);
</script>
<?
}}
?>