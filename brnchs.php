<?php
$reqlevel = 1;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
$a=$_POST[sn];
$b=$_POST[addr];
$c=$_POST[bcnt];
$d=$_POST[bls];$vat=$_POST[vat];
$err="";
$query = "SELECT * FROM ".$DBprefix."branch where bnm='$a'";
   $result = mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
if($count>0){
?>
<script language="javascript">
alert('Godown  Already Exists. Thank You.....');
window.history.go(-1);
</script>
<?
}
else
{
$query2 = "INSERT INTO ".$DBprefix."branch (bnm,als,addr,bcnt,vat) VALUES ('$a','$d','$b','$c','$vat')";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));;
$q=mysqli_query($conn,"select * from main_branch order by sl");while($r8=mysqli_fetch_array($q))	{$sl=$r8['sl'];}





$q3=mysqli_query($conn,"insert into  main_signup (username,password,name,brncd,mob,actnum,userlevel) values ('$a','pass','$a','$sl','$c','0','3')")or die (mysqli_error($conn));



?>
<script language="javascript">
alert('Godown Entry Completed. Thank You.....');
document.location="nbrnch.php";
</script>
<?
}
?>