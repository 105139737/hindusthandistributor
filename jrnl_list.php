<?php
$reqlevel = 3;
include("membersonly.inc.php");

$ledg=$_REQUEST[ledg];
$fdt=$_REQUEST[fdt];
$tdt=$_REQUEST[tdt];
$sids=$_REQUEST[sids];


$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
$pno1=$_REQUEST[pno1];
if($pno1!=0)
{$pnoo=" and pno='$pno1'";}else{$pnoo="";}
$pnog=rawurldecode($_REQUEST[pnog]);
//echo $src;
$ps=rawurldecode($_REQUEST[ps]);
if($ps=="")
{
$ps=10;
}
if($pnog==""){$pnog=1;}
$start=($pnog-1)*$ps;

if($tdt!="" and $fdt!="")
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$qr=" and dt between '$fdt' and '$tdt'";
}
else
{
$qr="";
}
if($ledg!="")
{
$ledg1=" and (cldgr='$ledg' or dldgr='$ledg')";
}else
{
$ledg1="";	
}
if($sids!="")
{
$sid1=" and sid='$sids'";
}
?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?=$ps;?>" size="7" onblur="pagnt1(this.value)">
</div>
          <table width="100%" border="1" class="table table-hover table-striped table-bordered">
     
          <tr style="height: 30px;">
          <th align="center" >
          Sl.
          </th>
		  <th align="center" >
         Date & JF No.
          </th>
		  <th align="center" >
          Credit Ledger &<br>Debit Ledger
          </th>
		  <th align="center" >
          Amount <br>& Project
          </th>
		   <th align="center" >
          Narration
          </th>
		  <th align="center">File</th>
		  <th align="center" >Edit</th>
		  <th align="center">Cancel</th>

		  </tr>
       
          <tbody>
		<?
		$f=0;
	
$sl=$start;
$sln=0;
$datatt= mysqli_query($conn,"SELECT * FROM main_drcr where typ='2' and stat='1'".$brncd1.$pnoo.$qr.$ledg1.$sid1)or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"SELECT * FROM main_drcr where typ='2' and stat='1'".$pnoo.$brncd1.$qr.$ledg1.$sid1)or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
 $data= mysqli_query($conn,"select * from main_drcr where typ='2' and stat='1' $pnoo $brncd1 $qr $ledg1 $sid1 order by dt Desc limit $start,$ps")or die(mysqli_error($conn));
 
	
		while ($row = mysqli_fetch_array($data))
		{
		$sl1= $row['sl'];
		$dt= $row['dt'];
		$pno= $row['pno'];
		$vno= $row['vno'];
		$blnon= $row['blnon'];
		$cldgr= $row['cldgr'];
		$cldgr1= $row['cldgr'];
		$dldgr= $row['dldgr'];
		$dldgr1= $row['dldgr'];
		$mtd= $row['mtd'];
		$mtddtl= $row['mtddtl'];
		$amm= $row['amm'];
		$nrtn= $row['nrtn'];
		$eby= $row['eby'];
		$edt= $row['edt'];
		$sid= $row['sid'];
		$path= $row['path'];

		  $sl++;
		if($mtddtl=='')
		{$mtddtl='NA';
		}
		if($nrtn=='')
		{$nrtn='NA';
		}
		

$doc1=glob("img/jrnl_form/".$vno.".*");
if(count($doc1)>0)
{
$doc=explode("img/jrnl_form/".$vno,$doc1[0]);
$doc="img/jrnl_form/".$vno.$doc[1];
}
else
{
$doc="img/noimg.jpg";
}		
								$data1= mysqli_query($conn,"SELECT * FROM main_ledg where sl='$cldgr'");
								while ($row1 = mysqli_fetch_array($data1))
								{
									$cldgr= $row1['nm'];
								}
								
								$data2= mysqli_query($conn,"SELECT * FROM main_ledg where sl='$dldgr'");
								while ($row2 = mysqli_fetch_array($data2))
								{
									$dldgr= $row2['nm'];
								}
								
								$data3= mysqli_query($conn,"SELECT * FROM ac_paymtd where sl='$mtd'");
								while ($row3 = mysqli_fetch_array($data3))
								{
									$mtd= $row3['mtd'];
								}
								$data21= mysqli_query($conn,"SELECT * FROM main_project where sl='$pno'");
								while ($row21 = mysqli_fetch_array($data21))
								{
									$pno= $row21['nm'];
								}
								if($pno=='0')
								{$pno='NA';
								}
								
								$query6="select * from  main_suppl where sl='$sid'";
								$result5 = mysqli_query($conn,$query6);
								while($row=mysqli_fetch_array($result5))
								{
								$cnm=$row['spn'];
								}
								if($cldgr1=='12')
								{
								$cldgr=$cldgr." : ".$cnm;	
								}
								if($dldgr1=='12')
								{
									
								$dldgr=$dldgr." : ".$cnm;	
								}
		$f++;
		if($f%2==0)
		{$cls="odd";
		}
		else
		{$cls="even";
		}
		$dt=date('d-M-Y', strtotime($dt));
		?>
  <tr class="<?echo $cls;?>" style="height: 20px;">
  <td align="left" valign="top"><a href="#" title="By : <?=$eby;?> | On :<?=$edt;?>"><b><?echo $f;?></b></td>
    <td align="left" valign="top"><b>Date :</b> <?echo $dt;?><br><a target="_blank" href="j1258.php?sl=<?php echo $sl1;?>"><b>JF No. :</b> <?echo $blnon;?></a></td>
    <td align="left" valign="top"><b>C.Ledger :</b> <?echo $cldgr;?><br><b>D.Ledger :</b> <?echo $dldgr;?></td>

	 <td align="center" valign="top" align="right"><font color="red">Rs. <b><?echo $amm;?></b></font><br><?echo $pno;?></td>
	
	    <td align="left" valign="top"><?echo $nrtn;?></td>
<td align="center" valign="top">
<?php if($path!=''){ ?>
<a href="<?php echo $doc;?>" target="_blank"> Click Here to Download</a>
<?php } ?></td>
	<td align="center" valign="top">
<a href="jrnl_form_det.php?sl=<? echo $sl1; ?>" target="_blank" title="Edit"><img src="images/edit.png" width="30"/></a>
	</td>
	<td align="center" valign="top">
<a href="#" onclick="cancell('<?php echo $sl1; ?>')" title="Cancel"><font color="red"><i class="fa fa-times fa-2x"></i></font></a>
</td>
	 </tr>
  <?
  }
  ?>
  </tbody>
