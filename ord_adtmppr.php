<?php

$err="";

if($pid=='' or $qnt=='' or $qnt=='0' or $prc=='' or $prc=='0')
$tot=0;
$queryq = "SELECT sum(qty) as qty1 FROM ".$DBprefix."slt where eby='$user_currently_loged' and prsl='$pid'";
$tot=$qty1+$qnt;
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pid' and bcd='$brncd'";
}
<script>
</script>
<?
}
<script>
}
?>