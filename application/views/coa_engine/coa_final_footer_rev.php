</div>
<!-- end widget div -->

</div>
<!-- end widget -->

</article>


<!-- WIDGET END -->
</div>
</div>
<div class="tests_table" style="display:none;">

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

<div id="addTest" style="top:1000px; position: absolute; display:none;">
    <table>
        <tr><td>
                <button class="btn  btn-info addtest"><span class="fa fa-plus-circle"> Add Test</span></button>&nbsp;</td>
            <td>            <button class="btn btn-primary addsignatory"><span class="fa fa-plus-circle"> Add Signatory</span></button>
            </td>
        </tr>
    </table>
</div>

<div class="panel panel-success col-md-4 col-md-offset-4" style="height: 400px; display: none; margin-top: 100px;" id="signatoriesPanel">
    <div class="panel panel-heading">
        <p><span class="fa fa-plus-circle"> Add Signatory</span></p>
    </div>
    <div class="panel panel-body">
        <form id="signatoriesForm">
            <table class="table table-stripped table-condensed">
                <tr>
                    <td>DESIGNATION: </td><td><select name="designation" class="form-control select">
                            <option value="ANALYST">ANALYST</option>
                            <option value="REVIEWER">REVIEWER</option>
                            <option value="DIRECTOR">DIRECTOR</option>
                        </select></td>
                </tr>
                <tr>
                    <td>NAME:</td>
                    <td><input type="text" class="form-control input-medium" name="designator"/></td>
                </tr>
                <tr>
                    <td>DATE:</td>
                    <td><input type="text" class="form-control input-medium" name="date"/></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="panel panel-footer ">
        <input type="button" class="btn btn-primary btn-lg " id="add_desig_now" value="Save"/>

    </div>
</div>

<div class="panel panel-success col-md-4 col-md-offset-4" style="height: 400px; display: none; margin-top: 100px;" id="testsPanel">
    <div class="panel panel-heading">
        <p><span class="fa fa-plus-circle"> Add Test</span></p>
    </div>
    <div class="panel panel-body">
        <form id="ntf">
            <table class="table table-stripped table-condensed">

                <tr>
                    <td>TEST:</td>
                    <td><select name="test_1" id="test_1" class="form-control select select2" style="width:300px;">

                        </select></td>
                </tr>
                <tr>
                    <td>METHOD:</td>
                    <td><select name="method_1" id="method_1" class="form-control select select2" style="width:320px;">

                        </select> <br><br>                   <input type='text' class="form-control input-medium" id='method_2' style="display:none;"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="panel panel-footer ">
        <input type="button" class="btn btn-primary btn-lg " id="add_test_now" value="Save"/>

    </div>

</div>

<div class="panel panel-success col-md-8 col-md-offset-2" style=" display: none; height:400px; margin-top: 100px;" id="clientsPanel">
    <div class="panel panel-heading">
        <p><span class="fa fa-edit"> Edit Client</span></p>
    </div>
    <div class="panel panel-body">
        <form id="e_cli">
            <input id="client_id"  />

            <table class="table table-stripped table-condensed">

                <tr>
                    <td>NAME:</td>
                    <td><input  class="form-control input-lg client_data"   name="c_name" id="c_name"/></td>
                </tr>
                <tr>
                    <td>ADDRESS:</td>
                    <td><input class="form-control input-lg client_data"  name="c_address" id="c_address"/></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="panel panel-footer ">
        <input type="button" class="btn btn-primary btn-lg " id="edit_client_now" value="Save"/>
    </div>
</div>

<div class="panel panel-success col-md-4 col-md-offset-4" style=" display: none; height:300px; margin-top: 100px;" id="data">
    <div class="panel panel-heading">
        <p><span class="fa fa-edit"> Assign Draft COA</span></p>
    </div>
    <div class="panel panel-body">
        <form id="popup" class="form-horizontal" >


            <select name="director" required id="reviewer" class=" form-control select select2" style="width:300px;">
                <option value="" selected="selected" >--Select Reviewer--</option>

            </select>

        </form>
    </div>
    <div class="panel panel-footer ">
        <input type="button" class="btn btn-primary btn-lg " id="assign_button1" value="Assign Draft COA"/>
    </div>
