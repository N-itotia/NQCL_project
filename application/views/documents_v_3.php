<html>
    <script>
        $(document).ready(function () {
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
        .data{
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

    <div class ="content">



        <legend><a href="<?php echo site_url() . "documentation/home/"; ?>">Analyzed Samples</a>&nbsp;||&nbsp;<a href="<?php echo site_url() . "documentation/reviewed/"; ?>">Reviewed Samples&nbsp;||&nbsp;<a href="<?php echo site_url() . "documentation/fromDirector/"; ?>">Samples From The Director </a>&nbsp;||&nbsp;<a href="<?php echo site_url() . "documentation/rejected/"; ?>">Rejected COA DRAFTS & COAs</a></legend>        <div>&nbsp;</div>
        <hr>
        <p><legend>Done Samples &#187 Analyzed Samples || <a href="<?php echo base_url() . 'documentation/s_logs/'; ?>" target="_blank"> See Receive logs</a> || <a href="<?php echo base_url() . 'documentation/rev_assigned/'; ?>" target="_blank"> Reviewer Assigned</a></legend></p>

    <hr>

    <div class="success">Success: Worksheet was successfully assigned for review</div>
    <div class="error">Error: Worksheet could not be assigned for review now, Please try again later!</div>
    <div class="content4">
        <table id = "refsubs">
            <thead>
                <tr>
                    <th>Lab Ref</th>
                    <th>Product Name</th>
<!--                    <th>Department</th>-->
                    <th>Reviewer</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tablebody">


                <?php foreach ($documentation_data as $sheets) : ?>	

                    <tr>
                        <td><?php echo $sheets->folder ?></td>

                        <td><?php echo $sheets->product_name ?></td>

        <!--                        <td><?php
                        if ($sheets->microbiology === '1') {
                            echo 'Wet-Chemistry';
                        } else {
                            echo 'Microbiology';
                        };
                        ?>
                                </td>-->

                        <td><?php echo $sheets->person ?></td>
                        <td><a  class="inline1" href="#withdraw-sample" id="<?php echo $sheets->id ?>" req-id="<?php echo $sheets->folder ?>" prod-name="<?php echo $sheets->product_name ?> " curr-assign="<?php echo $sheets->person ?>" rev-id="<?php echo $sheets->reviewer_id ?> ">Withdraw</a></td>


                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <div id="data" style="width: 500px; height: 500px;">

        <table >

            <tr>
                <td><span id="s_title" style="text-decoration: underline; font-weight: bolder;"></span></td> 
            </tr>

            <tr><td>

                    <select name="data_selection" required id="data_selection">
                        <option value="" selected="selected">--Select Action--</option> 
                        <option value="withdraw_alone" >Withdraw (Back to Analyzed Section)</option> 
                        <option value="withdraw_reassign" >Withdraw & Reassign (To New Reviewer)</option> 

                    </select>
                </td>
            </tr>
            <tr>
                <td><u><strong><em>SAMPLE ASSIGNMENT HISTORY</em></strong></u></td>
            </tr>
            <tr id="history">

            </tr>
            <tr>
                <td>
                    <input type="button" value="Withdraw" id="assign_go" class="submit-button" style="display:none;"/> 
                </td>
            </tr>
        </table>

        <form id="popup" style="display:none;" >
            <div class="selecterror">Please select a reviewer first!</div>
            <table>
                <tr>
                    <th>Reviewer Name </th> 
                </tr>
                <tr><td>
                        <select name="reviewer" required id="reviewer">
                            <option value="" selected="selected">--Select Reviewer--</option>              

                        </select>
                    </td>
                    <td>

                        <input type="button" value="Assign" id="assign_button1" class="submit-button"/> 
                    </td>
                </tr>


            </table>
        </form>
    </div>

    <!--div id ="showreviewer">Choose Reviewer</div-->
    <script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.css" media="screen" />


    <script type="text/javascript">


        var $lmtable = $('#refsubs').dataTable({
            "bJQueryUI": true,
            "bRetrieve": true
        });

        $(document).ready(function () {
            $('#data').hide()
            id = '';
            req = '';
            prod = '';
            current = '';
            rev_id = '';
            $(document).on("click", ".inline1", function () {
                id = $(this).attr('id');
                req = $(this).attr('req-id');
                prod = $(this).attr('prod-name');
                current = $(this).attr('curr-assign');
                rev_id = $(this).attr('rev-id');
                $('#s_title').text(req + ': ' + prod + ' <<>> ' + 'Reviewer: ' + current);
                $.fancybox({
                    href: "#data"
                });

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>documentation/rev_history/" + req,
                    dataType: "JSON",
                    success: function (reviewers)
                    {
                        var opt = '';
                        $("#history").html(" ");

                        $.each(reviewers, function (id, city)
                        {
                            opt = "<p>" + city.date_action + ' | ' + city.person + ' - ' + city.status + "</p>";
                            $('#history').append(opt);

                        });
                    }

                });
            });

            $('#data_selection').change(function () {
                det_value = $(this).val();
                assign_go = $('#assign_go');
                popup = $('#popup');
                if (det_value === 'withdraw_alone') {
                    assign_go.show();
                    popup.hide();
                } else if (det_value === 'withdraw_reassign') {
                    loadRevs();
                    assign_go.hide();
                    popup.show();
                } else {
                    assign_go.hide();
                    popup.hide();
                }

            });
        });



        function loadRevs() {

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>assign/getAJAXReviewers1/",
                dataType: "JSON",
                success: function (reviewers)
                {

                    $.each(reviewers, function (id, city)
                    {
                        var opt = $('<option />'); // here we're creating a new select option for each group
                        opt.val(city.id);
                        opt.text(city.title + ' ' + city.fname + ' ' + city.lname);
                        console.log(city.id);
                        $('#reviewer').append(opt);
                    });
                }

            });
        }



        $(document).ready(function () {



            $('#assign_go').click(function () {


                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>documentation/withdraw/" + req + "/" + rev_id,
                    success: function (data)
                    {

                        $.fancybox.close();


                      //  window.location.href = '<?php echo base_url(); ?>documentation/rev_assigned/';


                        return true;
                    },
                    error: function (data) {
                        $('div.error').slideDown('slow').animate({opacity: 1.0}, 5000).slideUp('slow');



                        return false;
                    }
                });
                return false;

            });

            $('#assign_button1').click(function () {
                var rev = $('#reviewer').val();
                if (rev == '') {
                    $('div.selecterror').slideDown('slow').animate({opacity: 1.0}, 3000).slideUp('slow');
                    return true;
                } else {


                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>documentation/withdraw_reassign/" + req + "/" + rev_id + "/" + id,
                        data:{reviewer:$('#reviewer').val()},
                        success: function (data)
                        {
                            console.log(rev_id);
                            $.fancybox.close();


                            //  window.location.href = '<?php echo base_url(); ?>documentation/rev_assigned/';


                            return true;
                        },
                        error: function (data) {
                            $('div.error').slideDown('slow').animate({opacity: 1.0}, 5000).slideUp('slow');



                            return false;
                        }
                    });
                    return false;
                }
            });

        });

    </script>


</script>
</html>