<?php
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST[sl];
$pno=$_REQUEST[pno];
$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
$fy=date('Y');
$fm=date('m');
if($fm<4)
{$fy--;
}
$fdt="01-Apr-".$fy;
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d');

if($pno=='0')
{
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where dldgr='$sl' and stat='1'  and dt between '$fdt' and '$tdt'".$brncd1);
}
else
{
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where dldgr='$sl' and pno='$pno' and stat='1'  and dt between '$fdt' and '$tdt'".$brncd1);
}
		while ($row = mysqli_fetch_array($data))
		{
			$t1 = $row['t1'];
		}
		
if($pno=='0')
{
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where cldgr='$sl' and stat='1'  and dt between '$fdt' and '$tdt'".$brncd1);
}
else
{
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where cldgr='$sl' and pno='$pno' and stat='1'  and dt between '$fdt' and '$tdt'".$brncd1);
}
		while ($row1 = mysqli_fetch_array($data1))
		{
			$t2 = $row1['t2'];
		}
		$T=$t1-$t2;
		?>
		 <img src="images\rp.png" height="15px"><input type="text" name="cbal" id="cbal" size="35" value="<?echo $T;?>" style="background :transparent; color : red;" readonly>