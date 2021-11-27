<?php
$merchant_id=Yii::app()->functions->getMerchantID();
$enabled=Yii::app()->functions->getOption('merchant_multicard_enabled',$merchant_id);
$key_pix=Yii::app()->functions->getOption('merchant_pix_key',$merchant_id);
$type_pix=Yii::app()->functions->getOption('merchant_pix_type',$merchant_id);
?>


<form class="uk-form uk-form-horizontal forms" id="forms">
    <?php echo CHtml::hiddenField('action','merchantMulticardSettings')?>


    <div class="uk-form-row">
        <label class="uk-form-label"><?php echo Yii::t("default","Habilitar Multicard")?>?</label>
        <?php
  echo CHtml::checkBox('merchant_multicard_enabled',
  $enabled=="yes"?true:false
  ,array(
    'value'=>"yes",
    'class'=>"icheck"
  ))
  ?>
    </div>



    <div class="uk-form-row">
        <label class="uk-form-label"><?php echo Yii::t("default","Cód Estabelecimento")?></label>
        <?php
  echo CHtml::textField('merchant_cod_estabelecimento',
  Yii::app()->functions->getOption('merchant_cod_estabelecimento',$merchant_id)
  ,array(
    'class'=>"uk-form-width-medium"
  ))
  ?>
    </div>

    <div class="uk-form-row">
        <label class="uk-form-label"></label>
        <input type="submit" value="<?php echo Yii::t("default","Save")?>"
            class="uk-button uk-form-width-medium uk-button-success">
    </div>

</form>
