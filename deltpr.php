<?php

/**
 * @author Onnet Solution
 * @copyright 2013
 */
$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
$a=$_REQUEST[tsl];
$sl=$_REQUEST[sl];

$query2 = "DELETE FROM ".$DBprefix."slt WHERE sl='$a'";
$result2 = mysqli_query($conn,$query2);

?>
<script>
temp();
</script>