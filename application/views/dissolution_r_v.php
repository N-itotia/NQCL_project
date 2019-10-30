<?php error_reporting(0);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>      
        <script type="text/javascript" href="<?php echo base_url() ?>javascript/jquery.min.js"></script>
        <style type="text/css">
            table{
                border:none;
                width:400px;
                margin:auto;
               // border:2px double #000 ;
            }
            td{
               // border:#000 solid 1px;
            }
            input[type=text]{
                text-align:center;
                margin:auto;
                width: 70px

            }
        
            span.workingweight12{

                margin-right: 100px;
                width: 75px

            }
            input#DM,#workingmgml1,#tcreading,
            #conc,#dmgml1,#dmgml{
                width: 200px;
            }
            select#apparatus{
                width: 150px;
                margin-right: 40px;
            }
            td{
                margin:auto;
                text-align:center;

            }
            td#b{
                border:thin #000;
            }

            div#a{
                text-align:center;
            }
            td#x{
                text-align:right;
            }
            p{
                margin:center;
            }
            div#a table{
                width:330px;
                border:#000000 1px solid;
                margin:auto;
                text-align: center;
            }
            table#we td, th{
              //  border:#000000 1px solid;
                margin:0px;	
            }
            input.dissolution-class, #tcmean[type=text]{
                width:80px;
                height:20px;
                text-align: center;
            }
            p#show,#hide{
                float: left;

            }
            p#show:hover{
                text-decoration: underline;
                font-weight: bold;
                color: blue;

            }
            p#hide:hover{
                text-decoration: underline;
                font-weight: bold;
                color: blue;

            }
            .s1,.s11{
                width: 70px;
            }
            .a,.b,.c{
                display: none;
            }
            .stage2{
                width: 150px;
            }
        

        </style>

    </head>
    <?php   foreach ($diss_conds_conc as $diss_conds)?>
    <script>
        $(document).ready(function() {

//            var nda = 'No Value';
//            $(".s1[value='0']").val(nda);
//            $(".s1[value='1']").val(nda);
//            $(".s1[value='0']").css("color", "white");
//            $(".s1[value='1']").css("color", "white");
//            $(".s1[value='0']").attr("disabled", "disabled");
//            $(".s1[value='1']").attr("disabled", "disabled");
//            $(".s1").attr("readonly", "readonly");
//            $('input[type=text],input[type=number],textarea').attr("readonly", "readonly");

   tcmean=parseFloat($('#tcmean').val());
   $('#tcmean').val(tcmean.toFixed(4));

        });
        $(document).ready(function() {
            loadComponents();
            hide();
            $('#component_name').change(function() {
                component_repeats = $(this).val();
                var assay = $('#component_repeats').empty();

                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>final_submission/dissolution_repeat/<?php echo $labref; ?>/" + component_repeats,
                    dataType: "json",
                    success: function(data) {
                        assay.append("<option value=''>-Select-</option>");
                        $.each(data, function(i, r) {
                            var opt = (r.repeat_status);
                            assay.append("<option value=" + opt + ">" + opt + "</option>");
                        });
                    },
                    error: function() {

                    }
                });

            });

            $('#component_repeats').change(function() {
                component_no = $('#component_name').val();
                component_repeats = $(this).val();
                window.location.href = "<?php echo base_url() . 'dissolution/diss_r/' . $labref . '/' ?>" + component_repeats + "/" + component_no;
            });

            $('.reject').hide();

            $("#Inline").fancybox({
            });
            
            
            
            
                            $('#update').click(function(){
                            $(this).prop('value','Saving Please Wait...');
        data = $('#disseditform').serialize();
       
        
        $.ajax({
  type: "POST",
  url: "<?php echo site_url('dissolution/saveEdit/'.$diss_conds->id);?>/",
  data: data, 
   success: function(){        
    $('#update').prop('value','Done, Update Again..');
            alert('Update Successfull'); 
        // window.location.href = "<?php echo base_url() . 'dissolution/diss_r/' .$labref.'/'.$r.'/'.$component.'/'.$test_id.'/'.$analyst_id;?>";

   },error:function(){
      // alert('An error occured while updating.')
   }
});
        
        
            
       
    });
            
        });



        function loadComponents() {
            var select = $('#component_name').empty();
            // test_name = $('#repeat').attr('class');
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>final_submission/dissolution_components/<?php echo $labref; ?>",
                            dataType: "json",
                            success: function(data) {
                                select.append("<option value=''>-Select-</option>");
                                $.each(data, function(i, r) {

                                    select.append("<option value=" + r.component_no + ">" + r.component + "</option>");
                                });
                            },
                            error: function() {

                            }
                        });

                    }
                    function hide() {
                        approved = "<?php echo $done; ?>";
                        if (approved > 0) {
                            $('.Inline,#Inline').hide();
                        } else {
                            $('.Inline,#Inline').show();
                        }
                    }
                    
        




    </script>

    <body>
        <p>
            <hr>
                <legend><a href="<?php echo site_url() . "supervisors/home/" . $labref . '/'; ?>">&lArr;BACK</a></legend>
        <center><legend>
