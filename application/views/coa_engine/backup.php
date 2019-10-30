<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>coa_engine/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>coa_engine/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>coa_engine/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>coa_engine/css/main.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>coa_engine/css/jquery-confirm.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>coa_engine/js/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css"/>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>coa_engine/css/smartadmin-production-plugins.min.css">
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Brand</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                        <li><a href="#Copy-to-Clipboard" id="hrefCopy"><span class="fa fa-copy" title="Copy to Browser Clipboard  Ctl+C"></span></a></li>
                        <li><a href="#Paste-from-Clipboard" id="hrefPaste"><span class="fa fa-paste" title="Copy from Browser Clipboard   Ctl+V"></span></a></li>
                        <li><a href="#EmptyClipboard" id="hrefEmpty"><span class="fa fa-cut" title="Empty Browser Clipboard"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#Clear" id="hrefClear"><span class="fa fa-trash-o"> Clear Form</span></a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div id="content" style="margin-top: 55px;">
            <div class="row">

                <!-- NEW WIDGET START -->
                <article class="col-md-9 col-md-offset-2" id="COA_AREA">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
                        <!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                        data-widget-colorbutton="false"
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true"
                        data-widget-sortable="false"

                        -->
                        <header>
                            <span class="widget-icon"> <i class="fa fa-eye"></i> </span>


                        </header>

                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body " >

                                <form class="form-horizontal">
                                    <div class="row">
                                        <fieldset>

                                            <table id="coa_top_table" class="table-condensed">
                                                <tr id="top_row" >
                                                    <td id="top_head" height="25" align="center" valign="middle"><span class="control-label">PRODUCT</span></td>
                                                    <td id="middle_head" align="left" valign="middle" colspan="2"><textarea name="product_name" id="product_name"  class="form-control textarea_top"  style="width:480px; border:none; " rows="1"></textarea> <span  id="p_name" class="control-label" style="position:absolute; top:20px; margin-left: 505px; width:200px;">REF. NO: &nbsp;</span></td>

                                                </tr>
                                                <tr>
                                                    <td align="center" valign="middle" id="side"><span>DATE RECEIVED</span></td>
                                                    <td rowspan="2" align="left" valign="top" id="label_name" class="left_c textarea_top_side"><span>LABEL CLAIM</span></td>
                                                    <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%; border:none;" name="labelclaim" id="labelclaim" class="form-control textarea_top"></textarea></td>
                                                </tr>
                                                <tr align="center" valign="middle">
                                                    <td id="side"><input class="form-control textarea_top_side" style="width:150px;  border:none;" type="text" value="" name="date_received" id="date_received"></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="middle" id="side"><span>BATCH NO.</span></td>
                                                    <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>PRESENTATION</span></td>
                                                    <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%; border:none;" class="form-control textarea_top" name="presentation" id="presentation"></textarea></td>
                                                </tr>
                                                <tr align="center" valign="middle">
                                                    <td id="side"><textarea name="batch_no" class="form-control textarea_top_side" style="text-align:center;  border:none;" id="batch_noo"></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="middle" id="side"> <span>MGF. DATE</span></td>
                                                    <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>MANUFACTURER</span></td>
                                                    <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%; border:none;" class="form-control textarea_top" name="manufacturer" id="manufacturer"></textarea></td>
                                                </tr>
                                                <tr align="center" valign="middle">
                                                    <td id="side"><textarea name="mnfg_date" class="form-control textarea_top_side" id="mnfg_date" class="monthYearPicker" style="text-align:center;  border:none;"></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="middle" id="side"><span>EXP. DATE</span></td>
                                                    <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>ADDRESS</span></td>
                                                    <td rowspan="2" align="left" valign="top" id="wording"><textarea  class="form-control textarea_top" style="width:100%; border:none;" name="address" id="addre"></textarea></td>
                                                </tr>
                                                <tr align="center" valign="middle">
                                                    <td id="side"><textarea  name="exp_date"  class="form-control textarea_top_side" id="exp_date" class="monthYearPicker" style="text-align:center;  border:none;"></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="middle" id="side">&nbsp;</td>
                                                    <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>CLIENT</span></td>
                                                    <td rowspan="2" align="left" valign="top" id="wording"><textarea class="form-control textarea_top" style="width:100%; border:none;" name="client" id="client"></textarea></td>
                                                </tr>
                                                <tr align="center" valign="middle">
                                                    <td id="side"><span>CLIENT REF NO</span></td>
                                                </tr>
                                                <tr>
                                                    <td height="40" align="center" valign="middle" id="side"><textarea type="text" class="form-control textarea_top_side" style="border:none;" name="client_ref" id="client_ref"></textarea></td>
                                                    <td align="left" valign="bottom" id="label_name">TESTS REQUESTED:</td>
                                                    <td align="left" valign="bottom" id="wording" style="font-size: 13px;"><span id="requested_tests"></span></td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                    </div>

                                    <div class="row col-md-12" style="text-align: center; font-weight: bolder; margin: 10px;">
                                        RESULTS

                                    </div>
                                    <fieldset>
                                        <table class="table table-condensed col-md-12 result_table">
                                            <thead style="border:solid black 1px;">
                                            <td class="side">TEST</td>
                                            <td class="tdbold">METHOD</td>
                                            <td class="tdbold">COMPENDIA</td>
                                            <td class="tdbold">SPECIFICATION</td>
                                            <td class="tdbold">DETERMINED</td>
                                            <td class="side">REMARKS</td>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </fieldset>



                                    <div class="form-group">
                                        <table>
                                            <td><label class="col-md-2 control-label">CONCLUSION:</label></td>
                                            <td>
                                                <div class="col-md-10">
                                                    <textarea style="border :none; width: 728px;" class="form-control" placeholder="Conclusion" id="Conclusion" rows="1"></textarea>
                                                </div>
                                            </td>
                                        </table>
                                    </div>

                                    <div row class="col-md-10 col-md-offset-2" id="signatoriesData">
                                    </div>





                                </form>

                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </article>


                <!-- WIDGET END -->
            </div>
        </div>
        <div class="tests_table">

            <table class="table table-condensed table-bordered table-striped" >
                <thead>
                <th>Tests (Drag Rows To Reorder)</th>
                </thead>
                <tbody id="sortable_row">

                </tbody>
                <tfoot style="background: #d7ebf9">
                <th>Drag rows to tests</th>
                </tfoot>

            </table>
        </div>





        <script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/app.config.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/app.min.js"></script>
        <script src="<?php echo base_url(); ?>coa_engine/js/jarvis.widget.min.js"></script>
        <script src="<?php echo base_url(); ?>coa_engine/js/jquery.storageapi.min.js"></script>
        <script src="<?php echo base_url(); ?>coa_engine/js/jquery-confirm.js"></script>
        <script>
            $(document).ready(function () {
                pageSetUp();
                base_url = "<?php echo base_url(); ?>";
                labref = "<?php echo $labref; ?>";
                loadTopInfo(labref);
                loadTests(labref);
                loadTestsRe(labref);
                loadSampleTests(labref);
                loadSignatories(labref);
                removed ='';

                storage = $.localStorage;

                $('#hrefClear').click(function () {

                    $('.textarea_top_side').text('');
                    $('.textarea_top').text('');
                });

                $('#hrefCopy').click(function () {
                    copyStorageItems();
                });

                $('#hrefPaste').click(function () {
                    pasteStorageItems();
                });
                $('#hrefEmpty').click(function () {

                    $.confirm({
                        title: 'Clear Clipboard?',
                        content: "You are about to clear the clipboard, you will not be able to paste the COA data you previously copied",
                        autoClose: 'cancel|10000',
                        confirm: function () {
                            clearStorageItems();
                        },
                        cancel: function () {
                            console.log('Cancelled');
                        }
                    });

                });

                $('#client').click(function () {

                    $.confirm({
                        title: 'Clear Clipboard?',
                        content: "You are about to clear the clipboard, you will not be able to paste the COA data you previously copied",
                        autoClose: 'cancel|10000',
                        confirm: function () {
                            clearStorageItems();
                        },
                        cancel: function () {
                            console.log('Cancelled');
                        }
                    });

                });



                function copyStorageItems() {
                    //TOP TEXT AREA
                    storage.set('product_name', $('#product_name').val());
                    storage.set('labelclaim', $('#labelclaim').val());
                    storage.set('presentation', $('#presentation').val());
                    storage.set('manufacturer', $('#manufacturer').val());
                    storage.set('address', $('#addre').val());
                    storage.set('client', $('#client').val());

                    //TOP SIDE TEXTAREA

                    storage.set('date_received', $('#date_received').val());
                    storage.set('batch_no', $('#batch_noo').val());
                    storage.set('exp_date', $('#exp_date').val());
                    storage.set('mnfg_date', $('#mnfg_date').val());
                    storage.set('client_ref', $('#client_ref').val());
                }

                function pasteStorageItems() {
                    //TOP TEXT AREA
                    $('#product_name').val(storage.get('product_name'));
                    $('#labelclaim').val(storage.get('labelclaim'));
                    $('#presentation').val(storage.get('presentation'));
                    $('#manufacturer').val(storage.get('manufacturer'));
                    $('#addre').val(storage.get('address'));
                    $('#client').val(storage.get('client'));

                    //TOP SIDE TEXTAREA

                    $('#date_received').val(storage.get('date_received'));
                    $('#batch_noo').val(storage.get('batch_no'));
                    $('#exp_date').val(storage.get('exp_date'));
                    $('#mnfg_date').val(storage.get('mnfg_date'));
                    $('#client_ref').val(storage.get('client_ref'));
                }

                function clearStorageItems() {
                    storage.removeAll(true);
                }

                function loadTopInfo(labref) {
                    $.getJSON(base_url + 'coa/getRequestInformationAJAX/' + labref, function (resp) {

                        $('#labref_coa').val(labref);
                        $('#p_name').text('REF. NO: ' + labref);
                        $('#product_name').val(resp[0].product_name);
                        $('#labelclaim').val(resp[0].label_claim);
                        $('#presentation').val(resp[0].presentation);
                        $('#manufacturer').val(resp[0].manufacturer_name);
                        $('#addre').val(resp[0].manufacturer_add);
                        $('#client').val(resp[0].name + ' ' + resp[0].address);

                        //TOP SIDE TEXTAREA

                        $('#date_received').val(resp[0].designation_date);
                        $('#batch_noo').val(resp[0].batch_no);
                        $('#exp_date').val(resp[0].exp_date);
                        $('#mnfg_date').val(resp[0].manufacture_date);
                        $('#client_ref').val(resp[0].client_ref);
                    })
                            .fail(function (e)
                            {
                                console.log(e);
                            });



                }
                function loadTests(labref) {


                    $.getJSON(base_url + 'coa/getRequestedTestsAJAX/' + labref, function (resp) {
                        // console.log(resp)
                        $('#requested_tests').text('');
                        $('#requested_tests').text(resp);

                    })
                            .fail(function (e)
                            {
                                console.log(e);
                            });

                }
                function loadTestsRe(labref) {


                    $.getJSON(base_url + 'coa/getRequestedTestsAJAXRe/' + labref, function (resp) {
                        $.each(resp, function (i, data) {
                            //  console.log(data)
                            $row = "<tr id=\"testReorder_" + data.id + "\"><td>" + data.name + "</td> </tr>";
                            $('.tests_table tbody').append($row);
                        });



                    })
                            .fail(function (e)
                            {
                                console.log(e);
                            });
                }

                function loadSampleTests(labref) {


                    $.getJSON(base_url + 'coa/getRequestedTestsDisplayAJAX/' + labref, function (resp) {

                        $('.result_table tbody').empty();
                        $.each(resp, function (i, data) {

                            $determined = data.determined;
                            $det = $determined.split(":");
                            $method = data.method;
                            $meth = $method.split(":");
                            $compedia = data.compedia;
                            $comp = $compedia.split(":");
                            $specification = data.specification;
                            $spec = $specification.split(":");
                            $complies = data.complies;
                            $com = $complies.split(":");

                            $rows = '<tr align="center" valign="middle"><td class="tbody_data side" style="font-size:13px; " >' + data.name + '</td>\n\
                                 <td align="center" valign="middle" class="tbody_data" style="padding: 0px;"><input type="hidden" name="tests[]" value='+data.test_id+'>\n';
                            for (i = 0; i < $meth.length; i++) {
                                $rows += '<textarea class="det_st form-control" style="border:none; vertical-align: middle;" >' + $meth[i] + '</textarea>';

                            }
                            $rows += '</td><td class="tbody_data" style="padding: 0px;">';

                            for (i = 0; i < $comp.length; i++) {
                                $rows += '<textarea class="det_st form-control" style="border:none;" >' + $comp[i] + '</textarea>';

                            }


                            $rows += '  </td><td class="tbody_data" style="padding: 0px;">';

                            for (i = 0; i < $spec.length; i++) {
                                $rows += '<textarea class="det_st form-control" style="border:none;" >' + $spec[i] + '</textarea>';

                            }

                            $rows += ' </td><td class="tbody_data" style="padding: 0px;">';
                            for (i = 0; i < $det.length; i++) {
                                $rows += '<textarea class="det_st form-control" style="border:none;" >' + $det[i] + '</textarea>';

                            }

                            $rows += '</td><td class="tbody_data side">';

                            for (i = 0; i < $com.length; i++) {
                                $rows += '<select selected=selected class="select" style="border:none; margin:15px; width:145px;">\n\
                                    <option value="' + $com[i] + '">' + $com[i] + '</option>\n\
                                    <option value="COMPLIES">COMPLIES</option>\n\
                                    <option value="DOES NOT COMPLY">DOES NOT COMPLY</option>\n\
                                    </select>';

                            }
                            $rows += ' </td></tr>';

                            $('.result_table tbody').append($rows);

                            $('#Conclusion').val(resp[0].conclusion);
                        });
                        
                        $(function () {
    $("textarea").each(function () {
        this.style.height = (this.scrollHeight+10)+'px';
    });
});



                    })
                            .fail(function (e)
                            {
                                console.log(e);
                            });
                }

                function loadSignatories(labref) {


                    $.getJSON(base_url + 'coa/getSignatoriesAJAX/' + labref, function (resp) {
                        $.each(resp, function (i, data) {
                            //  console.log(data)
                            $row = ' <div class="form-group"> <div class="col-sm-2"> <input type="text" style="border :none;" name="designator[]" class="designator form-control" value=' + data.designation + ' style="text-align:left;"/></div> <div class="col-sm-3"> <input type="text" style="border :none;" name="designator[]" class="designator form-control" value="' + data.signature_name + '" style="text-align:left;"/></div>  <div class="col-sm-3"> <input type="text" style="border :none;" name="signature[]" class="signature form-control" value="________________________________________" readonly/> </div> <div class="col-sm-3"> <input type="text" style="border :none;" name="date[]" class="date form-control" value=' + data.date_signed + ' placeholder="Enter Date"/></div> </div>';
                            $('#signatoriesData').append($row);
                        });



                    })
                            .fail(function (e)
                            {
                                console.log(e);
                            });
                      
                }
                
                      
                            $(document).on('mouseover', '.result_table tr td', function() {
  $('textarea', this).dblclick(function() {
    var self = $(this);
    var nbelement = self.parent('td').find('textarea').length;
    if (nbelement >= 2) {
     removed = self.remove();
    }
  });
});










                $('#sortable_row').sortable({
                    update: function (event, ui) {
                        var data = $('#sortable_row').sortable('serialize');

                        $.ajax({
                            data: {list: data},
                            type: 'POST',
                            url: base_url + 'coa/updateQuestionOrder/',
                            success: function (response) {
                                loadTests(labref);
                                loadSampleTests(labref)
                            }, error: function () {

                            }
                        });
                    }
                });





            });
        </script>
    </body>

</html>
