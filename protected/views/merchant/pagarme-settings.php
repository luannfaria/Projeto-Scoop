
<?php $enabled=getOption($mtid,'merchant_pagarme_enabled');?>
<div id="error-message-wrapper"></div>

<form class="uk-form uk-form-horizontal forms" id="forms">
<?php echo CHtml::hiddenField('action','merchantPagarmeSettings')?>









<h3><?php echo Yii::t("default","Credentials")?></h3>

<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Enabled Pagarme")?></label>
  <?php 
  echo CHtml::checkBox('merchant_pagarme_enabled',
  $enabled==1?true:false
  ,array(
    'value'=>1,
    'class'=>"icheck"
  ))
  ?> 
</div>


<div class="uk-form-row">
  <label class="uk-form-label"><?php echo t("Client ID")?></label>
  <?php 
  echo CHtml::textField('merchant_pagarme_id',
  getOption($mtid,'merchant_pagarme_id')
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