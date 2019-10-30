<html>

    <script>
        $(document).ready(function () {

            $body = $(".content");

            $(document).on({
                ajaxStart: function () {
                    $body.addClass("loading");
                },
                ajaxStop: function () {
                    $body.removeClass("loading");
                }
            });

            var success1 = $(".success");
            var error1 = $(".error");
            var selecterror = $(".selecterror");
            success1.hide();
            error1.hide();
            selecterror.hide()
        });
    </script>
    <style type="text/css">
        .success{
            background-color: greenyellow;
            display: none;
            width:100%;
            height: 20px;
            border-radius: 5px;
            color:black;
            text-align: center;
            padding-top: 10px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
            z-index: 100;
            opacity: .9;

        }

        .error{
            display: none;
            background-color: red;
            width:100%;
            height: 20px;
            border-radius: 5px;
            color:white;
            text-align: center;
            padding-top: 10px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
        }
        .selecterror{
            background-color: red;
            width:100%;
            border-radius: 3px;
            color:white;
            display: none;
            text-align: center;
            padding-top: 1px;
            font-family: sans-serif;
            font-weight: bolder;
            font-size: larger;
        }
        .data,.date_change,#popup_date{
            display: none;
        }
        label{
            display:block;
        }

        .select2-container{box-sizing:border-box;display:inline-block;margin:0;position:relative;vertical-align:middle}.select2-container .select2-selection--single{box-sizing:border-box;cursor:pointer;display:block;height:28px;user-select:none;-webkit-user-select:none}.select2-container .select2-selection--single .select2-selection__rendered{display:block;padding-left:8px;padding-right:20px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.select2-container .select2-selection--single .select2-selection__clear{position:relative}.select2-container[dir="rtl"] .select2-selection--single .select2-selection__rendered{padding-right:8px;padding-left:20px}.select2-container .select2-selection--multiple{box-sizing:border-box;cursor:pointer;display:block;min-height:32px;user-select:none;-webkit-user-select:none}.select2-container .select2-selection--multiple .select2-selection__rendered{display:inline-block;overflow:hidden;padding-left:8px;text-overflow:ellipsis;white-space:nowrap}.select2-container .select2-search--inline{float:left}.select2-container .select2-search--inline .select2-search__field{box-sizing:border-box;border:none;font-size:100%;margin-top:5px;padding:0}.select2-container .select2-search--inline .select2-search__field::-webkit-search-cancel-button{-webkit-appearance:none}.select2-dropdown{background-color:white;border:1px solid #aaa;border-radius:4px;box-sizing:border-box;display:block;position:absolute;left:-100000px;width:100%;z-index:1051}.select2-results{display:block}.select2-results__options{list-style:none;margin:0;padding:0}.select2-results__option{padding:6px;user-select:none;-webkit-user-select:none}.select2-results__option[aria-selected]{cursor:pointer}.select2-container--open .select2-dropdown{left:0}.select2-container--open .select2-dropdown--above{border-bottom:none;border-bottom-left-radius:0;border-bottom-right-radius:0}.select2-container--open .select2-dropdown--below{border-top:none;border-top-left-radius:0;border-top-right-radius:0}.select2-search--dropdown{display:block;padding:4px}.select2-search--dropdown .select2-search__field{padding:4px;width:100%;box-sizing:border-box}.select2-search--dropdown .select2-search__field::-webkit-search-cancel-button{-webkit-appearance:none}.select2-search--dropdown.select2-search--hide{display:none}.select2-close-mask{border:0;margin:0;padding:0;display:block;position:fixed;left:0;top:0;min-height:100%;min-width:100%;height:auto;width:auto;opacity:0;z-index:99;background-color:#fff;filter:alpha(opacity=0)}.select2-hidden-accessible{border:0 !important;clip:rect(0 0 0 0) !important;height:1px !important;margin:-1px !important;overflow:hidden !important;padding:0 !important;position:absolute !important;width:1px !important}.select2-container--default .select2-selection--single{background-color:#fff;border:1px solid #aaa;border-radius:4px}.select2-container--default .select2-selection--single .select2-selection__rendered{color:#444;line-height:28px}.select2-container--default .select2-selection--single .select2-selection__clear{cursor:pointer;float:right;font-weight:bold}.select2-container--default .select2-selection--single .select2-selection__placeholder{color:#999}.select2-container--default .select2-selection--single .select2-selection__arrow{height:26px;position:absolute;top:1px;right:1px;width:20px}.select2-container--default .select2-selection--single .select2-selection__arrow b{border-color:#888 transparent transparent transparent;border-style:solid;border-width:5px 4px 0 4px;height:0;left:50%;margin-left:-4px;margin-top:-2px;position:absolute;top:50%;width:0}.select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__clear{float:left}.select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__arrow{left:1px;right:auto}.select2-container--default.select2-container--disabled .select2-selection--single{background-color:#eee;cursor:default}.select2-container--default.select2-container--disabled .select2-selection--single .select2-selection__clear{display:none}.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b{border-color:transparent transparent #888 transparent;border-width:0 4px 5px 4px}.select2-container--default .select2-selection--multiple{background-color:white;border:1px solid #aaa;border-radius:4px;cursor:text}.select2-container--default .select2-selection--multiple .select2-selection__rendered{box-sizing:border-box;list-style:none;margin:0;padding:0 5px;width:100%}.select2-container--default .select2-selection--multiple .select2-selection__placeholder{color:#999;margin-top:5px;float:left}.select2-container--default .select2-selection--multiple .select2-selection__clear{cursor:pointer;float:right;font-weight:bold;margin-top:5px;margin-right:10px}.select2-container--default .select2-selection--multiple .select2-selection__choice{background-color:#e4e4e4;border:1px solid #aaa;border-radius:4px;cursor:default;float:left;margin-right:5px;margin-top:5px;padding:0 5px}.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{color:#999;cursor:pointer;display:inline-block;font-weight:bold;margin-right:2px}.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover{color:#333}.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice,.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__placeholder,.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-search--inline{float:right}.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice{margin-left:5px;margin-right:auto}.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove{margin-left:2px;margin-right:auto}.select2-container--default.select2-container--focus .select2-selection--multiple{border:solid black 1px;outline:0}.select2-container--default.select2-container--disabled .select2-selection--multiple{background-color:#eee;cursor:default}.select2-container--default.select2-container--disabled .select2-selection__choice__remove{display:none}.select2-container--default.select2-container--open.select2-container--above .select2-selection--single,.select2-container--default.select2-container--open.select2-container--above .select2-selection--multiple{border-top-left-radius:0;border-top-right-radius:0}.select2-container--default.select2-container--open.select2-container--below .select2-selection--single,.select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple{border-bottom-left-radius:0;border-bottom-right-radius:0}.select2-container--default .select2-search--dropdown .select2-search__field{border:1px solid #aaa}.select2-container--default .select2-search--inline .select2-search__field{background:transparent;border:none;outline:0;box-shadow:none;-webkit-appearance:textfield}.select2-container--default .select2-results>.select2-results__options{max-height:200px;overflow-y:auto}.select2-container--default .select2-results__option[role=group]{padding:0}.select2-container--default .select2-results__option[aria-disabled=true]{color:#999}.select2-container--default .select2-results__option[aria-selected=true]{background-color:#ddd}.select2-container--default .select2-results__option .select2-results__option{padding-left:1em}.select2-container--default .select2-results__option .select2-results__option .select2-results__group{padding-left:0}.select2-container--default .select2-results__option .select2-results__option .select2-results__option{margin-left:-1em;padding-left:2em}.select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option{margin-left:-2em;padding-left:3em}.select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option{margin-left:-3em;padding-left:4em}.select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option{margin-left:-4em;padding-left:5em}.select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option{margin-left:-5em;padding-left:6em}.select2-container--default .select2-results__option--highlighted[aria-selected]{background-color:#5897fb;color:white}.select2-container--default .select2-results__group{cursor:default;display:block;padding:6px}.select2-container--classic .select2-selection--single{background-color:#f7f7f7;border:1px solid #aaa;border-radius:4px;outline:0;background-image:-webkit-linear-gradient(top, #fff 50%, #eee 100%);background-image:-o-linear-gradient(top, #fff 50%, #eee 100%);background-image:linear-gradient(to bottom, #fff 50%, #eee 100%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0)}.select2-container--classic .select2-selection--single:focus{border:1px solid #5897fb}.select2-container--classic .select2-selection--single .select2-selection__rendered{color:#444;line-height:28px}.select2-container--classic .select2-selection--single .select2-selection__clear{cursor:pointer;float:right;font-weight:bold;margin-right:10px}.select2-container--classic .select2-selection--single .select2-selection__placeholder{color:#999}.select2-container--classic .select2-selection--single .select2-selection__arrow{background-color:#ddd;border:none;border-left:1px solid #aaa;border-top-right-radius:4px;border-bottom-right-radius:4px;height:26px;position:absolute;top:1px;right:1px;width:20px;background-image:-webkit-linear-gradient(top, #eee 50%, #ccc 100%);background-image:-o-linear-gradient(top, #eee 50%, #ccc 100%);background-image:linear-gradient(to bottom, #eee 50%, #ccc 100%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFCCCCCC', GradientType=0)}.select2-container--classic .select2-selection--single .select2-selection__arrow b{border-color:#888 transparent transparent transparent;border-style:solid;border-width:5px 4px 0 4px;height:0;left:50%;margin-left:-4px;margin-top:-2px;position:absolute;top:50%;width:0}.select2-container--classic[dir="rtl"] .select2-selection--single .select2-selection__clear{float:left}.select2-container--classic[dir="rtl"] .select2-selection--single .select2-selection__arrow{border:none;border-right:1px solid #aaa;border-radius:0;border-top-left-radius:4px;border-bottom-left-radius:4px;left:1px;right:auto}.select2-container--classic.select2-container--open .select2-selection--single{border:1px solid #5897fb}.select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow{background:transparent;border:none}.select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow b{border-color:transparent transparent #888 transparent;border-width:0 4px 5px 4px}.select2-container--classic.select2-container--open.select2-container--above .select2-selection--single{border-top:none;border-top-left-radius:0;border-top-right-radius:0;background-image:-webkit-linear-gradient(top, #fff 0%, #eee 50%);background-image:-o-linear-gradient(top, #fff 0%, #eee 50%);background-image:linear-gradient(to bottom, #fff 0%, #eee 50%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0)}.select2-container--classic.select2-container--open.select2-container--below .select2-selection--single{border-bottom:none;border-bottom-left-radius:0;border-bottom-right-radius:0;background-image:-webkit-linear-gradient(top, #eee 50%, #fff 100%);background-image:-o-linear-gradient(top, #eee 50%, #fff 100%);background-image:linear-gradient(to bottom, #eee 50%, #fff 100%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFFFFFFF', GradientType=0)}.select2-container--classic .select2-selection--multiple{background-color:white;border:1px solid #aaa;border-radius:4px;cursor:text;outline:0}.select2-container--classic .select2-selection--multiple:focus{border:1px solid #5897fb}.select2-container--classic .select2-selection--multiple .select2-selection__rendered{list-style:none;margin:0;padding:0 5px}.select2-container--classic .select2-selection--multiple .select2-selection__clear{display:none}.select2-container--classic .select2-selection--multiple .select2-selection__choice{background-color:#e4e4e4;border:1px solid #aaa;border-radius:4px;cursor:default;float:left;margin-right:5px;margin-top:5px;padding:0 5px}.select2-container--classic .select2-selection--multiple .select2-selection__choice__remove{color:#888;cursor:pointer;display:inline-block;font-weight:bold;margin-right:2px}.select2-container--classic .select2-selection--multiple .select2-selection__choice__remove:hover{color:#555}.select2-container--classic[dir="rtl"] .select2-selection--multiple .select2-selection__choice{float:right}.select2-container--classic[dir="rtl"] .select2-selection--multiple .select2-selection__choice{margin-left:5px;margin-right:auto}.select2-container--classic[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove{margin-left:2px;margin-right:auto}.select2-container--classic.select2-container--open .select2-selection--multiple{border:1px solid #5897fb}.select2-container--classic.select2-container--open.select2-container--above .select2-selection--multiple{border-top:none;border-top-left-radius:0;border-top-right-radius:0}.select2-container--classic.select2-container--open.select2-container--below .select2-selection--multiple{border-bottom:none;border-bottom-left-radius:0;border-bottom-right-radius:0}.select2-container--classic .select2-search--dropdown .select2-search__field{border:1px solid #aaa;outline:0}.select2-container--classic .select2-search--inline .select2-search__field{outline:0;box-shadow:none}.select2-container--classic .select2-dropdown{background-color:#fff;border:1px solid transparent}.select2-container--classic .select2-dropdown--above{border-bottom:none}.select2-container--classic .select2-dropdown--below{border-top:none}.select2-container--classic .select2-results>.select2-results__options{max-height:200px;overflow-y:auto}.select2-container--classic .select2-results__option[role=group]{padding:0}.select2-container--classic .select2-results__option[aria-disabled=true]{color:grey}.select2-container--classic .select2-results__option--highlighted[aria-selected]{background-color:#3875d7;color:#fff}.select2-container--classic .select2-results__group{cursor:default;display:block;padding:6px}.select2-container--classic.select2-container--open .select2-dropdown{border-color:#5897fb}



    </style>

    <style>


        .modal {

            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 ) 
                url("ajaxloader.gif") 
                50% 50% 
                no-repeat;
        }

        /* When the body has the loading class, we turn
           the scrollbar off with overflow:hidden */
        body.loading {
            overflow: hidden;   
        }

        /* Anytime the body has the loading class, our
           modal element will be visible */
        body.loading .modal {
            display: block;
        }
        
        #filter1, #filter2, #filter3, #filter4, #filter5,#filter6{
            position: absolute;
            float: right;
           
            
        }
        #filter1{
            margin-left: 5px
        }
        #filter2{
            margin-left: 250px;
        }
        #filter3{
            margin-left: 500px;
        }
        #filter4{
            margin-left: 700px;
        }
        #filter5{
            margin-left: 900px;
        }
        #filter6{
            margin-left: 1100px;
        }
        #refsubs_wrapper{
            position: relative;
            margin-top: 300px;
        }
    </style>
    <body>
        <div class ="content">

            <legend><a href="<?php echo site_url() . "request_management/assigned_samples/"; ?>">Analysis</a>&nbsp;||&nbsp;<a href="<?php echo site_url() . "request_management/review_samples/"; ?>">Review&nbsp;||&nbsp;<a href="<?php echo site_url() . "request_management/Draft_certificate_samples/"; ?>">Draft Certificate Samples </a>&nbsp;||&nbsp;<a href="<?php echo site_url() . "documentation_rejects/home/"; ?>"> </a></legend>        <div>&nbsp;</div>
            <div class="success">Success: Worksheet was successfully assigned for review</div>
            <div class="error">Error: Worksheet could not be assigned for review now, Please try again later!</div>
            <div class="content4" style="position: relative;">

                <div id="filter1">
                 
                                <form id="printing_form" method="post">

                                    <table>
                                        <tr><td colspan="2"><strong>Analyst Report</strong></td></tr>
                                        <tr><td><label>Start Date:</label><input type="text" id="start" name="start"/></td></tr>
                                        <tr><td><label>End Date:</label> <input type="text" id="end" name="end"/></td></tr>
                                        <tr><td><label>Departament: </label><select name="dept" id="dept">
                                                    <option value="">-Select Dept-</option>                                                    
                                                    <option value="1">Wet Chemistry</option>
                                                    <option value="2">Microbiology</option>
                                                </select></td></tr>

                                        <tr><td><select name="status" id="status" style="display:none;">
                                                    <option value="Returning to Documentation"></option>
                                                    <option value="Returning to Documentation">Complete</option>
                                                    <option value="Returning to Supervisor">Pending</option>
                                                </select></td></tr>
                                        <tr>
                                            <td>
                                                <label>Analyst</label>
                                                <select name="analysts" id="analysts">
                                                    <option value="">-Select Analyst-</option>
                                                    <?php foreach ($anna as $lyst): ?>
                                                        <option value="<?php echo $lyst->id; ?>"><?php echo $lyst->title . " " . $lyst->fname . " " . $lyst->lname; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                        </tr>


                                        <tr><td><input type="button"  value="Print Analyst Report" id="printer"/>

                                    </table>
                                </form>
                </div>
                <div id="filter2">
                    
                                <form id="printing_form_net" method="post">

                                    <table>
                                        <tr><td colspan="2"><strong>Analyst Net Report</strong></td></tr>
                                        <tr><td><label>Start Date:</label><input type="text" id="start_net" name="start"/></td></tr>
                                        <tr><td><label>End Date:</label> <input type="text" id="end_net" name="end"/></td></tr>
                                        <tr><td><label>Departament: </label><select name="dept" id="dept_net">
                                                    <option value=""></option>
                                                    <option value="1">Wet Chemistry</option>
                                                    <option value="2">Microbiology</option>
                                                </select>
                                        <tr><td><input type="button"  value="Print Analyst Net Report" id="printer_net"/></td></tr>

                                    </table>
                                </form>
                </div>
                    
                <div id="filter3">
                                <form id="printing_form" method="post">

                                    <table>
                                        <tr><td colspan="2"><strong>Reviewer Report</strong></td></tr>
                                        <tr><td><label>Start Date:</label><input type="text" id="start1" name="start1"/></td></tr>
                                        <tr><td><label>End Date:</label><input type="text" id="end1" name="end1"/></td></tr>
                                        <tr><td>         <tr>
                                            <td>
                                                <label>Reviewer</label>
                                                <select name="reveiwer_data" id="reveiwer_data">
                                                    <option value="">-All-</option>
                                                    <?php foreach ($anna_r as $lyst1): ?>
                                                        <option value="<?php echo $lyst1->id; ?>"><?php echo $lyst1->title . " " . $lyst1->fname . " " . $lyst1->lname; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr><td><input type="button"  value="Print Reviewer Report" id="printer1"/></td></tr>

                                    </table>
                                </form>
                </div>
                <div id="filter4">

                                <form id="printing_form" method="post">

                                    <table>
                                        <tr><td colspan="2"><strong>Supervisor Report</strong></td></tr>
                                        <tr><td><label>Start Date:</label><input type="text" id="start2e" name="start12"/></td></tr>
                                        <tr><td><label>End Date:</label><input type="text" id="end2e" name="end12"/></td></tr>
                    <!--					<tr><td>         <tr>
                                                                <td>
                                                                    <label>Reviewer</label>
                                                                    <select name="reveiwer_data" id="reveiwer_data">
                                                            <option value="">-All-</option>
                                        <?php foreach ($anna_r as $lyst1): ?>
                                                                <option value="<?php echo $lyst1->id; ?>"><?php echo $lyst1->title . " " . $lyst1->fname . " " . $lyst1->lname; ?></option>
                                        <?php endforeach; ?>
                                                            </select>
                                                                </td>
                                                            </tr>-->
                                        <tr><td><input type="button"  value="Print Supervisor Report" id="printer2e"/></td></tr>

                                    </table>
                                </form>
                </div>
                <div id="filter5">

                    <form>
                        <table>
                        <tr><td colspan="2"><strong>Samples Activity Report</strong></td></tr>
                        <tr><td><label>Start Date:</label><input type="text" id="start11" name="start11"/></td></tr>
                        <tr><td><label>End Date:</label><input type="text" id="end11" name="end11"/></td></tr>
                                            <tr><td><!--<label>Departament: </label><select name="dept" id="dept">
                                            <option value=""></option>
                                            <option value="1">Wet Chemistry</option>
                                            <option value="2">Microbiology</option>
                                            </select>-->
                        <tr><td><input type="button"  value="Print Sample Activity Report" id="printer11"/></td></tr>

                    </table>
                    </form>              
                 
                </div>
                
                    <div id="filter5">

                    <form>
                        <table>
                        <tr><td colspan="2"><strong>Samples Activity Report</strong></td></tr>
                        <tr><td><label>Start Date:</label><input type="text" id="start11e" name="start11e"/></td></tr>
                        <tr><td><label>End Date:</label><input type="text" id="end11e" name="end11e"/></td></tr>
                                            <tr><td><!--<label>Departament: </label><select name="dept" id="dept">
                                            <option value=""></option>
                                            <option value="1">Wet Chemistry</option>
                                            <option value="2">Microbiology</option>
                                            </select>-->
                        <tr><td><input type="button"  value="Print Sample Activity Report" id="printer11e"/></td></tr>

                    </table>
                    </form>              
                 
                </div>
                    <div id="filter6">

                    <form>
                        <table>
                        <tr><td colspan="2"><strong>Documentation Report</strong></td></tr>
                        <tr><td><label>Start Date:</label><input type="text" id="startdoc" name="startdoc"/></td></tr>
                        <tr><td><label>End Date:</label><input type="text" id="enddoc" name="enddoc"/></td></tr>
                                            <tr><td><!--<label>Departament: </label><select name="dept" id="dept">
                                            <option value=""></option>
                                            <option value="1">Wet Chemistry</option>
                                            <option value="2">Microbiology</option>
                                            </select>-->
                        <tr><td><input type="button"  value="Print Report" id="printerdoc"/></td></tr>

                    </table>
                    </form>              
                 
                </div>
                
                
                
            </div>
            
                <table id = "refsubs">
                    <thead>
                        <tr>
                            <th>Sample</th>
                            <th>Quantity Issued</th>
                            <th>Issued To.</th>
                            <th>Date</th>
                            <td>Analysis</td>
    <!--                         <td>Date Returned</td>-->



                        </tr>
                    </thead>
                    <tbody class="tablebody">


                        <?php
                        foreach ($info as $sheets) :


                            $timestamp_start = strtotime($sheets->date_time_tracker);

                            $now = date('d-m-Y');

                            $days = timespan($timestamp_start, $now);
                            ?>

                            <tr>
    <!--                            - <em><strong>Issued: <?php echo $days; ?> Ago</strong></em> -->
                                <td style="background: lightgreen;"><?php echo $sheets->labref ?> </td>
                                <td><?php echo $sheets->quantity_issued . " " . $sheets->sample_packaging ?></td>
                                <td><?php echo $sheets->analyst_name ?></td>
                                <td  class=""><a href="#date_change" class="Edit" id="<?php echo $sheets->id; ?>"> <?php echo $sheets->date_time_tracker ?> (Edit)</a></td>
                                <?php if ($sheets->a_stat === '0') { ?>
                                    <td style="background: yellow;">Analysis in Progress : <a href="<?php echo base_url() . 'request_management/complete/' . $sheets->labref ?>">Complete Analysis</a></td>
                                    <?php } else { ?>
                                    <td style="background: lawngreen;">
                                    <?php if ($sheets->stat === '0') { ?>
                                            <a id="<?php echo $sheets->labref; ?>" href="#data" class="assign_reviewer">Assign Reviewer</a></td>
                            <?php } else { ?>
                                <a href = "#review_in_progress" title = "Click to see reviewer" data-labref = "<?php echo $sheets->labref; ?>" id="rvip<?php echo $sheets->labref; ?>" class="review_in_progress">Review in Progress</a>
                            <?php } ?>
    <?php } ?>
    <!--                             <td > <?php echo $sheets->date_time_returned; ?></td> -->





                        </tr>
