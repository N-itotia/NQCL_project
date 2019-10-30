<script src="<?php echo base_url(); ?>dashboard_assets/js/jquery-1.10.2.min.js"></script>
<link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/jquery.dataTables.css' ?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url() . 'javascripts/DataTables-1.9.3/media/css/custom-theme/jquery-ui-1.8.23.custom.css' ?>" type="text/css" rel="stylesheet"/>
<script language="JavaScript">
    function drawChart(chartSWF, strXML, chartdiv) {
        //Create another instance of the chart.
        var chart = new FusionCharts(chartSWF, "chart1Id", "1024", "768", "0", "0");
        chart.setDataXML(strXML);
        chart.render(chartdiv);
    }

    function drawChart1(chartSWF, strXML, chartdiv) {
        //Create another instance of the chart.
        var chart = new FusionCharts(chartSWF, "chart1Id1", "450", "350", "0", "0");
        chart.setDataXML(strXML);
        chart.render(chartdiv);
    }


    function singleOut(i) {
        url= '<?php echo base_url()?>/main_dashboard/' + i
        openFancyBox(url, columns)
        console.log(url)
    }

    function updateChart() {
        //call the CI data url
        $.get("<?php echo base_url(); ?>main_dashboard/getSamplesPerClient/" + $('#changeData').val(), function(data) {
            if ($('#changeChart').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div");
            }
        });
    }


    function updateChart2() {
        //call the CI data url
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerClientPerMonth/" + $('#changeDataClient').val() + "/" + $('#changeYear1').val() , function(data) {
            if ($('#changeChart1').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div1");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div1");
            }
        });
    } 

    function updateChartActiveIng() {
        //call the CI data url
        $.get("<?php echo base_url(); ?>main_dashboard/activeIngredientsPerYear/" +  $('#changeYear2').val() , function(data) {
            if ($('#changeChart2').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div2");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div2");
            }
        });
    }

    function updateChartCerts(){
        $.get("<?php echo base_url(); ?>main_dashboard/certsDonePerMonth/" +  $('#changeYear3').val() , function(data) {
            if ($('#changeChart3').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div3");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div3");
            }
        });
    }

    function updateChartCollectedCerts(){
        $.get("<?php echo base_url(); ?>main_dashboard/certsCollectedPerMonth/" +  $('#changeYear4').val() , function(data) {
            if ($('#changeChart4').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div4");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div4");
            }
        });
    }

    function updateChartSamplesPerManufacturer(){
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerManufacturer/" +  $('#changeYear5').val() , function(data) {
            if ($('#changeChart5').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div5");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div5");
            }
        });
    }

    function updateChartSamplesPerCountry(){
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerCountry/" +  $('#changeYear6').val() , function(data) {
            if ($('#changeChart6').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div6");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div6");
            }
        });
    }

    function updateChartSamplesPerTest(){
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerTest/" +  $('#changeYear7').val() , function(data) {
            if ($('#changeChart7').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div7");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div7");
            }
        });
    }


    function updateChartSamplesPerTestPerMonth(){
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerTestPerMonth/" +  $('#changeYear8').val() + "/" + $('#changeMonth8').val()  , function(data) {
            if ($('#changeChart8').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div8");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div8");
            }
        });
    }

    function updateChartSamplesPerUnit(){
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerUnit/" +  $('#changeYear9').val() , function(data) {
            if ($('#changeChart9').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div9");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div9");
            }
        });
    }

    function updateChartSamplesPerUnitPerMonth(){
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerUnitPerMonth/" +  $('#changeYear10').val() + "/" + $('#changeUnit10').val(), function(data) {
            if ($('#changeChart10').val() === '3d') {
                drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div10");
            } else {
                drawChart("<?php echo base_url(); ?>charts/Column2D.swf", data, "chart1div10");
            }
        });
    }




    $(document).ready(function() {
   
        $('#end').prop('disabled', true);
        $('#end').prop('disabled', true);
        $('#filter').prop('disabled', true);
        $('#error').hide();
        //create the chart initially
        $.get("<?php echo base_url(); ?>main_dashboard/getSamplesPerClient/", function(data) {
            drawChart("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div");
        });

        //create the chart initially
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerClientPerMonth/1/2014", function(data) {
            drawChart1("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div1");
        });

        //create
        $.get("<?php echo base_url(); ?>main_dashboard/activeIngredientsPerYear/2014", function(data) {
            drawChart1("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div2");
        });

        //Certs Per Month
        $.get("<?php echo base_url(); ?>main_dashboard/certsDonePerMonth/2014", function(data) {
            drawChart1("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div3");
        });

        //Collected Certs Per Month
        $.get("<?php echo base_url(); ?>main_dashboard/certsCollectedPerMonth/2014", function(data) {
            drawChart1("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div4");
        });

        //Samples Per Manufacturer
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerManufacturer/2014", function(data) {
            drawChart1("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div5");
        });

        //Samples Per Country
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerCountry/2014", function(data) {
            drawChart1("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div6");
        });

        //Samples Per Test
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerTest/2014", function(data) {
            drawChart1("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div7");
        });

        //Samples Per Test Per Month
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerTestPerMonth/2014/January", function(data) {
            drawChart1("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div8");
        });

        //Samples Per Unit 
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerUnit/2014", function(data) {
            drawChart1("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div9");
        });

        //Samples Per Unit 
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerUnit/2014", function(data) {
            drawChart1("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div9");
        });

        //Samples Per Unit Per Month 
        $.get("<?php echo base_url(); ?>main_dashboard/samplesPerUnitPerMonth/2014/January", function(data) {
            drawChart1("<?php echo base_url(); ?>charts/Column3D.swf", data, "chart1div10");
        });

        //update the chart if the dropdown selection changes
        
        //Samples Per Client By Month Div
        $('.samplesPerClientPerYear select').change(function(){
            updateChart();
        })

        //Samples Per Month Per Client Div
        $('.samplesPerClientByMonth select').change(function(){
            updateChart2();
        })

        //Samples Per Month Per Client Div
        $('.activeIngredientsPerMonth select').change(function(){
            updateChartActiveIng();
        })

        //Certs Per Month
        $('.certsDonePerMonth select').change(function(){
            updateChartCerts();
        })

        //Certs Collected Per Month
        $('.certsCollectedPerMonth select').change(function(){
            updateChartCollectedCerts();
        })

        //Samples Per Manufacturer
        $('.samplesPerManufacturer select').change(function(){
            updateChartSamplesPerManufacturer();
        })

        //Samples Per Manufacturer
        $('.samplesPerCountry select').change(function(){
            updateChartSamplesPerCountry();
        })

        //Samples Per Test
        $('.samplesPerTest select').change(function(){
            updateChartSamplesPerTest();
        })

        //Samples Per Test Per Month
        $('.samplesPerTestPerMonth select').change(function(){
            updateChartSamplesPerTestPerMonth();
        })

        //Samples Per Test Per Month
        $('.samplesPerUnit select').change(function(){
            updateChartSamplesPerUnit();
        })

        //Samples Per Test Per Month
        $('.samplesPerUnitPerMonth select').change(function(){
            updateChartSamplesPerUnitPerMonth();
        })

        $('.analyst_sample').click(function() {
            id = $(this).attr('id');
            $.getJSON("<?php echo base_url(); ?>main_dashboard/getAnalsytLabrefs/" + id, function(samples) {
                $data_area = $('#data_area');
                $data_area.empty();

                $.each(samples, function(i, data) {

                    data_holder = "<li><a href='<?php echo base_url(); ?>request_management/assigned_samples/" + data.lab_ref_no + " target=\"_blank\"'>" + data.lab_ref_no + "</a></li>";
                    $data_area.append(data_holder);
                });

            });


            $.fancybox({
                href: "#analyst_samples"
            });
            console.log(id);
        });

    });

    $(document).ready(function() {
        
        $(document).on('click','.show-data',function(){
        id=$(this).attr('id');
        getData(id);
                $("#dialog").dialog({
            autoOpen: false,
            height: 600,
            width: 1100,
            modal: true,
            show: {
                effect: "slide",
                duration: 1000
            },
            hide: {
                effect: "slide",
                duration: 1000
            }
        });
          $("#dialog").dialog("open");
        });



        $("#start").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            changeDay: true
        });

        $("#end").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            maxDate: new Date
        });
        $('#start').change(function() {
            if ($(this).val() !== '') {
                $('#end').prop('disabled', false);
                $('#filter').prop('disabled', false);
            }
        });

        $('#start,#end').change(function() {

            if ($('#start').val() === $('#end').val())
            {
                $('#filter').prop('disabled', true);
                $('#error').slideDown('slow');
                $('#end').val('');
            } else {
                $('#filter').prop('disabled', false);
                $('#error').slideUp('slow');
            }
        });

    });

    




