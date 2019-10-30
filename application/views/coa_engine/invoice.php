D<input type="text" value="0" id="discount" style="border:none;"/>
<P CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Book Antiqua, serif"><FONT SIZE=5><B>INVOICE</B></FONT></FONT></P>
<P CLASS="western" STYLE="margin-bottom: 0in"><BR>
</P>
<CENTER>
    <TABLE WIDTH=600 CELLPADDING=7 CELLSPACING=0>
     
        <TR VALIGN=TOP>
            <TD WIDTH=305 HEIGHT=6 STYLE="border: none; padding: 0in">
                <P CLASS="western" STYLE="margin-bottom: 0in "  style="margin-left:148px;"><FONT FACE="Book Antiqua, serif"><FONT SIZE=3 STYLE="font-size: 13pt"><B>INVOICE
                        No:  /<?php echo $inyear; ?><input type="text" name="inumber" style="width:60px; padding: 0; margin:0px; text-align: left; border: none;"/></B></FONT></FONT></P>
               
               
            </TD>
            <TD WIDTH=250 STYLE="border: none; padding: 0in">
                <H4 CLASS="western">Date: <?php echo date('j') . '<sup>' . date('S') . '</sup>' . date(' F Y'); ?></H4>
            </TD>
        </TR>
		<tr><td>

        <div style="" >
            <TEXTAREA name="client_address" class="ADDRESS " style="font-family: Times New Roman; border:none; color: black; font-size: 12pt; so-language: en-US;width:350px; text-align: left; font-weight: bolder; padding-left: 0; margin-left: 0;" rows="5">
                <?php echo $information[0]->name . " " . $information[0]->address; ?>
</TEXTAREA>
</div>
</td></tr>
  

        
          </TABLE>
</CENTER>

<P CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.04in; margin-bottom: 0.04in">
    <FONT FACE="Book Antiqua, serif"><U><B>Re: ANALYSIS OF LISTED  PRODUCT</B></U></FONT><FONT FACE="Book Antiqua, serif"><FONT SIZE=2>.</FONT></FONT></P>
<P CLASS="western" STYLE="margin-top: 0.04in; margin-bottom: 0.04in">
</P>
<CENTER>
    <TABLE WIDTH=582 CELLPADDING=7 CELLSPACING=0>
        <COL WIDTH=178>
        <COL WIDTH=376>
        <TR>
            <TD WIDTH=178 HEIGHT=12 BGCOLOR="#cccccc" STYLE="border: none; padding: 0in">
                <P CLASS="western" STYLE="margin-top: 0.04in"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B>PRODUCT:</B></FONT></FONT></P>
            </TD>
            <TD WIDTH=376 VALIGN=TOP BGCOLOR="#cccccc" STYLE="border: none; padding: 0in">
                <P CLASS="western" STYLE="margin-top: 0.04in"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><?php echo strtoupper($information[0]->product_name); ?></FONT></FONT>
                </P>
            </TD>
        </TR>
        <TR>
            <TD WIDTH=178 HEIGHT=12 STYLE="border: none; padding: 0in">
                <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B>BATCH
                        NO:</B></FONT></FONT></P>
            </TD>
            <TD WIDTH=376 STYLE="border: none; padding: 0in">
                <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><?php echo strtoupper($information[0]->batch_no); ?></FONT></FONT></P>
            </TD>
        </TR>
        <TR>
            <TD WIDTH=178 HEIGHT=12 STYLE="border: none; padding: 0in">
                <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B>CERTIFICATE
                        NO:</B></FONT></FONT></P>
            </TD>
            <TD WIDTH=376 STYLE="border: none; padding: 0in">
                <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><?php echo $year; ?><input type="text" name="invnumber" style="width:60px; padding: 0; margin:0px; text-align: left; border: none;"/></FONT></FONT></P>
            </TD>
        </TR>
        <TR>
            <TD WIDTH=178 HEIGHT=12 STYLE="border: none; padding: 0in">
                <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B>LABORATORY
                        REF NO:</B></FONT></FONT></P>
            </TD>
            <TD WIDTH=376 STYLE="border: none; padding: 0in">
                <P CLASS="western" STYLE="margin-top: 0.04in"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><?php echo $labref; ?></FONT></FONT></P>
            </TD>
        </TR>
        <TR>
            <TD WIDTH=178 HEIGHT=12 STYLE="border: none; padding: 0in">
                <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B>CLIENT
                        REF NO:</B></FONT></FONT></P>
            </TD>
            <TD WIDTH=376 STYLE="border: none; padding: 0in">
                <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><?php echo!empty($information[0]->clientsampleref) ? $information[0]->clientsampleref : "-"; ?></FONT></FONT></P>
            </TD>
        </TR>
        <TR>
            <TD WIDTH=178 HEIGHT=12 VALIGN=TOP STYLE="border: none; padding: 0in">
                <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B>TEST(S)
                        REQUESTED:</B></FONT></FONT></P>
            </TD>
            <TD WIDTH=376 VALIGN=BOTTOM STYLE="border: none; padding: 0in">
                <P CLASS="western"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><?php echo $tests_requested; ?></FONT></P>
            </TD>
        </TR>
    </TABLE>
