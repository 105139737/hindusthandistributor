<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
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
</style> 
<link rel="stylesheet" type="text/css" href="style_sedt1.css" />
<script type="text/javascript" src="prdcedt.js"></script>
 	<script>	
	   $(document).ready(function()
{
	
	 $('#overlay').fadeOut('fast');
	    });
 function show()
 {
 
 var all= document.getElementById('all').value;
  var brncd= document.getElementById('brncd').value;

 $('#sgh').load('stock_list.php?all='+encodeURIComponent(all)+'&brncd='+brncd).fadeIn('fast');

 }


function pagnt(pno){
	  var brncd= document.getElementById('brncd').value;
        var ps=document.getElementById('ps').value;
        var src=document.getElementById('all').value;
    $('#sgh').load("stock_list.php?ps="+ps+"&pno="+pno+"&all="+encodeURIComponent(src)+'&brncd='+brncd).fadeIn('fast');
	$('#pgn').val=pno;
    }
	function pagnt1(pno){
	pno=document.getElementById('pgn').value;
	pagnt(pno);
	}

	
	
	function openOfferslDialog(sid) {

			  var brncd= document.getElementById('brncd').value;
		$('#contentl').load('stock_det.php?sl='+sid+'&brncd='+brncd).fadeIn("fast");
		

	$('#overlay').fadeIn('fast', function() {
		
		$('#boxpopupl').css('display','block');
		$('.boxopen').animate({'opacity': '1'});
        $('#boxpopupl').animate({'left':'5%'},600);
    });
}


function closeOfferslDialog(prospectElementID) {
	$('#overlay').fadeOut('fast', function() {
		
		$('#boxpopupl').css('display','block');
        $('#boxpopupl').animate({'left':'100%'},500);
		$('.boxopen').animate({'opacity': '1'});
    });
	
}


</script>

	</head>
 <body onload="show()" >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Stock Details
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Stock Details</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                   

                   

                    <!-- Main row -->
                    
                        <!-- Left col -->
                       
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        
                           

                            <!-- Chat box -->
					
                     <!-- /.box (chat box) -->

                            <!-- TO DO List -->
                          
	<form method="post" action="brnchs.php" id="form1" onSubmit="return check1()" name="form1">
                              
							
								


<input type="hidden">
  <center>
        <div class="box box-success" >
      <table border="0" width="860px" class="table table-hover table-striped table-bordered">

<tr>
<td align="right" width="30%" style="padding-top:15px"> 
<font size="3">
<b>Category :</b>
</font>
</td>
<td align="left">
<input type="text" name="all" id="all" class="form-control" style="width:400px">

</td>
<td align="right" style="padding-top:10px">
<b>Godown : </b>
</td>
<td align="left" >

    <select name="brncd" class="form-control" size="1" id="brncd"   >
<?
if($user_current_level<0)
{
	?>
	<option value="">---ALL---</option>
	<?
}
if($user_current_level<0)
{
$query="Select * from main_branch";
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>

</td>
</tr>
<tr>
<td colspan="4" align="right" style="padding-right:100px">
<input type="button" value=" Show " class="btn btn-info" onclick="show()">
</td>
</tr>


</tbody>
</table>
<div id="sgh">
</div>
	

	</div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->
<div id="wrapperl">
<div id="overlay" class="overlay"></div>
<div id="boxpopupl" class="boxl">
	
	<div class="topb">
     <div id="bnm" class="bnm"><h3><font color="#FFF"><b>Stock Details</b></font></h3></div>
 <div class="top_leftb" id="news_ttl"><a onclick="closeOfferslDialog('boxpopupl');" class="boxclosel"><img src="del1.png" height="30" width="30"></a>
      </div>
     
  </div>
	   <hr />
	
	<div id="contentl">


	</div>
</div>
</div> 
     

    </body>
</html>