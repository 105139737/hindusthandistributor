<?php

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$sl=1;
?>
 <table border="0" width="100%" class="advancedtable">
 <?
 $query100 = "SELECT * FROM ".$DBprefix."gordrtmp where eby='$user_currently_loged' order by sl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$prsl=$R100['prsl'];
$qnty=$R100['qty'];
		$query6="select * from  ".$DBprefix."product where sl='$prsl'";
			$result5 = mysqli_query($conn,$query6);
			while($row=mysqli_fetch_array($result5))
				{
					$pnm=$row['pnm'];
					$cat=$row['cat'];
					$bnm=$row['bnm'];
					$mnm=$row['mnm'];
				}
$cnm="";				
$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cnm=$row1['cnm'];
}
$brand="";
$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$brand=$row1['brand'];
}
?>
<tr class="even">
<td  align="left" width="60%"><b><?=$pnm;?> - <?=$cnm;?> - <?=$brand;?> - <?=$mnm;?></b></td>

<td align="center" width="30%"><b><?=$qnty;?></b></td>
<td align="center" width="10%"><b><a onclick="if(confirm('Are you Sure?')){deltpr('<?=$tsl;?>')}"><font color="red">Delete</font></a> </b></td>


</tr>
<?}?>
</table>
