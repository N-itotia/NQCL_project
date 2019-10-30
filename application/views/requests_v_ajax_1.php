<div class ="content">
    <style type="text/css">
        .tg,.tig, .tk  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
        .tg ,.tig,.tig td, .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
        .tg ,.tig,.tg th, .tig th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
        .tg, .tig,.tg-ugh9{background-color:#C2FFD6}
        .tk,.tig, .tk td, .tig td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
        .tk,.tig, .tk th, .tig th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
        .tk ,.tig,.tg-ugh9{background-color:#C2FFD6}
        .other{
            display: none;
        }

        tr.even:hover td,
        #mtTable tr.even:hover td,
        #mtTable tr.even:hover td.sorting_1 { background-color: #00CC33;
                                              border-top: 2px solid #00CC33;
                                              border-bottom: 2px solid #00CC33; }

        tr.odd:hover td,
        #mtTable tr.odd:hover td,
        #mtTable tr.odd:hover td.sorting_1 { background-color: #00CC33;
                                             border-top: 2px solid #00CC33;
                                             border-bottom: 2px solid #00CC33; }
        </style>


        <div id="test_filter" style="display: none;">
        <form id="test_f">
            <table class="tg" style="width:200px; ">

                <tr>
                    <td><strong>Test</strong></td>
                    <td><select name="testname" id="testname" >
                            <option value="">--Select Test--</option>
                            <?php foreach ($tests as $t): ?>
                                <option value="<?php echo $t->id; ?>" ><?php echo $t->name; ?></option>
                            <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <td class="tg-031e">Date From</td>
                    <td class="tg-031e">
                        <input type ="text" class="filter_date" id="f_date_from"/>

                    </td>   
                </tr>

                <tr>
                    <td class="tg-031e">Date To</td>
                    <td class="tg-031e">
                        <input type ="text" class="filter_date" id="f_date_to"/>		

                    </td>   
                </tr>
                <tr>
                    <td></td>
                    <td><input type ="button" class="submit" value="Genarate" id="generate_tests"/> &nbsp; <input type ="button" value="Cancel" id="cancel_generate"/></td>
                </tr>


            </table>


        </form>
    </div>



    <div id="period_filter" style="display: none;">
        <form id="period_f">
            <table class="tg" style="width:250px; ">

                <tr>
                    <td class="tg-031e">Date From</td>
                    <td class="tg-031e">
                        <input type ="text" class="filter_date" id="f_date_from1"/>

                    </td>   
                </tr>

                <tr>
                    <td class="tg-031e">Date To</td>
                    <td class="tg-031e">
                        <input type ="text" class="filter_date" id="f_date_to1"/>        

                    </td>   
                </tr>
                <td></td>
                <td><input type ="button" class="submit" value="Genarate" id="generate_period"/></td>
                </tr>


            </table>


        </form>
    </div>





    <div id="sample_update_1" style="display: none;">
        <form id="request_update">
            <table class="tg" id="table_update" style="width:1000px; ">

                <tr>
                    <td colspan="5"><center><strong>Sample Number: <select name="sample_req" id="sample_req" >
                            <?php foreach ($request as $req): ?>
                                <option value="<?php echo $req->request_id; ?>" ><?php echo $req->request_id; ?></option>
                            <?php endforeach; ?>
                        </select></center></td>
                </tr>
                <tr>
                    <th class="tg-031e">Activity</th>
                    <th class="tg-031e">From</th>
                    <th class="tg-031e">To </th>
                    <th class="tg-031e">Date / CAN No. </th>
                    <th class="tg-031e"><a href="#add" id="add_row"> +Add Row</a> </th>
                </tr>

                <tbody>
                    <tr><td colspan="3"></td><td></td><td colspan="3"></td></tr>
                </tbody>
            </table>
            <div id="table_sample_details">

            </div>

        </form>
    </div>

    <div id="data_response" style="display: none;">
        <table class="tg tj" >
            <tr><td colspan="5"><center><strong><em><br><span id="labr"></span>ACTIVITY LOG</em></strong></center></td></tr>
            <tr><td colspan="5" style="font-weight: bold; color: red;">NB: The table below holds information of old samples</td></tr>

            <tr>
            <tr>
                <th class="tg-031e">Activity</th>
                <th class="tg-031e">From</th>
                <th class="tg-031e">To </th>
                <th class="tg-031e">Date / CAN No. </th>
            </tr>

            <tbody>
                <tr><td colspan="4"></td></tr>

            </tbody>
        </table>

        <table class="tk" >

            <tr><td colspan="4" style="font-weight: bold; color: red;">NB: The table below holds information of this sample's personnel signatures </td></tr>

            <tr>
            <tr>
                <th class="tg-031e">Designation</th>
                <th class="tg-031e">Designator</th>
        <!--        <th class="tg-031e">Date Issued </th>-->
                <th class="tg-031e">Date Signed </th>
            </tr>

            <tbody>
                <tr><td colspan="3"></td></tr>

            </tbody>
        </table>
    </div>
</div>

<!--<div id = "nav_left_container">       
    <legend>
        <?php
        $startY = 2013;
        $endY = date('Y');
        $endYk = (int) $endY;
        ?>
        <select id="Ryear">
            <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
            <?php for ($i = $startY; $i <= $endY; $i++) { ?>            
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

            <?php } ?>
        </select> 
        <button type="button" id="gen_req_dataRRRR">Generate Sample List</button>
</div>-->
<table id = "requests" class="hover table-stripped">
    <p>
    <hr>
    <center><strong>CLIENT SAMPLE REQUEST LIST</strong></center>
    <?php for ($i = $startY; $i <= $endY; $i++) { ?>
<!--        <input type="button" id="<?php echo $i; ?>" value="<?php echo $i; ?>" class="ryear"/>-->
    <?php } ?>
    <hr>
    </p>

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
<div class = "hidden2" id = "fancybox_label" ></div>
<!--<div id = "confirm" class = "hidden2" >Mark Selected as OOS?</div>
<div id = "confirm_re" class = "hidden2" >Mark Selected for Re-analysis?</div>-->

<script type="text/javascript">

    unit = '<?php echo $this->session->userdata('user_unit') ?>';
    user_tier = '<?php echo $this->session->userdata('user_tier') ?>';
    tag = "<?php echo @$tag; ?>";
    if (tag === '') {
        url = "<?php echo site_url() . "request_management/requests_list_current_clients/" ?>";
    } else {
        url = "<?php echo site_url() . "request_management/requests_list_all/" ?>" + tag;
    }

    $loadpeople = function () {
        $.ajax({
            type: 'post',
            url: '<?php echo site_url('request_management/loadpeople/') ?>',
            dataType: 'json',
            success: function (data) {
                by = $('.by');
                $.each(data, function (i, people) {
                    names = people.title + " " + people.fname + " " + people.lname;
                    opt = '<option value="' + names + '">' + names + '</option>';
                    by.append(opt);
                });
            }, error: function () {

            }
        });
    }



    $('#generate_tests').click(function () {
        //alert(1);
        start = $('#f_date_from').val();
        end = $('#f_date_to').val();
        dept = $('#testname').val();
        if (start == '') {
            alert('WARNING: Start date cannot be left blank!');
            return false;
        } else if (end == '') {
            alert('WARNING: End date cannot be left blank!');
            return false;
        } else if (dept == '') {
            alert('WARNING: Test Name cannot be left blank!');
            return false;
        } else if (start > end) {
            alert('WARNING: Start date cannot be greater than End date!');
            return false;
        } else {
            window.location.href = "<?php echo base_url(); ?>request_management/test_per_sample_report/" + start + "/" + end + "/" + dept;
        }
    });

    $('#generate_period').click(function () {
        //alert(1);
        start = $('#f_date_from1').val();
        end = $('#f_date_to1').val();

        if (start == '') {
            alert('WARNING: Year cannot be left blank!');
            return false;
        } else if (end == '') {
            alert('WARNING: End date cannot be left blank!');
            return false;
        } else {
            window.location.href = "<?php echo base_url(); ?>request_management/days_taken_sample_report/" + start + "/" + end;
        }
    });


    $(document).on('click', '#t_requested', function () {
        $.fancybox({
            href: "#test_filter"
        });
    });


    $(document).on('click', '#t_period', function () {
        $.fancybox({
            href: "#period_filter"
        });
    });
    $('#cancel_generate').click(function () {
        $.fancybox.close();
    })




    $pick_date = function () {
        $(".date").datepicker({
            changeMonth: true,
            constrainInput: false,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    }

    $(".filter_date").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
    function getData() {
        db_data = '';
        var rtable = ''

        rtable = $('#requests').DataTable({
            "dom": 'TC<"clear">lfrtip',
          
            /*"fnCreatedRow":function(nRow, aData, iDataIndex) {
             if(aData.split_status == "1" && aData.assign_status == "2"){
             $('td',nRow).css('background-color', '#f8b88e');
             }
             else if(aData.split_status == "1" && aData.assign_status == "0"){
             $('td',nRow).css('background-color', '#f9ddca');
             }
             console.log(aData.assign_status);
             },*/
            //If Sample is already assigned, colour code entry a light green.
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
                if (aData.assign_status == "1") {
                    $('td', nRow).css('background-color', '#d5edcd');
                }
            },
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
                if (unit != '5') {
                    $('td a', nRow).not('.more_info, .a_detail_rev').replaceWith('<span>N/A</span>');
                }
            },
            "fnDrawCallback": function (nRow, aData, iDataIndex) {
                $('#requests tbody tr').each(function (i, k) {
                    var sTitle;
                    var text2 = '';
                    var nTds = $('td', this);
                    var labref = $(nTds[0]).text();
                    if (labref == '') {
                        console.log('Blank');
                    } else {
                        $.ajax({
                            Type: 'get',
                            url: "<?php echo base_url() . 'request_management/load_test_requested/' ?>" + labref,
                            dataType: 'json',
                            success: function (response) {
                                console.log(response)
                                $.each(response, function (i, data) {
                                    text = data.name;
                                    text2 += text + ",    ";
                                    sTitle = text2.replace('undefined', '->');

                                });

                                k.setAttribute('title', "Tests Requested for " + sAg + " : " + sTitle);
                            }, error: function () {
                                console.log('An error occured');
                            }
                        });
                    }


                    var sAg = $(nTds[1]).text();
                    var sEm = $(nTds[5]).text();
                    var sPh = $(nTds[4]).text();
                    var sUpv = $(nTds[3]).text();




                });

                /* Apply the tooltips */
                rtable = $('#requests').DataTable();
                rtable.$('tr').tooltip({
                    placement: '',
                    html: true
                });
            },
            "bJQueryUI": true,
            "scrollX": true,
            "order": [[0, "DESC"]],
            "aoColumns": [
                {"sTitle": "id", "mData": "iid", "visible": false, "bSortable": true},
                {"sTitle": "Reference Number", "mData": "request_iid"},
                {"sTitle": "Product Name", "mData": "product_name"},
                {"sTitle": "Active Ingredient", "mData": "active_ing"},
                {"sTitle": "Batch No.", "mData": "batch_ino"},
                {"sTitle": "Client Ref No.", "mData": "clientsampleref"},
                {"sTitle": "Client", "sClass": "client", "mData": "client"},
                {"sTitle": "Manufacturer", "mData": "manufacturer_iname"},
                {"sTitle": "Date of Manufacture", "mData": "manufacture_idate"},
                {"sTitle": "Date of Expiry", "mData": "exp_date"},
                {"sTitle": "Date Received", "mData": "designation_date_1"},
//                {"sTitle": "UpdateSample Details", "mData": null,
//                    "fnCreatedRow": function (nRow, aData, iDataIndex) {
//
////                        $.ajax({
////        type:"get",
////        url: "<?php echo base_url(); ?>request_management/check_su_stat/",
////        dataType: "json",
////        success:function(d){
////            alert(
////          $.each(d, function(i, row){
////            if(row.labref == aData[0]){
////                 $(nRow).css("background","yellow");
////            }else{
////                 $(nRow).css("background","green");
////            }
////          })
////
////    },error:function(){
////    }
////    });
//
//
//                    },
//                    "mRender": function (data, type, row) {
//                        //if(row.assign_status == "0" && row.quotation_status == "0"){
//                        //<a class="s_u" href = "#sample_update" id='+row.request_id+' >+Add </a> ||
//                        return '<a class="s_ue" href = "#Edit_log" id=' + row.request_id + ' >+Add</a> || <a class="s_uee" href = "#Edit_log_1" id=' + row.request_id + ' >View</a>';
//
//                        /*}
//                         else{
//                         return 'N/A';
//                         }*/
//                    }
//                },
//                {"sTitle": "Assign Status", "mData": "assign_status",
//                    "bVisible": false,
//                    "mRender": function (data, type, row) {
//                        if (data == "0") {
//                            return 'Unassigned';
//                        } else if (data == "1") {
//                            return 'Fully Assigned';
//                        } else if (data == "2") {
//                            return 'Partially Assigned'
//                        }
//                    },
//                },
//                {"sTitle": "Quantity", "mData": null,
//                    "mRender": function (data, type, row) {
//                        if (row.Packaging != null) {
//                            return row.sample_qty + " " + row.Packaging.name;
//                        } else {
//                            return " ";
//                        }
//                    }
//                },
//                {"sTitle": "Priority", "mData": "priority"},
//                {"sTitle": "Quote", "mData": null,
//                    "mRender": function (data, type, row) {
//                        if (row.quotation_status == '0') {
//                            if (row.component_status == '0') {
//                                return '<a class="quote" id = ' + row.request_id + ' data-table1 = "request" data-table2 = "tests" data-table3 = "request_details" data-client = ' + row.client_id + ' >Quote</a>';
//                            } else {
//                                if (row.coa_done_status == '0') {
//                                    return '<a class="set_components" id = ' + row.request_id + ' >Quote</a>';
//                                }
//                            }
//
//                        } else {
//                            return '<a class="quoted" id = ' + row.request_id + ' data-table1 = "request" data-table2 = "tests" data-table3 = "request_details" data-client = ' + row.client_id + ' >View</a>';
//                        }
//                    }
//
//
//
//                },
                {"sTitle": "Action", "mData": "id",
                    "mRender": function (data, type, row) {
                        if (row.assign_status == "0" && row.quotation_status == "0") {
                            return '<a class="edit" href = "<?php echo base_url() . "request_management/edit_clients/" ?>' + row.request_iid + '" id = ' + row.request_iid + ' >Validate Sample</a>';
                        } else {
                            return '<a class="edit" href = "<?php echo base_url() . "request_management/edit_clients/" ?>' + row.request_iid + '" id = ' + row.request_iid + ' >Validate Sample</a>';

                            //return 'N/A';
                        }
                    }
                },
//                {"sTitle": "More Info", "mData": "id",
//                    "mRender": function (data, type, row) {
//                        return '<a class="more_info" href = "<?php echo base_url() . "request_management/more_info/" ?>' + row.request_id + '" id = ' + row.request_id + ' >More Info</a>';
//                    }
//                },
//                {"sTitle": "Print Label", "mData": "id",
//                    "mRender": function (data, type, row) {
//                        if (row.label_status == "0") {
//                            return '<a class = "labels" id = ' + data + ' data-labelstatus = ' + row.label_status + ' data-printsno = ' + row.sample_qty + ' data-reqid =' + row.request_id + ' >Print</a>';
//                        } else {
//                            return '<a class = "labels" id = ' + data + ' data-labelstatus = ' + row.label_status + ' data-printsno = ' + row.sample_qty + ' data-reqid =' + row.request_id + ' >View</a>';
//                        }
//                    }
//                },
//                {"sTitle": "Assign", "mData": "id",
//                    "mRender": function (data, type, row) {
//                        if (row.coa_done_status != 3) {
//                            return '<a class = "assign" id = ' + data + ' data-reqid =' + row.request_id + ' data-rejStatus = ' + row.reject_status + ' data-client = ' + row.client_id + ' data-presentation = ' + row.presentation + ' >Assign</a>';
//                        } else {
//                            return 'N/A';
//                        }
//                    }
//                },
//                {"sTitle": "Update Presentation", "mData": "id",
//                    "mRender": function (data, type, row) {
//                        if (row.coa_done_status != 1) {
//                            return '<a class = "upd_presentation" id = ' + data + ' data-reqid =' + row.request_id + ' data-rejStatus = ' + row.reject_status + ' data-client = ' + row.client_id + ' data-presentation = ' + row.presentation + ' >Update</a>';
//                        } else {
//                            return 'N/A';
//                        }
//                    }
//                },
//                {"sTitle": "Invoice", "mData": "id",
//                    "mRender": function (data, type, row) {
//                        if (row.invoice_status != 1) {
//                            return '<a class = "invoice" id = ' + data + ' data-reqid =' + row.request_id + ' data-client = ' + row.client_id + ' data-table1 = "invoice" data-table2 = "tests" data-table3 = "request_details" >Show</a>';
//                        } else {
//                            return '<span class = "gray_out" >Pending</span>';
//                        }
//                    }
//                },
//
//                {"sTitle": "Log", "mData": "id",
//                    "mRender": function (data, type, row) {
//                        return '<a class = "log" id = ' + data + ' data-reqid =' + row.request_id + ' data-client = ' + row.client_id + ' data-table1 = "invoice" data-table2 = "tests" data-table3 = "request_details" >Show</a>';
//                    }
//                },
//                {"sTitle": "Reject Reason", "mData": "reject_reason"},
//                {"sTitle": "Sample_Reject_Action_______", "mData": "reject_reason",
//                    "mRender": function (data, type, row) {
//                        return '<a class = "re_assign" data-reqid =' + row.request_id + '>Re-assign (Reviewer)</a>  || <a class = "solved" data-reqid2 =' + row.request_id + '>Mark As Solved</a>';
//                    }
//                },
//                {"sTitle": "Compliance", "mData": "compliance"},
//                {"sTitle": "CAN", "mData": "CAN"},
//                {"sTitle": "View COA", "mData": "request_id",
//                    "mRender": function (data, type, row) {
//                        return '<a  href="#download-COA" class = "coa_down" id = ' + data + ' >View COA</a>';
//                    }
//                },
            ],
            "sScrollY": "300px",
            "sScrollX": "100%",
            "bDeferRender": true,
            "bProcessing": true,
            "bDestroy": true,
            "bLengthChange": true,
            "bStateSave": true,
            "iDisplayLength": 10,
            "sAjaxDataProp": "",
            "sAjaxSource": url,
        });



    }



    $(document).on('click', '.ryear', function () {
        $(".ryear").css('background', 'greenyellow');
        year = $(this).attr('id');
        $(this).css('background', 'green');
        url = "<?php echo site_url() . "request_management/requests_list_year/" ?>" + year;
        $("#requests").empty();
        $('#requests').dataTable().fnDestroy();
        getDataPerYear(url);
    })



    function getDataPerYear(url) {
        db_data = '';
        var rtable = ''

        rtable = $('#requests').DataTable({
            "dom": 'TC<"clear">lfrtip',
            tableTools: {
                "sRowSelect": "multi",
                "aButtons": [
                    {
                        "sExtends": "text",
                        "sButtonText": "Mark Selected as OOS",
                        "fnClick": function (nButton, oConfig, oFlash) {
                            var data = TableTools.fnGetInstance('requests');

                            //Get data from the selected rows
                            var selected_data = data.fnGetSelectedData();

                            //Initialize array to hold refsub ids
                            request_ids = [];

                            //Loop through the selected data
                            for (var i = 0; i < selected_data.length; i++) {

                                //Push ids of selected refsubs into above initialized array
                                request_ids.push(selected_data[i].request_id);
                            }

                            //Conver array of ids into a string
                            var ids = JSON.stringify(request_ids);

                            //Replace,remove forward slashes, quotation marks and square brackets and underscores from new string
                            sanitized_ids = ids.replace(/[,]/g, "/").replace(/[\[\]""]/g, "").replace(/ /g, "_");

                            //Url to generate pdf
                            update_url = '<?php echo base_url() . "request_management/markSelectedAsOos" ?>' + "/" + sanitized_ids

                            console.log(update_url);

                            //Confirm
                            console.log($('#confirm').dialog({
                                resizable: false,
                                modal: true,
                                title: "Mark as OOS",
                                buttons: {
                                    "Yes": function () {
                                        $(this).dialog("close");

                                        //Ajax function to pass ids to above gen url
                                        $.ajax({
                                            type: 'POST',
                                            url: update_url
                                        }).done(function (response) {
                                            noty({
                                                text: selected_data.length + ' successfully marked as OOS.',
                                                type: 'success',
                                                timeout: true,
                                                callback: {
                                                    afterShow: function () {
                                                        getData();
                                                    }

                                                }
                                            })
                                        })

                                    },
                                    "No": function () {
                                        $(this).dialog("close");
                                    }
                                }

                            }));

                        }

                    }
                ]
            },
            /*"fnCreatedRow":function(nRow, aData, iDataIndex) {
             if(aData.split_status == "1" && aData.assign_status == "2"){
             $('td',nRow).css('background-color', '#f8b88e');
             }
             else if(aData.split_status == "1" && aData.assign_status == "0"){
             $('td',nRow).css('background-color', '#f9ddca');
             }
             console.log(aData.assign_status);
             },*/
            //If Sample is already assigned, colour code entry a light green.
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
                if (aData.assign_status == "1") {
                    $('td', nRow).css('background-color', '#d5edcd');
                }
            },
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
                if (unit != '5') {
                    $('td a', nRow).not('.more_info, .a_detail_rev').replaceWith('<span>N/A</span>');
                }
            },
            "fnDrawCallback": function (nRow, aData, iDataIndex) {
                $('#requests tbody tr').each(function (i, k) {
                    var sTitle;
                    var text2 = '';
                    var nTds = $('td', this);
                    var labref = $(nTds[0]).text();
                    if (labref == '') {
                        console.log('Blank');
                    } else {
                        $.ajax({
                            Type: 'get',
                            url: "<?php echo base_url() . 'request_management/load_test_requested/' ?>" + labref,
                            dataType: 'json',
                            success: function (response) {
                                console.log(response)
                                $.each(response, function (i, data) {
                                    text = data.name;
                                    text2 += text + ",    ";
                                    sTitle = text2.replace('undefined', '->');

                                });

                                k.setAttribute('title', "Tests Requested for " + sAg + " : " + sTitle);
                            }, error: function () {
                                console.log('An error occured');
                            }
                        });
                    }


                    var sAg = $(nTds[1]).text();
                    var sEm = $(nTds[5]).text();
                    var sPh = $(nTds[4]).text();
                    var sUpv = $(nTds[3]).text();




                });

                /* Apply the tooltips */
                rtable = $('#requests').DataTable();
                rtable.$('tr').tooltip({
                    placement: '',
                    html: true
                });
            },
            "bJQueryUI": true,
            "scrollX": true,
            "order": [[0, "DESC"]],
            "aoColumns": [
                {"sTitle": "id", "mData": "id", "visible": false, "bSortable": true},
                {"sTitle": "Reference Number", "mData": "request_id"
                    , "mRender": function (data, type, row) {
                        //if(row.assign_status == "0" && row.quotation_status == "0"){
                        return '<a class="a_detail_rev" href = "#' + row.request_id + '" id = ' + row.request_id + ' >' + row.request_id + '</a>';
                        /*}
                         else{
                         return 'N/A';
                         }*/
                    }},
                {"sTitle": "Product Name", "mData": "product_name"},
                {"sTitle": "Active Ingredient", "mData": "active_ing"},
                {"sTitle": "Batch No.", "mData": "Batch_no"},
                {"sTitle": "Client Ref No.", "mData": "clientsampleref"},
                {"sTitle": "Client", "sClass": "client", "mData": "Clients.Name"},
                {"sTitle": "Manufacturer", "mData": "Manufacturer_Name"},
                {"sTitle": "Date of Manufacture", "mData": "Manufacture_date"},
                {"sTitle": "Date of Expiry", "mData": "exp_date"},
                {"sTitle": "Date Received", "mData": "Designation_date"},
                {"sTitle": "UpdateSample Details", "mData": null,
                    "fnCreatedRow": function (nRow, aData, iDataIndex) {

//                        $.ajax({
//        type:"get",
//        url: "<?php echo base_url(); ?>request_management/check_su_stat/",
//        dataType: "json",
//        success:function(d){
//            alert(
//          $.each(d, function(i, row){
//            if(row.labref == aData[0]){
//                 $(nRow).css("background","yellow");
//            }else{
//                 $(nRow).css("background","green");
//            }
//          })
//
//    },error:function(){
//    }
//    });


                    },
                    "mRender": function (data, type, row) {
                        //if(row.assign_status == "0" && row.quotation_status == "0"){
                        //<a class="s_u" href = "#sample_update" id='+row.request_id+' >+Add </a> ||
                        return '<a class="s_ue" href = "#Edit_log" id=' + row.request_id + ' >+Add</a> || <a class="s_uee" href = "#Edit_log_1" id=' + row.request_id + ' >View</a>';

                        /*}
                         else{
                         return 'N/A';
                         }*/
                    }
                },
                {"sTitle": "Assign Status", "mData": "assign_status",
                    "bVisible": false,
                    "mRender": function (data, type, row) {
                        if (data == "0") {
                            return 'Unassigned';
                        } else if (data == "1") {
                            return 'Fully Assigned';
                        } else if (data == "2") {
                            return 'Partially Assigned'
                        }
                    },
                },
                {"sTitle": "Quantity", "mData": null,
                    "mRender": function (data, type, row) {
                        if (row.Packaging != null) {
                            return row.sample_qty + " " + row.Packaging.name;
                        } else {
                            return " ";
                        }
                    }
                },
                {"sTitle": "Priority", "mData": "priority"},
                {"sTitle": "Quote", "mData": null,
                    "mRender": function (data, type, row) {
                        if (row.quotation_status == '0') {
                            if (row.component_status == '0') {
                                return '<a class="quote" id = ' + row.request_id + ' data-table1 = "request" data-table2 = "tests" data-table3 = "request_details" data-client = ' + row.client_id + ' >Quote</a>';
                            } else {
                                if (row.coa_done_status == '0') {
                                    return '<a class="set_components" id = ' + row.request_id + ' >Quote</a>';
                                }
                            }

                        } else {
                            return '<a class="quoted" id = ' + row.request_id + ' data-table1 = "request" data-table2 = "tests" data-table3 = "request_details" data-client = ' + row.client_id + ' >View</a>';
                        }
                    }



                },
                {"sTitle": "Edit", "mData": "id",
                    "mRender": function (data, type, row) {
                        if (row.assign_status == "0" && row.quotation_status == "0") {
                            return '<a class="edit" href = "<?php echo base_url() . "request_management/edit/" ?>' + row.request_id + '" id = ' + row.request_id + ' >Edit</a>';
                        } else {
                            return '<a class="edit" href = "<?php echo base_url() . "request_management/edit/" ?>' + row.request_id + '" id = ' + row.request_id + ' >Edit</a>';

                            //return 'N/A';
                        }
                    }
                },
                {"sTitle": "More Info", "mData": "id",
                    "mRender": function (data, type, row) {
                        return '<a class="more_info" href = "<?php echo base_url() . "request_management/more_info/" ?>' + row.request_id + '" id = ' + row.request_id + ' >More Info</a>';
                    }
                },
                {"sTitle": "Print Label", "mData": "id",
                    "mRender": function (data, type, row) {
                        if (row.label_status == "0") {
                            return '<a class = "labels" id = ' + data + ' data-labelstatus = ' + row.label_status + ' data-printsno = ' + row.sample_qty + ' data-reqid =' + row.request_id + ' >Print</a>';
                        } else {
                            return '<a class = "labels" id = ' + data + ' data-labelstatus = ' + row.label_status + ' data-printsno = ' + row.sample_qty + ' data-reqid =' + row.request_id + ' >View</a>';
                        }
                    }
                },
                {"sTitle": "Assign", "mData": "id",
                    "mRender": function (data, type, row) {
                        //if (row.coa_done_status != 3) {
                        return '<a class = "assign" id = ' + data + ' data-reqid =' + row.request_id + ' data-rejStatus = ' + row.reject_status + ' data-client = ' + row.client_id + ' >Assign</a>';
                        /*} else {
                         return 'N/A';
                         }*/
                    }
                },
                {"sTitle": "Invoice", "mData": "id",
                    "mRender": function (data, type, row) {
                        if (row.invoice_status != 1) {
                            return '<a class = "invoice" id = ' + data + ' data-reqid =' + row.request_id + ' data-client = ' + row.client_id + ' data-table1 = "invoice" data-table2 = "tests" data-table3 = "request_details" >Show</a>';
                        } else {
                            return '<span class = "gray_out" >Pending</span>';
                        }
                    }
                },

                {"sTitle": "Log", "mData": "id",
                    "mRender": function (data, type, row) {
                        return '<a class = "log" id = ' + data + ' data-reqid =' + row.request_id + ' data-client = ' + row.client_id + ' data-table1 = "invoice" data-table2 = "tests" data-table3 = "request_details" >Show</a>';
                    }
                },
                {"sTitle": "Reject Reason", "mData": "reject_reason"},
                {"sTitle": "Sample_Reject_Action_______", "mData": "reject_reason",
                    "mRender": function (data, type, row) {
                        return '<a class = "re_assign" data-reqid =' + row.request_id + '>Re-assign (Reviewer)</a>  || <a class = "solved" data-reqid2 =' + row.request_id + '>Mark As Solved</a>';
                    }
                },
                {"sTitle": "Compliance", "mData": "compliance"},
                {"sTitle": "CAN", "mData": "CAN"},
                {"sTitle": "View COA", "mData": "request_id",
                    "mRender": function (data, type, row) {
                        return '<a  href="#download-COA" class = "coa_down" id = ' + data + ' >View COA</a>';
                    }
                },
            ],
            "sScrollY": "300px",
            "sScrollX": "100%",
            "bDeferRender": true,
            "bProcessing": true,
            "bDestroy": true,
            "bLengthChange": true,
            "bStateSave": true,
            "iDisplayLength": 10,
            "sAjaxDataProp": "",
            "sAjaxSource": url,
        });



    }


    $(document).on('click', '.re_assign', function () {
        window.location.href = "<?php echo base_url(); ?>documentation/rev_assigned/";
    });

    $(document).on('click', '.solved', function () {
        labref = $(this).attr('data-reqid2');

        $.prompt("Kindly note that marking this rejected sample as solved will automatically re-assign it to the current reviewer, and remove it from the rejected list. Would you like to continue?", {
            title: "Mark As Solved",
            buttons: {"Yes, Mark as Solved": 1, "No, Cancel Action": false},
            focus: 1,
            submit: function (e, v, m, f) {
                // use e.preventDefault() to prevent closing when needed or return false. 
                // e.preventDefault(); 

                if (v === 1) {


                    $.post("<?php echo base_url() . 'request_management/mark_as_solved'; ?>/" + labref, function () {
                        window.location.href = "<?php echo base_url(); ?>request_management/samples/rejected/";

                    });


                } else {

                }

                console.log("Value clicked was: " + v);
            }
        });
    });





    $(document).ready(function () {


        $(document).on('click', '.coa_down', function () {

            id = $(this).attr('id');
            full = id + '.pdf';
            window.location.href = "<?php echo base_url() . 'coa_scans_files/'; ?>" + full;

        });




        $(document).on('click', '.a_details', function () {
            console.log($(this).attr('class'));
            id = $(this).attr('id');
            $('#labr,#labr1').text(id + " ");
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>request_management/get_sample_personnel/" + id,
                dataType: "json",
                success: function (data_response) {

                    $tbody = $('.tj > tbody tr:last');

                    $(".tj tbody tr.ai").remove();

                    $.each(data_response, function (the, data) {

                        row = '<tr class="ai">\n\
    <td class="tg-ugh9">' + data.activity + '</td>\n\
    <td class="tg-ugh9">' + data.from_who + '</td>\n\
    <td class="tg-ugh9">' + data.to_who + '</td>\n\
    <td class="tg-ugh9">' + data.date_added + '</td>\n\
</tr>';

                        $('.tj > tbody tr:last').before(row);


                    });

                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url(); ?>request_management/get_sample_signatories/" + id,
                        dataType: "json",
                        success: function (data_response) {

                            $tbody = $('.tk > tbody tr:last');

                            $(".tk tbody tr.saved").remove();

                            $.each(data_response, function (the, data) {

                                row = '<tr class="saved">\n\
    <td class="tg-ugh9">' + data.designation + '</td>\n\
    <td class="tg-ugh9">' + data.signature_name + '</td>\n\
    <td class="tg-ugh9">' + data.date_signed + '</td>\n\\n\
</tr>';

                                $('.tk > tbody tr:last').before(row);


                            });


                        }, error: function () {
                            alert('An error occured while loading the information, Try again later');
                        }
                    });


                    $.fancybox({
                        href: "#data_response"
                    });
                }, error: function () {
                    alert('An error occured while loading the information, Try again later');
                }
            });
        });