</div>


<div class="panel panel-success col-md-10 col-md-offset-1" style=" display: none; height:auto; margin-top: 100px; overflow-y: auto;" id="overlay1">
    <div class="panel panel-heading">
        <p><span class="fa fa-edit"> <?php echo $labref; ?> SAMPLE CHANGELOG</span></p>
    </div>
    <div class="panel panel-body" >
        <div id="box">
            <table id = "clogData">
                <thead>
                    <tr>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>

</div>


</body>
<div id="overlay" class="overlay">
</div>

<div id="odf"></div>





<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script src="<?php echo base_url() . 'Scripts/migrate.js' ?>"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/app.config.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/app.min.js"></script>
<script src="<?php echo base_url(); ?>coa_engine/js/jarvis.widget.min.js"></script>
<script src="<?php echo base_url(); ?>coa_engine/js/jquery.storageapi.min.js"></script>
<script src="<?php echo base_url(); ?>coa_engine/js/jquery-confirm.js"></script>
<script src="<?php echo base_url(); ?>coa_engine/js/jquery.modal.min.js"></script>
<script src="<?php echo base_url(); ?>coa_engine/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>coa_engine/js/log.js"></script>

<script src = "<?php echo base_url(); ?>coa_engine/js/webodf.js" type="text/javascript" charset="utf-8"></script>
<script src = "<?php echo base_url(); ?>coa_engine/js/noty/packaged/jquery.noty.packaged.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/jquery.print-preview.js"></script>
<link href="<?php echo base_url() . 'bower_components/datatables/media/css/jquery.dataTables.css' ?>" type="text/css" rel="stylesheet"/>
<script src="<?php echo base_url() . 'bower_components/datatables/media/js/jquery.dataTables.js' ?>" type="text/javascript"></script>

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
        loadLabrefs();
        load_reviewers();
        removed = '';

        //generate('success');


        //   var odfelement = document.getElementById("odf"),
        // odfcanvas = new odf.OdfCanvas(odfelement);
