<?php
$reqlevel = 0;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
$a=$_REQUEST[fv];
$b=$_REQUEST[cat];
$err="";
$query = "SELECT * FROM ".$DBprefix."group where pcd='$b' and nm='$a'";
   $result = mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
if($count>0){
$err="Already Entered";
}
if($a==""){
	$err="You Cant Left The Field Blank";
}
if($err=="")
{
$query2 = "INSERT INTO ".$DBprefix."group (pcd,nm) VALUES ('$b','$a')";
$result2 = mysqli_query($conn,$query2);
$query = "SELECT * FROM ".$DBprefix."group where pcd='$b' and nm='$a'";
   $result = mysqli_query($conn,$query);
   while ($R1 = mysqli_fetch_array ($result))
{
$psl=$R1['sl'];
}

}
$query3 = "SELECT * FROM ".$DBprefix."group";
   $result3 = mysqli_query($conn,$query3);

?>
<table border="0" cellspacing="1" width="100%" class="table table-hover table-striped table-bordered">
          <tr>
            <td width="20%"><font size="5" >ID</font></td>
            <td width="40%"><font size="5" >Under</font></td>
	    <td width="40%"><font size="5" >Group</font></td>
          </tr>
<?
while ($R = mysqli_fetch_array ($result3))
{
$x=$R['sl'];
$y=$R['pcd'];
$z=$R['nm'];
$query4 = "SELECT * FROM ".$DBprefix."primary where sl='$y'";
   $result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$m=$R4['nm'];
}
$grdv="grp".$x;
$prdv="prm".$x;
?>
          <tr>
            <td><? echo $x;?></td>
            <td><div id="<? echo $prdv;?>"><a onclick="showeditgrp('<? echo $x;?>','pcd','<? echo $y;?>','<? echo $prdv;?>')"><? echo $m;?></a></div></td>
            <td><div id="<? echo $grdv;?>"><a onclick="showeditgrp('<? echo $x;?>','nm','<? echo $z;?>','<? echo $grdv;?>')"><? echo $z;?></a></div></td>
          </tr>
<?
}
?>
          </table>
