<style>
    #top{
        background:#00CC33;
        color: white;
        text-align: center;
        font-weight: bolder;
        width: 100%;
        height: 50px;
        line-height: 50px;
        border-radius: 5px;
    }
    #cont{
        width: 100%;
        height: 300px;
        background: #00CC33;
        padding: 8px;
        border-radius: 10px;
    }
    #inst{
        width: 50%;
        padding: 10px;
        position: absolute;
    }
    #uploader{
        position: absolute;
        margin-left: 750px;
        width: 540px;
        height: 300px;
        background: white;
        border-radius: 10px;
    }
    hr{
        background: white;
    }
    label{
        display: block;
    }
    #up_form{
        margin: 0 auto 0 auto;
        margin-left: 150px;
    }
    input[type=text]{
        width: 250px;
    }
    #exists{
        width: 100%;
        height: 30px;
        background: #0063dc;
        color: white;
        font-weight: bolder;
    }
    #error{
        width: 100%;
        height: 30px;
        background: red;
        color: white;
        font-weight: bolder;
    }
    #success{
        width: 100%;
        height: 30px;
        background: #00ff00;
        color: black;
        font-weight: bolder;
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

<p>
<p><strong><center><?php echo strtoupper(str_replace('%20', ' ', $this->uri->segment(5))) ?> REDOWNLOAD</center></strong></p><hr>
<hr>




<div id="worksheet" style="  height: auto;">
    <form action="#" method="POST">
        <table id = "sheets_table">

            <tbody>
                <tr>
                    <td>
                        <select name="labref" id="Labref" class="select2" required>
                            <option value="">-Select Labref-</option>
                            <?php foreach ($sheets as $sheet): ?>                  
                                <option value="<?php echo $sheet->lab_ref_no; ?>"><?php echo $sheet->lab_ref_no; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea class="DREASON" name="mreason" style="height:50px;" placeholder="Enter test and reason e.g. pH:Wrong Calculations noticed" title="e.g. pH:Wrong Calculations noticed"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="DOWN" type="text" maxlength="20" id='reason' name="reason" placeholder="Give Short reason" required title="Please Say why you are redownloading e.g. 'Wrong Calculation','Sheet Damaged' "/>
                    </td>                
                </tr>
                <tr>
                    <td>
                        <input class="DOWN" type="button" value="Download" id="DOWNLOAD"/>
                        <input class="REQ" type="button" value="Request Download Permission" id="RECDOWNLOAD"/>
                    </td>                
                </tr>
            </tbody>
        </table>
    </form>
</div>
<script>
    $(document).ready(function () {
        base_url = "<?php echo base_url(); ?>";
        segments = "<?php echo $this->uri->segment(3) . '/' . $this->uri->segment(4); ?>";
        $('.DOWN,.REQ,.DREASON').hide();

        $('#Labref').change(function () {
            lab = $(this).val();
            $.getJSON(base_url + "supervisors/getPermissionData/" + lab, function (data) {
                if (data.length === 0) {
                    alert("No Request Sent");
                    $('.REQ,.DREASON').show();
                     $('.DOWN').hide();
                } else if (data[0].status === '0') {
                    alert("Request Awaiting Action");
                     $('.DOWN,.REQ,.DREASON').hide();
                } else if (data[0].status === '1') {
                    alert("Request Approved Download Worksheet");
                    $('.DOWN,.REQ,.DREASON').hide();
                     $('.DOWN').show();
                } else if (data[0].status === '2') {
                    alert("Permission Denied See Your Supervisor");
                     $('.DOWN,.REQ,.DREASON').hide();
                    
                }else{
                    alert("Invalid Request");
                     $('.DOWN,.REQ,.DREASON').hide();
                }
            });
        });
        
        
             $('.REQ').click(function () {
                 $(this).prop('disabled',true);
            lab = $("#Labref").val();
            reas = $('.DREASON').val();
            if (lab === '' || reas === '') {
                alert('Error:  TEST & REASON cannot be left blank. Please fill fields to continue');
            } else {
                $.post(base_url + 'analyst_controller/post_request/' + lab, {mreason: reas}, function () {
                    alert("INFO:SUCCESSFUL - Request for redownload submitted to supervisor. Wait for approval to redownload the worksheet");
                     window.location.href = base_url + "analyst_controller/";
                });
            }
        });



        $('#DOWNLOAD').click(function () {
            lab = $("#Labref").val();
            reas = $('#reason').val();
            if (lab === '' || reas === '') {
                alert('Error: LABREF or REASON cannot be left blank. Please fill fields to continue');
            } else {
                $.post(base_url + 'analyst_controller/singlesheet_stamp_custom/' + segments, {labref: lab, reason: reas}, function () {
                    window.location.href = base_url + "single_sheets/" + lab + '.pdf';
                });
            }
        });

    });
</script>

