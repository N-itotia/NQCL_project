$(function(){
 $('#product_name').focusout(function(){
               data = $(this).val();
                       $.post(base_url+'audit/getAuditData/'+labref+'/product_name/product_name',{product_name:data}, function(response){
                          // alert(response);
                       });
                   });
                       
              $('#label_claim').focusout(function(){
               data = $(this).val();
                       $.post(base_url+'audit/getAuditData/'+labref+'/label_claim/label_claim',{label_claim:data}, function(response){
                           //alert(response);
                       });
            });
              $('#date_received').focusout(function(){
               data = $(this).val();
                       $.post(base_url+'audit/getAuditData/'+labref+'/designation_date/designation_date',{designation_date:data}, function(response){
                           //alert(response);
                       });
            });
            
              $('#presentation').focusout(function(){
               data = $(this).val();
                       $.post(base_url+'audit/getAuditData/'+labref+'/presentation/presentation',{presentation:data}, function(response){
                          // alert(response);
                       });
            });
              $('#batch_no').focusout(function(){
               data = $(this).val();
                       $.post(base_url+'audit/getAuditData/'+labref+'/batch_no/batch_no',{batch_no:data}, function(response){
                           //alert(response);
                       });
            });
             $('#manufacturer').focusout(function(){
               data = $(this).val();
                       $.post(base_url+'audit/getAuditData/'+labref+'/manufacturer_name/manufacturer_name',{manufacturer_name:data}, function(response){
                           //alert(response);
                       });
            });
             $('#mnfg_date').focusout(function(){
               data = $(this).val();
                       $.post(base_url+'audit/getAuditData/'+labref+'/manufacture_date/manufacture_date',{manufacture_date:data}, function(response){
                          // alert(response);
                       });
            });
             $('#addre').focusout(function(){
               data = $(this).val();
                       $.post(base_url+'audit/getAuditData/'+labref+'/manufacturer_add/manufacturer_add',{manufacturer_add:data}, function(response){
                         //  alert(response);
                       });
            });
             $('#exp_date').focusout(function(){
               data = $(this).val();
                       $.post(base_url+'audit/getAuditData/'+labref+'/exp_date/exp_date',{exp_date:data}, function(response){
                        //   alert(response);
                       });
            });
            
             $('#client_ref').focusout(function(){
               data = $(this).val();
                       $.post(base_url+'audit/getAuditData/'+labref+'/clientsampleref/clientsampleref',{clientsampleref:data}, function(response){
                        //   alert(response);
                       });
            });
            
        $(document).on('focusout','.result_table tbody tr',function(){
                var data="";
              test_id =$('.test_id',this).val();
              $('.methods',this).each(function(i, val){
                  data+=val.value+":";
                  });
                  methods=data.substring(0, data.length - 1);
                  
                   $.post(base_url+'audit/getAuditDataBottom/'+labref+'/'+test_id+'/method/method',{method:methods}, function(response){
                           console.log(response);
                       });
            });
            
             $(document).on('focusout','.result_table tbody tr',function(){
                var data="";
              test_id =$('.test_id',this).val();
              $('.compendia',this).each(function(i, val){
                  data+=val.value+":";
                  });
                  compedias=data.substring(0, data.length - 1);
                  console.log(compedias)
                  
                   $.post(base_url+'audit/getAuditDataBottom/'+labref+'/'+test_id+'/compedia/compedia',{compedia:compedias}, function(response){
                           console.log(response);
                       });
            });
        
            
          
           $(document).on('focusout','.result_table tbody tr',function(){
                var data="";
              test_id =$('.test_id',this).val();
              $('.specification',this).each(function(i, val){
                  data+=val.value+":";
                  });
                  specifications=data.substring(0, data.length - 1);
                  
                   $.post(base_url+'audit/getAuditDataBottom/'+labref+'/'+test_id+'/specification/specification',{specification:specifications}, function(response){
                           console.log(response);
                       });
            });
   
          
            
           $(document).on('focusout','.result_table tbody tr',function(){
                var data="";
              test_id =$('.test_id',this).val();
              $('.determined',this).each(function(i, val){
                  data+=val.value+":";
                  });
                  determineds=data.substring(0, data.length - 1);
                  
                   $.post(base_url+'audit/getAuditDataBottom/'+labref+'/'+test_id+'/determined/determined',{determined:determineds}, function(response){
                           console.log(response);
                       });
            });
            
            
            });
         