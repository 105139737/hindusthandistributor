<?
$reqlevel = 3;
include("membersonly.inc.php");

$prnm=$_REQUEST['prnm'];
$geti=mysqli_query($conn,"select * from main_unit where cat='$prnm'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
	$sl=$rowi['sl'];
	$sun=$rowi['sun'];
	$mun=$rowi['mun'];
	$bun=$rowi['bun'];
	$smvlu=$rowi['smvlu'];
	$mdvlu=$rowi['mdvlu'];
	$bgvlu=$rowi['bgvlu'];
}
?>
<select id="unit" name="unit" class="form-control" tabindex="1">
<?if($sun!=''){?><option value="sun"><?=$sun;?></option><?}?>
<?if($mun!=''){?><option value="mun"><?=$mun;?></option><?}?>
<?if($bun!=''){?><option value="bun"><?=$bun;?></option><?}?>
</select>
<input type="hidden" value="<?=$sl?>" name="usl" id="usl">