<head> 


    <title><?php echo $title; ?></title>
    <script src="<?php echo base_url() . 'Scripts/jquery-1.10.2.js' ?>"></script>
    <script src="<?php echo base_url() . 'Scripts/migrate.js' ?>"></script>
   <link href="<?php echo base_url(); ?>CSS/jquery-ui.css" type="text/css" rel="stylesheet"/>
  <script src="<?php echo base_url() . 'Scripts/jquery-ui.js' ?>" type="text/javascript"></script> 
    <link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>
          <link href="<?php echo base_url() . 'Scripts/fancybox/source/jquery.fancybox.css?v=2.1.3' ?>" type="text/css" media="screen" rel="stylesheet"/>
        <script src="<?php echo base_url() . 'Scripts/fancybox/source/jquery.fancybox.js' ?>" type="text/javascript"></script> 

     <script src="<?php echo base_url() . 'javascripts/jquery.autosize.min.js' ?>" type="text/javascript"></script> 
   
    <script type="text/javascript">
        $(document).ready(function() {
			
			$(document).on('click','.remove',function(){
id= $(this).attr('id');	
tid= $(this).attr('tid');	
				var txt;
    var r = confirm("WARNING, This Test will be deleted permanently, Action is irrevasible. Do you want to continue?");
    if (r == true) {
        	$.ajax({
					type:'post',
					url:"<?php echo base_url().'coa/deletetest/'.$labref;?>/"+id+"/"+tid,
					success:function(){
						window.location.href="<?php echo base_url().'coa/generateCoa_r/'.$labref;?>";
					},fail:function(){
						alert('An error occured. Kindly contact te system Administrator');
					}
				})
				
				
				
		
    } else {
        txt = "No Change will be made to this COA!";
    }
				
		});			
				
				
			
			
            user_type = "<?php echo $this->session->userdata('usertype_id'); ?>";

            /*determnined_class = $('select.det');
           // complies ='The sample complies with the specifications of the tests perfomed.';
          //  does_not_comply ='The sample does not comply with the specifications of the tests perfomed.';

            $('select.det').change( function() {
                var selectedVals = $(determnined_class).map(function() {
                    return this.value;
                }).get().join(',');
                var data = selectedVals;
                if ($.inArray('DOES NOT COMPLY', data.replace(/,\s+/g, ',').split(',')) >= 0) {
                   
                      $('#conc').val(does_not_comply);
                      $('#conc').css('background','red');
                      $('#conc').css('color','white');
                       $('#conc').css('font-weight','bolder');
                    }else if ($.inArray('DOES NOT COMPLY', data.replace(/,\s+/g, ',').split(',')) < 0) {
                         $('#conc').val(complies); 
                         $('#conc').css('background','greenyellow');
                         $('#conc').css('color','black');
                         $('#conc').css('font-weight','bolder');
                    }else{
                        
                      $('#conc').val(''); 
                      
                       
                    }
                  


            }).trigger('change');*/

            coa_status = "<?php echo $coa_stat; ?>";
            if (coa_status == '1') {
                //$('#genCOA').prop('disabled', true);
            }

            var i = 1;
            var temp_array = new Array();
            temp_array[0] = "test";
            temp_array[1] = "method";
            temp_array[2] = "compedia";
            temp_array[3] = "specification";
            temp_array[4] = "determined";
            temp_array[5] = "complies";

            // $.each(temp_array,function(k,v){

            // });

         
            setInterval(function(){
                postData = $('#COAF').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>coa/saveCOA/<?php echo $labref; ?>",
                                    data: postData,
                                    success: function() {

                                        showNotification({
                                            message: "COA Successfully Saved ",
                                            type: "success",
                                            autoClose: true,
                                            duration: 5

                                        });
                                 
									// window.location.href = "<?php echo base_url() . 'COA/'.$labref.'_COA.xlsx'; ?>";                                        return true;

                                       // window.location.href = "<?php echo base_url() . 'documentation/reviewed/'; ?>";

                                    },
                                    error: function() {
                                        showNotification({
                                            message: "Oops! an error occurred - Please try again Later.",
                                            type: "error",
                                            autoClose: true,
                                            duration: 5
                                        });
                                        return false;
                                    }

                                }); 
            },60000)

       if(user_type == '5'){
                $('#genCOA').prop('value','Export To Ms. Excel');
                $('#genCOAWord').prop('value','Export To Ms. Word');
            }



 $('#genCOAWord').click(function() {
                $(this).prop('value', 'Saving Please Wait....');
                //$(this).prop('disabled', 'disabled');
                postData = $('#COAF').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>coa/saveCOA/<?php echo $labref; ?>/coa_printing",
                                    data: postData,
                                    success: function() {

                                        showNotification({
                                            message: "COA Successfully Generated ",
                                            type: "success",
                                            autoClose: true,
                                            duration: 5

                                        });
                                        
                                          $(this).prop('value', 'Generating, Please Wait....');
                                        
                                        
                                                 $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>wordexe/generate/<?php echo $labref; ?>/",
                                    data: postData,
                                    success: function() {

                                        showNotification({
                                            message: "COA Successfully Generated ",
                                            type: "success",
                                            autoClose: true,
                                            duration: 5

                                        });
                                        $('#genCOAWord').prop('value', 'Availing For Download..');
                                        $('#genCOAWord').prop('disabled', true);
                                        
                                    window.location.href = "<?php echo base_url() . 'printed_coa/'.$labref.'.docx'; ?>";                                        return true;

             
                                    },
                                    error: function() {
                                        showNotification({
                                            message: "Oops! an error occurred - Please try again Later.",
                                            type: "error",
                                            autoClose: true,
                                            duration: 5
                                        });
                                        return false;
                                    }

                                });
                                        
                                                                         return true;

                                  //  window.location.href = "<?php echo base_url() . '/documentation/fromDirector/'; ?>";                                        return true;
             
                                    },
                                    error: function() {
                                        showNotification({
                                            message: "Oops! an error occurred - Please try again Later.",
                                            type: "error",
                                            autoClose: true,
                                            duration: 5
                                        });
                                        return false;
                                    }

                                });

                            });
                            
                            
                             $('#genCOAS').click(function() {
                $(this).prop('value', 'Saving, Please Wait....');
                $(this).prop('disabled', 'disabled');
                postData = $('#COAF').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>coa/saveCOA/<?php echo $labref; ?>",
                                    data: postData,
                                    success: function() {

                                        showNotification({
                                            message: "COA Successfully Saved ",
                                            type: "success",
                                            autoClose: true,
                                            duration: 5

                                        });
                                        window.location.href = "<?php echo base_url() . 'coa/generateCoa_fd/'.$labref; ?>";

                                    },
                                    error: function() {
                                        showNotification({
                                            message: "Oops! an error occurred - Please try again Later.",
                                            type: "error",
                                            autoClose: true,
                                            duration: 5
                                        });
                                        return false;
                                    }

                                });

                            });
                            
                            
                            
                            $('#Back').click(function() {

                                
                                

                                    window.location.href = "<?php echo base_url() . 'documentation/fromDirector/'; ?>";
                               
                            });

                                                
                        
                             $('#genCOA').click(function() {
                $(this).prop('value', 'Processing....');
                //$(this).prop('disabled', 'disabled');
                postData = $('#COAF').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>coa/saveCOA/<?php echo $labref; ?>/coa_printing",
                                    data: postData,
                                    success: function() {

                                        showNotification({
                                            message: "COA Successfully Generated ",
                                            type: "success",
                                            autoClose: true,
                                            duration: 5

                                        });
                                        $('#genCOA').prop('value', 'Generate');
                                        $('#genCOA').prop('disabled', true);
                                        
                                     window.location.href = "<?php echo base_url() . 'COA/'.$labref.'_COA.xlsx'; ?>";                                        return true;

                                  //  window.location.href = "<?php echo base_url() . '/documentation/fromDirector/'; ?>";                                        return true;
             
                                    },
                                    error: function() {
                                        showNotification({
                                            message: "Oops! an error occurred - Please try again Later.",
                                            type: "error",
                                            autoClose: true,
                                            duration: 5
                                        });
                                        return false;
                                    }

                                });

                            });
                            $('#Back').click(function() {

                                
                                

                                    window.location.href = "<?php echo base_url() . 'documentation/fromDirector/'; ?>";
                               
                            });
                              $(function() {
    $( "#date_received" ).datepicker({
        dateFormat: 'dd.mm.yy'
        
    });
    
    $(function() {
	$('.monthYearPicker').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'M.yy'
	}).focus(function() {
		var thisCalendar = $(this);
		$('.ui-datepicker-calendar').detach();
		$('.ui-datepicker-close').click(function() {
var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
thisCalendar.datepicker('setDate', new Date(year, month, 1));
		});
	});
});
  });
  function h(e) {
    $(e).css({'height':'auto'}).height(e.scrollHeight);
}
$('.det,#addre').each(function () {
  h(this);
}).on('input', function () {
  h(this);
});   
   $.getJSON("<?php echo base_url() . 'coa/get_signatories/' . $labref; ?>",function(result){
   $.each(result,function(i, results){
       $row='<tr>\n\
<td> <select name="designation[]" class="designation" selected="selected">\n\\n\
 <option value="'+results.designation+'">'+results.designation+'</option>\n\
<option value="ANALYST:">ANALYST</option>\n\
<option value="REVIEWER:">REVIEWER</option>\n\
<option value="DIRECTOR:">DIRECTOR</option>\n\
</select>\n\
</td>\n\
<td><input type="text" name="designator[]" class="designator" value="'+results.signature_name+'" style="text-align:left;"/></td>\n\
 <td><input type="text" name="signature[]" class="signature" value="________________________________________" readonly/></td>\n\
<td>DATE: <input type="text" name="date[]" class="date" value="'+results.date_signed+'"/></td>\n\
<td><a href="#remove_signatory" class="remove_signatory">- Rem</a></td>\n\
</tr>';
    $('#signatories > tbody').append($row);
     });
   });
   
   $('#add_signatory').click(function(){   
    
       $row='<tr>\n\
<td> <select name="designation[]" class="designation" selected="selected">\n\\n\
 <option value=""></option>\n\
<option value="ANALYST:">ANALYST</option>\n\
<option value="REVIEWER:">REVIEWER</option>\n\
<option value="DIRECTOR:">DIRECTOR</option>\n\
</select>\n\
</td>\n\
<td><input type="text" name="designator[]" class="designator" value="" style="text-align:left;"/></td>\n\
 <td><input type="text" name="signature[]" class="signature" value="________________________________________" readonly/></td>\n\
<td>DATE: <input type="text" name="date[]" class="date" value=""/></td>\n\
<td><a href="#remove_signatory" class="remove_signatory">- Rem</a></td>\n\
</tr>';
    $('#signatories > tbody tr:last').after($row);
    
     
    return false;
  
    });
    
      $(document).on('click','.remove_signatory', function(){
          $(this).closest('tr').remove();       
            return false;
        });
        
        $('#add_new').click(function(){
            $.fancybox({
                href:'#new_test'
            })
        });
        
        $('#add_test_now').click(function() {
                $(this).prop('value', 'Processing....');
                $(this).prop('disabled', 'disabled');
                postData = $('#ntf').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>coa/saveCOANT/<?php echo $labref; ?>",
                                    data: postData,
                                    success: function() {

                                        showNotification({
                                            message: "Test Successfully Added ",
                                            type: "success",
                                            autoClose: true,
                                            duration: 5

                                        });
                                  
                                    $.fancybox.close();

                                      window.location.href = "<?php echo base_url() . 'coa/generateCoa_r/'.$labref; ?>";

                                    },
                                    error: function() {
                                        showNotification({
                                            message: "Oops! an error occurred - That Test is already existing.",
                                            type: "error",
                                            autoClose: true,
                                            duration: 5
                                        });
                                        return false;
                                    }

                                });

                            });
                            
                            $('#cancel_now').click(function(){
                            $.fancybox.close();
                            });
                            
                            $('#method_1').change(function(){
                                value= $(this).val();
                                if(value==='1'){
                                   $('#method_1').prop('name','') ;
                                   $('#method_2').prop('name','method_1') ;
                                   $('#method_2').show(); 
                                   $('#method_2').prop('placeholder','Please specify Method here');
                                }else{
                                   $('#method_2').prop('name','') ;
                                   $('#method_1').prop('name','method_1') ;
                                   $('#method_2').hide(); 
                                }
                            });
                            $('#method_2').hide();
                            
                            var fixHelperModified = function(e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width())
    });
    return $helper;
},
    updateIndex = function(e, ui) {
        $('#temp_table  tbody', ui.item.parent()).each(function (i) {
            $(".table_row", this).val(i + 1);
        });
    };