<?php if ($r > 1) {
    $repeat = $r - 1 ?>
                    <p><center><legend><h2>Dissolution Results: <?php echo $labref; ?>&nbsp;|&nbsp; <?php echo $component_name[0]->component; ?> &nbsp; <?php echo 'Repeat ' . $repeat; ?> &nbsp;|&nbsp;Posted: <?php echo $date_time[0]->date_time; ?>  </h2></legend></center></p>
                <?php } else { ?>
                    <p><center><legend><h2>Dissolution Results: <?php echo $labref; ?>&nbsp;|&nbsp;<?php echo $component_name[0]->component; ?> &nbsp;|&nbsp;Posted: <?php echo $date_time[0]->date_time; ?>  </h2></legend></center></p>
                <?php } ?>
            </legend></center></p>      
        <p></p>

        <select name="component" id="component_name" class="a"></select>

        <p></p>

        <select name="repeats" id="component_repeats" class="b"></select>
        </p>

        <p class="c">Components</p>
        <?php //echo $done; ?>
        <?php echo form_open('dissolution/approve/' . $labref . '/' . $r . '/' . $component, array('id'=>'disseditform')); ?>     
        <p><center><h3><u>1. Tablets/Capsule Weights</u></h3></center></p>       
        <div id="a">


             <?php 
 //var_dump($diss_conds_conc);
           
                
                ?>                

            <table  class="toptable"  width="800px">
                <tr>
<!--                    <td width="33">No</td>-->
<!--                    <td width="62">Wgt(mg)</td>-->
                    <td width="178">&nbsp;</td>
                    <td width="250">Stage 1</td>
                    <td width="126">Stage 2</td>
                </tr>
                <tr>
<!--                    <td>1</td>-->
<!--                    <td><input type="text" name="tc1" id="tc1" class="dissolution-class" required value="<?php echo $diss_tabs[0]->tab_caps_weights; ?>"/></td>-->
                    <td>Dissolution Medium</td>
                    <td>
                        <input type="text" name="DM" placeholder="e.g. HCL" id="DM" required="required" value="<?php echo $diss_conds->dissolution_medium; ?>" />
                    </td>
                    <td>   <input type="text" name="DM2" placeholder="e.g. HCL" value="<?php echo $stage_2[0]->medium; ?>" id="DM2"  class="stage2" />
                    </td>
                </tr>
                <tr>
<!--                    <td>2</td>-->
<!--                    <td><input type="text" name="tc2" id="tc2" class="dissolution-class" required value="<?php echo $diss_tabs[1]->tab_caps_weights; ?>"/></td>-->
                    <td>Volume Used (mL)</td>
                    <td><input type="text" name="R2" placeholder="900" value="<?php echo $diss_conds->volume_used; ?>"  id="R2" required="required" /></td>
                    <td></td>
                </tr>
                <tr>
