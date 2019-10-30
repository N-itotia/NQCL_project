<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>REPORT</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>COA_ENGINE/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>COA_ENGINE/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>COA_ENGINE/css/style.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>COA_ENGINE/js/jquery-ui-1.11.4.custom/jquery-ui.min.css"/>
    </head>
    <body>
    <page size="A4" >
        <form id="SR">
            <div class="content_area" >
                <center>
                    <div class="header ">
                        <img src="<?php echo base_url(); ?>COA_ENGINE/images/letterhead.jpg" alt="Letter Head" width="600px"/>    
                    </div>
                    <div class="content ">
                        <p>ANALYST’S MONTHLY WORK REPORT (<i>To be submitted by the fifth of each Month</i>)</p>
                        <p>Name:<input class="mn" type="text" class="input-lg" value="<?php echo $name; ?>"/></p>
                        <p>Period: 5<sup>th</sup>  <select class="mn" name="month" id="MONTH" >
                                <option value="<?php echo date('m')-1 ?>"><?php $currentMonth = date('F');
echo Date('F', strtotime($currentMonth . " last month")); ?></option>
                                <?php for ($i = 0; $i < count($no); $i++): ?>                            
                                    <option value="<?php echo $no[$i]; ?>"><?php echo $mo[$i]; ?></option>
                                <?php endfor;
                                ?>
                            </select><select class="mn" name="month2" id="MONTH2" >
                                <option value="<?php echo date('m') ?>"><?php echo date('F') ?></option>
                                <?php for ($i = 0; $i < count($no); $i++): ?>                            
                                    <option value="<?php echo $no[$i]; ?>"><?php echo $mo[$i]; ?></option>
                                <?php endfor;
                                ?>
                            </select><select class="mn" name="year" id="YEAR">
                                <option value="<?php echo date('Y') ?>"><?php echo date('Y') ?></option>
                                <option value="<?php echo date('Y') - 1 ?>"><?php echo date('Y') - 1 ?></option>
                            </select><!--br> (Note: To generate a report for the previous month, please select the current month e.g. December to generate for November)-->
                        <p></p>
                        <p style="width: 100%; height: 20px;"></p>
                        <p>ROUTINE ANALYSIS SAMPLES (<i>Please delete or add rows as is necessary</i>)</p>

                        <table class="tg RS" style="max-width:750px !important;">
                            <thead>
                            <th class="tg-yw4l">No.</th>
                            <th class="tg-yw4l">Name of Sample</th>
                            <th class="tg-yw4l">Laboratory Ref. No.</th>
                            <th class="tg-yw4l">Date received</th>
                            <th class="tg-yw4l">Date returned <a class="addRS" title="Add Row">+</a></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="tg-yw4l RS_td">1</td>
                                    <td class="tg-yw4l"><textarea name="nameRS[]"></textarea></td>
                                    <td class="tg-yw4l"><input type="text" class="labref" name="labrefRS[]"/></td>
                                    <td class="tg-yw4l"><input type="text" class="labref" name="drecRS[]"/></td>
                                    <td class="tg-yw4l"><input type="text" class="labref datepicker" name="dretRS[]"/></td>
                                    <td class="tg-yw4l rem"><a class="reRS" href="#remove">-</a></td>
                                </tr>
                            </tbody>

                        </table>
                        <div class="spacer">&nbsp;</div>

                        <p></p>
                        <p>OVERTIME SAMPLES (<i>Please delete or add rows as is necessary</i>)</p>
                        <table class="tg OT">
                            <thead>
                            <th class="tg-yw4l">No.</th>
                            <th class="tg-yw4l">Name of Sample</th>
                            <th class="tg-yw4l">Laboratory Ref. No.</th>
                            <th class="tg-yw4l">Date received</th>
                            <th class="tg-yw4l">Date returned <a class="addOT" title="Add Row">+</a></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="tg-yw4l RS_td1">1</td>
                                    <td class="tg-yw4l"><textarea name="nameOT[]"></textarea></td>
                                    <td class="tg-yw4l"><input type="text" class="labref" name="labrefOT[]"/></td>
                                    <td class="tg-yw4l"><input type="text" class="labref" name="drecOT[]"/></td>
                                    <td class="tg-yw4l"><textarea  class="labref datepicker" name="dretOT[]"></textarea></td>
                                    <td class="tg-yw4l rem"><a class="reOT" href="#remove">-</a></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="spacer">&nbsp;</div>

                        <p></p>
                        <p>PENDING SAMPLES (<i>Please delete or add rows as is necessary</i>)</p>
                        <table class="tg PS">
                            <thead>
                            <th class="tg-yw4l">No.</th>
                            <th class="tg-yw4l">Name of Sample</th>
                            <th class="tg-yw4l">Laboratory Ref. No.</th>
                            <th class="tg-yw4l">Date received</th>
                            <th class="tg-yw4l">Reason <a class="addPS" title="Add Row">+</a></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="tg-yw4l Rs_td2">1</td>
                                    <td class="tg-yw4l"><textarea name="namePS[]"></textarea></td>
                                    <td class="tg-yw4l"><input type="text" class="labref" name="labrefPS[]"/></td>
                                    <td class="tg-yw4l"><input type="text" class="labref" name="drecPS[]"/></td>
                                    <td class="tg-yw4l"><input type="text" class="labref" name="dretPS[]"/></td
                                    <td class="tg-yw4l rem"><a class="rePS" href="#remove">-</a></td>
                                </tr>
                            </tbody>

                        </table>

                    </div>
                    <div class="footer">
                        <div class="spacer">&nbsp;</div>
                        <p style="text-align: left !important;">SUMMARY (<i>Should include both routine analysis and overtime samples</i>)</p>
                        <p class="btl">Total Number of Samples Received: <input type="text" class="input-lg mn" id="" name="tns" value="<?php echo $received;?>"/> </p>
                        <p class="btl">Total Number of Samples Completed: <input type="text" class="input-lg mn" id="TNS" name="tnc"/> </p>
                        <p class="btl">Total Number of Samples Pending: <input type="text" class=" input-lg mn" id="TNP" name="tnp"/></p>

                        <p style="text-align: left !important;">OTHER ACTIVITIES (<i>Please indicate the dates of the activities</i>)</p>
                        <p>
                            <textarea style="width:100% !important;" placeholder="Team Building  | 25/12/2016" name="activities" id="AC"></textarea>
                        </p>
                        <p style="text-align: left !important;">CONSTRAINTS/COMMENTS </p>
                        <p>
                            <textarea style="width:100% !important;" id="CO" placeholder="Lack of printing paper / cartridges" name="comments"></textarea>
                        </p>
                        <div class="spacer">&nbsp;</div>
                        <table class="tg">
                            <tr>
                                <th class="tg-yw4l">ANALYST</th>
                                <th class="tg-yw4l">SIGNATURE</th>
                                <th class="tg-yw4l">DATE</th>
                            </tr>
                            <tr>
                                <td class="tg-yw4l"><?php echo $name; ?></td>
                                <td class="tg-yw4l"></td>
                                <td class="tg-yw4l"><?php echo date('d/m/Y'); ?></td>
                            </tr>
                            <tr>
                                <th class="tg-yw4l">HEAD OF UNIT</th>
                                <th class="tg-yw4l">SIGNATURE</th>
                                <th class="tg-yw4l">DATE</th>
                            </tr>
                            <tr>
                                <td class="tg-yw4l">&nbsp;</td>
                                <td class="tg-yw4l">&nbsp;</td>
                                <td class="tg-yw4l">&nbsp;</td>
                            </tr>
                        </table>

                        <hr>
                        <p style="font-size: 10px; color:grey; font-weight: normal;">National Quality Control Laboratory for Drugs and Medical Devices - Analyst Report <?php echo date('Y'); ?></p>
                    </div>

                    <div class="spacer">&nbsp;</div>
                    <a href="#Save" id="SaveSR">Save</a>
                </center>
            </div>
        </form>
    </page>

