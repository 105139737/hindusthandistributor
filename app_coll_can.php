<?php$reqlevel = 1;include("membersonly.inc.php");$sl=$_REQUEST[sl];$query2 = "update main_recv_app set stat='2' WHERE sl='$sl'";$result2 = mysqli_query($conn,$query2);?><script>show1()
</script>