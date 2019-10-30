<!doctype>
<html>
    <a href="#help" class="help">Help </a> &nbsp;&nbsp;&nbsp;<a href="#clean" class="clean_m">Clean for Printing</a>
    <div id="symbols">
   &#174;        &#8482;       &#8240;
    
    <input type="button" id="sup" value="sup">
    <input type="button" id="sub" value="sub">
    </div>
 
    <head>
   <link href="<?php echo base_url(); ?>CSS/jquery-ui.css" type="text/css" rel="stylesheet"/>

        <title>INVOICE</title>
    </head>


    <style>
        body{
            margin: 0px;
            padding: 0px;         
            font-family: "Book Antiqua";
        }
        #content{
            margin: 0px;
            padding: 0px;

            width: 100%;
            height: 100%;
        }
        #title{
            width:100%;
                       
            font-size: 24px;
            font-weight: bolder;
        }
        #inv_date,#invoice_top,#invoice_body,#invoice_footer{
            width: 680px;
            background: white;
        }


        .topic{
            font-weight: bolder;
            text-decoration: underline;
            font-size: 16px;
        }
        .topic_t{
            font-weight: bold;
            font-size: 14px;
            line-height: 25px;
            width: 190px;
        }
        .topic_w{
            font-size: 14px;
            line-height: 25px;
        }
        #invoice_body  td{
            padding: 2px;
        }
        input, textarea,select{
            border:none;
        }

        #invoice_body tr td{
            border: 1px solid #000;
        }
        #invoice_body th{
            border: 1px solid #000;
        }
        .tests{
            width:100%;
            font-family: "Book Antiqua";
            font-weight: bolder;
          
            text-align: center;
            background: #CCCCCC;
        }
        .method, .compendia{
            width: 100%;
            text-align: center;
            font-family:"Book Antiqua";

        }

        .cost{
            font-weight: bolder;
            font-size: 15px;
            text-align: center;
            width:100%;
             font-family:"Book Antiqua";

        }
          #product_name{
              font-family:"Book Antiqua" !important;
          }
       
      

    </style>
    <body>
        <div id="content">
        <textarea name=""></textarea>
            <form id="INVOICE">
            <center><div id="title">INVOICE</div></center>
            <center>
                <table id="inv_date" >
                <tr><td colspan="2"><textarea name=""></textarea></tr>
                    <tr>
                        <td><span style="font-size:18px; font-weight: bold;">INVOICE No:</span>  <input style="font-weight: bolder; " type="text" name="inumber" value="<?php echo @$inv[0]->invno. $year2; ?>"/></td>
                        <td style="font-weight: bolder; text-align: right;"><?php echo date('j') . '<sup>' . date('S') . '</sup>' . date(' F Y'); ?></td>

                    </tr>
                    <tr><td colspan="2"><textarea> </textarea></td></tr>
                    <tr>
                        <td>
                            <div id="edaddress" contenteditable="true" name="client" cols="50" rows="10" style=" overflow: hidden; font-weight: bold; font-size:14px; font-family:'Book Antiqua'; text-align: left">
                                <?php
                                $def =$information[0]->name . " " . $information[0]->address;
                                $norm = @$inv[0]->client;
                                 if(empty($norm)){
                                    echo $def;
                                 }else{
                                   echo trim($norm);
                                 }
                                 ?>   </div>
								 								  <!--textarea id="address" name="client" style="display:none"></textarea-->

                        </td>
                        <td></td>
                    </tr>
                    <tr><td colspan="2"><textarea></textarea></td></tr>
                </table>

                <table id="invoice_top" style="margin-top: 10px;">
                    
                    <thead>
                    <th style="height: 40px; vertical-align: top;" colspan="2">
                        <span class="topic">Re: ANALYSIS OF LISTED PRODUCT.</span>
                    </th>
                    </thead>
                    <tbody>
                        <tr style="background: #d9d9d9;" >
                            <td class="topic_t" style="border:none;">PRODUCT:</td>
                            <td class="topic_w" style="border:none;"><div contenteditable="true" id="product_name" style="width:100%; background:#d9d9d9; overflow:none;"><?php echo $information[0]->product_name; ?></div> </td>
                        </tr>
                        <tr>
                            <td class="topic_t" style=" vertical-align: text-top !important;">BATCH NO:</td>
                            <td class="topic_w"><textarea style=" overflow: hidden; font-weight: normal; font-size:14px; font-family:'Book Antiqua'; text-align: left" name="batch_no" >   <?php
                                $def1 =$information[0]->batch_no;
                                $norm1 = @$inv[0]->batch;
                                 if(empty($norm1)){
                                    echo $def1;
                                 }else{
                                   echo trim($norm1);
                                 }
                                 ?></textarea></td>
                        </tr>
                        <tr>
                            <td class="topic_t">CERTIFICATE NO:</td>
                            <td class="topic_w"><?php echo $year ?><input type="text" name="cert" value="<?php echo @$inv[0]->can; ?>"/></td>
                        </tr>
                        <tr>
                            <td class="topic_t">LABORATORY REF NO:</td>
                            <td class="topic_w"><input type="text" name="" value="<?php echo $labref; ?>"/></td>
                        </tr>
                        <tr>
                            <td class="topic_t">CLIENT REF NO:</td>
                            <td class="topic_w">
							<textarea style=" overflow: hidden; font-weight: normal; font-size:14px; font-family:'Book Antiqua'; text-align: left" name="client_ref" ><?php 
							$cli = @$inv[0]->client_ref;
                                 if(empty($cli)){
                                echo !empty($information[0]->clientsampleref) ? $information[0]->clientsampleref : "-";

                                 }else{
                                   echo @$inv[0]->client_ref;
                                 }

							?></textarea>
					</td>
                        </tr>
                        <tr>
                            <td class="topic_t" style=" vertical-align: text-top !important;">TEST(S) REQUESTED:</td>
                            <td class="topic_w"><textarea  style="width:500px; font-family: 'Book Antiqua'"><?php echo $tests_requested;?></textarea></td>
                        </tr>

                    </tbody>            

                </table>

                <table id="invoice_body" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr style="">
                            <th style="height: 40px; vertical-align: middle; border-top: none; border-right: none; border-left:none;" colspan="4">
                                <span class="topic">COST OF ANALYSIS: </span>
                            </th>
                        </tr>
                        <tr>
                            <th style="background: #cccccc;">
                                TEST
                            </th>
                            <th>
                                METHOD
                            </th>
                            <th>
                                COMPENDIA
                            </th>
                            <th id="disc_toggle">
                                COST(<select name="currency" selected="selected">
                                    <option value="<?php echo @$inv[0]->currency;?>"><?php echo @$inv[0]->currency;?></option>
                                    <option value="KShs.">KShs.</option>
                                    <option value="USD.">USD.</option>
                                </select>)
                            </th>
                        </tr>
                    </thead>
                    <tbody> 
                               
                        <?php 
						 $norm1 = @$inv[0]->batch;
                                 if(empty($norm1)){                                 
						for ($i = 0; $i < count($trd); $i++) {?>
                                 <tr style="vertical-align: middle; text-align: center; width:100%;">
                                <td style="font-weight: bolder; font-size: 14px; background: #cccccc;"><input class="tests tests_remover" name="tetst[]" type="text" value="<?php echo $trd[$i]->name; ?>" style="width:200px;"/></td>
                                <td style=""><textarea style="font-size: 12px; vertical-align:middle;" class="method" name="method[]" rows="1"><?php echo $trd[$i]->methods; ?></textarea></td>
                                <td style=""><textarea style="font-size: 12px; vertical-align:middle;" class="compendia" name="compendia[]"  rows="1"><?php echo $trd[$i]->compedia; ?></textarea></td>
                                <td style="font-weight: bolder; font-size: 16px; width:120px;"><input class="cost" name="cost[]" type="text" value="<?php echo @$inv[$i]->cost;?>" /></td>
                                <td class="remover" style="border:none;">&nbsp;&nbsp;</td></tr>
                        <?php }   
						}else{
                                   for($i=0;$i<count($inv);$i++){?>
                                   <tr style="vertical-align: middle; text-align: center; width:100%;">
                                <td style="font-weight: bolder; font-size: 14px; background: #cccccc;"><input class="tests tests_remover" name="tetst[]" type="text" value="<?php echo $inv[$i]->tests; ?>" style="width:200px;"/></td>
                                <td style=""><textarea style="font-size: 12px; vertical-align:middle;" class="method" name="method[]" rows="1"><?php echo $inv[$i]->method; ?></textarea></td>
                                <td style=""><textarea style="font-size: 12px; vertical-align:middle;" class="compendia" name="compendia[]"  rows="1"><?php echo $inv[$i]->compendia; ?></textarea></td>
                                <td style="font-weight: bolder; font-size: 16px; width:120px;"><input class="cost" name="cost[]" type="text" value="<?php echo $inv[$i]->cost;?>" /></td>
                                <td class="remover" style="border:none;">&nbsp;&nbsp;</td></tr>
								 <?php  } ?>
                                 <?php } ?>
                             
                           

                        <tr style="vertical-align: middle; text-align: center;">
                            <td colspan="2" style="border-left: none; border-bottom: none;"></td>                         
                            <td style="font-size: 14px; font-weight: bold;">TOTAL COST</td>
                            <td style="font-weight: bolder; font-size: 16px; width:100px;"><input class="tests" style="font-size: 20px;" id="total_cost" name="total_cost" type="text" value=""/></td>
                        </tr>
                        <tr id="disc_row" style="vertical-align: middle; text-align: center;">
                            <td colspan="2" style="border-left: none; border-bottom: none; border-top:none;"><span id="dmode"><input type="text"  style="text-align: right;" id="discount" name="discount" value="<?php echo @$inv[0]->discount;?>"/>% </span></td>                         
                            <td style="font-size: 14px; font-weight: bold;">DISCOUNT </td>
                            <td style="font-weight: bolder; font-size: 16px; width:100px;"><input class="tests" style="font-size: 20px;" id="discount_amount" name="discount_amount" type="text" /></td>
                        </tr>
                        <tr style="vertical-align: middle; text-align: center;">
                            <td colspan="2" style="border-left: none; border-bottom: none; border-top:none;"></td>                         
                            <td id="saver" style="font-size: 14px; font-weight: bold;">PAYABLE AMOUNT</td>
                            <td style="font-weight: bolder; font-size: 16px; width:100px; background: #cccccc;"><input class="tests" style="font-size: 20px;" id="amount_payable" name="payable_amount" type="text" value=""/></td>
                        </tr>
                   
                    </tbody>
                </table>
                <input type="button" id="save_button" style="margin:5px;" value="SAVE INVOICE"/>
                <table id="invoice_footer" style="margin-top: 20px;">
                    <tr>
                        <td style="font-weight: bolder; width: 100px;">DIRECTOR:</td>
                        <td style="width:150px;"><input type="text" value="DR. H. K. CHEPKWONY" style="width:150px;"/></td>
                        <td style="border-bottom:dotted black;  width: 170px; padding-right: 20px;"></td>                     
                        <td style="font-weight: bolder;"> &nbsp;&nbsp;&nbsp;&nbsp;DATE: <input type="text" name="date" value="<?php echo date('d/m/Y'); ?>"/></td>
                    </tr>
                    <tr style="height: 20px;">
                        <td colspan="4" style="margin-top: 20px;">
                    <center><span id="footer" style="font-size: 10px; color: gray;">
                            <br>
                            <p></p>
                            All cheques should be made payable to: NATIONAL QUALITY CONTROL LABORATORY
                        </span></center>
                    </td>
                    </tr>
                </table>
            </center>
            </form>
        </div>
    </body>

    <script src="<?php echo base_url() . 'bower_components/jquery/dist/jquery.js' ?>" type="text/javascript"></script>

  <script src="<?php echo base_url() . 'Scripts/jquery-ui.js' ?>" type="text/javascript"></script>
  
  
    <script>
        $(document).ready(function () {
            
           $('#address').val($('#edaddress').text());
            $('#edaddress').focusout(function(){
                $('#address').val($(this).text());
            })
          
             findaverage();
               findDis();
             
          
             
            $('.cost').on('keyup', function () {

                findaverage();
                findDis();
            });
          
               $('.remover').on('click', function () {
                $(this).closest('tr').remove();
            });

            $('#discount').on('keyup', function () {

                findDis();

            });


            $('#disc_toggle').click(function () {
                $('#dmode,#disc_row').toggle();
            });
          
            $('.clean_m').click(function () {
                $('#dmode,#discount,.help,.clean_m,#save_button,#symbols,#sup,#sub').toggle();
            });
          
             $('.help').click(function () {
                help="QUICK HELP MENU\n\
                      1. Put costs in cost column without formatting\n\
                      2. Once you have entered the cost click on the words 'PAYABLE AMOUNT' to save\n\
                      3. To show and hide 'DISCOUNT' row click the word 'COST' in cost column both to show and hide\n\
                      4. Click the the furthest right borderline of 'COST' column to delete the row\n\
                      5. For discount percentage, along the discount row at the bottom of the table, there is a symbol '%',\n\
\n\                      Type your percentage value (5, 7.5, 10 e.t.c) before the '%' symbol, if none, leave blank\n\
                      6. Rows can only be swaped for only printing purposes, will not be saved. Take the cursor and point the far left of the test\n\
                         column, click and drag the row ro position. (This should be done only once you are ready for printing, saving is disabled at this point) \n\
NOTE: To Add a new test, go to COA ENGINE add a test then refresh invoice page to load the addition.\n\
";
                       print="QUICK HELP PRINTING MENU\n\
                              \n\When Ready to print the invoice, click 'Clean for Printing' at the top right of the page\n\
\n\To remove uneccessary data from the page\n\
                           1. Press Alt or F10 to see the menu bar.\n\
                           2. Click on File, then Page Setup.\n\
                           3. Select the tab Margins & Header/Footers.\n\
                           4. Change selections to blank or your desired action.\n\
                           5. On the Format & Options tab, you can Check print background and image to print the colors."
                alert(help);
                alert(print);
            });



            $('#invoice_body tbody tr').on('focusout', function () {
                data = $(this).closest('tr').find('.cost').val();
                //alert(data)
                //new_value = data.toFixed(2);
                $(this).closest('tr').find('.cost').val(addCommas(data + '.00'));
            });

            function findDis() {
                p = parseFloat($('#discount').val() + '.00');
                tc = parseFloat($('#total_cost').val().replace(',', ''));
                amount = p / 100 * tc;
                $('input#discount_amount').val(addCommas(amount + '.00'));
                totc = tc - amount;
                $('input#amount_payable').val(addCommas(totc + '.00'));
            }
            ;



            function findaverage() {
                discount = $('#discount').val();
                var sum = 0;
                var sum1 = 0;
                var answer = 0;
                var answer1 = 0;
                var boxes = $('.cost[value!=""]').length;
                $('.cost').each(function () {
                    sum += Number($(this).val().replace(',', ''));
                    sum1 = addCommas(sum.toFixed(2));

                });
                discount_val = discount / 100 * sum;

                console.log(sum1);


                $('input#total_cost').val(sum1);
                $('input#amount_payable').val(sum1);
            }
          
          
                                    var fixHelperModified = function(e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width())
    });
    return $helper;
},
    updateIndex = function(e, ui) {
        $('#saver').prop('id','null')
    };

