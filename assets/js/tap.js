
jQuery(document).ready(function() {
 		    
    try {
	  initTap();
    } catch(err) {
	   tap_message(err.message);
	   $("form button").attr("disabled",true);
	}
	
});
/*end doc ready*/


initTap = function(){
	
    var tap = Tapjsli(tap_public_key);
	var elements = tap.elements({});
	
	var style = {
	  base: {
	    color: '#535353',
	    lineHeight: '18px',
	    fontFamily: 'sans-serif',
	    fontSmoothing: 'antialiased',
	    fontSize: '16px',
	    '::placeholder': {
	      color: 'rgba(0, 0, 0, 0.26)',
	      fontSize:'15px'
	    }
	  },
	  invalid: {
	    color: 'red'
	  }
	};
	
	tap_label = JSON.parse(tap_label);
	currency_code = JSON.parse(currency_code);
	  
	//payment options
	var paymentOptions = {	  
	  currencyCode:currency_code,
	  labels : tap_label,
	  TextDirection: tap_text_direction
	}
	
	var card = elements.create('card', {style: style},paymentOptions);
	card.mount('#element-container');
	
	card.addEventListener('change', function(event) {
	  if(event.BIN){
         //console.log(event.BIN);
      }
	  if(event.loaded){
	    console.log("UI loaded :"+event.loaded);
	    console.log("current currency is :"+card.getCurrency())
	  }
	  	  	  
	  if (event.error) {
	  	  if(event.error.key!="error_invalid_cvv_characters"){
	  	  	 //
	  	  }	  	  
	  	  if(event.error.key=="error_currency_not_supported"){
	  	  	 tap_message(event.error.message);	
	  	     $("form button").attr("disabled",true);
	  	  }
	  }
	  
	});
	
	var tap_form = document.getElementById('tap-form');
	tap_form.addEventListener('submit', function(event) {
		 event.preventDefault();
		 tap_loader(true);
		 tap.createToken(card).then(function(result) {			 	 	 	
		 	 if (result.error) {
		 	 	tap_loader(false);
		 	 	tap_message(result.error.message);		 	 	
		 	 } else {		 	  	
		 	 	 $("form button").attr("disabled",true);
		 	  	 $("#tap-form").append('<input type="hidden" name="tap_token" value="'+ result.id +'" >');
		 	  	 tap_form.submit();
		 	 }
		 });
	});	
	
};
/*end inittap*/

tap_loader = function($load){
	if ( $(".mobile_body").exists() ){		
		loader($load);
	} else {
	   showPreloader($load);
	}
};

tap_message = function($message){
	if ( $(".mobile_body").exists() ){
		alert($message);
	} else {
	    uk_msg($message);
	}
};