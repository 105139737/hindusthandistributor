<?php

/**
 * @author Onnet Solution
 * @copyright 2015
 */

$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$sl=1;
$blno=$_REQUEST[blno];
?>
 <table border="0" width="100%" class="advancedtable">
<?
 $query100 = "SELECT * FROM  main_purchasedet where blno='$blno' order by sl";
   $result100 = mysqli_query($conn,$query100);
<tr class="odd">
<td  align="left" width="40%"><b><?=$pnm;?> - <?=$cnm;?> - <?=$brand;?></b></td>

<td align="right" width="30%" >


<td align="right" width="10%"><b><?=number_format($ttl,2);?></b></td>
<td align="center" width="10%"><b><?if($qnty<0){?><font color="red">Return</font><?}?> </b></td>


</tr>

<?}?>


</table>

<script>

t();

</script>