$("#invoice_body tbody").sortable({
    helper: fixHelperModified,
    stop: updateIndex
})



            function addCommas(nStr)
            {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
			
			
			$('#edaddress').focusout(function () {
             saveClient();
            });
			
			
			function saveClient(){
				   postData = $('#edaddress').html();

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('coa/saveCOABillingUpdate/'.$labref); ?>" ,
                    data: {client:postData},
                    success: function () {
                        console.log('Save Successfull!')
                     // window.location.href="<?php echo site_url('coa/generatecoa_invoice2/'.$labref); ?>"
;                    },
                    error: function () {
                        consile.log('Error')
                        return false;
                    }

                });
			}

            $('#saver,#save_button').click(function () {
                postData = $('#INVOICE').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('coa/saveCOABilling/'.$labref); ?>" ,
                    data: postData,
                    success: function () {
						 saveClient();
                        alert('Save Successfull!')
                     // window.location.href="<?php echo site_url('coa/generatecoa_invoice2/'.$labref); ?>"
;                    },
                    error: function () {
                        alert('Error')
                        return false;
                    }

                });
            });
        });
        
        
        function setSuper() {
    try {
        if (window.ActiveXObject) {
            var c = document.selection.createRange();
            return c.htmlText;
        }
    
        var nNd = document.createElement("super");
        var w = getSelection().getRangeAt(0);
        w.surroundContents(nNd);
        return nNd.innerHTML;
    } catch (e) {
        if (window.ActiveXObject) {
            return document.selection.createRange();
        } else {
            return getSelection();
        }
    }
}

      function setSub() {
    try {
        if (window.ActiveXObject) {
            var c = document.selection.createRange();
            return c.htmlText;
        }
    
        var nNd = document.createElement("sub");
        var w = getSelection().getRangeAt(0);
        w.surroundContents(nNd);
        return nNd.innerHTML;
    } catch (e) {
        if (window.ActiveXObject) {
            return document.selection.createRange();
        } else {
            return getSelection();
        }
    }
}


$(function() {
    $('#sup').click( function() {
        var mytext = setSuper();
        $('super').css({"vertical-align":"super", "font-size":".63em" });
    });
    
    $('#sub').click( function() {
        var mytext = setSub();
        $('sub').css({"vertical-align":"sub", "font-size":".63em" });
    });
});
    </script>


</html>