//odfcanvas.load("<?php echo base_url(); ?>MANAGEMENT_FUNCTION.odt");


        $('#co_num').blur(function () {
            val = $(this).val();
            $.post(base_url + "coa/updatecan/" + labref, {can: val}, function () {
                generate('information', 'CAN Number successfully assigned to ' + val);
            }).fail(function () {
                generate('error', 'An error occured when assignig CAN Number, you can assign it manually in the file');
            })
        })

        $('.select2').select2();

        storage = $.localStorage;
        settings = $.localStorage;

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

            $("#clientsPanel").modal({
                fadeDuration: 1000,
                fadeDelay: 0.50
            });

        });

        $('#makeCOPY').click(function () {
            value = $('#labrefs_area').val();
            if (value === '') {
                $.alert('Kindly Select a Labref Number First');
            } else {



                $.confirm({
                    title: "MAKE A COPY of " + labref + '.docx TEMPLATE',
                    keyboardEnabled: true,
                    content: 'Please note that you are about to replicate one draft COA for another, the file structure will remain the same but the data will vary, please update the softcopy in LIMS and the generated Ms.Word doc appropriately to ensure data integrity.\nThis Feature is experimental and should be used with much care\n \nDo you want to continue?\n Press ESC to cancel or ENTER to continue ',
                    cancel: function () {

                    },
                    confirm: function () {
                        generate('information', 'Commencing Replication Operation.. Please Wait..');
                        $.getJSON(base_url + 'coa/makeCopy/' + $('#labref_coa').val() + '/' + value, function (resp) {
                            generate('success', 'Operation completed Successfully, Availing BAT file for download..');


                        }).fail(function (e)
                        {
                            generate('success', 'Operation completed Successfully, Availing Word document for download..');
                            window.location.href = "<?php echo base_url() . 'printed_coa/'; ?>" + value + '.docx';

                        });

                    }
                });



            }
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

            storage.set('client_id', $('#client_id').val());
            storage.set('c_name', $('#c_name').val());
            storage.set('c_address', $('#c_address').val());
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

            $('#client_id').val(storage.get('client_id'));
            $('#c_name').val(storage.get('c_name'));
            $('#c_address').val(storage.get('c_address'));
        }

        function clearStorageItems() {
            storage.removeAll(true);
        }
        
        function setSettings() {
            //TOP TEXT AREA
            settings.set('coa_size', $('#coa_size').val());
            settings.set('coa_size_rsize', $('#coa_size_rsize').val());
            settings.set('coa_line_spacing', $('#coa_line_spacing').val());
            settings.set('label_size', $('#label_size').val());
            settings.set('sublabel_size', $('#sublabel_size').val());
            settings.set('tfont', $('#tfont').val());

            //TOP SIDE TEXTAREA

            settings.set('theight', $('#theight').val());
            settings.set('fcfont', $('#fcfont').val());
            settings.set('fmfont', $('#fmfont').val());
            settings.set('flfont', $('#flfont').val());
            settings.set('rtrheight', $('#rtrheight').val());

            settings.set('rtconclusion', $('#rtconclusion').val());
            settings.set('sdes', $('#sdes').val());
            settings.set('sname', $('#sname').val());
            settings.set('sdate', $('#sdate').val());
        }

        function fetchSetSettings() {
            //TOP TEXT AREA
            $('#coa_size').val(storage.get('coa_size'));
            $('#coa_size_rsize').val(storage.get('coa_size_rsize'));
            $('#coa_line_spacing').val(storage.get('coa_line_spacing'));
            $('#label_size').val(storage.get('label_size'));
            $('#sublabel_size').val(storage.get('sublabel_size'));
            $('#tfont').val(storage.get('tfont'));

            //TOP SIDE TEXTAREA

            $('#theight').val(storage.get('theight'));
            $('#fcfont').val(storage.get('fcfont'));
            $('#fmfont').val(storage.get('fmfont'));
            $('#flfont').val(storage.get('flfont'));
            $('#rtrheight').val(storage.get('rtrheight'));

            $('#rtconclusion').val(storage.get('rtconclusion'));
            $('#sdes').val(storage.get('sdes'));
            $('#sname').val(storage.get('sname'));
            $('#sdate').val(storage.get('sdate'));
        }

        function clearSetting() {
            settings.removeAll(true);
        }

        function loadTopInfo(labref) {
            $(document).ajaxStart(function () {
                console.log('sss');
            });
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
                $('#client_ref').val(resp[0].clientsampleref);
                $('#client_id').val(resp[0].client_id);
                $('#c_name').val(resp[0].name);
                $('#c_address').val(resp[0].address);

                $can = $('#co_num').val(resp[0].CAN);

                if ($can === '' || $can === '0') {
                    $('#co_num').val("<?php echo $fyear; ?>");
                }
            })
                    .fail(function (e)
                    {
                        console.log(e);
                    });
            $(document).ajaxStop(function () {
                $('.fadeMe').hide();
            });


        }




        function loadLabrefs() {

            labrefs = $('#labrefs_area');
            $.getJSON(base_url + 'coa/coaLabrefAJAX/', function (resp) {
                labrefs.empty();
                $.each(resp, function (i, data) {
                    $option = '<option value=' + data.labref + '>' + data.labref + '</option>';
                    labrefs.append($option);
                });

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


        function loadTestMethods() {

            methods = $('#method_1');
            $.getJSON(base_url + 'coa/test_methods_AJAX/', function (resp) {
                methods.empty();
                $.each(resp, function (i, data) {
                    $option = '<option value=' + data.name + '>' + data.name + '</option>';
                    methods.append($option);
                });
                methods.append('<option value="1">Other</option>');

            })


                    .fail(function (e)
                    {
                        console.log(e);
                    });

        }


        function loadPureTests() {

            tests = $('#test_1');
            $.getJSON(base_url + 'coa/test_AJAX/', function (resp) {
                tests.empty();
                $.each(resp, function (i, data) {
                    $option = '<option value=' + data.id + '>' + data.name + '</option>'
                    tests.append($option);
                });

            })


                    .fail(function (e)
                    {
                        console.log(e);
                    });

        }

        function loadTestsRe(labref) {

            $(document).ajaxStart(function () {
                $('.fadeMe').show();
            });
            $.getJSON(base_url + 'coa/getRequestedTestsAJAXRe/' + labref, function (resp) {
                $('.tests_table tbody').empty();
                $.each(resp, function (i, data) {
                    //  console.log(data)
                    $row = "<tr id=\"testReorder_" + data.id + "\"><td>" + data.name + "</td> <td id='test_data_id' data-id=" + data.id + "><a href='#removeTest' class='removeTest' id=" + data.id + " data-name=" + data.name + " data-test_id=" + data.test_id + "><span class='fa fa-remove' title='Remove Test'></span></a></td></tr>";
                    $('.tests_table tbody').append($row);
                });



            })
                    .fail(function (e)
                    {
                        console.log(e);
                    });
            $(document).ajaxStop(function () {
                $('.fadeMe').hide();
            });
        }

        $(document).on('click', '.removeTest', function () {

            id = $(this).attr('id');
            $name = $(this).attr('data-name');
            tid = $(this).attr('data-test_id');
            console.log(id + tid);


            $.confirm({
                title: "DELETE " + $name,
                keyboardEnabled: true,
                content: 'You are about to PERMANENTLY Remove this test\nDo you want to continue?\n Press ESC to cancel or ENTER to continue ',
                cancel: function () {

                },
                confirm: function () {
                    $.ajax({
                        type: 'post',
                        url: "<?php echo base_url() . 'coa/deletetest/'; ?>" + labref + '/' + tid,
                        success: function () {
                            generate('success', $name + 'has been deleted Successfully!');
                            loadSampleTests(labref);
                            loadTestsRe(labref);
                        }, fail: function () {
                            generate('error', 'An error occured, Contact System Administrator');
                        }
                    })

                }
            });

        });


        $(document).on('click', '#removeSignature', function () {


            tid = $(this).attr('data-sid');



            $.confirm({
                title: "REMOVE SIGNATORY",
                keyboardEnabled: true,
                content: 'You are about to PERMANENTLY Remove this Signatory\nDo you want to continue?\n Press ESC to cancel or ENTER to continue ',
                cancel: function () {

                },
                confirm: function () {
                    $.ajax({
                        type: 'post',
                        url: "<?php echo base_url() . 'coa/remove_signatory/'; ?>" + tid,
                        success: function () {
                            generate('success', 'Signatory has been removed Successfully!');
                            loadSignatories(labref);
                        }, fail: function () {
                            generate('error', 'An error occured, Contact System Administrator');
                        }
                    })

                }
            });

        });


        $('#method_1').change(function () {
            value = $(this).val();
            if (value === '1') {
                $('#method_1').prop('name', '');
                $('#method_2').prop('name', 'method_1');
                $('#method_2').show();
                $('#method_2').prop('placeholder', 'Please specify Method here');
            } else {
                $('#method_2').prop('name', '');
                $('#method_1').prop('name', 'method_1');
                $('#method_2').hide();
            }
        });
        $('#method_2').hide();

        function loadSampleTests(labref) {


            $.getJSON(base_url + 'coa/getRequestedTestsDisplayAJAX/' + labref, function (resp) {

                $('.result_table tbody').empty();
                $.each(resp, function (di, data) {

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

                   

                        $rows = '<tr align="middle" valign="middle"><td class="tbody_data side" style="font-size:13px; " >' + data.name + '</td>\n\
                         <td align="center" valign="middle" class="tbody_data" style="padding: 0px;"><input type="hidden" name="tests[]" value=' + data.test_id + '>\n';
                        for (i = 0; i < $meth.length; i++) {
                            $rows += '<textarea class="det_st form-control" name="method_' + di + '[]" style="border:none; vertical-align: middle;" >' + $meth[i] + '</textarea>';

                        }
                        $rows += '</td><td class="tbody_data" style="padding: 0px;">';

                        for (i = 0; i < $comp.length; i++) {
                            $rows += '<textarea class="det_st form-control" name="compedia_' + di + '[]" style="border:none;" >' + $comp[i] + '</textarea>';

                        }


                        $rows += '  </td><td class="tbody_data" style="padding: 0px;">';

                        for (i = 0; i < $spec.length; i++) {
                            $rows += '<textarea class="det_st form-control" name="specification_' + di + '[]" style="border:none;" >' + $spec[i] + '</textarea>';

                        }

                        $rows += ' </td><td class="tbody_data" style="padding: 0px;" >';
                        for (i = 0; i < $det.length; i++) {
                            $rows += '<textarea class="det_st form-control" name="determined_' + di + '[]" style="border:none;" >' + $det[i] + '</textarea>';

                        }

                        $rows += '</td><td class="tbody_data side" width="50px">';

                        for (i = 0; i < $com.length; i++) {
                            $rows += '<select selected=selected disabled=disabled class="select select2 complies_split" name="complies_' + di + '[]" style="border:none; margin-top:10px; width:120px; ">\n\
                            <option value="' + $com[i] + '">' + $com[i] + '</option>\n\
                            <option value="COMPLIES">COMPLIES</option>\n\
                            <option value="DOES NOT COMPLY">DOES NOT COMPLY</option>\n\
                            <option value=":">SPLIT</option>\n\
                            <option value="Remove">REMOVE</option>\n\
                            </select>';

                        }
                        $rows += ' </td></tr>';
                   

                    $('.result_table tbody').append($rows);
                    $('.result_table tbody td').css('vertical-align', 'middle');
                    $('.complies_split').css('padding', '15px');
                    $('.complies_split').css('width', '150px');

                    $('textarea').css('overflow', 'hidden');
                    $('textarea').css('padding-top', '15px');
                    $('.textarea_top').css('padding-top', '0px');
                    $('#COA_AREA').css('font-family', 'Book Antiqua');

                    $('#Conclusion').val(resp[0].conclusion);
                });


                $("textarea").each(function () {
                    this.style.height = (this.scrollHeight + 0) + 'px';
                })
				
				$('textarea , input , select').prop('readonly',true);





            })
                    .fail(function (e)
                    {
                        console.log(e);
                    });
        }

        $(document).on('change', '.complies_split', function () {
            $value = $(this).val();
            if ($value === ':') {
                saveCOA();
            } else if ($value === 'Remove') {
                $(this).remove();
            }
        });

        function loadSignatories(labref) {


            $.getJSON(base_url + 'coa/getSignatoriesAJAX/' + labref, function (resp) {
                $('#signatoriesData').empty();
                $.each(resp, function (i, data) {
                    //  console.log(data)
                    $row = ' <div class="form-group" > <div class="col-sm-2"> <input type="text" style="border :none;" name="designation[]" class="designator form-control" value=' + data.designation + ' style="text-align:left;"/></div> <div class="col-sm-3"> <input type="text" style="border :none;" name="designator[]" class="designator form-control" value="' + data.signature_name + '" style="text-align:left;"/></div>  <div class="col-sm-3"> <input type="text" style="border :none;" name="signature[]" class="signature form-control" value="________________________________________" readonly/> </div> <div class="col-sm-3"> <input type="text" style="border :none;" name="date[]" class="date form-control" value=' + data.date_signed + ' placeholder="Enter Date"/></div></div>';
                    $('#signatoriesData').append($row);
                });
				$('input').prop('disabled',true);



            })
                    .fail(function (e)
                    {
                        console.log(e);
                    });

        }



// Initialize an array to store all the removed textareas.
        var removedTextAreas = [];

        $(document).on("mouseover", ".result_table tr td", function () {

            // How many textareas within this cell?
            var numberOfTextAreas = $("textarea", this).length;

            // Handle the double click event.
            handleDblClick(numberOfTextAreas, this);
        });

        $("#hrefUndo").on("click", function () {
            // Is there anything removed and not undone?
            if (removedTextAreas.length > 0) {
                // The undo goes from the last to the first in the list.
                // We always re-attach the last one that has been removed.
                var itemPos = removedTextAreas.length - 1;
                var reAttach = removedTextAreas[itemPos];
                var previous = reAttach.previous;
                var next = reAttach.next;

                if (previous.length > 0) {
                    // The removed element had a sibling before it,
                    // so let's append it back after this sibling.
                    reAttach.textarea.appendTo(reAttach.cell);
                } else {
                    // The removed element had a sibling after it,
                    // so let's append it back before this sibling.
                    reAttach.textarea.prependTo(reAttach.cell);
                }

                // We now can remove this item from the list of
                // removed textareas.
                removedTextAreas.splice(itemPos);
            }
        });

// Let's separate concerns by creating a function.
// This way you can also reduce the code within the caller.
        function handleDblClick(numberOfTextAreas, el) {
            // The target for the double click.
            var target = $("textarea", el);

            // Let's unbind the double click to start with.
            target.off("dblclick");

            // Two or more textareas?
            if (numberOfTextAreas >= 2) {
                target.on("dblclick", function () {
                    // Let's store the removed textarea and some details
                    // to identify its current parent and siblings.
                    removedTextAreas.push({
                        cell: $(this).closest("td"),
                        previous: $(this).prev("textarea"),
                        next: $(this).next("textarea"),
                        textarea: $(this).detach()
                    });
                });
            }
        }





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


        function generate(type, text) {
            var n = noty({
                text: text,
                type: type,
                dismissQueue: true,
                timeout: 10000,
                closeWith: ['click'],
                layout: 'topCenter',
                theme: 'defaultTheme',
                maxVisible: 10,
            });
            console.log('html: ' + n.options.id);
        }

        $('.addsignatory').click(function () {
            $("#signatoriesPanel").modal({
                fadeDuration: 1000,
                fadeDelay: 0.50
            });
        });

        $('.addtest').click(function () {
            loadPureTests();
            loadTestMethods();
            $("#testsPanel").modal({
                fadeDuration: 1000,
                fadeDelay: 0.50
            });

        });
        $('#add_desig_now').click(function () {
            $.ajax({
                type: 'post',
                data: $('#signatoriesForm').serialize(),
                url: "<?php echo base_url() . 'coa/send_to_signatureAJAX/'; ?>" + labref,
                success: function () {
                    generate('success', 'Signatory has been Added Successfully!');
                    loadSignatories(labref);
                    $.modal.close();
                }, fail: function () {
                    generate('error', 'An error occured, Contact System Administrator');
                }
            });
        });


        $('#SaveGenCOAS').click(function () {
            saveCOA();

        });


        function saveCOA() {
            $(this).prop('disabled', 'disabled');
            postData = $('#COAF').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>coa/saveCOA/" + labref,
                data: postData,
                success: function () {

                    loadTopInfo(labref);
                    loadSampleTests(labref);
                    generate('success', 'COA Successfully Saved');
                    $("#SaveGenCOAS").prop('disabled', false);
                },
                error: function () {
                    generate('error', 'COA Engine Encountered an error while saving, Please contact System Administrator');

                    return false;
                }

            });

        }
        $('#genCOAS').click(function () {
            $('#printable_area').print();
        });


        $('#BackButton').click(function () {

            window.location.href = "<?php echo base_url() . 'documentation/fromDirector/'; ?>";
            return false;
        });


        $('#edit_client_now').click(function () {

            $(this).prop('disabled', 'disabled');
            postData = $('#e_cli').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>coa/saveClient/" + $('#client_id').val(),
                data: postData,
                success: function () {

                    generate('success', 'Save Successfull');
                    $.modal.close();
                    loadTopInfo(labref);

                },
                error: function () {
                    generate('error', 'An Error Was Encountered!');
                    return false;
                }

            });

        });


        $('#add_test_now').click(function () {

            $(this).prop('disabled', 'disabled');
            postData = $('#ntf').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>coa/saveCOANT/" + labref,
                data: postData,
                success: function () {

                    generate('success', 'Save Successfull');
                    $.modal.close();
                    loadSampleTests(labref);
                    loadTestsRe(labref);
                    $('#add_test_now').prop('disabled', false);


                },
                error: function () {
                    generate('error', 'An Error Was Encountered!');
                    return false;
                }

            });

        });




        $('#genCOAWordDATA').click(function () {
            generate('information', 'COA Save process started..');


            postData = $('#COAF').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>coa/saveCOA/" + labref + "/coa_printing",
                data: postData,
                success: function () {

                    generate('success', 'COA Has been succesfully Saved');

                    $("#coaSettings").modal({
                        fadeDuration: 1000,
                        fadeDelay: 0.50
                    });
                     fetchSetSettings();

                    return true;


                },
                error: function () {
                    generate('error', 'An error occured while attempting to export the draft, please contact system Administrator for help!');

                    return false;
                }

            });

        });

        $('#GenCOAFinal').click(function () {
            setSettings();
            data = $('#coa_settings').serialize();
            generate('information', 'Exporting final COA to Ms.Word and preparing download..');

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>wordexe/generate/" + labref,
                data: data,
                success: function () {
                    generate('success', 'COA successfully Generated and exported, Please click "Save File" for ' + labref + '.docx..')
                   
                    $('#genCOAWordDATA').prop('disabled', false);
                     
                    window.location.href = "<?php echo base_url() . 'printed_coa/'; ?>" + labref + '.docx';
                    $.modal.close();
                    return true;


                }, error: function () {
                    generate('error', 'An error occured while attempting to export the draft, please contact system Administrator for help!');
                    return false;
                }

            });
        });

        function load_reviewers() {


            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>assign_director/getAJAXDirectors/",
                dataType: "JSON",
                success: function (reviewers)
                {

                    $.each(reviewers, function (id, city)
                    {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(city.id);
                        opt.text(city.lname + " " + city.fname);
                        $('#reviewer').append(opt);
                    });
                }

            });
        }

        $('#assign_button1').click(function () {
            var rev = $('#reviewer').val();
            if (rev == '') {
                generate('error', "Assign Error: No Reviewer Selected!");

                return true;
            } else {


                var labref = $('#labref_no').val();
                var data1 = $('#popup').serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>assign_director/sendSamplesFolderToDirector/" + labref,
                    data: data1,
                    success: function (data)
                    {

                        generate('success', "Draft COA Successfully Assigned");


                        window.location.href = '<?php echo base_url(); ?>documentation/reviewed';

                        return true;
                    },
                    error: function (data) {
                        generate('error', "An error occured, Please contact System Administrator");



                        return false;
                    }
                });
                return false;
            }
        });

        $(function () {
            $('#show_logs').click(function () {
                $('#overlay1').modal();
                $('#box').animate({'top': '160px'}, 500);
                loadLogs(labref);

            });

        });


        function loadLogs(labref) {
            $('#clogData').DataTable({
                "scrollX": true,
                "createdRow": function (row, data, dataIndex) {
                    if (data[4] == "dfdfd") {
                        $(row).addClass('important');
                    }
                },
                "order": [[0, "desc"]],
                "aoColumns": [
                    {"sTitle": "id", "mData": "id", "visible": false, "bSortable": true},
                    {"sTitle": "Test", "mData": "name"},
                    {"sTitle": "CHANGE", "mData": "field_changed"},
                    {"sTitle": "OLD DATA", "mData": "from_what"},
                    {"sTitle": "NEW DATA", "mData": "to_what"},
                    {"sTitle": "DATE MODIFIED", "mData": "date_time"},
                    {"sTitle": "USER", "mData": "user"},
                ],
                "bDeferRender": true,
                "bProcessing": true,
                "bDestroy": true,
                "bLengthChange": true,
                "bStateSave": true,
                "iDisplayLength": 5,
                "sAjaxDataProp": "",
                "sAjaxSource": '<?php echo site_url() . "coa/ChangeLog/" ?>' + labref,
            });
        }



    });
</script>
</body>

</html>
