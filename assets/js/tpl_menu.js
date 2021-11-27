
lazyMenu1 = function(data , element, $activated_menu){
	if (data.length<=0){
		return;
	}		
	
	
	dump("activated_menu=>"+$activated_menu);
	dump("DATA=>");
	dump(data);
	
	
	$category_id = 0;
	
	var html=''; x=0	
	$.each( data.data  , function( key, val ) {
		
		$category_id = val.category_id;
		
		$class_name  = x%2?'odd':'even';
		$not_available = val.not_available==2?"item_not_available":"";		
		
		$discount = parseInt( val.discount )  ;
		
		$atts='';
		if(val.single_item==2){
			
			$atts+='data-price="'+val.single_details.price+'"';
			$atts+=" ";
			$atts+='data-size="'+val.single_details.size+'"';
			$atts+=" ";
			if( !empty(val.single_details.size_id) ){
				 $atts+='data-size_id="'+val.single_details.size_id +'"';
			}
			$atts+=" ";
			$atts+='data-discount="'+val.discount+'"';
		}
		
		switch($activated_menu){
			case 1:
						 
			  $show_category = true;	  
			  if ( $(".cat-"+ $category_id ).exists()){
			  	  $show_category = false;
			  } else {			  	  			  	  
			  	  html+='<h2 class="text-left cat_category_name cat-'+ $category_id +'">'+ val.category_name +'</h2>';			  
			  	  if(!empty(val.category_description)){
					html+='<p class="small cat_category_description">'+ val.category_description +'</p>';
				  }
			  }
						 			
			  html+='<div class="col-md-6 border" style="padding-left:10px;padding-right:10px;">';
			    html+='<div class="box-grey">';
			    
			    html+='<div class="food-thumbnail" ';
                 html+='style="background:url('+ q(val.photo_url) +');"> ';
                html+='</div>';
                
                html+='<p class="bold top10">'+ val.item_name +'</p>';
                
                if(!empty(val.item_description)){
                   html+='<p class="small food-description read-more">'+ val.item_description +'</p>';
                }
                
                if(val.description_dummy){
                	html+='<div class="dummy-link"></div>';
                }
                
                if(empty(disabled_addcart)){
	                html+='<div class="center top10 food-price-wrap">';
	                
	                html+='<a href="javascript:;"';
				     html+='class="dsktop orange-button inline rounded3 menu-item '+ $not_available +'  "';
				     html+='rel="'+ val.item_id +'" ';
				     html+='data-single="'+ val.single_item +'" ';
				     html+= $atts ;
				     html+='data-category_id="'+ $category_id +'" ';
				    html+='>';
				      
				    /*if(!empty(val.size_name)){
				    	html+=val.size_name + "&nbsp;";
				    }				  				   
				    if($discount >0){
				      html+='<span class="normal-price">'+val.price+'</span> <span class="sale-price">'+val.discount_price+'</span>';
				    } else {
				       html+=val.price;
				    }*/			
				    				  
				    if ((typeof  val.prices !== "undefined") && ( val.prices  !== null)) {
				    	html+= priceDisplay( val.prices ,'' );
				    }
				    
				    html+='</a>';		
				    
				    /*MOBILE*/		    				    
				     html+='<a href="javascript:;"';
				     html+='class="mbile orange-button inline rounded3 menu-item '+ $not_available +'  "';
				     html+='rel="'+ val.item_id +'" ';
				     html+='data-single="'+ val.single_item +'" ';
				     html+= $atts ;
				     html+='data-category_id="'+ $category_id +'" ';
				    html+='>';
				      
				    if ((typeof  val.prices !== "undefined") && ( val.prices  !== null)) {
				    	html+= priceDisplay( val.prices ,'');
				    }
				    		      
				    html+='</a>';		
				   
	                html+='</div>';
                }
			    
			    html+='</div>';
			  html+='</div>';
			break;
			
			
			case 2:
			
			  		
			  $show_category = true;	  
			  if ( $(".cat-"+ $category_id ).exists()){
			  	  $show_category = false;
			  } else {			  	  			  	  
			  	  html+='<h2 class="text-left cat_category_name cat-'+ $category_id +'">'+ val.category_name +'</h2>';			  
			  	  if(!empty(val.category_description)){
					html+='<p class="small cat_category_description">'+ val.category_description +'</p>';
				  }
			  }
			  
			  			  		
			  if(empty(disabled_addcart)){			  	
			  	 html+='<a href="javascript:;"';
				     html+='class="dsktop menu-item '+ $not_available +'  "';
				     html+='rel="'+ val.item_id +'" ';
				     html+='data-single="'+ val.single_item +'" ';
				     html+= $atts ;
				     html+='data-category_id="'+ $category_id +'" ';
				    html+='>';
			  } else {
			  	  html+='<a href="javascript:;" class="menu-3-disabled-ordering">';
			  }
			  
			  html+='<div class="row">';
				  html+='<div class="col-md-3 removePaddingLeft">';
				    html+='<img src='+ q(val.photo_url) +'>';
				  html+='</div>';			  
				  
				  html+='<div class="col-md-6">';
				    html+='<p class="bold">'+ val.item_name +'</p>'; 
				    if(!empty(val.item_description)){
				       html+='<p class="small food-description read-more">'+ val.item_description +'</p>';
				    }
				  html+='</div>';
				  
				  html+='<div class="col-md-3 center">';
                  
				    if ((typeof  val.prices !== "undefined") && ( val.prices  !== null)) {
				    	html+= priceDisplay( val.prices , 'bold' );
				    }
				  
                  html+='</div>';
			  
			  html+='</div>'; /*row*/
			  
			  html+='</a>';
			  
			  
			  if(empty(disabled_addcart)){			  	
			  	 html+='<a href="javascript:;"';
				     html+='class="mbile menu-item '+ $not_available +'  "';
				     html+='rel="'+ val.item_id +'" ';
				     html+='data-single="'+ val.single_item +'" ';
				     html+= $atts ;
				     html+='data-category_id="'+ $category_id +'" ';
				    html+='>';
			  } else {
			  	  html+='<a href="javascript:;" class="mbile menu-3-disabled-ordering">';
			  }
			  
			  html+='<div class="row">';
			    html+='<div class="col-md-2">';
				    html+='<img src='+ q(val.photo_url) +'>';
				  html+='</div>';			  
			  html+='</div>';
			  
			   html+='<div class="col-md-7">';
				    html+='<p class="bold">'+ val.item_name +'</p>'; 
				    if(!empty(val.item_description)){
				       html+='<p class="small food-description read-more">'+ val.item_description +'</p>';
				    }
				  html+='</div>';
				  
				  html+='<div class="col-md-3 center food-price-wrap">';
                   html+='<p class="bold">';
                   
                    if ((typeof  val.prices !== "undefined") && ( val.prices  !== null)) {
				    	html+= priceDisplay( val.prices , 'bold' );
				    }
                   
                   html+='</p>';
                  html+='</div>';
			  
			  html+='</a>';
			  
			  if($show_category){
			  	 //html+='</div>'; /*menu-3-cat*/
			  }
			  
			break;
			
			
			default:		
						
		    $show_category = true;	  
		    if ( $(".cat-"+ $category_id).exists()){
		  	   $show_category = false;
		    } else {			  	  			  	  
		  	   html+='<h2 class="text-left cat_category_name cat-'+ $category_id +'">'+ val.category_name +'</h2>';			  
		  	   if(!empty( val.category_description )){
				 html+='<p class="small cat_category_description">'+ val.category_description +'</p>';
			   }
		    }
				
			html+='<div class="row '+ $class_name +'">';
			  html+='<div class="col-md-10 col-xs-10 border">';
			    html+= val.item_name;
			    			   			   
			    if ((typeof  val.prices !== "undefined") && ( val.prices  !== null)) {
			    	html+= priceDisplay( val.prices ,'' );
			    }
			    
			  html+='</div>';
			  			  
			  
			  html+='<div class="col-md-1 col-xs-1 relative food-price-wrap border">';
			  
			  html+='<a href="javascript:;" class="dsktop menu-item '+ $not_available +' " ';
			  html+=' rel="'+ val.item_id +'" data-single="'+ val.single_item +'" '+  $atts +' data-category_id="'+ $category_id +'">';
			   html+='<i class="ion-ios-plus-outline green-color bold"></i>';
			  html+='</a>';
			  
			  html+='<a href="javascript:;" class="mbile menu-item '+ $not_available +' " ';
			  html+=' rel="'+ val.item_id +'" data-single="'+ val.single_item +'" '+  $atts +' data-category_id="'+ $category_id +'">';
			   html+='<i class="ion-ios-plus-outline green-color bold"></i>';
			  html+='</a>';
			  
			  html+='</div>';
			  
			html+='</div>';			
			break;
		}
		
		/*end switch*/			
				
		$("."+element).append( html );
		x++;
		html='';
		
		setTimeout( function(){     			   	   	      
			 initReadMore()
        }, 500);
		
	});
};

