<?php
$reqlevel = 1;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$a=$_REQUEST[psl];
?>
<select name="unt" size="1" id="unt" onchange="lttla()" class="sc1"  >
<?
	$query="SELECT * FROM ".$DBprefix."product where sl='$a'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array ($result))
	{
		$pcd=$R['sl'];
		$b=$R['pname'];
		$c=$R['pkgunt'];
	}
	$query1="Select * from ".$DBprefix."unit where sl='$c'";
	$result1=mysqli_query($conn,$query1);
	while($R1=mysqli_fetch_array ($result1))
	{
		$puntsl=$R1['sl'];
		$punt=$R1['pkgunt'];
		$upkg=$R1['untpkg'];
		$ptu=$R1['tunt'];
		?>
		<option value="<?=$punt?>"><?=$punt?></option>
		<?
	}
?>
</select>
<input type="hidden" id="usl" name="usl" value="<?=$puntsl;?>" >