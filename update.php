<?php$reqlevel = 1;include("membersonly.inc.php");$scat=$_REQUEST[scat];$prnm=$_REQUEST[prnm];$kg=$_REQUEST[kg];$grm=$_REQUEST[grm];$pcs=$_REQUEST[pcs];$prc1=$_REQUEST[prc];$lttl=$_REQUEST[lttl];$brncd=$_REQUEST[brncd];$fst=$_REQUEST[fst];$tst=$_REQUEST[tst];$cgst_rt=$_REQUEST[cgst_rt];$sgst_rt=$_REQUEST[sgst_rt];$igst_rt=$_REQUEST[igst_rt];$cgst_am=$_REQUEST[cgst_am];$sgst_am=$_REQUEST[sgst_am];$igst_am=$_REQUEST[igst_am];$adp=$_REQUEST[adp];$srt=$_REQUEST[srt];$refno=$_REQUEST[refno];$tsl=$_REQUEST[tsl];$blno=$_REQUEST[blno];
if($scat=='' or $lttl=='' or $prnm=='' or $refno==''){$err="Please Fill All Fields....";}$query7="Select * from main_slt where scat='$scat' and  prsl='$prnm' and eby='$user_currently_loged' and refno='$refno'";$result7 = mysqli_query($conn,$query7);$rowcount=mysqli_num_rows($result7);if($rowcount>0){$err="Product Already Exists....";}if($err==''){$query7="select * from main_scat where sl='$scat'";$result7 = mysqli_query($conn,$query7);while($row=mysqli_fetch_array($result7)){$unit=$row['unit'];$cat=$row['cat'];}$queryx = "SELECT * FROM main_purchasedet where blno='$refno' and scat='$scat'";$resultx = mysqli_query($conn,$queryx)or die(mysqli_error($conn));while ($rowx = mysqli_fetch_array ($resultx)){$mrp=round($rowx['mrp'],4);}$mrp1=round($mrp*$adp/100,4);$prc=$mrp+$mrp1;if($unit=='1'){$stock_out=$kg.".".$grm;
}elseif($unit=='2' or $unit=='3'){$stock_out=$pcs;	
}$lttl=$stock_out*$prc;$stck=0;$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$scat' and bcd='$brncd' and refno='$refno'";$result4 = mysqli_query($conn,$query4);while ($R4 = mysqli_fetch_array ($result4)){$stck=$R4['stck1'];}if($unit=='1'){$chk_stk=($kg*1000)+$grm;}elseif($unit=='2' or $unit=='3'){$chk_stk=$pcs;	}/*if($stck>=$chk_stk){	*/if($cgst_rt>0){$cgst_am=round(($cgst_rt*$lttl)/100,2);}if($sgst_rt>0){$sgst_am=round(($sgst_rt*$lttl)/100,2);}if($igst_rt>0){$igst_am=round(($igst_rt*$lttl)/100,2);}$net_am=$lttl+$cgst_am+$sgst_am+$igst_am;	/*$query21 = "INSERT INTO ".$DBprefix."slt (cat,scat,prsl,unit,kg,grm,pcs,srt,adp,prc,ttl,eby,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,refno)VALUES ('$cat','$scat','$prnm','$unit','$kg','$grm','$pcs','$srt','$adp','$prc','$lttl','$user_currently_loged','$fst','$tst','$cgst_rt','$sgst_rt','$igst_rt','$cgst_am','$sgst_am','$igst_am','$net_am','$refno')";$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	*/$query21 = "update main_billdtls set refno='$refno' where sl='$tsl'";$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn)); $query21 = "update main_stock set refno='$refno' where pcd='$scat' and sbill='$blno' and stout='$pcs'";$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn)); ?><script>temp();reset();</script><?/*}else{$err="Please Check  Quantity....";		
}*/}if($err!=''){?><script>alert('<?=$err;?>');temp();</script><?
}?>