<?
$reqlevel = 1; 
include("membersonly.inc.php");
setlocale(LC_MONETARY, 'en_IN');
set_time_limit(0);
$fdt=$_REQUEST[dt];
$tdt=$_REQUEST[dt1];
$ledg=$_REQUEST[cc];
?>
<input type="hidden" id="ledg" name="ledg" size="5" value="<? echo $ledg; ?>" style="font-size: 12pt; text-align: left;color: #008000">
<input type="hidden" id="fdt" name="fdt" size="5" value="<? echo $fdt; ?>" style="font-size: 12pt; text-align: left;color: #008000">
<input type="hidden" id="tdt" name="tdt" size="5" value="<? echo $tdt; ?>" style="font-size: 12pt; text-align: left;color: #008000">
<?

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

		
		$prevdt = strtotime ( "- 1 day" , strtotime ( $fdt) ) ;
		$prevdt = date ( 'Y-m-d' , $prevdt );


$amm=0;


?>
<table width="96%" border="1" class="advancedtable">

          <thead>
		  <tr style="height: 30px;">
<th  align="left" colspan="4" width="50%">
         
          </th>
<th  align="right" colspan="4" width="50%"><a href="#" onclick="clr()" title="Close"><img src="images/close.png" width="25"/></a></th>
		</tr>
          <tr class="even">
          <td colspan="4" align="left">
          <font size="3"><b>Dr.</b></font>
          </td>
		  <td colspan="4" align="right">
           <font size="3"><b>Cr.</b></font>
          </td>
		  </tr>
          </thead>
<tr class="odd">
<td align="center" width="50%%" colspan="4" valign="top">
<table border="0" width="100%" >
<tr background="images/tablebg.jpg">
<td align="center" width="15%"> <font size="3">Date</td>
<td align="center" width="30%"> <font size="3">Project</td>
<td align="center" width="30%"> <font size="3">Perticulars</td>
<td align="center" width="25%"> <font size="3">Amount</td>
</tr>
<?
$sl=1;

$amm1=0;
$DR=0;
$f=0;
$query = "SELECT sum(amm) as amm1 FROM ac_misacdet where dt between '1970-01-01' and '$prevdt' and dldgr='$ledg'";
$result = mysqli_query($conn,$query);

while ($R = mysqli_fetch_array ($result))
{
$amm1=$R[amm1];
}
$DR=$DR+$amm1;

if($f%2==1)
{$clr="#D1A3FF";
 $fclr="#FFFAF0";
}
else
{$clr="#D5D5D2";
 $fclr="#1A4C80";
}
$f++;
if($amm1!=0)
{
$f++;
?>
<tr bgcolor="<? echo $clr; ?>">
<td align="center"  valign="top"> <font size="2" color="red">Prev.</font></td>
<td align="center"  valign="top"> <font size="2" color="red"></font></td>
<td align="left"  valign="top"> <font size="2" color="red">Prev.</font></td>
<td align="right"  valign="top" > <font size="2" color="red"><?echo $amm1;?></font></td>
</tr>
<?
}
$fdt1=date('Y-m-d', strtotime($fdt));
$tdt1=date('Y-m-d', strtotime($tdt));
while($fdt1 <= $tdt1){
    $dndt=$fdt1;

$query = "SELECT * FROM ac_misacdet where dt='$fdt1' and dldgr='$ledg' order by edt";
$result = mysqli_query($conn,$query);
$c=0;
$a='';
$p='0';
while ($R = mysqli_fetch_array ($result))
{
$a=$R['cldgr'];
$c=$R['amm'];
$p=$R['pno'];
$nrtn1=$R['nrtn'];
$ff1=$R['sl'];

if($p=='0')
{$p1="NA";
}
else
{
$query31 = "SELECT * FROM main_project where sl='$p'";
$result31 = mysqli_query($conn,$query31);
while ($R3 = mysqli_fetch_array ($result31))
{
$p1=$R3['nm'];
}
}

$query3 = "SELECT * FROM ac_ledg where sl='$a'";
$result3 = mysqli_query($conn,$query3);

while ($R3 = mysqli_fetch_array ($result3))
{
$ehnm=$R3['nm'];
}

if($f%2==1)
{$clr="#D1A3FF";
 $fclr="#FFFAF0";
}
else
{$clr="#D5D5D2";
 $fclr="#1A4C80";
}
if($c!=0)
{
$f++;
?>
<tr bgcolor="<? echo $clr; ?>">
<td align="center"  valign="top"><a title="Code : <?echo $ff1;?>" style="cursor:pointer;"> <font size="2" color="<? echo $fclr; ?>"><?echo $dndt;?></font></td>

<td align="center"  valign="top"> <font size="2" color="<? echo $fclr; ?>"><?echo $p1;?></font></td>

<td align="left"  valign="top"> <font size="2" color="<? echo $fclr; ?>">To. <?echo $ehnm;?></font></td>
<td align="right"  valign="top"> <font size="2" color="<? echo $fclr; ?>"><?echo number_format($c,2);?></font></td>
</tr>
<?
$DR=$DR+$c;
}
}
$newdate = strtotime ( "+ 1 day" , strtotime ( $fdt1) ) ;
$fdt1 = date ( 'Y-m-d' , $newdate );
}