</CENTER>

<P ALIGN=CENTER STYLE="margin-bottom: 0in; page-break-after: avoid"><FONT FACE="Book Antiqua, serif"><FONT SIZE=3><B>COST
        OF ANALYSIS:</B></FONT></FONT></P><br>

<CENTER>
    <TABLE style="width:500px; !important; "   CELLSPACING=0 id="invoice_table">
        
        <thead style="height:10px !important;">
            <TH BGCOLOR="#cccccc" STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding:0px;">
                <H5 CLASS="" ALIGN=CENTER STYLE=""><FONT SIZE=2>TEST</FONT></H5>
            </TH>
             <TH  STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding:0px;">
                <H6 CLASS="" STYLE=""><FONT SIZE=2>METHOD</FONT></H6>
            </TH>
            <TH  STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding:0px;">
                <H6 CLASS="" STYLE=""><FONT SIZE=2>COMPENDIA</FONT></H6>
            </TH>
            <TH  width="85" STYLE="border: 1px solid #000000;  width:85px !important; padding:0px;">
                <H3 CLASS="" ALIGN=CENTER STYLE=""><FONT FACE="Book Antiqua, serif"><FONT SIZE=2>COST
                    (KShs)</FONT></FONT></H3>
            </TH>
        </thead>
		<tbody>
        <?php for ($i = 0; $i < count($trd); $i++) {
; ?>
            <TR>
                <TD HEIGHT=3 BGCOLOR="#cccccc" STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
                    <P CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.04in"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B><input style="font-weight:bold; text-align:center; border:none; background:#CCCCCC;" type="text" value="<?php echo $trd[$i]->name; ?>"/></B></FONT></FONT></P>
                </TD>
                <TD  STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
                    <P CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.04in"><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><input style="font-weight:bold; text-align:center; border:none; width:100px;" type="text" value="<?php echo $trd[$i]->methods; ?>"/></FONT></FONT></P>
                </TD>
                <TD  STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
                    <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><textarea style="border:none; text-align:center;"><?php echo $trd[$i]->compedia; ?></textarea></FONT></FONT></P>
                </TD>
                <TD width=85  STYLE="border: 1px solid #000000; padding: 0in 0.08in: !important;" >
                    <P CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.04in"><FONT FACE="Book Antiqua, serif"><B><input style="font-weight:bolder; width:85px; border: none; text-align:center;" type="text" name="cost[]" class="cost"/></B></FONT></P>
                </TD>
            </TR>
        <?php }; ?>
 

        <TR>
            <TD ROWSPAN=2 COLSPAN=2 HEIGHT=2 STYLE="border-left: none; border-right: none; padding: 0in">
                <P CLASS="western" ALIGN=CENTER><BR>
                </P>
            </TD>
            <TD STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
                <P ALIGN=CENTER STYLE="margin-top: 0.04in; page-break-after: avoid">
                    <FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B>TOTAL COST</B></FONT></FONT></P>
            </TD>
            <TD width=85  STYLE="border: 1px solid #000000; padding: 0in 0.08in">
                <P CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.04in"><FONT FACE="Book Antiqua, serif"><B><input style="border:none; font-weight:bolder; text-align:center;" readonly type="text" id="total_cost"/></B></FONT></P>
            </TD>
        </TR>
		
		 
		
        <TR>
            <TD   STYLE=" border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
                <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B>DISCOUNT</B></FONT></FONT></P>
            </TD>
            <TD width=85   STYLE="border: 1px solid #000000; ">
                <P CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.04in"><FONT FACE="Book Antiqua, serif"><U><B><input style="border:none; font-weight:bolder; text-align:center; " type="text" readonly id="discount_amount" value="0.00"/></span></B></U></FONT></P>
            </TD>
        </TR>
		
		<TR>
		<TD ROWSPAN=2 COLSPAN=2 HEIGHT=2 STYLE=" border-left: none; none; padding: 0in">
               
            </TD>
            <TD   STYLE="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: none; padding-top: 0in; padding-bottom: 0in; padding-left: 0.08in; padding-right: 0in">
                <P CLASS="western" ALIGN=CENTER><FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B>AMOUNT
                        PAYABLE</B></FONT></FONT></P>
            </TD>
            <TD width=85  BGCOLOR="#d9d9d9" STYLE="border: 1px solid #000000; ">
                <P CLASS="western" ALIGN=CENTER STYLE="margin-top: 0.04in"><FONT FACE="Book Antiqua, serif"><U><B><input style="border:none; font-weight:bolder; text-align:center; background:#D9D9D9;" type="text" readonly id="amount_payable"/></span></B></U></FONT></P>
            </TD>
        </TR>
		
		
		
		
		
		
		</tbody>
    </TABLE>