//$('#save_su').hide();
        $('#add_row').click(function () {
            $('save_su').show();
            $tbody = $('.tg > tbody tr:last');
            row = '<tr class="saved">\n\
    <td class="tg-ugh9">\n\
<select name="activity[]" class="activity" style="width:240px;">\n\
<option  value="">-- Select Activity --</option>\n\
<option  value="Issuing">Issuing</option>\n\
<option  value="Returning to Supervisor">Returning to Supervisor</option>\n\
<option  value="Returning to Documentation">Returning to Documentation</option>\n\
<option  value="Documentation">Documentation</option>\n\
<option  value="Assigning for worksheet Review">Assigning for worksheet Review</option>\n\
<option  value="Returning for COA Drafting">Returning for COA Drafting</option>\n\
<option  value="Assigning COA Draft for Review">Assigning COA Draft for Review</option>\n\
<option  value="Draft COA Review Rejected">Draft COA Review Rejected</option>\n\
<option  value="Re-assigning COA Draft for Review">Re-assigning COA Draft for Review</option>\n\
<option  value="Marked as OOS Sample - Re-Issue">Marked as OOS Sample - Re-Issue</option>\n\\n\
<option  value="Forwarding COA for Approval">Forwarding COA for Approval</option>\n\\n\
<option  value="Authorization of COA Release">Authorization of COA Release</option>\n\\n\
<option  value="CAN No.">CAN No.</option>\n\
</select>\n\
</td>\n\
\n\
<td class="tg-ugh9">\n\
<select name="by[]" class="by" style="width:200px;">\n\
<option  value="">-- Select From --</option>\n\\n\
<option  value="-">-</option>\n\
</select>\n\
</td>\n\
\n\
<td class="tg-ugh9">\n\
<select name="to_who[]" class="by" style="width:200px;">\n\
<option  value="">-- Select To --</option>\n\\n\
<option  value="-">-</option>\n\
<option  value="Documentation">Documentation</option>\n\
</select>\n\
</td>\n\
\n\
\n\<td class="tg-ugh9">\n\
<input type="text" class="date dr" name="dater[]"/>\n\
</td>\n\
\n\
<td><a href="#remove_row" id="remove_row"> -Remove</a></td>\n\
</tr>';

            $('.tg > tbody tr:last').before(row);
            $loadpeople();
            $pick_date();

            return false;

        });



        $(document).on('click', '.s_uee', function () {
            $.fancybox({
                href: "#sample_update_1",
                modal: true,
                closeBtn: 'true',
            });

            $('save_su').show();
            id = $(this).attr('id');

            $('#sample_req').val(id);
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>request_management/get_sample_signatories_1/" + id,
                dataType: "json",
                success: function (data_response) {



                    $(".tg tbody tr.saved").remove();

                    $.each(data_response, function (the, data) {

                        row = '<tr class="saved">\n\
    <td class="tg-ugh9">\n\
<select name="activity[]" class="activity" selected="selected">\n\
<option  value="' + data.activity + '">' + data.activity + '</option>\n\
<option  value="">-- Select Activity --</option>\n\
<option  value="Issuing">Issuing</option>\n\
<option  value="Returning to Supervisor">Returning to Supervisor</option>\n\
<option  value="Returning to Documentation">Returning to Documentation</option>\n\
<option  value="Documentation">Documentation</option>\n\
<option  value="Assigning for worksheet Review">Assigning for worksheet Review</option>\n\
<option  value="Returning for COA Drafting">Returning for COA Drafting</option>\n\
<option  value="Assigning COA Draft for Review">Assigning COA Draft for Review</option>\n\
<option  value="Draft COA Review Rejected">Draft COA Review Rejected</option>\n\
<option  value="Re-assigning COA Draft for Review">Re-assigning COA Draft for Review</option>\n\
<option  value="Marked as OOS Sample - Re-Issue">Marked as OOS Sample - Re-Issue</option>\n\\n\
<option  value="Forwarding COA for Approval">Forwarding COA for Approval</option>\n\\n\
<option  value="Authorization of COA Release">Authorization of COA Release</option>\n\\n\
<option  value="CAN No.">CAN No.</option>\n\
</select>\n\
</td>\n\
\n\
<td class="tg-ugh9">\n\
<select name="by[]" class="by" selected="selected">\n\
<option  value="' + data.from_who + '">' + data.from_who + '</option>\n\
</select>\n\
</td>\n\
\n\
<td class="tg-ugh9">\n\
    <select name="to_who[]" class="by" style="width:200px;">\n\
<option  value="' + data.to_who + '">' + data.to_who + '</option>\n\
<option  value="-">-</option>\n\
<option  value="Documentation">Documentation</option>\n\
</select>\n\
</td>\n\
\n\<td class="tg-ugh9">\n\
<input type="text" class="date dr" value="' + data.date_added + '" name="dater[]"/>\n\
</td>\n\
\n\
<td><a href="#remove_row" id="remove_row"> -Remove</a></td>\n\
</tr>';


                        $('.tg > tbody tr:last').before(row);


                    });

                    rowdata = new Array();
                    //load_tests_done/
                    $.getJSON("<?php echo base_url(); ?>request_management/load_tests_done/" + id, function (data) {
                        $('.tig > tbody tr:nth-last-child(2)').empty();
                        $.each(data, function (i, row) {
                            //row.test
                            rowdata.push('<tr>\n\
                           <td>' + row.test + '<input type="hidden" name="tests[]" class="tests" value="' + row.test + '"/></td>\n\
                          <td>\n\
                          <select name="compliance[]" class="compliance" >\n\
                          <option value="' + row.compliance + '">' + row.compliance + '</option>\n\
                                                  <option value=""></option>\n\
                          <option value="COMPLIES">COMPLIES</option>\n\
                          <option value="DOES NOT COMPLY">DOES NOT COMPLY</option>\n\
                          <option value="Other">Other</option>\n\
                          </select>                          <textarea  cols="100" class="other"></textarea>\n\
</td>\n\
                          </tr>');


                        });
                        rowdata.push('<tr><td>Compliance</td><td></td></tr>');
                        rowdata.push('<tr><td colspan="2"><textarea name="reason_of_nonc" cols="100" id="conc"></textarea></td></tr>');
                        rowdata.push('<tr><td colspan="2"><input type="button" id="save_su" value="Submit" class="submit-button" /> <input type="button" id="cancel" value="Cancel" class="submit-button" /></td><td></td></tr>');
                        $('#table_sample_details').html('<table class="tig" id="table_update_12" style="width:1000px; "> <tr> <th class="tg-031e">Test Name </th> <th class="tg-031e">Compliance</th>  </tr> <tbody>' + rowdata + '</tbody> </table>');
                    });

                    $.getJSON("<?php echo base_url(); ?>request_management/load_tests_reason/" + id, function (data) {

                        $('#conc').val(data[0].reason);

                    });


                    $loadpeople();
                    $pick_date();





                }, error: function () {
                    alert('An error occured while loading the information, Try again later');
                }
            });



        });

        $(document).on('click', '.compliance', function () {
            svalue = $('.compliance option:selected').val();
            $('.compliance').prop('name', '');
            if (svalue == 'Other') {
                $('.other').prop('name', 'compliance[]');
                $('.other').show();
            } else {
                $('.compliance').prop('name', 'compliance[]');
                $('.other').prop('name', '');
                $('.other').hide();
            }
        });





        $(document).on('click', '.s_ue', function () {
            $.fancybox({
                href: "#sample_update_1",
                modal: true,
                closeBtn: 'true',
            });

            $('save_su').show();
            id = $(this).attr('id');

            $('#sample_req').val(id);
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>request_management/get_sample_signatories_1/" + id,
                dataType: "json",
                success: function (data_response) {



                    $(".tg tbody tr.saved").remove();

                    $.each(data_response, function (the, data) {

                        row = '<tr class="saved">\n\
    <td class="tg-ugh9">\n\
<select name="activity[]" class="activity" selected="selected">\n\
<option  value="' + data.activity + '">' + data.activity + '</option>\n\
<option  value="">-- Select Activity --</option>\n\
<option  value="Issuing">Issuing</option>\n\
<option  value="Returning to Supervisor">Returning to Supervisor</option>\n\
<option  value="Returning to Documentation">Returning to Documentation</option>\n\
<option  value="Documentation">Documentation</option>\n\
<option  value="Assigning for worksheet Review">Assigning for worksheet Review</option>\n\
<option  value="Returning for COA Drafting">Returning for COA Drafting</option>\n\
<option  value="Assigning COA Draft for Review">Assigning COA Draft for Review</option>\n\
<option  value="Draft COA Review Rejected">Draft COA Review Rejected</option>\n\
<option  value="Re-assigning COA Draft for Review">Re-assigning COA Draft for Review</option>\n\
<option  value="Marked as OOS Sample - Re-Issue">Marked as OOS Sample - Re-Issue</option>\n\\n\
<option  value="Forwarding COA for Approval">Forwarding COA for Approval</option>\n\\n\
<option  value="Authorization of COA Release">Authorization of COA Release</option>\n\\n\
<option  value="CAN No.">CAN No.</option>\n\
</select>\n\
</td>\n\
\n\
<td class="tg-ugh9">\n\
<select name="by[]" class="by" selected="selected">\n\
<option  value="' + data.from_who + '">' + data.from_who + '</option>\n\
</select>\n\
</td>\n\
\n\
<td class="tg-ugh9">\n\
   <select name="to_who[]" class="by" style="width:200px;">\n\
<option  value="' + data.to_who + '">' + data.to_who + '</option>\n\
<option  value="-">-</option>\n\
<option  value="Documentation">Documentation</option>\n\
</select>\n\
</td>\n\
\n\<td class="tg-ugh9">\n\
<input type="text" class="date dr" value="' + data.date_added + '" name="dater[]"/>\n\
</td>\n\
\n\
<td><a href="#remove_row" id="remove_row"> -Remove</a></td>\n\
</tr>';


                        $('.tg > tbody tr:last').before(row);


                    });

                    rowdata = new Array();
                    //load_tests_done/
                    $.getJSON("<?php echo base_url(); ?>request_management/load_tests/" + id, function (data) {
                        $('.tig > tbody tr:nth-last-child(2)').empty();
                        $.each(data, function (i, row) {
                            //row.test
                            rowdata.push('<tr>\n\
                           <td>' + row.name + '<input type="hidden" name="tests[]" class="tests" value="' + row.name + '"/></td>\n\
                          <td>\n\
                          <select name="compliance[]" class="compliance" >\n\
                          <option value="' + row.compliance + '">' + row.compliance + '</option>\n\
                                                   <option value=""></option>\n\
                          <option value="COMPLIES">COMPLIES</option>\n\
                          <option value="DOES NOT COMPLY">DOES NOT COMPLY</option>\n\
                           <option value="Other">Other</option></select><textarea  cols="100" class="other"></textarea>\n\
                          </td>\n\
                          </tr>');


                        });
                        rowdata.push('<tr><td>Compliance</td><td></td></tr>');
                        rowdata.push('<tr><td colspan="2"><textarea name="reason_of_nonc" cols="100" id="conc"></textarea></td></tr>');
                        rowdata.push('<tr><td colspan="2"><input type="button" id="save_su" value="Submit" class="submit-button" /> <input type="button" id="cancel" value="Cancel" class="submit-button" /></td><td></td></tr>');
                        $('#table_sample_details').html('<table class="tig" id="table_update_12" style="width:1000px; "> <tr> <th class="tg-031e">Test Name </th> <th class="tg-031e">Compliance</th>  </tr> <tbody>' + rowdata + '</tbody> </table>');
                    });

                    $.getJSON("<?php echo base_url(); ?>request_management/load_tests_reason/" + id, function (data) {

                        $('#conc').val(data[0].reason);

                    });


                    $loadpeople();
                    $pick_date();





                }, error: function () {
                    alert('An error occured while loading the information, Try again later');
                }
            });



        });



        $(document).on('click', '#remove_row', function () {
            $(this).closest('tr').remove();
            return false;
        });

        $(document).on('click', '#cancel', function () {
            $.fancybox.close();
            return false;
        });
        $(document).on('click', '.s_u', function () {
            id = $(this).attr('id');

            $.ajax({
                type: "get",
                url: "<?php echo base_url(); ?>request_management/check_su_stat/" + id,
                dataType: "json",
                success: function (d) {

                    if (d.stat == '1') {
                        alert('Sample Activity Log for this sample is already updated, Kindly Use the Edit link instead');
                        return false;
                    } else {
                        $('#sample_req').val(id);
                        rowdata = new Array();
                        $.getJSON("<?php echo base_url(); ?>request_management/load_tests/" + id, function (data) {
                            $('.tig > tbody tr:nth-last-child(2)').empty();
                            $.each(data, function (i, row) {
                                rowdata.push('<tr>\n\
                           <td>' + row.name + '<input type="hidden" name="tests[]" class="tests" value="' + row.name + '"/></td>\n\
                          <td>\n\
                          <select name="compliance[]" class="compliance compliance1" >\n\
                          <option value="">--Select--</option>\n\
                          <option value="COMPLIES">COMPLIES</option>\n\
                          <option value="DOES NOT COMPLY">DOES NOT COMPLY</option>\n\
                          </select>\n\
                          </td>\n\
                          </tr>');


                            });
                            rowdata.push('<tr><td>Compliance</td><td></td></tr>');
                            rowdata.push('<tr><td colspan="2"><textarea name="reason_of_nonc" cols="100" id="conc"></textarea></td></tr>');
                            rowdata.push('<tr><td colspan="2"><input type="button" id="save_su" value="Submit" class="submit-button" /> <input type="button" id="cancel" value="Cancel" class="submit-button" /></td><td></td></tr>');
                            $('#table_sample_details').html('<table class="tig" id="table_update_12" style="width:1000px; "> <tr> <th class="tg-031e">Test Name </th> <th class="tg-031e">Compliance</th>  </tr> <tbody>' + rowdata + '</tbody> </table>');
                        });



                        $(".tg tbody tr.saved").remove();
                        $.fancybox({
                            href: "#sample_update_1",
                            modal: true,
                            closeBtn: 'true',
                        });
                        return true;
                    }
                }, error: function () {
                }
            });
        });



        complies = 'COMPLIES: The sample complies with the specifications of the tests perfomed.';
        does_not_comply = 'DOES NOT COMPLY: The sample does not comply with the specifications of the tests perfomed.';

        $(document).on('change', '.compliance', function () {
            var selectedVals = $('.compliance').map(function () {
                return this.value;
            }).get().join(',');
            var data = selectedVals;
            //   alert(data)
            if ($.inArray('DOES NOT COMPLY', data.replace(/,\s+/g, ',').split(',')) >= 0) {

                $('#conc').val(does_not_comply);
                $('#conc').css('background', 'red');
                $('#conc').css('color', 'white');
                $('#conc').css('font-weight', 'bolder');
            } else {
                $('#conc').val(complies);
                $('#conc').css('background', 'greenyellow');
                $('#conc').css('color', 'black');
                $('#conc').css('font-weight', 'bolder');
            }



        });

        $(document).on('click', '#remove_row', function () {
            $(this).closest('tr').remove();
            return false;
        });
        $(document).on('change', '.activity', function () {
            value = $(this).val();
            if (value === 'CAN No.') {
                //$(this).closest('tr').find('.di').prop('readonly', 'readonly').val('-------');

                $(this).closest('tr').find('.date').removeClass('hasDatepicker');
                $(this).closest('tr').find('.date').removeAttr('id');
                $(this).closest('tr').find('.date').addClass('hasDatepicker_removed');
                $(this).closest('tr').find('.date').removeClass('date');
            } else {
                //$(this).closest('tr').find('.di').prop('readonly', false).val('');
                $(this).closest('tr').find('.hasDatepicker_removed').removeClass('date');
                $(this).closest('tr').find('.date').addClass('hasDatepicker');
                $(this).closest('tr').find('.date').addClass('hasDatepicker_removed')
            }
        });

        $(document).on('click', '#save_su', function (e) {
            e.preventDefault();
            // $(this).prop('disabled','disabled');
            // $(this).prop('value','Saving....');

            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>request_management/saveSampleDetails/",
                data: $('#request_update').serialize(),
                success: function () {
                    alert('Sample Update Complete')
                    $.fancybox.close();
                }, error: function (e) {
                    alert('An error occured');
                    //  $(this).prop('disabled',false);
                    // $(this).prop('value','Try Again...');
                }
            });
        });

        $('.edits').live("click", function (e) {
            e.preventDefault();
            var href = '<?php echo base_url() . "request_management/edit/" ?>' + $(this).attr('id')
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 400,
                height: 500,
                //'beforeClose' : function(){
                //	getData();
                //}
            });
            return(false);
        })
        getData();


        $('.log').live("click", function (e) {
            e.preventDefault();
            rlogid = $(this).attr('id');
            var href = '<?php echo base_url() . "request_management/showrequestlog/"; ?>' + rlogid + "/new"
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 800,
                height: 500,
                //'beforeClose' : function(){
                //getData();
                //}
            });
            return(false);
        })

        $('.a_detail_rev').live("click", function (e) {
            e.preventDefault();
            rlogid = $(this).attr('id');
            var href = '<?php echo base_url() . "main_dashboard/more_info/"; ?>' + rlogid
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 800,
                height: 500,
                //'beforeClose' : function(){
                //	getData();
                //}
            });
            return(false);
        })

        $('.set_components').live("click", function (e) {
            e.preventDefault();
            var href = '<?php echo base_url() . "tests_management/testsMethodsWizard/" ?>' + $(this).attr('id') + "/" + "request" + "/" + "tests" + "/" + "request_details" + "/" + "quotation_components";
            console.log(href);
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 700,
                height: 490,
                //'beforeClose' : function(){
                //getData();
                //}
            });
            return(false);
        })


