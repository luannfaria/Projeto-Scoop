var iwomipay_ajax ;

function iwomipay_init()
{
	iwomipay_GetPaymentStatus();
}

function iwomipay_GetPaymentStatus()
{
	data = "reference_id="+ reference_id;
	data+= "&payment_type="+ payment_type;
	if ((typeof  renew !== "undefined") && ( renew !== null)) {
	data+= "&renew="+renew;
	}
	if ((typeof  package_id !== "undefined") && ( package_id !== null)) {
	data+= "&package_id="+package_id;
	}
	data+= addValidationRequest();	
	
	iwomipay_ajax = $.ajax({
	  url: front_ajax+"/iwomipay_getstatus",
	  method: "POST",
	  data: data ,
	  dataType: "json",
	  timeout: 20000,
	  crossDomain: true,
	  beforeSend: function( xhr ) {   
	  	 if ((typeof silent !== "undefined") && (silent !== null)) {	  	    
	  	 } else {
	  	 	if ((typeof  loader_object !== "undefined") && ( loader_object !== null)) {	  	 		
	  	 		//loader_object.find("i").removeClass("fas fa-cloud-download-alt").addClass("fas fa-spinner fa-spin");
	  	 	} else {
	  	 	   //busy(true);	
	  	 	}
	  	 }
         if(iwomipay_ajax != null) {	
         	dump("request aborted");     
         	iwomipay_ajax.abort();            
         } else {         	
         	setTimeout(function() {				
				iwomipay_ajax.abort();
				uk_msg( "Request taking lot of time. Please try again" );
	        }, 20000); 
         }
      }
    });
    
    iwomipay_ajax.done(function( data ) {
    	
    	 dump('done');	
	     var next_action='';     
	     
	     if ((typeof  data.details !== "undefined") && ( data.details !== null)) {
	     	if ((typeof  data.details.next_action !== "undefined") && ( data.details.next_action !== null)) {
	     	   next_action = data.details.next_action;
	     	}
	     }
	     
	     dump("next_action=>"+next_action);
	     
	     switch (next_action){
	     	case "receipt":
	     	  window.location.href = data.details.redirect_url;
	     	break;
	     	
	     	case "stop_fetch":
	     	  uk_msg( data.msg );
	     	  $(".iwomipay_loader").hide();
	     	  $(".iwomipay_result").html( data.msg );
	     	break;
	     	
	     	case "continue_fetch":
	     	  $(".iwomipay_result").html( data.msg );
	     	  setTimeout( function(){ 
				  iwomipay_init();
			  }, 20000 ); 			   
	     	break;
	     }
    });
    
    /*ALWAYS*/
    iwomipay_ajax.always(function() {    	
    	if ((typeof  loader_object !== "undefined") && ( loader_object !== null)) {
    		//loader_object.find("i").removeClass("fas fa-spinner fa-spin").addClass("fas fa-cloud-download-alt");
    	} else {
    	    //busy(false);	
    	}
        dump("ajax always");
        iwomipay_ajax=null;          
    });
    
    /*FAIL*/
    iwomipay_ajax.fail(function( jqXHR, textStatus ) {    	    	
        uk_msg( textStatus );
    });  
    
}