</body>
<script type="text/javascript" src="<?php echo base_url(); ?>COA_ENGINE/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>COA_ENGINE/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>COA_ENGINE/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
        base_url = "<?php echo base_url(); ?>report_engine/";
        month = "<?php echo $this->uri->segment(3); ?>"
        year = "<?php echo $this->uri->segment(4); ?>"
        total = 0;
        
        $('.datepicker').datepicker({
            
        });


        getCompleted(month, year);



        function getCompleted(m, y) {
            $.getJSON(base_url + 'getCompleted/' + m + '/' + y, function (resp) {
                table = $('.RS > tbody');
                $('.RS > tbody').empty();
                $.each(resp, function (i, d) {
                    row = '<tr><td class="tg-yw4l Rs_td">1</td><td class="tg-yw4l"><textarea name="nameRS[]">' + d.product_name + '</textarea></td><td class="tg-yw4l"><input type="text" class="labref" name="labrefRS[]" value=' + d.lab_ref_no + '></td><td class="tg-yw4l"><input type="text" class="labref" name="drecRS[]" value=' + d.received + '></td><td class="tg-yw4l"><input type="text" class="labref datepicker" name="dretRS[]" ></td><td class="tg-yw4l rem"><a class="reRS" href="#remove">-</a></td></tr>';
                    table.append(row);
                  
                });
                $('#TNS').val($('.RS tr').length-1);
                updateRowOrder();
            }).fail(function (e) {
                console.log(e + "Error Has Occuredd");
            });

            $.getJSON(base_url + 'getPending/' + m + '/' + y, function (resp) {
                table = $('.PS > tbody');
                $('.PS > tbody').empty();
                $.each(resp, function (i, d) {
                    row = '<tr><td class="tg-yw4l Rs_td2">1</td><td class="tg-yw4l"><textarea name="namePS[]">' + d.product_name + '</textarea></td><td class="tg-yw4l"><input type="text" class="labref" name="labrefPS[]" value=' + d.lab_ref_no + '></td><td class="tg-yw4l"><input type="text" class="labref" name="drecPS[]" value=' + d.received + '></td><td class="tg-yw4l"><textarea  class="labref" name="dretPS[]"></textarea></td><td class="tg-yw4l rem"><a class="rePS" href="#remove">-</a></td></tr>';
                    table.append(row);
                    $('#TNP').val($('.PS tr').length-1);
                });
                updateRowOrder2();
               recalculate();   
            }).fail(function (e) {
                console.log(e + "Error Has Occuredd");
            });
        
            
        }
        
        function recalculate(){
        $('#TNC').val('');
         rem =parseInt($('#TNS').val())-parseInt($('#TNP').val()) ;
             $('#TNC').val(rem);
        }

        function loadRS(m, y) {
            $.getJSON(base_url + 'serveLookup/' + m + '/' + y + '/RS', function (resp) {
                table = $('.RS > tbody');
                $('.RS tbody').empty();
                $.each(resp, function (i, d) {
                    row = '<tr><td class="tg-yw4l Rs_td">1</td><td class="tg-yw4l"><textarea name="nameRS[]">' + d.sname + '</textarea></td><td class="tg-yw4l"><input type="text" class="labref" name="labrefRS[]" value=' + d.labref + '></td><td class="tg-yw4l"><input type="text" class="labref" name="drecRS[]" value=' + d.recdate + '></td><td class="tg-yw4l"><input type="text" class="labref" name="dretRS[]" value=' + d.retdate + '></td><td class="tg-yw4l rem"><a class="reRS" href="#remove">-</a></td></tr>';
                    table.append(row);
                   
                });
                 $('#TNS').val($('.RS tr').length -1);
                updateRowOrder();
             
            }).fail(function (e) {
                console.log(e + "Error Has Occured");
            });
        }
        function loadOT(m, y) {
            $.getJSON(base_url + 'serveLookup/' + m + '/' + y + '/OT', function (resp) {
                table = $('.OT > tbody');
                $('.OT > tbody').empty();
                $.each(resp, function (i, d) {
                    row = '<tr><td class="tg-yw4l Rs_td1">1</td><td class="tg-yw4l"><textarea name="nameOT[]">' + d.sname + '</textarea></td><td class="tg-yw4l"><input type="text" class="labref" name="labrefOT[]" value=' + d.labref + '></td><td class="tg-yw4l"><input type="text" class="labref datepicker" name="drecOT[]" value=' + d.recdate + '></td><td class="tg-yw4l"><textarea  class="labref" name="dretOT[]">' + d.retdate + '</textarea></td><td class="tg-yw4l rem"><a class="rePS" href="#remove">-</a></td></tr>';
                    table.append(row);
                });
                updateRowOrder1();
            }).fail(function (e) {
                console.log(e + "Error Has Occured");
            });
        }
        function loadPS(m, y) {
            $.getJSON(base_url + 'serveLookup/' + m + '/' + y + '/PS', function (resp) {
                table = $('.PS > tbody');
                $('.PS > tbody').empty();
                $.each(resp, function (i, d) {
                    row = '<tr><td class="tg-yw4l Rs_td2">1</td><td class="tg-yw4l"><textarea name="namePS[]">' + d.sname + '</textarea></td><td class="tg-yw4l"><input type="text" class="labref" name="labrefPS[]" value=' + d.labref + '></td><td class="tg-yw4l"><input type="text" class="labref" name="drecPS[]" value=' + d.recdate + '></td><td class="tg-yw4l"><textarea  class="labref" name="dretPS[]">' + d.retdate + '</textarea></td><td class="tg-yw4l rem"><a class="rePS" href="#remove">-</a></td></tr>';
                    table.append(row);
                  
                });
                  $('#TNP').val($('.PS tr').length-1);
                updateRowOrder2()
                  recalculate();  
                 
            }).fail(function (e) {
                console.log(e + "Error Has Occured");
            });
           
        }

        function loadOD(m, y) {
            $.getJSON(base_url + 'serveLookupSetails/' + m + '/' + y, function (resp) {

                $.each(resp, function (i, d) {

                    //$('#TNS').val(d.r);
                    //$('#TNC').val(d.c);
                    //$('#TNP').val(d.p);
                    $('#AC').val(d.activities);
                    $('#CO').val(d.comments);
                });
            }).fail(function (e) {
                console.log(e + "Error Has Occured");
            });
        }


        function updateRowOrder() {
            $('td.Rs_td').each(function (i) {
                $(this).text(i + 1);
            });
        }
        function updateRowOrder1() {
            $('td.Rs_td1').each(function (i) {
                $(this).text(i + 1);
            });
        }
        function updateRowOrder2() {
            $('td.Rs_td2').each(function (i) {
                $(this).text(i + 1);
            });
        }





        $('.addRS').click(function () {
            table = $('.RS > tbody');
            row = '<tr><td class="tg-yw4l Rs_td">1</td><td class="tg-yw4l"><textarea name="nameRS[]"></textarea></td><td class="tg-yw4l"><input type="text" class="labref" name="labrefRS[]"/></td><td class="tg-yw4l"><input type="text" class="labref" name="drecRS[]"/></td><td class="tg-yw4l"><input type="text" class="labref datepicker" name="dretRS[]"/></td><td class="tg-yw4l rem"><a class="reRS" href="#remove">-</a></td></tr>';
            table.append(row);
            updateRowOrder();
              recalculate();   
        });
        $('.addOT').click(function () {
            table = $('.OT > tbody');
            row = '<tr><td class="tg-yw4l Rs_td1">1</td><td class="tg-yw4l"><textarea name="nameOT[]"></textarea></td><td class="tg-yw4l"><input type="text" class="labref" name="labrefOT[]"/></td><td class="tg-yw4l"><input type="text" class="labref" name="drecOT[]"/></td><td class="tg-yw4l"><input type="text" class="labref datepicker" name="dretOT[]"/></td><td class="tg-yw4l rem"><a class="reRS" href="#remove">-</a></td></tr>';
            table.append(row);
            updateRowOrder1();
              recalculate();   
        });
        $('.addPS').click(function () {
            table = $('.PS > tbody');
            row = '<tr><td class="tg-yw4l Rs_td2">1</td><td class="tg-yw4l"><textarea name="namePS[]"></textarea></td><td class="tg-yw4l"><input type="text" class="labref" name="labrefPS[]"/></td><td class="tg-yw4l"><input type="text" class="labref" name="drecPS[]"/></td><td class="tg-yw4l"><textarea  class="labref" name="dretPS[]"></textarea></td><td class="tg-yw4l rem"><a class="rePS" href="#remove">-</a></td></tr>';
            table.append(row);
            updateRowOrder2();
              recalculate();   
        });
        $(document).on('click', '.reRS', function () {
            $(this).closest('tr').remove();
            updateRowOrder();
              recalculate();  
                 
        });
        $(document).on('click', '.reOT', function () {
            $(this).closest('tr').remove();
            updateRowOrder1();
              recalculate();   
        });
        $(document).on('click', '.rePS', function () {
            $(this).closest('tr').remove();
            updateRowOrder2();
              recalculate();   
        });


        $('#MONTH,#YEAR').change(function () {
            m = $('#MONTH').val();
            y = $('#YEAR').val();
            loadRS(m, y);
            loadOT(m, y);
            loadPS(m, y);
            loadOD(m, y);
             
        });


        $('#SaveSR').click(function () {
            alert('Saving will take a moment Please Wait..');
            $.post(base_url + 'saveData/', $('#SR').serialize(), function () {
            }).done(function () {
                alert('Save Successfully Completed');
            }).fail(function () {
                console.log('An Error Occured');
            })
        });



    });
</script>
</html>