<P CLASS="western" STYLE="margin-bottom: 0in; display: none"><CENTER>
    <TABLE DIR="LTR" WIDTH=533 CELLPADDING=7 CELLSPACING=0>
        <COL WIDTH=95>
        <COL WIDTH=154>
        <COL WIDTH=101>
        <COL WIDTH=43>
        <COL WIDTH=70>
        <TR VALIGN=BOTTOM>
            <TD WIDTH=95 HEIGHT=15 STYLE="border: none; padding: 0in; color: black;">
              <FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B>DIRECTOR:</B></FONT></FONT
            </TD>
			
			 <TD WIDTH=200 STYLE="border: none; padding: 0in; color:black;">
               <FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B><input style="border:none;  text-align: left; color:black; width:150px;" type="text" name="director" value="DR. H. K. CHEPKWONY" /></FONT></FONT></H2>
                    </B></FONT></FONT>
             
            </TD>
			<br>
          
            <TD WIDTH=200 STYLE="border-top: none; width:350px; border-bottom: 1px dotted #000000; border-left: none; border-right: none; padding: 0in">
                <P CLASS="western" STYLE="margin-bottom: 0in"><BR>
                </P>
                
               
            </TD>
            <TD WIDTH=43 STYLE="border: none; padding: 0in; color:black;">
               <FONT FACE="Book Antiqua, serif"><FONT SIZE=2><B>DATE:
                    </B></FONT></FONT>
             
            </TD>
            <TD WIDTH=70 STYLE="border: none; padding: 0in; color: black;">
                <FONT FACE="Book Antiqua, serif"><FONT SIZE=2><input style=" text-align: left; color:black; border:none;" type="text" name="date" value="<?php echo date('d/m/Y'); ?>"/></FONT></FONT>
            </TD>
        </TR>
    </TABLE>
</CENTER>



<DIV TYPE=FOOTER>
    
    <P ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Book Antiqua, serif"><FONT SIZE=1 STYLE="font-size: 8pt; color: #808080;">All
        cheques should be made payable to: NATIONAL
            QUALITY CONTROL LABORATORY</B></FONT></FONT></P>
</DIV>


<script src="<?php echo base_url() . 'bower_components/jquery/dist/jquery.js' ?>" type="text/javascript"></script>

<script>
$(document).ready(function(){
	$('.cost').on('keyup',function () {	
	   
       findaverage();
	   findDis();
    });
	
	$('#discount').on('keyup',function () {	
	   
	 findDis();  
       
    });
	
	
	
	$('#invoice_table tbody tr').on('focusout',function(){
		data=$(this).closest('tr').find('.cost').val();
		//alert(data)
		//new_value = data.toFixed(2);
		$(this).closest('tr').find('.cost').val(addCommas(data+'.00'));
	});
	
	function findDis(){
		p = parseFloat($('#discount').val()+'.00');
	   tc = parseFloat($('#total_cost').val().replace(',',''));
	   amount = p/100 * tc;
	   $('input#discount_amount').val(addCommas(amount+'.00'));
	    totc = tc - amount;
	   $('input#amount_payable').val(addCommas(totc+'.00'));
	};
	

	
 function findaverage(){
	 discount=$('#discount').val();
        var sum = 0;
        var sum1=0;
        var answer=0;
        var answer1=0;
        var boxes= $('.cost[value!=""]').length;
        $('.cost').each(function() {
            sum += Number($(this).val().replace(',',''));			
            sum1=addCommas(sum.toFixed(2));
           
        });
		discount_val = discount/100 * sum;
		
		console.log(sum1);
		
		
        $('input#total_cost').val(sum1);
		$('input#amount_payable').val(sum1);
        } 
		
	
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
});
</script>
