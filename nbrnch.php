<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";

date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$m=date('m');
$y=date('y');
if($m>3)
{
$yy="G&co/".$y."-".($y+1)."/";	
}
elseif($m<3)
{
$yy="G&co/".($y-1)."-".$y."/";	
}
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <?
include "left_bar.php";
?>
    <style type="text/css">
    th {
        text-align: center;
        color: #000;
        border: 1px solid #37880a;
    }

    input:focus {
        background-color: Aqua;
    }

    a {
        cursor: pointer;
    }
    </style>
    <script>
    function check1() {
        if (document.form1.sn.value == '') {
            alert("Please Enter Branch Name !");
            document.form1.sn.focus();
            return false;
        }
        if (document.form1.addr.value == '') {
            alert("Please Enter Branch Address !");
            document.form1.addr.focus();
            return false;
        }
        if (document.form1.bcnt.value == '') {
            alert("Please Enter Branch Contact No. !");
            document.form1.bcnt.focus();
            return false;
        } else {
            document.forms["form1"].submit();
        }
    }

    function show() {
        var all = document.getElementById('all').value;
        $('#sgh').load('brnch_vws.php?all=' + encodeURIComponent(all)).fadeIn('fast');
    }

    function pagnt(pno) {
        var ps = document.getElementById('ps').value;
        var src = document.getElementById('all').value;
        $('#sgh').load("brnch_vws.php?ps=" + ps + "&pno=" + pno + "&all=" + encodeURIComponent(src)).fadeIn('fast');
        $('#pgn').val = pno;
    }

    function pagnt1(pno) {
        pno = document.getElementById('pgn').value;
        pagnt(pno);
    }

    function edit(sl) {
        document.location = 'branch_edit.php?sl=' + sl;
    }


    function check(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode; // ONLY NUMBER FOR NUMBER FIELD
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    function ctagupdate(sl,val)
{
$('#alld').load('ctag_update.php?sl='+sl+'&val='+val+'&fld=ctag').fadeIn('fast');
}
    </script>

    <body onload="show()">
<div id="alld"></div>
        <!-- Right side column. Contains the navbar and content of the page -->

        <aside class="right-side">

            <!-- Content Header (Page header) -->

            <section class="content-header">

                <h1 align="center">

                    New Branch

                    <small>Entry</small>

                </h1>

                <ol class="breadcrumb">

                    <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>

                    <li class="active">New Branch</li>

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
                    <input type="hidden" name="bls" id="bls" class="form-control" value="" size="20"
                        placeholder="Enter Alias">
                    <input type="hidden" name="vat" id="vat" class="form-control" size="20" placeholder="Vat No.">
                    <center>
                        <div class="box box-success">
                            <table border="0" width="800px" align="center"
                                class="table table-hover table-striped table-bordered">
                                <tr>
                                    <td align="right">Name :</td>
                                    <td align="left">
                                        <input type="text" class="form-control" name="sn" id="sn" size="20"
                                            placeholder="Enter Name">
                                    </td>
                                    <td align="right">Contact No. :</td>
                                    <td align="left">
                                        <input type="text" name="bcnt" id=="bcnt" class="form-control" size="20"
                                            onkeypress="return check(event)" maxlength="10"
                                            placeholder="Enter Contact No">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">Address :</td>
                                    <td align="left" colspan="3">
                                        <input type="text" name="addr" id="addr" class="form-control" size="20"
                                            placeholder="Enter Address">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right" style="padding-right: 8px;">
                                        <input type="submit" value="Submit" class="btn btn-primary" name="B1">
                                        <input type="reset" class="btn btn-primary" value="Reset" name="B2">
                                    </td>
                                </tr>
                            </table>
                        </div>

                </form><!-- /.box-body -->
                <div class="box box-success">
                    <table border="0" width="860px" class="table table-hover table-striped table-bordered">
                        <tr>
                            <td align="right" width="30%" style="padding-top:15px">
                                <font size="3"><b>Search :</b></font>
                            </td>
                            <td align="left" width="40%">
                                <input type="text" name="all" id="all" class="form-control" style="width:400px">
                            </td>
                            <td align="left" width="30%">
                                <input type="button" value=" Show " class="btn btn-primary" onclick="show()">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="sgh"></div>
                <div class="box-footer clearfix no-border">



                </div>

</div>

<!-- /.box -->
<!-- right col -->

<!-- /.row (main row) -->
</section><!-- /.content -->

</aside><!-- /.right-side -->
<!-- add new calendar event modal -->

</body>

</html>