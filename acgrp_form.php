<?php
    <td align="left" width="30%"><select  name="pac" style="width:300px" class="form-control">
							<option value="">-- Select --</option>
							<?php 
							$get = mysqli_query($conn,"SELECT * FROM main_primary order by nm") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?=$row['sl']?>" <?=$row['sl'] == $rowpages['pcd'] ? 'selected' : '' ?>><?=$row['nm']?></option>
							<?php 
							} 
							?>
						</select></td>
	<td align="right" width="20%"><font color="red">*</font>Account Group :</td>
    <td align="left" width="30%">
      <input type="text" name="acgrp" id="acgrp" size="40" class="form-control">
	</td>   
  </tr>
  
  
  
  
  <tr >
    <td colspan="4" align="right"><input type="submit" value="Submit" class="btn btn-success"></td>
  </tr>

</table>

</div>



<?
$data= mysqli_query($conn,"SELECT * FROM main_group order by pcd");

?>
        <div class="box box-success" >
  <table width="860px" class="table table-hover table-striped table-bordered">
          <thead>
          <tr style="height: 30px;">
          <th align="center" width="10%">
          Sl.
          </th>
		  <th align="center" width="40%">
         Primary Account
          </th>
		  <th align="center" width="40%">
          Account Group
          </th>
		  
		  <th align="center" width="10%">
          Edit
          </th>
		  </tr>
          </thead>
          <tbody>
		<?
		$f=0;
		while ($row = mysqli_fetch_array($data))
		{
		$sl= $row['sl'];
		$p=$row['pcd'];
								$data1= mysqli_query($conn,"SELECT * FROM main_primary where sl='$p'");
								while ($row1 = mysqli_fetch_array($data1))
								{
									$p= $row1['nm'];
								}
		$nm = $row['nm'];
        $stat = $row['stat'];
				
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
  <td align="left" valign="top"><?echo $f;?></td>
    <td align="left" valign="top"><?echo $p;?></td>
    <td align="left" valign="top"><?echo $nm;?></td>
	<td align="center" valign="top">
	 </tr>
  <?
  }
  ?>
  </tbody>
</table>

  </div>





<div id='sfdtl' align='center' style="z-index:1000;">
Loding.....<br>
<img src="images/loading.gif">
</div> 
</form>
 </section><!-- /.content -->
 </aside><!-- /.right-side -->
</body>


<div id="underlay" style="z-index:200;">
</div>
</div>
</html>