?>
</table>
</td>


<td align="center" width="50%%" colspan="4" valign="top">
<table border="0" width="100%">
<tr >
<td align="center" width="15%"> <font size="3">Date</td>

<td align="center" width="30%"> <font size="3">Project</td>

<td align="center" width="30%"> <font size="3">Perticulars</td>
<td align="center" width="25%"> <font size="3">Amount</td>
</tr>
<?
$sl=1;

$amm1=0;
$CR=0;
$f=0;

$query = "SELECT sum(amm) as amm1 FROM ac_misacdet where dt between '1970-01-01' and '$prevdt' and cldgr='$ledg'";
$result = mysqli_query($conn,$query);

while ($R = mysqli_fetch_array ($result))
{
$amm1=$R[amm1];
}
$CR=$CR+$amm1;

if($f%2==1)
{$clr="#D1A3FF";
 $fclr="#FFFAF0";
}
else
{$clr="#D5D5D2";
 $fclr="#1A4C80";
}
$f++;
if($amm1!=0)
{
$f++;
?>
<tr bgcolor="<? echo $clr; ?>">
<td align="center"  valign="top"> <font size="2" color="red">Prev.</font></td>
<td align="center"  valign="top"> <font size="2" color="red"></font></td>
<td align="left"  valign="top"> <font size="2" color="red">Prev.</font></td>
<td align="right"  valign="top" > <font size="2" color="red"><?echo $amm1;?></font></td>
</tr>
<?
}
$fdt1=date('Y-m-d', strtotime($fdt));
$tdt1=date('Y-m-d', strtotime($tdt));
while($fdt1 <= $tdt1){
    $dndt=$fdt1;
	
$query = "SELECT * FROM ac_misacdet where dt='$fdt1' and cldgr='$ledg' order by edt";
$result = mysqli_query($conn,$query);
$c=0;
$a='';
$p='0';
while ($R = mysqli_fetch_array ($result))
{
$a=$R['dldgr'];
$c=$R['amm'];
$p=$R['pno'];
$nrtn1=$R['nrtn'];
$ff1=$R['sl'];

if($p=='0')
{$p1="NA";
}
else
{
$query31 = "SELECT * FROM main_project where sl='$p'";
$result31 = mysqli_query($conn,$query31);
while ($R3 = mysqli_fetch_array ($result31))
{
$p1=$R3['nm'];
}
}

$query3 = "SELECT * FROM ac_ledg where sl='$a'";
$result3 = mysqli_query($conn,$query3);

while ($R3 = mysqli_fetch_array ($result3))
{
$ehnm=$R3['nm'];
}

if($f%2==1)
{$clr="#D1A3FF";
 $fclr="#FFFAF0";
}
else
{$clr="#D5D5D2";
 $fclr="#1A4C80";
}
if($c!=0)
{
$f++;
?>
<tr bgcolor="<? echo $clr; ?>">
<td align="center"  valign="top"><a title="Code : <?echo $ff1;?>" style="cursor:pointer;"> <font size="2" color="<? echo $fclr; ?>"><?echo $dndt;?></font></td>

<td align="center"  valign="top"> <font size="2" color="<? echo $fclr; ?>"><?echo $p1;?></font></td>
<td align="left"  valign="top"> <font size="2" color="<? echo $fclr; ?>">By. <?echo $ehnm;?></font></td>
<td align="right"  valign="top"> <font size="2" color="<? echo $fclr; ?>"><?echo number_format($c,2);?></font></td>
</tr>
<?
$CR=$CR+$c;
}
}
$newdate = strtotime ( "+ 1 day" , strtotime ( $fdt1) ) ;
$fdt1 = date ( 'Y-m-d' , $newdate );
}
$NT=0;
$Dfrd=0;
$CFrd=0;
$TOT=0;
$NT=$CR-$DR;
if($NT>=0)
{
$DFrd=$NT;
$TOT=$CR;
}
else
{
$CFrd=$NT*-1;
$TOT=$DR;
}


?>
</table>
</td>
</tr>
<?
if($DFrd==0)
{
?>
<tr class="odd">
<td width="50%" align="left" colspan="4"> <font size="2"></td>
<td width="37%" align="right" colspan="3"> <font size="2">By Balance c/d </font></td>
<td width="13%" align="right"> <font size="2"><?echo number_format($CFrd,2);?></font></td>
</tr>
<?
}
else
{
?>
<tr class="odd">
<td width="37%" align="right" colspan="3"> <font size="2">By Balance f/d </font></td>
<td width="13%" align="right"> <font size="2"><?echo number_format($DFrd,2);?></font></td>
<td width="50%" align="right" colspan="4"> <font size="2"></td>
</tr>
<?
}
?>

<tr class="odd">
<td width="50%" align="right" colspan="4"> <font size="3" color="red"><?echo number_format($TOT,2);?></font></td>
<td width="50%" align="right" colspan="4"> <font size="3" color="red"><?echo number_format($TOT,2);?></font></td>
</tr>
</table>
<br>