//Get all the information for a single analyis request entry
        $('.more_info').live("click", function (e) {
            e.preventDefault();
            var href = '<?php echo base_url() . "request_management/getMoreSampleInfo/" ?>' + $(this).attr('id');
            console.log(href);
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 700,
                height: 490,
                //'beforeClose' : function(){
                //getData();
                //}
            });
            return(false);
        })


        $('.quote').live("click", function (e) {
            e.preventDefault();
            client_id = $(this).attr('data-client');
            var href = '<?php echo base_url() . "quotation/stateComponents/" ?>' + $(this).attr('id') + "/" + "request" + "/" + "tests" + "/" + "request_details" + "/" + client_id;
            console.log(href);
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 600,
                height: 250,
                //'beforeClose' : function(){
                //getData();
                //}
            });
            return(false);
        })


        $('.quoted').live("click", function (e) {
            e.preventDefault();
            //Get unique id
            id = $(this).attr('id');

            //Get tables
            table1 = $(this).attr('data-table1');
            table2 = $(this).attr('data-table2');
            table3 = $(this).attr('data-table3');

            //Get Client Id
            client_id = $(this).attr('data-client');

            //Get href
            var href = '<?php echo base_url() . "client_billing_management/showBillPerTest/" ?>' + id + "/" + table1 + "/" + table2 + "/" + table3 + "/" + client_id;

            console.log(href);
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 700,
                height: 400,
                //'beforeClose' : function(){
                //getData();
                //}
            });
            return(false);
        })


        $('.invoice').live("click", function (e) {
            e.preventDefault();
            //Get unique id
            id = $(this).attr('data-reqid');

            //Get tables
            table1 = $(this).attr('data-table1');
            table2 = $(this).attr('data-table2');
            table3 = $(this).attr('data-table3');

            //Get Client Id
            client_id = $(this).attr('data-client');

            //Get href
            var href = '<?php echo base_url() . "quotation/showInvoiceBeforePrint/" ?>' + id + "/" + table1 + "/" + table2 + "/" + table3 + "/" + client_id;

            console.log(href);
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 700,
                height: 400,
                //'beforeClose' : function(){
                //getData();
                //}
            });
            return(false);
        })


        $('.labels').live("click", function (e) {
            e.preventDefault();
            label_status = $(this).attr("data-labelstatus");
            console.log(label_status);
            if (label_status == "0") {
                var href = '<?php echo base_url() . "request_management/label_form/" ?>' + $(this).attr('data-reqid');
                var hght = 200;
                var wdth = 300;
            } else if (label_status == "1") {
                var href = '<?php echo base_url() . "labels/" ?>' + "Label" + $(this).attr('data-reqid') + ".pdf";
                var hght = 842;
                var wdth = 595;
            }
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: wdth,
                height: hght,
                'beforeClose': function () {
                    getData();
                }
            });
            return(false);
        })

        $('.assign').live("click", function (e) {

            //Get presentation, check if null
            presentation = $(this).attr('data-presentation');
            console.log(presentation);
            if (presentation == "") {
                var href = '<?php echo base_url() . "coa/coa_engine_top_2/" ?>' + $(this).attr('data-reqid') + "/" + $(this).attr('data-client') + "/";
            } else {
                var href = '<?php echo base_url() . "sample_issue/sample_split/" ?>' + $(this).attr('data-reqid') + "/" + $(this).attr('data-client') + "/";
            }

            e.preventDefault();

            console.log(href);
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                width: 800,
                height: 500,
                autoDimensions: false,
                'beforeClose': function () {
                    getData();
                }
            })
        })

        $('.upd_presentation').live("click", function (e) {

            //Get presentation, check if null
            presentation = $(this).attr('data-presentation');
            console.log(presentation);
            if (presentation == "") {
                p = 0;
            } else {
                p = 1;
            }

            e.preventDefault();

            var href = '<?php echo base_url() . "coa/coa_engine_top_2/" ?>' + $(this).attr('data-reqid') + "/" + $(this).attr('data-client') + "/" + p;
            console.log(href);
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                width: 800,
                height: 500,
                autoDimensions: false,
                //'beforeClose' : function(){
                //getData();
                //}
            })
        })


        $('#gen_req_dataRRRR').click(function () {
               year = $('#Ryear').val();
            $.post("<?php echo base_url() . 'Sample_request_details/generate/'; ?>"+year, function (data) {
                //window.location.href = "<?php echo base_url() . 'sample_report/Report.xlsx'; ?>";

            });

        });


        $('#gen_label').live("click", function (e) {
            e.preventDefault();
            var href = '<?php echo base_url() . "request_management/generate_label" ?>';
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 350,
                //'beforeClose':function(){
                //getData();
                //}
            })
        })


        $('#gen_quotation').live("click", function (e) {
            e.preventDefault();
            var href = '<?php echo base_url() . "quotation/generate" ?>';
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 360,
                //'beforeClose':function(){
                //getData();
                //}
            })
        })

        $('.assigned').live("click", function (e) {
            e.preventDefault();
            var href = '<?php echo base_url() . "sample_issue/show_assigned_to/" ?>' + $(this).attr('id');
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                width: 600,
                height: 500,
                autoDimensions: false,
                //'beforeClose' : function(){
                //getData();
                //}
            })
        })


    })

</script>