$("#temp_table tbody").sortable({
    helper: fixHelperModified,
    stop: updateIndex
})




  $('._rows').each(function (i) {
            $(".table_row",this).val(i + 1);
        });
});





   $(document).on('click', '.method_', function () {
  
    $id = $(this).prev().remove();
    $id.fadeOut(function () {
    $(this).remove();
   
  });
   });

 $(document).on('click', '.compendia_', function () {
    $id = $(this).prev().remove();
    $id.fadeOut(function () {
    $(this).remove();
    });
});
 
$(document).on('click', '.specification_', function () {
    $id = $(this).prev().remove();
    $id.fadeOut(function () {
    $(this).remove();
    });
}); 

$(document).on('click', '.determined_', function () {
    $id = $(this).prev().remove();
    $id.fadeOut(function () {
    $(this).remove();
    });
});
 
$(document).on('click', '.complies_', function () {
    $id = $(this).prev().remove();
    $id.fadeOut(function () {
    $(this).remove();
    });
});
    </script>
    <style type="text/css">
        #conc{
            width:700px;
            height:40px;
        }
        #COA_BODY{
            margin-top: 200px;
        }
        #COA{
            padding-right:25px;
            padding-left:25px;

        }
        #temp_table td{
            border: 1px solid black;
        }

        #side{
            background-color:#CCCCCC;
            font-size:11px;

        }
        #top_row{
            background-color:#CCCCCC;
        }
        table { 
            border-collapse:collapse;

        }
        p{
            margin-bottom: 0px;
            font-weight: bolder;
        }
        #label_name{
            font-size:11px;
        }
        #wording{
            font-size: 10px;
        }
        textarea.det {
            //vertical-align:middle;
            
            font-size: 12px;
           

        }
        .det{
            font-weight: bold;
            width: 175px;
            //white-space: normal;
    
//-moz-text-align-last: center; /* Firefox 12+ */
 //text-align-last: center;
        }

        #hes{
            font-type: Book Antiqua;
            font-weight: bolder;
            font-size: 12px;
        }
        #signatories{
            font-size: 10px;
        }
        textarea { 
            font-type:Book Antiqua;
            font-size: 12px;
            width: 130px;
            height: 60px;
        } 

        #COA_AREA{
            width:99.5%;
            height: auto;
            background: -moz-linear-gradient(top,  rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(100%,rgba(255,255,255,0))); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* IE10+ */
            background: linear-gradient(to bottom,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#00ffffff',GradientType=0 ); /* IE6-9 */

            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 1px solid black;
            box-shadow: 3px;
            font-size: 12px;
            font-type:Book Antiqua;

        }
        #content{
            margin: 10px;
        }

        form input,select,textarea,button {
            //width: 70%;
            padding: 5px;
            border: 1px solid #d4d4d4;
            border-bottom-right-radius: 5px;
            border-top-right-radius: 4px;

         //   line-height: 1.5em;
            //float: right;

            /* some box shadow sauce :D */
            box-shadow: inset 0px 2px 2px #ececec;
        }
        form input:focus {
            /* No outline on focus */
            outline: 0;
            /* a darker border ? */
            border: 1px solid #bbb;
        }
        #coa_top{
            // background-color: blue;
            width:867.5px;
            height:300px;
        }
        #coa_top_table{
            width:784px;
            height: 300px;
        }
        #top_head{
            width:100px;
        }
        #middle_head{
            width:100px;

        }
        #top_row{
            height: 50px;
        }
        #p_name{
            float: right;
            margin-right: 50px;
        }
        .left_c{
            width:100px;
            margin-left: 5px;

        }
        .test_font{
            font-size: 18px;
        }
        input[type=text]{
            text-align: center;
        }
        .width{
            width: 180px;
            text-align: left;
        }
    </style>
