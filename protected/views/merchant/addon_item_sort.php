<?php
$merchant_id=Yii::app()->functions->getMerchantID();
$list=Yii::app()->functions->getAddonItemListByMerchant($merchant_id);

?>


<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/AddOnItem/Do/Add" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/AddOnItem" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/merchant/AddOnItem/Do/Sort" class="uk-button"><i class="fa fa-sort-alpha-asc"></i> <?php echo Yii::t("default","Sort")?></a>
</div>

<form class="uk-form uk-form-horizontal forms" id="forms">
<?php echo CHtml::hiddenField('action','sortItem')?>
<?php echo CHtml::hiddenField('table','subcategory_item')?>
<?php echo CHtml::hiddenField('whereid','sub_item_id')?>

<h3 class="uk=h3"><?php echo Yii::t("default","Sort")?></h3>
<p class="uk-text-muted"><?php echo Yii::t("default","Drag the item below to sort")?></p>
<?php if (is_array($list) && count($list)>=1):?>
   <ul class="uk-sortable" data-uk-sortable>
  <?php foreach ($list as $val):?>
   <li class="uk-panel uk-panel-box" style="list-style:none;margin-bottom:5px;">
    <?php echo CHtml::hiddenField('sort_field[]',$val['sub_item_id'])?>
    <i class="fa fa-arrows-alt"></i>
    <?php echo $val['sub_item_name']?>

    <!-- INICIO ALTERAÇÃO PARA MOSTRAR SUBCATEGORIA NA LISTA DE ORDENAÇÃO DO SUBITEM -->
    &nbsp;&nbsp;

<strong><?php echo Yii::t('default',"AddOn Category")?>: </strong>
    <?php
    $cat_list = yii::app()->functions->getSubcategory();
    $cat = '';
    if (!empty($val['category'])) {
						$category = json_decode($val['category']);
						if (is_array($category) && count($category) >= 1) {
							foreach ($category as $cat_id) {
           //   echo  $cat_id['subcategory_name'];
              $teste = yii::app()->functions->getAddonCategory($cat_id);
           //   echo $teste['subcategory_name'];
								$cat .= $teste['subcategory_name'] . ",";
							}
							$cat = substr($cat, 0, -1);
						}
            echo $cat;
					}?>
  <!-- FIM ALTERAÇÃO PARA MOSTRAR SUBCATEGORIA NA LISTA DE ORDENAÇÃO DO SUBITEM -->
   </li>
  <?php endforeach;?>
  </ul>
<?php else :?>
<p class=""><?php echo Yii::t("default","No results")?></p>
<?php endif;?>

<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>
</form>