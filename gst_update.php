<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sl=$_REQUEST[sl];
$data= mysqli_query($conn,"select * from main_gst where sl='$sl'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$sgst=$row['sgst'];
$cgst=$row['cgst'];
$igst=$row['igst'];
$fdt=$row['fdt'];
$tdt=$row['tdt'];
$cat=$row['cat'];
}
?>
<html>
<div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

   
      <link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
</style>

<script type="text/javascript" language="javascript">
   $(document).ready(function()
{

   var jQueryDatePicker2Opts =
   {
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   
   $("#fdt").datepicker(jQueryDatePicker2Opts);
   $("#fdt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
   $("#tdt").datepicker(jQueryDatePicker2Opts);
   $("#tdt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});

      	
   });
   

   </script>

   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>      
<style type="text/css"> 
th{
text-align:center;
color:#FFF;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
#boxpopup{

left:100%;
position:fixed;
}

select.sc {
	width: 250px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 7px;
}
</style> 
   <script>
   function check()
   {
		if(document.form1.cat.value=='')
			{

	     alert("Please Enter Category ?");

		document.form1.cat.focus();
	return false;
			}
				else  
			{


		document.forms["form1"].submit();


				
			}  
   }

   

   </script>   
 
	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                    GST
                    <small>Setup</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">GST</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
		
							
<HR> 	
<form name="form1" id="form1" method="post" action="gsts.php" onsubmit="return check()">
<input type="hidden" id="sl" name="sl" value="<?=$sl;?>">
<center>
<div class="box box-success" >
<table border="0"  width="800px" class="table table-hover table-striped table-bordered" >
<tr>
<td  align="right" style="padding-top:17px"><b>CGST :</b></td>
<td  align="left">
<input type="text" class="form-control" id="cgst" name="cgst" value="<?=$cgst;?>" size="50" placeholder="Enter CGST">
</td>
<td  align="right" style="padding-top:17px"><b>SGST :</b></td>
<td  align="left">
<input type="text" class="form-control" id="sgst"  name="sgst" value="<?=$sgst;?>" size="50" placeholder="Enter SGST">
</td>
</tr>
<tr>
<td  align="right" style="padding-top:17px"><b>IGST :</b></td>
<td  align="left">
<input type="text" class="form-control" id="igst" name="igst" value="<?=$igst;?>" size="50" placeholder="Enter IGST">
</td>
<td  align="right" style="padding-top:17px"><b>Category :</b></td>
<td  align="left">
<select class="form-control" id="cat"  name="cat">
<option value="">---Select---</option>
<?
$get=mysqli_query($conn,"select * from main_scat order by nm") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
?>
<option value="<?=$row['sl']?>" <?=$row['sl']==$cat? 'selected' : ''?>><?=$row['nm']?> (<?=$row['hsn']?>)</option>
<?
}
?>
</select>
</td>
</tr>
<tr>
<td  align="right" style="padding-top:17px"><b>From Date :</b></td>
<td  align="left">
<input type="text" class="form-control" id="fdt" name="fdt" value="<?=$fdt;?>" size="50" required>
</td>
<td  align="right" style="padding-top:17px"><b>To Date :</b></td>
<td  align="left">
<input type="text" class="form-control" id="tdt"  name="tdt" value="<?=$tdt;?>" size="50" required>
</td>
</tr>
<tr>
<td colspan="4" align="right"  style="padding-right: 8px;">
<input type="submit" class="btn btn-primary" id="Button1" name="" value="Update" >
<input type="reset" class="btn btn-primary" id="Button2" name="" value="Reset" >
</td>
</tr>	
</table>
</form>
</div>
</center>
</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                  
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     

    </body>
	   </div>
	   
</html>