<!--                    <td>3</td>-->
<!--                    <td><input type="text" name="tc3" id="tc3" class="dissolution-class" readonly value="<?php echo $diss_tabs[2]->tab_caps_weights; ?>"/></td>-->
                    <td>Apparatus</td>
                    <td>
                        <input name="apparatus" value="<?php echo $diss_conds->apparatus; ?>"  id="workingp13" class="s11"  required /></td>
                    <td></td>
                </tr>
                <tr>
<!--                    <td>4</td>-->
<!--                    <td><input type="text" name="tc4" id="tc4" class="dissolution-class" required value="<?php echo $diss_tabs[3]->tab_caps_weights; ?>"/></td>-->
                    <td>RPM (rpm)</td>
                    <td>  <input type="text" name="Rm" value="<?php echo $diss_conds->rotations_per_minute; ?>"  placeholder="e.g 100" value="" id="Rm" required="required" />
                    </td>
                    <td></td>
                </tr>
                <tr>
<!--                    <td>5</td>-->
<!--                    <td><input type="text" name="tc5" id="tc5" class="dissolution-class" required value="<?php echo $diss_tabs[4]->tab_caps_weights; ?>"/></td>-->
                         <td>Time (mins)</td>
                    <td>
                        <input type="text" name="R3" id="first" class="time1" value="<?php echo $diss_conds->time_taken1; ?>" />
                        <input type="text" name="R31" id="second" class="time1" value="<?php echo $diss_conds->time_taken2; ?>" />
                        <input type="text" name="R32" id="third" class="time1" value="<?php echo $diss_conds->time_taken3; ?>" />
                        <input type="text" name="R33" id="fourth" class="time1" value="<?php echo $diss_conds->time_taken4; ?>" />
                        <input type="text" name="R34" id="fifth" class="time1" value="<?php echo $diss_conds->time_taken5; ?>" />
                    </td>
                    
                    <td><input type="text" name="R4" id="textfield14" class="stage2" value="<?php echo $stage_2[0]->time_taken; ?>">
                       </td>
                </tr>
                <tr>
<!--                    <td>6</td>-->
<!--                    <td><input type="text" name="tc6" id="tc6" class="dissolution-class" required value="<?php echo $diss_tabs[5]->tab_caps_weights; ?>"/></td>-->
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
<!--                <tr>

                    <td height="26">Avg</td>
                    <td>
                        <input type="text" name="tcmean" id="tcmean" value="<?php echo $diss_conds->diss_mean; ?>"  />
                    </td>    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>-->

            </table>







        </div>
		
		<center>
                <div class="other_details">
                    <legend> Assay Data Details</legend>
                    <p><em><strong>Please Click the download link Below Select Assay Worksheet</strong></em> </p>
<!--                    <select name="heading" id="activeIngredient" >               
                    </select>-->
                    <br>
                    <p>
                        <a href="#downloadWrksheets?<?php echo date('d-m-y H:i:s');?>" class="Wrksh" id="<?php echo $labref;?>">Download</a> 
                    </p>
                    <!--<p style="width:20px;"></p>
                    <p><em><strong>Please Click the  link Below Select Worksheet to be uploaded!</strong></em> </p>
                    <p>
                        <a href="<?php echo site_url('analyst_uploads/worksheet/'.$labref.'/'.$id);?>">Upload Worksheet</a> 
                    </p>-->
                </div></center>
<!--        <center><h3><u>3. Subsequent Dillution</u></h3></center></p>-->
        <div id="subsequent">
