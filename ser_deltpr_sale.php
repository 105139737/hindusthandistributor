<?php
$reqlevel = 1;
include("membersonly.inc.php");
$a=$_REQUEST[tsl];
$sl=$_REQUEST[sl];
$query2 = "DELETE FROM ".$DBprefix."ser_slt WHERE sl='$a'";
$result2 = mysqli_query($conn,$query2) or die(mysqli_error($conn));
?>
<script>
temp();
</script>