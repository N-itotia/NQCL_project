<html>
    <script type='text/javascript' src='<?php echo base_url(); ?>javascripts/zebra_dialog.js'></script>
    <link type='text/css' href='<?php echo base_url(); ?>stylesheets/css/zebra_dialog.css' rel='stylesheet' media='screen' />
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
    <center><strong>ASSIGNED DRAFT COA WITHDRAWAL PAGE</strong></center>
    <hr>
 <p><legend>Done Samples &#187 Reviewed Samples || <a href="<?php echo base_url().'documentation/r_logs/';?>" target="_blank"> See Receive logs</a> || <a href="<?php echo base_url().'documentation/reviewed_assigned/';?>">WITHDRAW DRAFT COA</a></legend></p>
    <hr>
   

    <div class="success">Success: Worksheet was successfully sent to Reviewer</div>
    <div class="error">Error: Worksheet could not be sent, Please try again later!</div>
    <div class="content4">
        <table id = "refsubs">
            <thead>
                <tr>
                    <th>Labreference </th>
                    <th>Product Name</th>                     
                    <th>Reviewer Name</th>
                    <th>Action</th>



                </tr>
            </thead>
            <tbody class="tablebody">


                <?php foreach ($documentation_data as $sheets) : ?>	

                    <tr>


                        <td  class="bold assign" ><strong><em><?php echo $sheets->folder ?></em></td>
                        <td  class="bold assign" ><strong><em><?php echo $sheets->product_name ?></em></td>
                        <td><?php echo $sheets->person ?></td>

                        <td><a href="#<?php echo $sheets->folder; ?>" id="<?php echo $sheets->folder; ?>"  data-rid="<?php echo $sheets->director_id; ?>" class="remove">Withdraw</a></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <div id="data">
        <form id="popup" >
            <div class="selecterror">Please select a COA Reviewer first!</div>
            <table>
                <tr>
                    <th>Reviewer's Name </th> 
                </tr>
                <tr><td>

                        <select name="director" required id="reviewer">
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
            "bRetrieve": true,
            "iDisplayLength": 100
        });



        $(document).ready(function () {
            $('.remove').click(function () {
                labref = $(this).attr('id');
                rid = $(this).attr('data-rid');
                $.Zebra_Dialog('<strong>' + labref + '</strong>, Please note that withdrawing this Draft COA will return it back to documentation to be re-assigned to another Draft COA reviewer, Do you want to continue?', {
                    'type': 'question',
                    'title': 'Withdraw  Draft COA',
                    'buttons': [
                        {caption: 'Yes', callback: function () {
                                $.ajax({
                                    type: "post",
                                    url: "<?php echo site_url('assign_director/upDateWithdraw'); ?>/" + labref+'/'+rid,
                                    data: labref,
                                    success: function () {
                                        window.location.href = "<?php echo base_url(); ?>documentation/reviewed_assigned/"
                                        console.log('deleted');
                                    }, error: function () {
                                        alert('An Error occured wile performing the operation, please notify system admin.');
                                    }
                                });

                            }},
                        {caption: 'Cancel', callback: function () {}}

                    ]
                });
            });

            $('#data').hide();
            $(".inline1").fancybox({
            });
        });

        $('.inline1').click(function () {
            labref = $(this).attr('id');
            console.log(labref);
            $('#labref_no').val(labref)

        });

        $(document).ready(function () {
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
                        url: "<?php echo base_url(); ?>assign_director/sendSamplesFolderToDirector/" + labref,
                        data: data1,
                        success: function (data)
                        {

                            // var content=$('.refsubs');
                            $('div.success').slideDown('slow').animate({opacity: 1.0}, 2000).slideUp('slow');
                            $.fancybox.close();


                            setTimeout(function () {
                                window.location.href = '<?php echo base_url(); ?>documentation/reviewed';
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

        });

    </script>


</script>
</html>