<?php endforeach; ?>

                    </tbody>
                </table>

            </div>
            <div id="data">
                <form id="popup" >
                    <div class="selecterror">Please select a reviewer first!</div>
                    <table>
                        <tr>
                            <th>Reviewer Name </th>
                        </tr>
                        <tr><td>
                                <select name="reviewer" required id="reviewer">
                                    <option value="" selected="selected">--Select Reviewer--</option>

                                </select>
                                <input type="hidden" name="rev_name" id="revname"/>
                                <input type="hidden" id="labref_no" name="labref_no"/>
                            </td>
                            <td>

                                <input type="button" value="Assign" id="assign_button1" class="submit-button"/>
                            </td>
                        </tr>


                    </table>
                </form>
            </div>

            <div id="date_change">
                <form id="popup_date" >
                    <div class="selecterror">Field date cannot be left blank!</div>
                    <table>
                        <tr>
                            <th>Click TextBox to change date</th>
                        </tr>
                        <tr><td>
                                <input type="hidden" id="d_id" name="d_id"/>
                                <input type="text" id="date_field" name="date_field"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="button" value="Change" id="change_date" class="submit-button"/>

                                <input type="button" value="Cancel" id="cancel" class="button"/>

                            </td>

                        </tr>


                    </table>
                </form>
            </div>
            <div class="modal"><!-- Place at bottom of page --></div>
            <!--div id ="showreviewer">Choose Reviewer</div-->
            <script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.pack.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/dist/js/select2.js"></script>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>javascripts/fancybox/source/jquery.fancybox.css" media="screen" />
    </body>

    <script type="text/javascript">
      $(document).ready(function () {
          $('.select2').select2();
          $parameta = "<?php echo $this->uri->segment(3); ?>";
          $('aria-controls').text($parameta);
          var $lmtable = $('#refsubs').dataTable({
              "bJQueryUI": true,
              "bRetrieve": true,
              "stateSave": true
          });
          $(function () {
              $("#start,#end,#start1,#end1,#start11,#end11,#start2,#end2,#start_cli,#end_cli,#startdoc,#enddoc").datepicker({
                  changeMonth: true,
                  changeYear: true,
                  dateFormat: 'yy-mm-dd'
              });
          });

          $(function () {
              $("#start_net,#end_net,#start1_net,#end1_net,#start11e,#end11e,#start2e,#end2e").datepicker({
                  changeMonth: true,
                  changeYear: true,
                  dateFormat: 'yy-mm-dd'
              });
          });

          $('#printer_cli_1').click(function () {
              $(this).prop('value', 'Plese Wait...');

              start = $('#start_cli').val();
              end = $('#end_cli').val();
              client = $('#client').val();
              dept = $('#dept_cli').val();

              if (start == '') {
                  alert('Start date cannot be left blank!');
              } else if (end == '') {
                  alert('End date cannot be left blank!');
              } else if (client == '') {
                  alert('Client date cannot be left blank!');
              } else if (dept == '') {
                  alert('Department cannot be left blank!');
              } else {

                  name = $("#client option:selected").text();
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>Client_sample_report/generate/" + start + "/" + end + "/" + client + "/" + dept + "/" + name,
                      dataType: "json",
                      beforeSend: function () {
                          {
                              $body.addClass("loading");
                          }
                          $('#printer_cli_1').prop('disabled', true);
                          $('#printer_cli_1').prop('value', 'Plese Wait..., Report is being compiled, it might take some time to complete');
                      },
                      success: function ()
                      {
                          {
                              $body.removeClass("loading");
                          }
                          $('#printer_cli_1').prop('disabled', false);
                          $('#printer_cli_1').prop('value', 'Print Report');

                          window.location.href = "<?php echo base_url(); ?>sample_report/ClientSampleReport.xlsx";
                      }, error: function () {
                          {
                              $body.removeClass("loading");
                          }
                          $('#printer_cli_1').prop('disabled', false);
                          $('#printer_cli_1').prop('value', 'Print Report');
                          window.location.href = "<?php echo base_url(); ?>sample_report/ClientSampleReport.xlsx";
                          console.log('An error occured');
                      }

                  });
              }
          });


          $('#printer').click(function () {
              $analyst = $('#analysts').val();
              start = $('#start').val();
              end = $('#end').val();
              dept = $('#dept').val();

              if (start == '') {
                  alert('Start date cannot be left blank!');
              } else if (end == '') {
                  alert('End date cannot be left blank!');
              } else if (dept == '') {
                  alert('Department cannot be left blank!');
              } else if ($analyst == '') {
                  alert('Please select Analyst!');
              } else {

                  window.location.href = "<?php echo base_url(); ?>assigned_report/getReportPerAnalyst/" + start + "/" + end + "/" + dept + '/' + $analyst + "/Returning to Documentation";

              }
          });

          $('#printerD').click(function () {
              start = $('#start').val();
              end = $('#end').val();
              dept = $('#dept').val();

              if (start == '') {
                  alert('Start date cannot be left blank!');
              } else if (end == '') {
                  alert('End date cannot be left blank!');
              } else if (dept == '') {
                  alert('Department cannot be left blank!');
              } else {

                  window.location.href = "<?php echo base_url(); ?>assigned_report/getDocumentation/" + start + "/" + end + "/" + dept + "/x/Returning to Documentation";

              }
          });


          $('#printer_net').click(function () {
              //alert(1);
              start = $('#start_net').val();
              end = $('#end_net').val();
              dept = $('#dept_net').val();

              if (start == '') {
                  alert('Start date cannot be left blank!');
              } else if (end == '') {
                  alert('End date cannot be left blank!');
              } else if (dept == '') {
                  alert('Department cannot be left blank!');
              } else {

                  window.location.href = "<?php echo base_url(); ?>assigned_report/getNetReport/" + start + "/" + end + "/" + dept;
              }
          });


          $('#printer1').click(function () {
              $reviewer = $('#reveiwer_data').val();
              start = $('#start1').val();
              end = $('#end1').val();
              dept = $('#dept').val(2);
              if (start == '') {
                  alert('Start date cannot be left blank!');
              } else if (end == '') {
                  alert('End date cannot be left blank!');
              } else if (dept == '') {
                  alert('Department cannot be left blank!');
              } else {

                  if ($reviewer === '') {
                      window.location.href = "<?php echo base_url(); ?>assigned_report/getReviewerReport/" + start + "/" + end + "/";
                  } else {
                      window.location.href = "<?php echo base_url(); ?>assigned_report/getReportPerReviewer/" + start + "/" + end + "/" + $reviewer;
                  }

              }
          });

          $('#printer11e').click(function () {
              //alert(1);
              start = $('#start11e').val();
              end = $('#end11e').val();

              if (start == '') {
                  alert('Start date cannot be left blank!');
              } else if (end == '') {
                  alert('End date cannot be left blank!');
              } else {

                  window.location.href = "<?php echo base_url(); ?>assigned_report/getSampleActivity/" + start + "/" + end + "/";
              }
          });
          
               $('#printer2e').click(function () {
              //alert(1);
              start = $('#start2e').val();
              end = $('#end2e').val();

              if (start == '') {
                  alert('Start date cannot be left blank!');
              } else if (end == '') {
                  alert('End date cannot be left blank!');
              }  else {

                  window.location.href = "<?php echo base_url(); ?>request_management/days_taken_supervisor/" + start + "/" + end + "/";
              }
          });

          $('#printerdoc').click(function () {
              //alert(1);
              start = $('#startdoc').val();
              end = $('#enddoc').val();

              if (start == '') {
                  alert('Start date cannot be left blank!');
              } else if (end == '') {
                  alert('End date cannot be left blank!');             
              } else {

                  window.location.href = "<?php echo base_url(); ?>assigned_report/getDocumentation/" + start + "/" + end + "/";
              }
          });

      });
      $(document).ready(function () {
          $('#data').hide();
          $('#date_change').hide();

      });


      $('.Edit').click(function () {
          $('#d_id').val($(this).attr('id'));
      });
      $(".Edit").fancybox({
      });

      $(function () {
          $("#date_field").datepicker({
              changeMonth: true,
              changeYear: true,
              dateFormat: 'yy-mm-dd'
          });
      });
      $('#cancel').click(function () {
          $.fancybox.close();
      });



      $(document).ready(function () {
          $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>assign/getAJAXReviewers1/",
              dataType: "json",
              success: function (reviewers)
              {
                  //console.log(reviewers);
                  $.each(reviewers, function (id, city)
                  {
                      var opt = $('<option />'); // here we're creating a new select option for each group
                      opt.val(city.id);
                      opt.text(city.fname + " " + city.lname);
                      $('#reviewer').append(opt);
                  });
              }

          });

          $('#assign_button1').click(function () {
              var rev = $('#reviewer').val();
              if (rev == '') {
                  $('div.selecterror').slideDown('slow').animate({opacity: 1.0}, 3000).slideUp('slow');
                  return true;
              } else {


                  var labref = $('#labref_no').val();
                  var data1 = $('#popup').serialize();
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>assign/IssueStandAlone/" + labref,
                      data: data1,
                      success: function (data)
                      {

                          // var content=$('.refsubs');
                          $('div.success').slideDown('slow').animate({opacity: 1.0}, 2000).slideUp('slow');
                          $.fancybox.close();


                          setTimeout(function () {
                              window.location.href = '<?php echo base_url(); ?>request_management/complete/';
                          }, 3000);

                          return true;
                      },
                      error: function (data) {
                          $('div.error').slideDown('slow').animate({opacity: 1.0}, 5000).slideUp('slow');
                          $.fancybox.close();


                          return false;
                      }
                  });
                  return false;
              }
          });


          $('#date_change').click(function () {
              var rev = $('#date_field').val();
              if (rev == '') {
                  $('div.selecterror').slideDown('slow').animate({opacity: 1.0}, 3000).slideUp('slow');
                  return true;
              } else {


                  var labref = $('#d_id').val();
                  var data1 = $('#popup_date').serialize();
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>assign/edit_assignment/" + labref,
                      data: data1,
                      success: function (data)
                      {

                          // var content=$('.refsubs');
                          alert('Sample Assign Date Update was successfull!');
                          $.fancybox.close();


                          setTimeout(function () {
                              window.location.href = '<?php echo base_url(); ?>request_management/assigned_samples/';
                          }, 3000);

                          return true;
                      },
                      error: function (data) {
                          $('div.error').slideDown('slow').animate({opacity: 1.0}, 5000).slideUp('slow');
                          $.fancybox.close();


                          return false;
                      }
                  });
                  return false;
              }
          });


          $('#reviewer').change(function () {
              name = $('#reviewer option:selected').text();
              $('#revname').val(name);
          });
      });

      //Show reviewer details to whom sample assigned

      $(document).on('click', '.review_in_progress', function (e) {
          e.preventDefault();
          labref = $(this).attr('data-labref');
          reviewer_details_url = "<?php echo base_url(); ?>assign/reviewerDetailsView/" + labref;
          $.fancybox.open({
              href: reviewer_details_url,
              type: 'iframe',
              autoSize: false,
              autoDimensions: false,
              width: 600
          })
      })

      //Show reviewers to assign to
      $('.assign_reviewer').on("click", function (e) {
          e.preventDefault();
          href = $(this).attr('href');
          labref = $(this).attr('id');

          //Set labref
          $('#labref_no').val(labref);

          //Pop up reviewer select
          $.fancybox.open({
              href: href
          })
      });

    </script>


</script>
</html>