<!--            <table id="assay">


                <tr id="test1">
                    <td>&nbsp;</td>

                    <td>Label Claim (mg)</td>
                    <td><span>Volume Used</span></td>
                    <td><span>Pipette</span></td>
                    <td><span>Vf</span></td>
                    <td><span>Pipette2</span></td>
                    <td><span>Vf2</span></td>
                    <td><span>Pipette3</span></td>
                    <td><span>Vf3</span></td>
                    <td><span>Pipette4</span></td>
                    <td><span>Vf4</span></td>

                    <td><span>Concentration</span></td>

                </tr>


                =======================SUBSEQUENT  DISSOLUTIONS AFTER DISSOLUTIONS===============================	
<?php foreach ($subsequent as $sd)
    ; ?>
                <tr>
                    <td class="workingweight" ><strong>Desired Concetration</strong></td>
                    <td class="labelclaim" ><input type="text" value="<?php echo $sd->label_claim; ?>" name="labelclaim" placeholder="e.g 20mg" value="" id="labelclaim" required /></td>
                    <td class ="vf1" >
                        <input type="text" name="vu" value="<?php echo $sd->volume_used; ?>" placeholder="e.g 20mg" value="" id="vu" readonly />
                    </td>
                    <td class="workingp1" >
                        <input name="workingp1" value="<?php echo $sd->pipette; ?>" id="workingp13" class="s1"  required />
                    </td>
                    <td class="workingv1">
                        <input name="workingv"value="<?php echo $sd->volume; ?>"  id="workingp13" class="s1"  required />
                    </td>
                    <td class="workingp1" >
                        <input name="workingp2" value="<?php echo $sd->pipette2; ?>" id="workingp13" class="s1"  required />
                    </td>
                    <td class="workingv1">
                        <input name="workingv2"value="<?php echo $sd->volume2; ?>"  id="workingp13" class="s1"  required />
                    </td>
                    <td class="workingp1" >
                        <input name="workingp3" value="<?php echo $sd->pipette3; ?>" id="workingp13" class="s1"  required />
                    </td>
                    <td class="workingv1">
                        <input name="workingv3"value="<?php echo $sd->volume3; ?>"  id="workingp13" class="s1"  required />
                    </td>
                    <td class="workingp1" >
                        <input name="workingp4" value="<?php echo $sd->pipette4; ?>" id="workingp13" class="s1"  required />
                    </td>
                    <td class="workingv1">
                        <input name="workingv4"value="<?php echo $sd->volume4; ?>"  id="workingp13" class="s1"  required />
                    </td>
                    <td class="conc" ><input type="text" value="<?php echo $sd->concetration; ?>" name="conc" placeholder="e.g 20mg" value="" id="conc" readonly /></td>                   
                </tr>
            </table>
        </div>-->
        <p></p>
