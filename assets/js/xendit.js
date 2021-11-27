
var $form = ".frm_xendit";

jQuery(document).ready(function() {
	
	$.validate({ 	
		language : jsLanguageValidator,
	    form : '#frm_xendit',    
	    onError : function() {      
	    },
	    onSuccess : function() {     
	    	
	      if ( $("#xendit_card_token").exists()){
	      	 showPreloader(true);	      	 
	      	 return true;
	      }
	    	
	      $validated = true;
	      	      
	      showPreloader(true);
	      	      	      	     
	      $($form+" button").prop('disabled', true);  
	      
	      $card_number = $($form+" #card_number").val();	      
	      $expiration_month = $($form+" #expiration_month").val();
	      $expiration_yr = $($form+" #expiration_yr").val();
	      $cvv = $($form+" #cvv").val();
	      
	      $($form+" .form-error").remove();
	      
	      if(!Xendit.card.validateCardNumber( $card_number )){
	      	  $($form+" #card_number").after("<span class=\"help-block form-error\" style=\"color:#a94442\">Invalid credit card</span>");
	      	  $validated = false;
	      } 
	      	      
	      if(!Xendit.card.validateCvn( $cvv )){	      	  
	      	  $($form+" #expiration_month").after("<span class=\"help-block form-error\" style=\"color:#a94442\">Invalid security code</span>");
	      	  $validated = false;
	      } 
	      	      
	      if(!Xendit.card.validateExpiry( $expiration_month , $expiration_yr  )){	      	  
	      	  $($form+" #cvv").after("<span class=\"help-block form-error\" style=\"color:#a94442\">Invalid expiration</span>");
	      	  $validated = false;
	      } 
	      
	      
	      if($validated){	      	 
	      	 Xendit.card.createToken({        
				amount: amount_to_pay,     
				card_number: $card_number,
				card_exp_month: $expiration_month,
				card_exp_year: $expiration_yr,
				card_cvn: $cvv,
				is_multiple_use: false ,
				currency : currency_code
			}, xenditResponseHandler);   
	      } else {
	      	 $($form+" button").prop('disabled', false);  
	      	 showPreloader(false);
	      }	      	      	      	     
	      return false;	      	     
	      
	    }  
	});
	
});
/*end docu*/

function xenditResponseHandler (err, creditCardCharge) {
		
	
	if (err) {        		
		showPreloader(false);
		$err_html = '<div class="has-error">';
		$err_html+= '<span class="help-block form-error">'+ err.message +'</span>';
		$err_html+= '</div>';
				
		$($form+" .api_message").html($err_html, false); 
		$($form+" button").prop('disabled', false);                 
		return;        
	}      		
	
	dump(creditCardCharge);
	
	if (creditCardCharge.status === 'APPROVED' || creditCardCharge.status === 'VERIFIED') {		
		var token = creditCardCharge.id; 	
		var authentication_id = creditCardCharge.authentication_id;
				
		$($form+" #reference_id").after($('<input type="hidden" id="xendit_card_token" name="xendit_card_token" />').val(token)); 
		$($form+" #reference_id").after($('<input type="hidden" id="authentication_id" name="authentication_id" />').val(authentication_id)); 
		
		$('#three-ds-container').hide();
        $('.overlay').hide();
        				
        dump("submit the form");
        uk_msg_sucess("Please don't close the window wait until we redirect you");
		$($form).submit();
		
	} else if (creditCardCharge.status === 'IN_REVIEW') {		
		showPreloader(false);
		 window.open(creditCardCharge.payer_authentication_url, 'sample-inline-frame');
         $('.overlay').show();
         $('#three-ds-container').show();
	} else if (creditCardCharge.status === 'FAILED') {
		
		showPreloader(false);
		$err_html = '<div class="has-error">';
		$err_html+= '<span class="help-block form-error">'+ creditCardCharge.failure_reason +'</span>';
		$err_html+= '</div>';
		
		$($form+" .api_message").html($err_html, false); 
		$($form+" button").prop('disabled', false);     
		
		setTimeout(function(){ 
			$('#three-ds-container').hide();
            $('.overlay').hide();
		}, 1000);
		            
	}
		
}