</table>
<?
$tp=$rcnt/$ps;
if(($rcnt%$ps)>0)
{
    $tp=floor($tp)+1;
}
if($pnog==1)
{
    $prev=1;
}
else
{
$prev=$pnog-1;    
}
if($pnog==$tp)
{
 $next=$tp;   
}
else
{
$next=$pnog+1;
}
$flt="";
if($rcnt!=$rcntttl)
{
    $flt="(filtered from ".$rcntttl." total entries)";
}
echo "<font color=\"#FFF\">Showing ".($start+1)." to ".($sl)." of ".$rcnt." entries".$flt."</font>";
?>
<div align="left"><input type="text" size="10" id="pgn" name="pgn" value="<? echo $pnog;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>
<div class="pagination pagination-centered">
                            <ul class="pagination pagination-sm inline">
							<li <? if($pnog==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('1')"><i class="icon-circle-arrow-left"></i>First</a></li>
                            <li <? if($pnog==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $prev;?>')"><i class="icon-circle-arrow-left"></i>Previous</a></li>
                            <?
                            
                            if($tp<=5)
                            {
                              $n=1;  
                              while($n<=$tp)
                              {
                                ?>
                             <li <? if($pnog==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }  
                            }
                            else
                            {
                                if($pnog<4)
                                {
                                  $n=1;
                                  while($n<=5)
                              {
                                ?>
                             <li <? if($pnog==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }     
                                }
                                elseif($pnog>$tp-3)
                                {
                                    $n=$tp-5;
                                    while($n<=5)
                              {
                                ?>
                             <li <? if($pnog==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }   
                                }
                                else
                                {
                                $n=$pnog-2; 
                                 while($n<=$pnog+2)
                              {
                                ?>
                             <li <? if($pnog==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }     
                                }
                               
                                
                                
                            }
                            ?>
                            <li <? if($pnog==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $next;?>')">Next<i class="icon-circle-arrow-right"></i></a></li>
                            <li <? if($pnog==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $tp;?>')">Last<i class="icon-circle-arrow-right"></i></a></li>
                            </ul>
                            </div>
							