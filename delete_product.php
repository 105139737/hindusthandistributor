<?php
$reqlevel = 3;
include("membersonly.inc.php");

$psls = $_REQUEST['psls'];

$abc  = mysqli_query($conn,"delete from main_catg where sl='$psls'") or die(mysqli_error($conn));

?> 
<script>
show();
</script>