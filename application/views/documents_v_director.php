<html>
    <script>
        $(document).ready(function() {
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

        <legend><a href="<?php echo site_url() . "documentation/home/"; ?>">Analyzed Samples</a>&nbsp;||&nbsp;<a href="<?php echo site_url() . "documentation/reviewed/"; ?>">Reviewed Samples&nbsp;||&nbsp;<a href="<?php echo site_url() . "documentation/fromDirector/"; ?>">Samples From The Director </a>||&nbsp;<a href="<?php echo site_url() . "documentation/archive/"; ?>">ARCHIVE </a></legend>
        <hr>
        <p><legend>Done Samples &#187 Samples From Director</legend></p>

    <hr>


    <div>&nbsp;</div>
    <div class="success">Success: Worksheet was successfully sent to the director</div>
    <div class="error">Error: Worksheet could not be sent to the Director, Please try again later!</div>
    <div class="content4">
        <table id = "refsubs">
            <thead>
                <tr>
                    <th>Labreference (.xlsx)</th>

                    <th></th>
<!--                    <th>Director's Name</th>-->
                                     
                    <th>COA Ver. 2</th>  
                    <th>Invoice</th> 
                      <th>Download COA</th>  					
                    <th>Upload</th>  
                        <th>Correction</th> 
                    <th>Priority</th> 
                 



                </tr>
            </thead>
            <tbody class="tablebody">


                <?php foreach ($documentation_data as $sheets) : ?>	

                    <tr>
                        <td><?php echo $sheets->labref ?></td>

                        <td  class="bold assign" ><strong><em><?php echo $sheets->labref ?></em></td>

<!--                        <td><?php echo $sheets->name_of_director ?></td>-->

                       

                        <td><?php echo anchor('coa/generateCoa_final/' . $sheets->labref, 'COA Ver. 2') ?> &nbsp;  &nbsp; <?php //echo anchor('reviewer_uploads/'.$sheets->labref.".xlsx" ,'Download Worksheet')  ?></td>
                        <td><?php echo anchor('coa/generatecoa_invoice/' . $sheets->labref.'/INVOICE/', 'Invoice',array('target'=>'_blank')) ?>  || <?php echo anchor('coa/clean/' . $sheets->labref.'/INVOICE/', 'Clean',array('target'=>'_blank')) ?></td>
						<td><?php echo anchor('approved_drafts/'.$sheets->labref.".docx" ,'Download Approved COA')  ?></td>
                        <td><?php echo anchor('upload/final_coa_upload/' . $sheets->labref, 'Final COA') ?> &nbsp;  &nbsp; <?php //echo anchor('reviewer_uploads/'.$sheets->labref.".xlsx" ,'Download Worksheet')  ?></td>
                        <td style="background: yellow; font-weight: bolder;"><a  style="color: black; text-decoration: blink; "  class="inline1" href="#data" id="<?php echo $sheets->labref; ?>" >Submit COA to..</a><input type="hidden" id="labref_no"  value="<?php echo $sheets->labref; ?>"/></td>
                        <?php if ($sheets->priority === '1') { ?>
                            <td><span id="high">High</span></td>
                        <?php } else { ?>
                            <td><span id="low">Low</span></td>    
                        <?php } ?> 
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <div id="data" style="">
            <form id="popup" >
                <div class="selecterror">Please select a Personnel!</div>
                <table>
                    <tr>
                        <th>Name </th> 
                    </tr>
                    <tr><td>
                           
                            <select name="director" required id="reviewer">
                                <option value="" selected="selected">--Select Person--</option>              

                            </select>
                        </td>
                        <td>

                            <input type="button" value="Assign" id="assign_button1" class="submit-button"/> 
                        </td>
                    </tr>


                </table>
            </form>
        </div>


</div>

<!--div id ="showreviewer">Choose Reviewer</div-->
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>scripts/fancybox/source/jquery.fancybox.css" media="screen" />


<script type="text/javascript">


var $lmtable = $('#refsubs').dataTable({
    "bJQueryUI": true,
    "bRetrieve": true
}).rowGrouping({
    iGroupingColumnIndex: 1,
    sGroupingColumnSortDirection: "asc",
    iGroupingOrderByColumnIndex: 1,
    //bExpandableGrouping:true,
    //bExpandSingleGroup: true,
    iExpandGroupOffset: -1

});





$(document).ready(function() {
	
	
	  $('.invcleaner').click(function() {
        var rev = $(this).attr('id');    
    
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>coa/clean/"+rev,
                success: function(data)
                {                
                 
				 alert('Success, Redirecting....')
                
                        window.location.href = '<?php echo base_url(); ?>coa/generatecoa_invoice/'+rev+'/INVOICE/';
                   

                    return true;
                },error:function(){
                console.log('error');


                    return false;
                }
            });
	  });
	
	
	
	
    $('#data').hide();
            

            $(document).on('click','.inline1', function() {
                $.fancybox({
                    href:'#data'
                })
                
                labref = $(this).attr('id');
                console.log(labref);
                $('#labref_no').val(labref)

            });
    
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>documentation/getReviewersArray/",
        dataType: "JSON",
        success: function(reviewers)
        {

            $.each(reviewers, function(id, city)
            {
                var opt = $('<option />'); // here we're creating a new select option for each group
                opt.val(city.id);
                opt.text(city.title+" "+city.fname+" "+city.lname);
                $('#reviewer').append(opt);
            });
        }

    });

    $('#assign_button1').click(function() {
        var rev = $('#reviewer').val();
        if (rev == '') {
            $('div.selecterror').slideDown('slow').animate({opacity: 1.0}, 3000).slideUp('slow');
            return true;
        } else {


            var labref = $('#labref_no').val();
            var data1 = $('#popup').serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>documentation/returnCOA/"+$('#reviewer').val()+"/" + labref,
                data: data1,
                success: function(data)
                {

                    // var content=$('.refsubs');
                    $('div.success').slideDown('slow').animate({opacity: 1.0}, 2000).slideUp('slow');
                    $.fancybox.close();


                    setTimeout(function() {
                        window.location.href = '<?php echo base_url(); ?>documentation/fromDirector';
                    }, 3000000);

                    return true;
                },
                error: function(data) {
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