lazyCategory = function(data, element){		
	
	if ( $(".cat-"+ data.details.data.category_id  ).exists()){
		return false;
	}
	
	$(".cat_header").html('');
	html='';		
    html+='<h2 class="text-left cat_category_name cat-'+ data.details.data.category_id +'">'+ data.details.data.category_name +'</h2>';			  
    if(!empty( data.details.data.category_description )){
	   html+='<p class="small cat_category_description">'+ data.details.data.category_description +'</p>';
    }
    html+='<p class="small text-danger">'+ data.msg  +'</p>';    
    $("."+element).append( html );
};

q = function(data){
	return "'" + addslashes(data) + "'";
};

var addslashes = function(str)
{
	return (str + '')
    .replace(/[\\"']/g, '\\$&')
    .replace(/\u0000/g, '\\0')
};

var priceDisplay = function(data , class_name )
{
	var $html = '';
	if(data.length>0){
		$.each( data  , function( price_key, price_val ) {
			if ( price_val.exchange_discount_price>0){
				 $html+='<p class="'+ class_name+'">';
				 $html+='<span class="normal-price">';							      
				  $html+= !empty(price_val.size_name)?price_val.size_name :'';
				  $html+= price_val.exchange_price1;
				  $html+='</span>';
				  $html+='&nbsp;';
				  $html+='<span class="sale-price">'+ price_val.exchange_discount_price1 +'</span>';
				 $html+='</p>';
			} else {
				$html+='<p class="'+ class_name+'">';
				$html+= !empty(price_val.size_name)?price_val.size_name :'';
				$html+='&nbsp;';
				$html+= price_val.exchange_price1;
				$html+='</p>';
			}
		});
	}
	return $html;
};