</script>
<style>
    div.dataTables_length  {
        width: 100px;
    }
    div.dataTables_length label {
        display: none;
    }
</style>
<style>

</style>
<div class="row-fluid top_span_info">

    <div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3"> 
        <i class="icon-check blue"></i>
        <span class="title">Samples</span>
        <span class="value"><a href = "#" id="all"><?php echo $all_samples->count; ?></a></span>
    </div>

    <div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
        <i class="icon-check orange"></i>
        <span class="title">Near Expiry</span>
        <span class="value"><a href = "#" id="near_expired" ><?php echo $near_expiry[0]->count; ?><a></span>
    </div>

    <div class="span3 smallstat box mobileHalf noMargin" ontablet="span6" ondesktop="span3">
        <i class="icon-check red"></i>
        <span class="title">Expired Samples</span>
        <span class="value"><a href = "#" id="expired"><?php echo $expired ?></a></span>
    </div>
</div>  
<div class="row-fluid"> 
</div>
<div style="width: 100%; height: 20px;"></div>

<div class="row-fluid">
    <div class="box blue span12 noMargin" ontablet="span12" ondesktop="span12">
        <div class="box-header">
            <h2>Samples Per Client Per Year <?php echo date('Y'); ?></h2>
        </div>
        <div class="box-content" style="float:left">
            <div class = "samplesPerClientPerYear" >
                <select name="changeData" id="changeData">
                    <?php foreach ($years as $every_year): ?>
                        <option value="<?php echo $every_year; ?>" ><?php echo $every_year; ?></option>
                    <?php endforeach; ?>    
                </select>
                <select name="changeChart" id="changeChart">
                    <option value="3d">3D Version</option>
                    <option value="2d">2D Version</option>
                </select><br>
					<a href = "<?php echo base_url().'main_dashboard/client_list' ?>" class = "btn btn-lg btn-success pull-right " ><i class = "icon icon-zoom-in" >View Clients List</i></a>
					<a href = "<?php echo base_url().'main_dashboard/samples_list' ?>" class = "btn btn-lg btn-primary pull-right " ><i class = "icon icon-zoom-in" >View Samples List</i></a>
			   <div id="chart1div" align="left">Loading Data, Please Wait....</div>
            </div>
        </div>
    </div>  

