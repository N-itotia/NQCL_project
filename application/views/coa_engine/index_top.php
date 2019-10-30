<?php $this->load->view('coa_engine/coa_head');?>
<div class="widget-body " >
    <section id='printable_area'>
    <input type="hidden" id="labref_coa"/>
    <div class="row col-md-10 col-md-offset-2" id="heading"><strong><h3>NQCL TOP SAMPLE INFORMATION EDIT & ASSIGNMENT</h3> </strong></div>
    <form class="form-horizontal" id="COAF">
        <printable>
        <div class="row">
            <fieldset>
               
                <table id="coa_top_table" class="table-condensed">
                    <tr id="top_row" >
                        <td id="top_head" height="25" align="center" valign="middle"><span class="control-label"><strong>PRODUCT</strong></span></td>
                        <td id="middle_head" align="left" valign="middle" colspan="2"><textarea name="product_name" id="product_name"  class="form-control textarea_top"  style="width:480px; border:none; " rows="1"></textarea> <span  id="p_name" class="control-label" style="position:absolute; font-weight: bolder; top:75px; margin-left: 595px; width:200px;">REF. NO: &nbsp;</span></td>

                    </tr>
                    <tr>
                        <td align="center" valign="middle" id="side"><span><strong>DATE RECEIVED</strong></span></td>
                        <td rowspan="2" align="left" valign="top" id="label_name" class="left_c textarea_top_side"><span><strong>LABEL CLAIM</strong></span></td>
                        <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%; border:none;" name="labelclaim" id="labelclaim" class="form-control textarea_top"></textarea></td>
                    </tr>
                    <tr align="center" valign="middle">
                        <td id="side"><input class="form-control textarea_top_side" style="width:150px;  border:none;" type="text" value="" name="date_received" id="date_received"></td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" id="side"><span><strong>BATCH NO.</strong></span></td>
                        <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span><strong>PRESENTATION</strong></span></td>
                        <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%; border:none;" class="form-control textarea_top" name="presentation" id="presentation"></textarea></td>
                    </tr>
                    <tr align="center" valign="middle">
                        <td id="side"><textarea name="batch_no" class="form-control textarea_top_side" style="text-align:center;  border:none;" id="batch_noo"></textarea></td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" id="side"> <span><strong>MFG. DATE</strong></span></td>
                        <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span><strong>MANUFACTURER</strong></span></td>
                        <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%; border:none;" class="form-control textarea_top" name="manufacturer" id="manufacturer"></textarea></td>
                    </tr>
                    <tr align="center" valign="middle">
                        <td id="side"><textarea name="mnfg_date" class="form-control textarea_top_side" id="mnfg_date" class="monthYearPicker" style="text-align:center;  border:none;"></textarea></td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" id="side"><span><strong>EXP. DATE</strong></span></td>
                        <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span><strong>ADDRESS</strong></span></td>
                        <td rowspan="2" align="left" valign="top" id="wording"><textarea  class="form-control textarea_top" style="width:100%; border:none;" name="address" id="addre"></textarea></td>
                    </tr>
                    <tr align="center" valign="middle">
                        <td id="side"><textarea  name="exp_date"  class="form-control textarea_top_side" id="exp_date" class="monthYearPicker" style="text-align:center;  border:none;"></textarea></td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" id="side">&nbsp;</td>
                        <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span><strong>CLIENT</strong></span></td>
                        <td rowspan="2" align="left" valign="top" id="wording"><textarea class="form-control textarea_top" style="width:100%; border:none;" name="client" id="client"></textarea></td>
                    </tr>
                    <tr align="center" valign="middle">
                        <td id="side"><span><strong>CLIENT REF NO</strong></span></td>
                    </tr>
                    <tr>
                        <td height="40" align="center" valign="middle" id="side"><textarea type="text" class="form-control textarea_top_side" style="border:none;" name="client_ref" id="client_ref"></textarea></td>
                        <td align="left" valign="bottom" id="label_name"><strong>TESTS REQUESTED:</strong></td>
                        <td align="left" valign="bottom" id="wording" style="font-size: 13px;"><span id="requested_tests"></span></td>
                    </tr>
                </table>
            </fieldset>
        </div>

       <!-- <div class="row col-md-12" style="text-align: center; font-weight: bolder; margin: 10px;">
            RESULTS

        </div>
        <fieldset>
            <results>
            <table class="table table-condensed col-md-12 result_table">
                <thead style="border:solid black 1px;">
                <td class="side">TEST</td>
                <td class="tdbold">METHOD</td>
                <td class="tdbold">COMPENDIA</td>
                <td class="tdbold">SPECIFICATION</td>
                <td class="tdbold">DETERMINED</td>
                <td class="side">REMARKS</td>
                </thead>
                <tbody>

                </tbody>
            </table>
            </results>
        </fieldset>



        <div class="form-group">
            <table>
                <td><label class="col-md-2 control-label">CONCLUSION:</label></td>
                <td>
                    <div class="col-md-10">
                        <textarea style="border :none; width: 728px;" class="form-control" placeholder="Conclusion" id="Conclusion" name="conclusion" rows="1"></textarea>
                    </div>
                </td>
            </table>
        </div>

        <div row class="col-md-10 col-md-offset-2" id="signatoriesData">
          <table class="signatory_table">
            <tbody>
            </tbody>
          </table>
        </div>

    </printable>-->


        <div class="row col-md-8 col-md-offset-2 not_pintable" style="margin-top:10px" >
            <dl>
                <dd>

                    <button type="button" class="btn  btn-info" id="BackButton"><span class="fa fa-backward"> Back</span></button>
                    <button type="button" class="btn btn-primary" id="SaveGenCOAS"><span class="fa fa-save"> Save Information</span></button>
                   <button type="button"  class="btn btn-success" id="genCOAWordDATA"><span class="fa fa-briefcase"> Save & Assign Sample for Review</span></button>
                     <!--<button type="button"  class="btn btn-warning" id="genCOAS"><span class="fa fa-print"> Print Draft</span></button>-->

                </dd>
            </dl>
        </div>





    </form>
    </section>

</div>
<!-- end widget content -->
<?php $this->load->view('coa_engine/coa_footer_top');?>
