<?php
$reqlevel = 3;
include("membersonly.inc.php");
$bill_typ=$_REQUEST['bill_typ'];
?>
<table border="0" width="100%" class="advancedtable">
 <?
$query100 = "SELECT * FROM ".$DBprefix."ser_slt where eby='$user_currently_loged' and bill_typ='$bill_typ' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$prsl=$R100['prsl'];
$unit=$R100['unit'];
$pcs=$R100['pcs'];
$prc=$R100['prc'];
$ttl=$R100['ttl'];
$cgst_rt=$R100['cgst_rt'];
$cgst_am=$R100['cgst_am'];
$sgst_rt=$R100['sgst_rt'];
$sgst_am=$R100['sgst_am'];
$igst_rt=$R100['igst_rt'];
$igst_am=$R100['igst_am'];
$net_am=$R100['net_am'];
$adp=$R100['adp'];
$disp=$R100['disp'];
$disa=$R100['disa'];
$total=$R100['total'];
$refno=$R100['refno'];
$bcd=$R100['bcd'];
$betno=$R100['betno'];
$cnm="";				
$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cnm=$row1['cnm'];
}
$scat_nm="";				
$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$scat_nm=$row1['nm'];
}
$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$prsl'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
}
$geti=mysqli_query($conn,"select * from main_unit where cat='$prsl'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$unit_nm=$rowi[$unit];
}
$bcdnm="";
$getii=mysqli_query($conn,"select * from main_branch where sl='$bcd'") or die(mysqli_error($conn));
while($rowii=mysqli_fetch_array($getii))
{
$bcdnm=$rowii['bnm'];
}
?>

<tr class="even">
<td  align="left" width="15%" <? /*onclick="get_data('<?=$tsl;?>','<?=$bcd;?>','<?=$prsl;?>','<?=$betno;?>','<?=$unit;?>','<?=$refno;?>','<?=$pcs;?>','<?=$prc;?>','<?=$total;?>','<?=$disp;?>','<?=$disa;?>','<?=$ttl;?>','<?=$cgst_rt;?>','<?=$cgst_am;?>','<?=$sgst_rt;?>','<?=$sgst_am;?>','<?=$igst_rt;?>','<?=$igst_am;?>','<?=$net_am;?>')" style="cursor:pointer;" title="Click Here To Edit" */?> >
<b><?=$pnm;?></b>
</td>
<td  align="left" hidden><b><?=$bcdnm;?></b></td>
<td align="center" hidden><b></b><?=$betno;?></td>

<td  align="center" width="5%"><b><?=$unit_nm;?></b></td>
<td align="center" hidden><b></b><?=$refno;?></td>
<td align="center" width="5%" ><b><?=$pcs;?></b></td>
<td align="right" width="6%" ><b><?=round($prc,2);?></b></td>

<td align="right" width="7%"><b><?=round($total,2);?></b></td>
<td align="center" width="5%"><b><?=$disp;?></b></td>
<td align="right" width="6%"><b><?=$disa;?></b></td>

<td align="right" width="6%"><b><?=round($ttl,2);?></b></td>
<td align="center" width="5%" ><b><?=$cgst_rt;?></b></td>
<td align="right" width="6%" ><b><?=round($cgst_am,2);?></b></td>
<td align="center" width="5%" ><b><?=$sgst_rt;?></b></td>
<td align="right" width="6%" ><b><?=round($sgst_am,2);?></b></td>
<td align="center" width="5%" ><b><?=$igst_rt;?></b></td>
<td align="right" width="6%" ><b><?=round($igst_am,2);?></b></td>
<td align="right" width="7%" ><b><?=round($net_am,2);?></b></td>
<td align="center" width="4%"><b><a onclick="if(confirm('Are you Sure?')){deltpr('<?=$tsl;?>')}"><font color="red">Delete</font></a> </b></td>

</tr>

<?}?>

</table>

<script>
t();
</script>