<?php
$reqlevel = 1;
include("membersonly.inc.php");
include "function.php";
$cat=$_REQUEST['cat'];
$scat=$_REQUEST['scat'];
$pnm=rawurldecode($_REQUEST['pnm']);
$ean=$_REQUEST['ean'];
if($cat!=""){$cat1=" and cat='$cat'";}else{$cat1="";}
if($scat!=""){$scat1=" and scat='$scat'";}else{$scat1="";}
if($ean=="1"){$ean1=" and ean=''";}elseif($ean=="0"){$ean1=" and ean!=''";}

$af="%".$pnm."%";
if($pnm!=''){$a2=" and (pnm LIKE '$af')";}else{$a2='';}

$pno=rawurldecode($_REQUEST['pno']);
$ps=rawurldecode($_REQUEST['ps']);
if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;


$cnt=0;
$sl=$start;
$datatt= mysqli_query($conn,"SELECT * FROM main_product where sl>0 $cat1 $scat1 $a2 $ean1 order by sl")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"SELECT * FROM main_product where sl>0 $cat1 $scat1 $a2 $ean1 order by sl")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$get=mysqli_query($conn,"select * from main_product where sl>0 $cat1 $scat1 $a2 $ean1 order by sl limit $start,$ps") or die(mysqli_error($conn));
$total=mysqli_num_rows($get);
if($total!=0)
{
	
	
	
?>

<div align="left">
<input type="text" name="ps" id="ps" value="<?=$ps;?>" size="7" onblur="pagnt1(this.value)" style="width:50px;">
<a type="button" href="import_pcd.php" target="_blank" class="btn btn-success btn-sm">Generate Code</a>
</div>

<table class="table table-hover table-striped table-bordered">
<tr>
<th style="text-align:center;">Sl No</th>
<th style="text-align:center;">Brand</th>
<th style="text-align:center;">Category</th>
<th style="text-align:center;">Model Name</th>
<th style="text-align:center;">HSN</th>
<th style="text-align:center;">IGST</th>
<?/*<th style="text-align:center;">Sale Rate</th>
<th style="text-align:center;">Unit</th>
<th style="text-align:center;">Small Unit</th>
<th style="text-align:center;">Midle Unit</th>
<th style="text-align:center;">Big Unit</th>*/?>
<th style="text-align:center;">Action</th>
<th style="text-align:center;">Delete</th>
</tr>
<?
while($row=mysqli_fetch_array($get))
{
	$cnt++;
	$sl++;
	$psl=$row['sl'];
	$cat1=$row['cat'];
	$scat1=$row['scat'];
	$pnm=$row['pnm'];
	$hsn=$row['hsn'];
	$unit1=$row['unit'];
	$mrp=$row['mrp'];
	$smvlu=$row['smvlu'];
	$mdvlu=$row['mdvlu'];
	$bgvlu=$row['bgvlu'];
	$typ=$row['typ'];
	$stat=$row['stat'];
	$ean=$row['ean'];
	$pcd=$row['pcd'];
	$cat="";
	$get1=mysqli_query($conn,"select * from main_catg where sl='$cat1'") or die(mysqli_error($conn));
	while($row1=mysqli_fetch_array($get1))
	{
	$cat=$row1['cnm'];
	}
	$scat="";
	$get2=mysqli_query($conn,"select * from main_scat where sl='$scat1'") or die(mysqli_error($conn));
	while($row2=mysqli_fetch_array($get2))
	{
	$scat=$row2['nm'];
	}
/*
	$get3=mysqli_query($conn,"select * from main_unit where sl='$psl'") or die(mysqli_error($conn));
	while($row3=mysqli_fetch_array($get3))
	{
		$sun1=$row3['sun'];
		$mun1=$row3['mun'];
		$bun1=$row3['bun'];
		$smvlu1=$row3['smvlu'];
		$mdvlu1=$row3['mdvlu'];
		$bgvlu1=$row3['bgvlu'];
	}
$color="";	
if($mun1!='' and $mdvlu1=='')
{
	$color="red";
}
if($bun1!='' and $bgvlu1=='')
{
	$color="red";
}
*/	
$dsql=mysqli_query($conn,"select * from main_gst where cat='$psl' order by sl")or die(mysqli_error($conn));
while($drow=mysqli_fetch_array($dsql))
{
$gsl=$drow['sl'];
$cgst=$drow['cgst'];
$sgst=$drow['sgst'];
$igst=$drow['igst'];
$fdt=$drow['fdt'];
$tdt=$drow['tdt'];
}
	
?>
<tr bgcolor="<?=$color;?>">
<td style="text-align:center;"><?=$sl;?></td>
<td style="text-align:left;"><?=$cat;?></td>
<td style="text-align:left;"><?=$scat;?></td>
<td style="text-align:left;"><?=reformat($pnm);?><br><font color="red" size="2"> EAN  : <?php echo $ean;?> Code  : <?php echo $pcd;?></td>
<td style="text-align:left;"><?=$hsn;?></td>
<td style="text-align:left;"><?=$igst;?></td>
<?/*<td style="text-align:left;"><?=$mrp;?></td>
<td style="text-align:center;"><?=$unit;?></td>
<td style="text-align:right;">
Name : <?=$sun1;?><br>
Value : <?=$smvlu1;?><br>
Rate : <?=$smvlu;?>

</td>
<td style="text-align:right;">
Name : <?=$mun1;?><br>
Value : <?=$mdvlu1;?><br>
<?=$mdvlu;?>

</td>
<td style="text-align:right;">
Name : <?=$bun1;?><br>
Value : <?=$bgvlu1;?><br>
<?=$bgvlu;?>
</td>*/?>
<td style="text-align:center;">
<?
if($typ==0)
{
?>
<a href="prod_list_edit.php?sl=<?=$psl;?>&gsl=<?=$gsl;?>" target="_blank" title="Click to Update"><i class="fa fa-pencil-square-o"></i></a> 
<?
}
else
{
?>
<a href="servc_edt.php?sl=<?=$psl;?>&gsl=<?=$gsl;?>" target="_blank" title="Click to Update"><i class="fa fa-pencil-square-o"></i></a> 

<?	
}
?>
<?/*
&nbsp;&nbsp;&nbsp;
<a onclick="if(confirm('Are you sure to delete...')){dlt('<?=$psl;?>')}" title="Click to Delete" style="color:red;"><i class="fa fa-trash-o" ></i></a>
*/?><br/>
<?if($stat==0){?>
<input type="button" onclick="act('<?=$psl;?>','1','Deactive')" value="Active" title="Click to Deactive" class="btn btn-primary btn-xs">
<?} else{ ?>
<input type="button" onclick="act('<?=$psl;?>','0','Active')" value="Deactive" title="Click to Active" class="btn btn-danger btn-xs">
<? } ?>
</td>


<td style="text-align:center;">
<?
$sqle  = mysqli_query($conn,"select * from main_stock where pcd='$psl'") or die(mysqli_error($conn));
$cnts = mysqli_num_rows($sqle);

if($cnts == 0)
{
?>
<input type="button" title="Click Here To Delete" class="btn btn-block btn-danger btn-xs" value="Delete" onclick="dlts('<?php echo $psl; ?>')" name="B2">
<?php	
}
?>


</td>


</tr>
<?															
}
?>
</table>
<center>
<?


$tp=$rcnt/$ps;
if(($rcnt%$ps)>0)
{
    $tp=floor($tp)+1;
}
if($pno==1)
{
    $prev=1;
}
else
{
$prev=$pno-1;    
}
if($pno==$tp)
{
 $next=$tp;   
}
else
{
$next=$pno+1;
}
$cnt1=$cnt+$start;
$flt="";
if($rcnt!=$rcntttl)
{
    $flt="(filtered from ".$rcntttl." total entries)";
}
echo "Showing ".($start+1)." to ".($cnt1)." of ".$rcnt." entries".$flt;
?>
<div class="pagination pagination-centered">
<center>
    <table border="0" style="width:10%">
        <tr>
            <td>
            <input type="text" size="10" id="pgn" name="pgn" value="<?=$pno;?>" style="text-align:center; width:50px;">
            </td>
			<td style="padding-top:5px;"><input type="button" value="Go" onclick="pagnt1()"></td>
        </tr>
    </table>
</center>

                            <ul class="pagination pagination-sm inline">
							<li <? if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('1')"><i class="icon-circle-arrow-left"></i>First</a></li>
                            <li <? if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $prev;?>')"><i class="icon-circle-arrow-left"></i>Previous</a></li>
                            <?
                            
                            if($tp<=5)
                            {
                              $n=1;  
                              while($n<=$tp)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }  
                            }
                            else
                            {
                                if($pno<4)
                                {
                                  $n=1;
                                  while($n<=5)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }     
                                }
                                elseif($pno>$tp-3)
                                {
                                    $n=$tp-5;
                                    while($n<=5)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }   
                                }
                                else
                                {
                                $n=$pno-2; 
                                 while($n<=$pno+2)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }     
                                }
                               
                                
                                
                            }
                            ?>
                            <li <? if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $next;?>')">Next<i class="icon-circle-arrow-right"></i></a></li>
                            <li <? if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $tp;?>')">Last<i class="icon-circle-arrow-right"></i></a></li>
                            </ul>
                            </div>
							</center>
<?
}
else
{
?>
<table class="table table-hover table-striped table-bordered">
<tr>
<td style="text-align:center;"><font size="4" color="red"><b>No Records Available</b></font></td>
</tr>
</table>
<?
}
?>