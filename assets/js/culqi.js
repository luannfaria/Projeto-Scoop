var $form = ".frm_culqi";

jQuery(document).ready(function() {
		
	Culqi.publicKey = culgi_public_key;
	
	Culqi.settings({
	    title: stripslashes(merchant_name) ,
	    currency: currency_code,
	    description: stripslashes(payment_description),
	    amount: amount_to_pay
    });
	 
      
   $( document ).on( "click", $form + " button", function(e) {   	     	  
   	  $($form+" .api_message").html(''); 
   	  Culqi.open();
      e.preventDefault();
   });
	    
    
});
/*end ready*/

function stripslashes (str) {
    return (str + '').replace(/\\(.?)/g, function (s, n1) {
    switch (n1) {
    case '\\':
      return '\\';
    case '0':
      return '\u0000';
    case '':
      return '';
    default:
      return n1;
    }
  });	
}


function culqi() {
  showPreloader(true);
  $($form+" button").prop('disabled', true);  
  if (Culqi.token) { // ¡Objeto Token creado exitosamente!
      var token = Culqi.token.id;      
      $($form+" #reference_id").after($('<input type="hidden" id="card_token" name="card_token" />').val(token));    
      uk_msg_sucess("Please don't close the window wait until we redirect you");
	  $($form).submit();
  } else {
  	  showPreloader(false);
  	  $($form+" button").prop('disabled', false);  
      $err_html = '<div class="has-error">';
	  $err_html+= '<span class="help-block form-error">'+ Culqi.error.user_message +'</span>';
	  $err_html+= '</div>';
	
	  $($form+" .api_message").html($err_html, false); 
	  $($form+" button").prop('disabled', false);     
  }
};