<!--        <div id="sample"> 
            <p><center><h3><u>4. Standard Preparation for Dissolution</u></h3></center></p>
            <table id="assay">               
                <tr>
                    <td rowspan="2">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2">
                    </td>
                    <td colspan="2">
                    </td>
                    <td colspan="2">
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr id="test">
                    <td><span>Weight</span></td>
                    <td><span>Vf1</span></td>
                    <td><span>Pipette</span></td>
                    <td><span>Vf2</span></td>
                    <td><span>Pipette2</span></td>
                    <td><span>Vf3</span></td>
                    <td><span>Pipette3</span></td>
                    <td><span>Vf4</span></td>
                    <td><span>Concentration</span></td>

                </tr>


                ========================SAMPLE PREPARATION FOR DISSOLUTIONS==============================	

                <tr>
                    <td class="workingweight" ><strong>Desired Weight</strong></td>
                    <td class="workingweight" ><input type="text" value="<?php echo $diss_std_prep[0]->weight; ?>" name="workingweight" placeholder="e.g 20mg" value="" id="workingweight" readonly/></td>

                    <td class="workingvf1" >                          
                        <input name="workingvf1" value="<?php echo $diss_std_prep[0]->vf1; ?>"  id="workingvf1" required class="s1"/>

                    </td>


                    <td class="workingpipette1" >
                        <input name="workingp11" value="<?php echo $diss_std_prep[0]->pipette1; ?>" id="workingp11"  required  class="s1"/>

                    </td>
                    <td class="workingvf2">
                        <input name="workingvf2" value="<?php echo $diss_std_prep[0]->vf2; ?>"id="workingp11"  required  class="s1"/>
                    </td>
                    <td class="workingpipette2" >
                        <input name="workingvp12" value="<?php echo $diss_std_prep[0]->pipette2; ?>" id="workingp11"  required  class="s1"/>
                    </td>
                    <td class="workingvf3">
                        <input name="workingvf3" value="<?php echo $diss_std_prep[0]->vf3; ?>" id="workingp11"  required  class="s1"/>
                    </td>

                    <td class="workingpipette2" >
                        <input name="workingp13" value="<?php echo $diss_std_prep[0]->pipette3; ?>" id="workingp13" class="s1"  required />


                    </td>
                    <td class="workingvf4">
                        <input name="workingvf4" value="<?php echo $diss_std_prep[0]->vf4; ?>" id="workingp11"  required  class="s1"/>
                    </td>

                    <td class="mgml11"><input type="text" value="<?php echo $diss_std_prep[0]->concetration; ?>" name="workingmgml" placeholder="e.g 0.04mg/ml" id ="workingmgml1" readonly  /></td>
                </tr>


                --================================================================================================================


                <tr>
                    <td colspan="8" class="weight" width="10" >&nbsp;</td>
                </tr>
                <tr>

                    <td ><strong>Standard A</strong></td>
                    <td><input type="text" value="<?php echo $diss_std_prep[1]->weight; ?>" name="u_weightA"  id="number"  value="<?php //echo $assayweight['0']->weight;     ?>" class="stdabc"/></td>
                    <td >
                        <input type="text" value="<?php echo $diss_std_prep[1]->vf1; ?>" name="v11" id="v11" readonly/>
                    </td>
                    <td >
                        <input type="text" value="<?php echo $diss_std_prep[1]->pipette1; ?>" name="standardp1" id="standardp1"  class="s1" readonly/>

                    </td>
                    <td>
                        <input type="text" value="<?php echo $diss_std_prep[1]->vf2; ?>" name="standardvf" id="standardvf" class="s1" readonly/>

                    </td>
                    <td >
                        <input type="text" value="<?php echo $diss_std_prep[1]->pipette2; ?>" name="p20" id="p20" class="s1" readonly/>

                    </td>
                    <td>
                        <input type="text" value="<?php echo $diss_std_prep[1]->vf3; ?>" name="vf3" id="vf3"  class="s1"readonly/>

                    </td>

                    <td>
                        <input type="text" name="p211" value="<?php echo $diss_std_prep[1]->pipette3; ?>" id="p211"  class="s1" readonly/>

                    </td>
                    <td>
                        <input type="text" value="<?php echo $diss_std_prep[1]->vf4; ?>" name="vf4" id="vf4"  class="s1" readonly/>

                    </td>

                    <td><input type="text" value="<?php echo $diss_std_prep[1]->concetration; ?>" name="dmgml" placeholder="e.g 0.04mg/ml" id ="dmgml" value="" required readonly /></td>
                </tr>

                <tr>
                    <td class="weight" ><strong>Standard B</strong></td>
                    <td class="weight" ><input type="text" name="u_weightB" value="<?php echo $diss_std_prep[2]->weight; ?>" id ="number1" class="stdabc" /></td>
                    <td class ="vf111" ><input type="text"  id="v2" value="<?php echo $diss_std_prep[2]->vf1; ?>" name="v2" size="15"/></td>
                    <td class="pipette11111" ><input type="text" id="standardp2" value="<?php echo $diss_std_prep[2]->pipette1; ?>" name="standardp2" class="s1" size="15" readonly/></td>
                    <td class="vf22222">
                        <input type="text" required id="standardvf1" value="<?php echo $diss_std_prep[2]->vf2; ?>" name="standardvf1" class="s1" size="15" readonly/> 
                    </td>

                    <td class="pipette21" >
                        <input type="text" id="p21" value="<?php echo $diss_std_prep[2]->pipette2; ?>" name="p21" size="15"  class="s1"readonly/> 
                    </td>
                    <td class="vf23">
                        <input type="text" required value="<?php echo $diss_std_prep[2]->vf3; ?>" id="vf23" name="vf23" size="15" class="s1" readonly/> 
                    </td>

                    <td class="pipette21" >
                        <input type="text" value="<?php echo $diss_std_prep[2]->pipette3; ?>" id="p22" name="p22" size="15" class="s1" readonly/> 
                    </td>
                    <td class="vf23">
                        <input type="text" value="<?php echo $diss_std_prep[2]->vf4; ?>" required id="vf24" name="vf24" size="15" class="s1" readonly/> 
                    </td>

                    <td class="mgml1"><input type="text" value="<?php echo $diss_std_prep[2]->concetration; ?>" name="dmgml1" placeholder="e.g 0.04mg/ml" value="" id="dmgml1" required readonly /></td>
                </tr>



            </table>
        </div>-->

        <center>     
            <p><input type="button" id="update" value="Update"/><input type="submit" value="Approve" style="background-color: #33ff33;color: #ffffff; " class="Inline"/>&nbsp;&nbsp;<a href="<?php echo site_url('supervisors/reject_test/'.$labref.'/'.$test_id.'/'.$analyst_id.'/'.$test_name);?>" id="Inline1" style="background-color: #F00; color: #ffffff;">Reject</a></p>
