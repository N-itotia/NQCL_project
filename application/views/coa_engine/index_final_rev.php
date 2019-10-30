<?php $this->load->view('coa_engine/coa_final_head'); ?>
<div class="widget-body " >
    <section id='printable_area'>
        <input type="hidden" id="labref_coa"/>
        <div class="row col-md-8 col-md-offset-2" style="margin-bottom: 5px;">
            <center><strong> CERTIFICATE OF ANALYSYS
                    <p>CERTIFICATE No:<input type="text" class="form-control" name="co_num" id="co_num" style="width:200px; text-align:center;"/></p>
                </strong></center></div>

        <form class="form-horizontal" id="COAF">
            <div class="row">
                <fieldset>

                    <table id="coa_top_table" class="table-condensed">
                        <tr id="top_row" >
                            <td id="top_head" height="25" align="center" valign="middle"><span class="control-label">PRODUCT</span></td>
                            <td id="middle_head" align="left" valign="middle" colspan="2"><textarea name="product_name" id="product_name"  class="form-control textarea_top"  style="width:480px; border:none; " rows="1"></textarea> <span  id="p_name" class="control-label" style="position:absolute; top:90px; margin-left: 505px; width:200px; font-weight: bolder;">REF. NO: &nbsp;</span></td>

                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"><span>DATE RECEIVED</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c textarea_top_side"><span>LABEL CLAIM</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%; border:none;" name="labelclaim" id="labelclaim" class="form-control textarea_top"></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><input class="form-control textarea_top_side" style="width:150px;  border:none;" type="text" value="" name="date_received" id="date_received"></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"><span>BATCH NO.</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>PRESENTATION</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%; border:none;" class="form-control textarea_top" name="presentation" id="presentation"></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><textarea name="batch_no" class="form-control textarea_top_side" style="text-align:center;  border:none;" id="batch_noo"></textarea></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"> <span>MGF. DATE</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>MANUFACTURER</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%; border:none;" class="form-control textarea_top" name="manufacturer" id="manufacturer"></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><textarea name="mnfg_date" class="form-control textarea_top_side" id="mnfg_date" class="monthYearPicker" style="text-align:center;  border:none;"></textarea></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"><span>EXP. DATE</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>ADDRESS</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea  class="form-control textarea_top" style="width:100%; border:none;" name="address" id="addre"></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><textarea  name="exp_date"  class="form-control textarea_top_side" id="exp_date" class="monthYearPicker" style="text-align:center;  border:none;"></textarea></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side">&nbsp;</td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>CLIENT</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea class="form-control textarea_top" style="width:100%; border:none;" name="client" id="client"></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><span>CLIENT REF NO</span></td>
                        </tr>
                        <tr>
                            <td height="40" align="center" valign="middle" id="side"><textarea type="text" class="form-control textarea_top_side" style="border:none;" name="client_ref" id="client_ref"></textarea></td>
                            <td align="left" valign="bottom" id="label_name">TESTS REQUESTED:</td>
                            <td align="left" valign="bottom" id="wording" style="font-size: 13px;"><span id="requested_tests"></span></td>
                        </tr>
                    </table>
                </fieldset>
            </div>

            <div class="row col-md-12" style="text-align: center; font-weight: bolder; margin: 10px;">
                RESULTS

            </div>
            <fieldset>
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
            </div>


            <div class="row col-md-6 col-md-offset-3 not_pintable" >
                <dl>
                    <dd>

                        <button type="button" class="btn  btn-info" id="BackButton"><span class="fa fa-backward"> Back</span></button>
                        <button type="button" class="btn btn-primary" id="SaveGenCOAS"><span class="fa fa-save"> Save</span></button>
                        <button type="button"  class="btn btn-success" id="genCOAWordDATA"><span class="fa fa-download"> Save & Export - Ms.Word</span></button>
                        <button type="button"  class="btn btn-default" id="invoice"><span class="fa fa-money"> Invoice</span></button>

                    </dd>
                </dl>
            </div>




        </form>


        <div class="panel panel-success col-md-10 col-md-offset-1" style="height: auto; display: none; margin-top: 100px; overflow: auto; padding: 30px;" id="coaSettings">
            <div class="panel panel-heading">
                <p><span class="fa fa-gear"> MS.WORD PRINTING SETTINGS : LIMS FINAL CERTIFICATE OF ANALYSIS</span></p>
            </div>
            <div class="panel panel-body">
                <p>Ms.Word Page Settings</p>
                <form id="coa_settings">
                    <div class="row col-md-4">
                        <table class="table table-stripped table-condensed">

                            <tr>
                                <td>COA Top Table Size</td>
                                <td>  <select id="coa_size" name="coa_size" class="form-control select select2" style="width:auto;" >
                                        <option value="71">71%</option>
                                        <option value="72">72%</option>
                                        <option value="73">73%</option>
                                        <option value="74">74%</option>
                                        <option value="75">75%</option>
                                        <option value="76">76%</option>
                                        <option value="77">77%</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>COA Result Table Size</td>
                                <td>  <select id="coa_size_rsize" name="coa_size_rsize" class="form-control select select2" style="width:auto;" >
                                        <option value="71">71%</option>
                                        <option value="72">72%</option>
                                        <option value="73">73%</option>
                                        <option value="74">74%</option>
                                        <option value="75">75%</option>
                                        <option value="76">76%</option>
                                        <option value="77">77%</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Line Spacing</td>
                                <td>  <select id="coa_line_spacing" name="coa_line_spacing" class="form-control select select2" >
                                        <option value="1.15"> &updownarrow; 1.15</option>
                                        <option value="1.0">&updownarrow; 1.0</option>
                                        <option value="0">&updownarrow; 0</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Top_Label_Font_Size</td>
                                <td><select name="label_size" class="select" id="label_size">
                                        <option value="18">18</option>
                                        <option value="16">16</option>                                
                                        <option value="20">20</option>

                                    </select></td>
                            </tr>
                            <tr>
                                <td>Top_Sub_Label_Font_Size</td>
                                <td><select name="sublabel_size" class="select" id="sublabel_size">
                                        <option value="12">12</option>
                                        <option value="10">10</option>                                
                                        <option value="14">14</option>

                                    </select></td>
                            </tr>
                            <tr><td colspan="2">TOP TABLE</td></tr>
                            <tr>
                                <td>Top Title Row Font</td>
                                <td><select name="tfont" class="select" id="tfont">

                                        <option value="9">9</option>
                                        <option value="8">8</option>

                                    </select></td>
                            </tr>
                            <tr>
                                <td>Top Table Row Height</td>
                                <td><select name="theight" class="select" id="theight">

                                        <option value="450">450</option>
                                        <option value="500">500</option>
                                        <option value="600">600</option>
                                        <option value="700">700</option>
                                        <option value="750">750</option>
                                        <option value="800">800</option>

                                    </select></td>
                            </tr>
                            <tr>
                            <tr>

                                <td>First Column Font</td>
                                <td><select name="fcfont" class="select" id="fcfont" name="fcfont">

                                        <option value="9">9</option>  
                                        <option value="8">8</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Middle Column Font</td>
                                <td><select name="fmfont" class="select" id="fmfont"  name="fmfont">

                                        <option value="9">9</option> 
                                        <option value="8">8</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Last Column Font</td>
                                <td><select name="flfont" class="select" id="flfont" name="flfont">

                                        <option value="9">9</option>   
                                        <option value="8">8</option>
                                    </select></td>
                            </tr>

                        </table>
                    </div>
                    <div class="row col-md-4 col-md-offset-2">
                        <table>
                            <tr>
                                <td colspan="2"><strong>RESULTS TABLE</strong></td>
                            </tr>
                            <tr>
                                <td>Result Table Row Height</td>
                                <td><select name="rtrheight" class="select" id="rtrheight">

                                        <option value="450">450</option>
                                        <option value="500">500</option>
                                        <option value="600">600</option>
                                        <option value="700">700</option>
                                        <option value="750">750</option>
                                        <option value="800">800</option>

                                    </select></td>
                            </tr>
                            <tr>
                                <td>Result_Table_Font_Size</td>
                                <td><select name="rtfont" class="select" id="rtfont">

                                        <option value="9">9</option> 
                                        <option value="8">8</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Result Conclusion</td>
                                <td><select name="rtconclusion" class="select" id="rtconclusion">

                                        <option value="9">9</option> 
                                        <option value="8">8</option>
                                    </select></td>
                            </tr>

                            <tr>
                                <td colspan="2"><strong>SIGNATURE TABLE</strong></td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td><select name="sdes" class="select" id="sdes">

                                        <option value="9">9</option> 
                                        <option value="8">8</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><select name="sname" class="select" id="sname">

                                        <option value="9">9</option> 
                                        <option value="8">8</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td><select name="sdate" class="select" id="sdate">

                                        <option value="9">9</option> 
                                        <option value="8">8</option>
                                    </select></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
            <div class="panel panel-footer ">
                <input type="button" class="btn btn-success btn-lg " id="GenCOAFinal" value="GENERATE CERTIFICATE"/>

            </div>

        </div>

    </section>

</div>
<!-- end widget content -->
<?php $this->load->view('coa_engine/coa_final_footer_r1'); ?>