</head>
<div id="new_test" style="display:none;">
    <form name="" id="ntf">
        <table>
            <thead>
                <tr>
                    <td>
            <center><strong>ADD NEW TEST</strong></center>
                    </td>
                </tr>
            </thead>
            <tr>
                <td>TEST</td>
                <td>
                    <select name="test_1" id="tests_1" class="width">
                       <?php foreach($tests as $test):?>
                        <option value="<?php echo $test->id;?>"><?php echo $test->name;?></option> 
                       <?php endforeach;?> 
                    </select>
                </td>
            </tr>
             <tr>
                  <td>METHOD</td>
                <td>
                    <select name="method_1" id="method_1" class="width">
                         <?php foreach($test_methods as $methods_):?>
                        <option value="<?php echo $methods_->name;?>"><?php echo $methods_->name;?></option> 
                       <?php endforeach;?> 
                        <option value='1'>Other</option>
                    </select>
                    <input type='text' class="width" id='method_2'/>
                </td>
            </tr>
             <tr>
                  <td>COMPENDIA</td>
                <td>
                    <textarea name="compendia_1" id="compendia_1" class="width">
                        
                    </textarea>
                </td>
            </tr>
            <tr>
                  <td>SPECIFICATION</td>
                <td>
                    <textarea name="specification_1" id="specification_1" class="width">
                        
                    </textarea>
                </td>
            </tr>
            <tr>
                  <td>DETERMINED</td>
                <td>
                    <textarea name="determined_1" id="determined_1" class="width">
                        
                    </textarea>
                </td>
            </tr>
            
               <tr>
                  <td>REMARKS</td>
                <td>
                    <select name="remarks_1" id="remarks_1" class="width">
                        <option value="COMPLIES">COMPLIES</option>
                         <option value="DOES NOT COMPLY">DOES NOT COMPLY</optio
                    </select>
                </td>
            </tr>
               <tr>
                   <td><input type="button" value="Add Test" id='add_test_now'/></td>
                    <td><input type="button" value="Cancel" id='cancel_now'/></td>
            </tr>
        </table>
    </form>
