<?php
$enabled_pagarme=Yii::app()->functions->getOptionAdmin('admin_enabled_pagarme');

?>

<div id="error-message-wrapper"></div>

<form class="uk-form uk-form-horizontal forms" id="forms">
<?php echo CHtml::hiddenField('action','adminPagarmeSettings')?>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Enabled Pagarme")?>?</label>
  <?php 
  echo CHtml::checkBox('admin_enabled_pagarme',
  $enabled_pagarme=="yes"?true:false
  ,array(
    'value'=>"yes",
    'class'=>"icheck"
  ))
  ?> 
</div>



<h3><?php echo Yii::t("default","Sandbox")?></h3>
<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Client ID")?></label>
  <?php 
  echo CHtml::textField('admin_pagarme_apikey',
  Yii::app()->functions->getOptionAdmin('admin_pagarme_apikey')
  ,array(
    'class'=>"uk-form-width-large"
  ))
  ?>
</div>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","ID recebedor ADMIN")?></label>
  <?php 
  echo CHtml::textField('admin_pagarme_idrecebedor',
  Yii::app()->functions->getOptionAdmin('admin_pagarme_idrecebedor')
  ,array(
    'class'=>"uk-form-width-large"
  ))
  ?>
</div>


<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>

</form>