<div id="sidebar-left" class="span2">

    <div class="row-fluid actions">

        <input type="text" class="search span12" placeholder="..." />

    </div>	


    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li><a href="<?php echo base_url(); ?>"><i class="icon-arrow-left"></i><span class="hidden-tablet">BACK</span></a></li>	

          <?php if($this->uri->segment(3)=='HOD'){?>
		  
            <li>
                <a class="dropmenu"  style="background: white; color:black;"  href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> HOD</span> <span class="label">3</span></a>
                <ul>
                    <li><a class="submenu" href="<?php echo base_url(); ?>main_dashboard/standards/HOD"><i class="icon-eye-open"></i><span class="hidden-tablet"> Standards Dashboard</span></a></li>
                    <li><a class="submenu" href="<?php echo base_url(); ?>main_dashboard/columns/HOD"><i class="icon-dashboard"></i><span class="hidden-tablet"> Columns Dashboard</span></a></li>
					<li><a class="submenu"  href="<?php echo base_url(); ?>main_dashboard/equipment/HOD"><i class="icon-edit"></i><span class="hidden-tablet"> Equipment</span></a></li>	
					<li><a class="submenu"  target="_blank" href="<?php echo base_url(); ?>report_engine/analyst_report_hod/HOD"><i class="icon-edit"></i><span class="hidden-tablet"> Analyst Report</span></a></li>	
               </ul>	
            </li>
		  <?php }else if($this->uri->segment(2)=='Docum'){?>
		  
            <li>
                <a class="dropmenu"  style="background: white; color:black;"  href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Menu 1</span> <span class="label">3</span></a>
                <ul>
                    <li><a class="submenu" href="<?php echo base_url(); ?>main_dashboard/documentation"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Documentation Dashboard</span></a></li>	
               </ul>	
            </li>
		  
		  <?php }else{ ?>
		     <li>
                <a class="dropmenu"  style="background: white; color:black;"  href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Director</span> <span class="label">3</span></a>
                <ul>
                    <li><a class="submenu" href="<?php echo base_url(); ?>main_dashboard/samples"><i class="icon-bar-chart"></i><span class="hidden-tablet">Samples</span></a></li>	
                    <li><a class="submenu" href="<?php echo base_url(); ?>main_dashboard/clients_report"><i class="icon-bar-chart"></i><span class="hidden-tablet">Samples/Clients Report</span></a></li>	
                    <li><a class="submenu" href="<?php echo base_url(); ?>main_dashboard/clients"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Clients Dashboard</span></a></li>  
                    <li><a class="submenu" href="#"><i class="icon-hdd"></i><span class="hidden-tablet"> Finance Dashboard</span></a></li>

              

                </ul>	
            </li>

		  
		  <?php };?>
         
			
			</ul>
    </div>


</div>