</div>
<div id="COA_AREA">
    <form action="" id="COAF" method="post">   
        <center><div id="content">
                <center><p><?php echo 'CERTIFICATE OF ANALYSIS'; ?></p><br></center>
                <center>CERTIFICATE No: <input type="text" name="co_num" style="width:200px; text-align:left;" value="<?php echo @$information[0]->CAN;?>"/></center>
                <p></p>
                <p>
                <div id="coa_top">

                    <table id="coa_top_table">
                        <tr id="top_row">
                            <td id="top_head" height="25" align="center" valign="middle"><span >PRODUCT</span></td>
                            <td id="middle_head" align="left" colspan="2"><textarea name="product_name"  style="width:380px; height:40px;"><?php echo $information[0]->product_name; ?></textarea><span id="p_name">REF. NO: &nbsp;<?php echo $information[0]->request_id; ?></span></td>

                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"><span>DATE RECEIVED</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>LABEL CLAIM</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="labelclaim"><?php echo $information[0]->label_claim; ?></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><input type="text" value="<?php echo $information[0]->designation_date; ?>" name="date_received" id="date_received"></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"><span>BATCH NO.</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>PRESENTATION</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="presentation"><?php echo $information[0]->presentation; ?></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><textarea name="batch_no" style="text-align:center;"><?php echo $information[0]->batch_no; ?></textarea></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"> <span>MGF. DATE</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>MANUFACTURER</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="manufacturer"><?php echo $information[0]->manufacturer_name; ?></textarea></td>
                        </tr>
                         <tr align="center" valign="middle">
                            <td id="side"><textarea name="mnfg_date" id="mnfg_date" class="monthYearPicker" style="text-align:center;"><?php echo $information[0]->manufacture_date; ?></textarea></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"><span>EXP. DATE</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>ADDRESS</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="address" id="addre"><?php echo $information[0]->manufacturer_add; ?></textarea></td>
                        </tr>
                         <tr align="center" valign="middle">
                            <td id="side"><textarea  name="exp_date" id="exp_date" class="monthYearPicker" style="text-align:center;"> <?php echo $information[0]->exp_date; ?></textarea></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side">&nbsp;</td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>CLIENT</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="client"><?php echo $information[0]->name . " " . $information[0]->address; ?></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><span>CLIENT REF NO</span></td>
                        </tr>
                        <tr>
                            <td height="40" align="center" valign="middle" id="side"><textarea type="text"  name="client_ref"><?php echo $information[0]->clientsampleref; ?></textarea></td>
                            <td align="left" valign="bottom" id="label_name"><span>TEST(S) REQUESTED</span></td>
                            <td align="left" valign="bottom" id="wording" style="font-size: 16px;"><?php echo $tests_requested; ?></td>
                        </tr>
                    </table>
                </div>

                <p></p>
                <p></p><br>

                <p></p>
                <div id="COA_BODY">
                    <center> <p>
                            <strong>RESULTS</strong>
                        </p></center>
                    <table width="490" height="278" border="1" id="temp_table">
                        <tr align="center" valign="middle">
                            <td height="34" align="center" valign="middle" id="side"><span>TEST</span>&nbsp;<a href="#add_new_test" id="add_new">+</a></td>
                            <td align="center" valign="middle"><span id="hes">METHOD</span></td>
                            <td align="center" valign="middle"><span id="hes">COMPEDIA</span></td>
                            <td align="center" valign="middle"><span id="hes">SPECIFICATION</span></td>
                            <td align="center" valign="middle"><span id="hes">DETERMINED</span></td>
                            <td align="center" valign="middle" id="side"><span>REMARKS</span></td>
                        </tr>
                        <tbody>

                        <?php
                        for ($i = 0; $i < count($trd); $i++) {

                            foreach ($coa_details as $coa) {

                                if ($coa->test_id == $trd[$i]->test_id) {
                                    $determined = $coa->determined;
                                    $remarks = $coa->verdict;
                                }
                            }
                            ?>

                            <tr class="_rows">
                                <?php if ($trd[$i]->test_id == 2) { ?>
                                    <td height="56"  rowspan="<?php count($determined); ?>" align="center" valign="middle" id="side" style="font-size: 16px;"><?php echo $trd[$i]->name ?>
                                        <input type="hidden" name="tests[]" value="<?php echo $trd[$i]->test_id ?>"/>
                                         <input type="hidden" name="table_row[]" class="table_row" />
                                    </td>
                                <?php } else { ?>                                
                                    <td height="56"  align="center" valign="middle" id="side" style="font-size: 16px;"><?php echo $trd[$i]->name ?>
                                        <input type="hidden" name="tests[]" value="<?php echo $trd[$i]->test_id ?>"/>
                                        <input type="hidden" name="table_row[]" class="table_row" />
                                    </td>
                                <?php } ?>

                                <td align="center" valign="middle">
                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->methods);

                                    foreach ($myvals as $option) {
                                        $newoption = str_ireplace("(", "&#13;&#10(", $option);
                                        echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="method_' . $i . '[]" value="" class="det methods"  >' . trim($option)
                                        . '</textarea><a href="#remove-method-value-'.$j.'" class="method_" data-id='.$j.'>x</a>';
                                        $j++;
                                    }
                                    ?>
                                   
                                </td>
                                <td align="center" valign="middle">
                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->compedia);

                                    foreach ($myvals as $option) {
                                        //$newoption = str_ireplace("(", "&#13;&#10(", $option);
                                        echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="compedia_' . $i . '[]" value="" class="det"  >' . trim($option)
                                        . '</textarea><a href="#remove-method-value-'.$j.'" class="compendia_" data-id='.$j.'>x</a>';
                                        $j++;
                                    }
                                    ?>
                                </td>

                                <td align="center" valign="middle">
                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->specification);

                                    foreach ($myvals as $option) {
                                        $newoption = str_ireplace("(", "&#13;&#10(", $option);
                                        echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="specification_' . $i . '[]" value="" class="det"  >' . $option
                                        . '</textarea><a href="#remove-method-value-'.$j.'" class="specification_" data-id='.$j.'>x</a>';
                                        $j++;
                                    }
                                    ?>
                                </td>
                                <td align="center" valign="middle" id="addinput">

                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->determined);

                                    foreach ($myvals as $option) {
                                        $newoption = str_ireplace("(", "&#13;&#10(", $option);
                                        echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="determined_' . $i . '[]" value="" class="det"  >' . $option
                                        . '</textarea><a href="#remove-method-value-'.$j.'" class="determined_" data-id='.$j.'>x</a>';
                                        $j++;
                                    }
                                    ?>



                                </td>
                                <td align="center" valign="middle" id="side">
                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->complies);

                                    foreach ($myvals as $option) {
                                        ?>

                                        <select  id="<?php echo $j; ?>" name="complies_<?php echo $i; ?>[]"  class="det" selected="selected" >
                                            <option value="<?php echo str_replace("_", " ", $option); ?>"><?php echo str_replace("_", " ", $option); ?></option>
                                            <option value="COMPLIES:">SPLIT CELL</option>                                            
                                            <option value="COMPLIES">COMPLIES</option>
                                            <option value="DOES NOT COMPLY:">SEPARATOR 2</option>
                                            <option value="DOES NOT COMPLY">DOES NOT COMPLY</option>
                                        </select>
										 <a href='#remove-complies-"$j"' class="determined_" data-id='.$j.'>x</a>
                                        <?php
                                        $j++;
                                    }
                                    ?>
                                </td>
                                	<td ><a href="#remove-test&action=%fromCOA%" id="<?php echo $trd[$i]->id;?>" tid="<?php echo $trd[$i]->test_id;?>" class="remove">x</a></td>
                            </tr>
                            </tr>
                        <?php }; ?>
                    </tbody>
                    </table>
                </div>

                <p>
                    <label>Conclusion: &nbsp;</label><label id="side"><textarea type="text" id="conc" name="conclusion"><?php
					if($conclusion[0]->conclusion==''){
							echo 'The sample complies with the specifications of the tests performed.';
					}else{
					  echo $conclusion[0]->conclusion;
					}
					?></textarea></label>
                </p>
                <p>
                <table id="signatories" >
                    <thead>
                        <tr><td></td><td></td><td></td><td><a href="#add_signatory" id="add_signatory">+Add</a></td></tr>
                    </thead>
                    <tbody>                        
                    </tbody>
                    
                </table>
                <input type="button" value="Save Alone" id="genCOAS" name="genCOAS"/>
               <input type="button" value="Save Changes And Export To Excel." id="genCOA" name="genCOA"/>
                <input type="button" value="Save Changes And Export To Word." id="genCOAWord" name="genCOAWord"/>
                <input type="button" value="Back" id="Back" name="genBack"/>
        </center>        
    </form>
    <br>

</div>




