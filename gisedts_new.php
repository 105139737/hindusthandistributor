<?php
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST[sl];
$fn=$_REQUEST['fn'];
$fv=rawurldecode($_REQUEST['fv']);
$div=$_REQUEST['div'];
$tblnm=$_REQUEST['tblnm'];
$cd='';
if($fv=="")
{
?>
<script>
alert('Please Fill Up!!');
location.reload();
</script>
<?
}
else
{
$sql1 =mysqli_query($conn,"select * from  $tblnm where $fn='$fv' and sl!='$sl'")or die(mysqli_error($conn));


$sql =mysqli_query($conn,"UPDATE  $tblnm set $fn='$fv' where sl='$sl'")or die(mysqli_error($conn));

}
										
?>
<a onclick="sedt('<?echo $sl;?>','<?=$fn;?>','<?echo $fv;?>','<?=$div;?>','<?=$tblnm;?>')"><b><font size="" color="grren"><?=$fv;?></font></b></a>