</div>





<script>


    $(document).ready(function() {
        $('.top_span_info a').on("click",function(e) {
            e.preventDefault();
            var columns = new Array();
            id = $(this).attr("id");
            console.log(id);
        
            //Define url and table tr td variables for DataTable       
            var url = '<?php echo site_url()."main_dashboard/getSamplesExpired/"?>' + id 
            var columns = [
                        {"sTitle":"Reference Number", "mData":"request_id"},
                        {"sTitle":"Product", "mData":"product_name"},
                        {"sTitle":"Active Ingredient", "mData":"active_ing"},
                        {"sTitle":"Date of Expiry", "mData":"exp_date"},
                        {"sTitle":"Client", "mData":"name"}
                    ]

                //Call Fancybox
                openFancyBox(url, columns);  

            })

        //openFancyBox
        function openFancyBox(url, columns){
            $.fancybox.open({
                    href:'#details_table',
                    autoSize: false,
                    autoDimensions : false,
                    width:700,
                    height:490,
                    'beforeLoad':function(){
                        getTableData(url, columns);
                    }
                })
            }


        //getTableData
        function getTableData(url, columns){
            if(typeof stable == 'undefined'){
                var stable = $('#stable').dataTable({
                    "bJQueryUI":true,
                    "aoColumns":columns,
                    "bDeferRender":true,
                    "bProcessing":true,
                    "bDestroy":true,
                    "bLengthChange":true,
                    "bStateSave":true,
                    "iDisplayLength":16,
                    "sAjaxDataProp": "",
                    "sAjaxSource": url
                })
            }
            else{
                stable.fnDraw()
            }
        }     

    });
</script>

</div>