</center>
<hr></hr>

        </form>
        <div class="reject">
            <div id="rejectSample">
<?php $this->load->view('compose_v_1'); ?>
            </div>
        </div>


<div id="tests" class="hidden2">
    <style type="text/css">
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
        	#the_worksheettable{
		width:100%; 
		border-collapse:collapse; 
	}
	#the_worksheettable td{ 
		padding:7px; border:#4e95f4 1px solid;
	}
	/* Define the default color for all the table rows */
	#the_worksheettable tr{
		background: #b8d1f3;
	}
	/* Define the hover highlight color for the table row */
    #the_worksheettable tr:hover {
          background-color: #ffff99;
    }
    </style>
    <form id="sheet_gen">
        <table class="tg" id="the_worksheettable">
            <tr>
                <th class="tg-031e">ID</th>
                <th class="tg-031e">TEST NAME</th>
                <th class="tg-031e">TEST NAME / MOLECULE</th>
                 <th class="tg-031e">SELECTOR</th>
            </tr>
            <tbody>
            <?php
            $i = 1;
         
            foreach ($T as $t):
                foreach ($mole as $cule):
                ?>
                <tr>
                    <td class="tg-031e"><?php echo $i; ?></td>
                    <td class="tg-ugh9"><?php echo $t->name; ?><input type="hidden" name="test_id[]" value="<?php echo $t->test_id;?>"/></td>
                    <td><select name="molecule[]" id="" class="selectbox_1"> 
                                    <option value="">-Select-</option>
<!--                                   <option value="Uniformity">Uniformity</option>
                                    <option value="Relative Density">Relative Density</option>-->
                                     <option value="<?php echo $cule->name;?>"><?php echo $cule->name;?></option>
                                  
                        </select></td>
                    <td class="tg-031e"><input type="checkbox" value="<?php echo $t->alias; ?>"name="test_names[]" class="checkbox_1"/></td>
                   
                </tr>
                <?php
                endforeach;
                $i++;
            endforeach;
            ?>
            </tbody>
            <tfoot>
            <tr>
                <input type="hidden" id="the_labref"/>
                <td colspan="3">
                    <input type="button" id="generator" value="Generate & Download Worksheets"/>
                    <input type="button" id="resetgenerator" value="Reset"/>
                </td>
            </tr>
            </tfoot>
        </table>
    </form>
</div>
		
    </body>

</html>

</html>
