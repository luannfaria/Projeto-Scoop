
<?php if(is_array($menu) && count($menu)>=1):?>

<?php foreach ($menu as $val):?>
<div class="menu-1 box-grey rounded" style="margin-top:0;">

  <div class="menu-cat cat-<?php echo $val['category_id']?> ">
     <a href="javascript:;">       
       <span class="bold">
          <i class="<?php echo $tc==2?"ion-ios-arrow-thin-down":'ion-ios-arrow-thin-right'?>"></i>
         <?php //echo qTranslate($val['category_name'],'category_name',$val)?>
         <?php echo $val['category_name'];?>
       </span>
       <b></b>
     </a>
          
     <?php $x=0?>
          
     <div class="items-row <?php echo $tc==2?"hide":''?>" >
     
     <?php if (!empty($val['category_description'])):?>
     <p class="small">
       <?php //echo qTranslate($val['category_description'],'category_description',$val)?>
       <?php echo $val['category_description']?>
     </p>
     <?php endif;?>
     <?php echo Widgets::displaySpicyIconNew($val['dish'],"dish-category")?>
     
     <?php if (is_array($val['item']) && count($val['item'])>=1):?>
     <?php foreach ($val['item'] as $val_item):?>
     
     <?php                    
	    $atts='';	    
	    if ( $val_item['single_item']==2){
			  $atts.='data-price="'.$val_item['single_details']['price'].'"';
			  $atts.=" ";
			  $atts.='data-size="'.$val_item['single_details']['size'].'"';
			  $atts.=" ";
			  if(isset($val_item['single_details']['size_id'])){
			     $atts.='data-size_id="'.$val_item['single_details']['size_id'].'"';
			  }
			  $atts.=" ";
			  $atts.='data-discount="'.$val_item['discount'].'"';
			  $atts.=" ";
			  if(isset($val_item['single_details']['item_size_token'])){
			     $atts.='data-item_size_token="'.$val_item['single_details']['item_size_token'].'"';			  
			  }
		}
	  ?>       
     
     <div class="row <?php echo $x%2?'odd':'even'?>">
        <div class="col-md-10 col-xs-10 border">          
          <?php echo $val_item['item_name']?>          
          <?php 
           $this->widget('application.components.Widget_price',array(
             'price'=> $val_item['prices']
           ));
           ?>          
        </div>
                   
                   
        <div class="col-md-1 col-xs-1 relative food-price-wrap border">
          <?php if ( $disabled_addcart==""):?>
          
          <a href="javascript:;" class="dsktop menu-item <?php echo $val_item['not_available']==2?"item_not_available":''?>" 
            rel="<?php echo $val_item['item_id']?>"
            data-single="<?php echo $val_item['single_item']?>" 
            <?php echo $atts;?>
            data-category_id="<?php echo $val['category_id']?>"
           >
           <i class="ion-ios-plus-outline green-color bold"></i>
          </a>
         
          <a href="javascript:;" class="mbile menu-item <?php echo $val_item['not_available']==2?"item_not_available":''?>" 
            rel="<?php echo $val_item['item_id']?>"
            data-single="<?php echo $val_item['single_item']?>" 
            <?php echo $atts;?>
            data-category_id="<?php echo $val['category_id']?>"
           >
           <i class="ion-ios-plus-outline green-color bold"></i>
          </a>
          
          <?php endif;?>
        </div>
     </div> <!--row-->
     <?php $x++?>
     <?php endforeach;?>
    <?php else :?>       
      <p class="small text-danger"><?php echo t("no item found on this category")?></p>      
     <?php endif;?>
    </div> 
    
       
  </div> <!--menu-cat-->

</div> <!--menu-1-->
<?php endforeach;?>

<?php else :?>
<p class="text-danger"><?php echo t("This restaurant has not published their menu yet.")?></p>
<?php endif;?>