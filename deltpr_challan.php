<?php

/**
 * @author Onnet Solution
 * @copyright 2013
 */
$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");

$sl=$_REQUEST[sl];

$query2 = "DELETE FROM  main_ctemp WHERE sl='$sl'";
$result2 = mysqli_query($conn,$query2);

?>
<script>
temp();
</script>