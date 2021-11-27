var mongo_ajax;

jQuery(document).ready(function() {
	
	$.validate({ 	
		language : jsLanguageValidator,
	    form : '#frm_paymongo',    
	    onError : function() {      
	    },
	    onSuccess : function() {     
	      var params=$("#frm_paymongo").serialize();	    
	      paymongoSendRequest(ajax_action, params) ;
	      return false;	      	     
	    }  
	});
	
	if ( $(".paymongo_webhook").exists() ){
		//paymongoSendRequest(mongo_action,'');
	}
	
	$( document ).on( "click", ".mongo_remove_webhook", function() {
		var a=confirm("Remove webhooks?");    
        if (a){
           paymongoSendRequest('paymongo_remove_webhook','');
        }
	});
	
});
/*end docu*/

paymongoSendRequest = function(action, params , buttons){
	
	params+= addValidationRequest();
	
	mongo_ajax = $.ajax({    
    type: "POST",
    url: front_ajax+"/"+action,
    data: params,
    timeout: 20000,
    dataType: 'json',       
    beforeSend: function() {	 	
	 	if(mongo_ajax != null) {
	 	   mongo_ajax.abort();	 	   
	 	   busy(false);
	       showPreloader(false);
	 	} else {
	 	   busy(true);
	       showPreloader(true);
	 	}
	},
	complete: function(data) {					
		mongo_ajax = (function () { return; })();		
	},
    success: function(data){     
    	dump(data);
    	if(data.code ==1){
    		next_action='';
    		if ((typeof  data.details !== "undefined") && ( data.details !== null)) {
    			next_action = data.details.next_action;
    		}    		
    		switch (next_action){
    			case "redirect":
    			  window.location.href = data.details.link;
    			break;
    			
    			case "display_webhook":    	
    			  $(".paymongo_webhook").html( '<a href="javascript:;" class="mongo_remove_webhook">'+data.details.webhook_url+'</a>' );
    			break;
    			
    			default:
    			 busy(false);
                 showPreloader(false);
    			break;
    		}
    	} else {
    		busy(false);
            showPreloader(false);
    		uk_msg(data.msg);
    	}
    }, 
    error: function(){	        	    	
    	busy(false); 
    	showPreloader(false);
    	if (!empty(buttons)){
    		buttons.html(buttons_text);
		    buttons.css({ 'pointer-events' : 'auto' });
    	}
    }		
    });   	     	  	
};