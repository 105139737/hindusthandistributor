<?php
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
$cy=date('Y');
$all=rawurldecode($_REQUEST[all]);
$sup=$_REQUEST[sup];
$al="%".$all."%";
if($all!="")
{
	$all1=" and gstin LIKE '$al' or pan LIKE '$al' or addr LIKE '$al'";
}
else
{
$all1="";	
}
if($sup!="")
{
	$all2=" and spn LIKE '$sup'";
}
else
{
$all2="";	
}

$pno=rawurldecode($_REQUEST[pno]);

//echo $src;
$ps=rawurldecode($_REQUEST[ps]);
if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;

?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?=$ps;?>" size="7" onblur="pagnt1(this.value)">
</div>
<table  class="table table-hover table-striped table-bordered"  >	
<tr>
<th >Action</font></th>
<th >Sl</font></th>
<th >Supplier</font></th>
<th >Address</font></th>
<th >GSTIN</font></th>
<th >PAN</font></th>
<th >State</font></th>

</tr>
<?
$sl=$start;
$sln=0;
$datatt= mysqli_query($conn,"select * from main_suppl_gst where sl>0")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from main_suppl_gst where  sl>0 $all1 $all2")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data= mysqli_query($conn,"select * from main_suppl_gst where  sl>0 $all1 $all2  limit $start,$ps ")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{

$spn=$row['spn'];
$addr=$row['addr'];
$pan=$row['pan'];
$gstin=$row['gstin'];
$x=$row['sl'];
$st=$row['st'];
$spn1="";
$data5= mysqli_query($conn,"select * from main_suppl where  sl='$spn'")or die(mysqli_error($conn));
while ($row5 = mysqli_fetch_array($data5))
{
$spn1=$row5['spn'];
}
$sn="";
$data55= mysqli_query($conn,"select * from main_state where sl='$st'")or die(mysqli_error($conn));
while ($row55 = mysqli_fetch_array($data55))
{
$sn=$row55['sn'];
}



$sln++;   
$sl++; 
$sll=base64_encode($x);
?>
<tr  >
<?	if($user_current_level<0)
{?>
<td  align="center" style="cursor:pointer" onclick="edit('<?=$sll;?>')" >
<i class="fa fa-pencil-square-o"></i>
</td>
<?}
else
{
?>
<td  align="center"   >
You need to be<br> an admin for <br>this page
</td>
<?
}
?>
<td align="center"><? echo $sln;?></td>
<td align="center"><? echo $spn1;?></td>
<td align="center"><? echo $addr;?></td>
<td align="center"><? echo $gstin;?></td>
<td align="center"><? echo $pan;?></td>		
<td align="center"><? echo $sn;?></td>		

</tr>	 
<?
}
?>
</table>
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
$flt="";
if($rcnt!=$rcntttl)
{
    $flt="(filtered from ".$rcntttl." total entries)";
}
echo "Showing ".($start+1)." to ".($sl)." of ".$rcnt." entries".$flt;
?>
<div align="center"><input type="text" size="10" id="pgn" name="pgn" value="<? echo $pno;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>
<div class="pagination pagination-centered">
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
							