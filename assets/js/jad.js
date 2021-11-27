
JadCardNonce = function()
{
	params = 'reference_id=' + reference_id;
	params+= '&payment_type=' + payment_type;
	params+= addValidationRequest();	
	call_ajax_handle = $.ajax({    
    type: "POST",
    url: front_ajax+"/jad_card_nonce",
    data: params,
    timeout: 20000,
    dataType: 'json',       
    beforeSend: function() {	 	
	 	if(call_ajax_handle != null) {
	 	   call_ajax_handle.abort();	 	   
	 	   busy(false);
	       showPreloader(false);
	 	} else {
	 	   busy(true);
	       showPreloader(true);
	 	}
	},
	complete: function(data) {			
		call_ajax_handle= (function () { return; })();		
		busy(false);
	    showPreloader(false);
	},
    success: function(data){       	
    	if(data.code==1){    		
    		switch(data.details.next_action){
    			case "set_nonce":
    			  $("#nonce").val(  data.details.nonce );
    			break;
    		}
    	} else {
    		uk_msg(data.msg);
    	}
    }, 
    error: function(){	        	    	
    	busy(false); 
    	showPreloader(false);    	
    }		
    });   	    	
};