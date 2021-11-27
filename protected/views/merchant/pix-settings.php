<?php
$merchant_id=Yii::app()->functions->getMerchantID();
$enabled=Yii::app()->functions->getOption('merchant_pix_enabled',$merchant_id);
$key_pix=Yii::app()->functions->getOption('merchant_pix_key',$merchant_id);
$type_pix=Yii::app()->functions->getOption('merchant_pix_type',$merchant_id);
?>

<script src="//code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>

<form class="uk-form uk-form-horizontal forms" id="forms">
    <?php echo CHtml::hiddenField('action','merchantPixSettings')?>


    <div class="uk-form-row">
        <label class="uk-form-label"><?php echo Yii::t("default","Habilitar PIX")?>?</label>
        <?php
  echo CHtml::checkBox('merchant_pix_enabled',
  $enabled=="yes"?true:false
  ,array(
    'value'=>"yes",
    'class'=>"icheck"
  ))
  ?>
    </div>
      <div class="uk-form-row">

  <label class="uk-form-label"><?php echo t("Tipo da chave")?></label>
  <?php
  echo CHtml::dropDownList('merchant_pix_type',
  Yii::app()->functions->getOption('merchant_pix_type',$merchant_id)
    ,array(
   '0'=>t(""), 
   '1'=>t("CPF/CNPJ"),
   '2'=>t("Email"),
   '3'=>t("Telefone"),
   '4'=>t("Chave Aleatoria")

  ));
  ?>
</div>


    <div class="uk-form-row">
        <label class="uk-form-label"><?php echo Yii::t("default","Chave PIX")?></label>
        <?php
  echo CHtml::textField('merchant_pix_key',
  Yii::app()->functions->getOption('merchant_pix_key',$merchant_id)
  ,array(
    'class'=>"uk-form-width-medium"

  ))
  ?>
    </div>
    <div class="uk-form-row">
    <span id="msg" style="display:none;"></span>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label"></label>
        <input type="submit" value="<?php echo Yii::t("default","Save")?>"
            class="uk-button uk-form-width-medium uk-button-success">
    </div>

</form>
<script type="text/javascript">
$('#merchant_pix_type').change(function () {

   
    var $selected = $(this).find('option:selected');
    var op = $selected.val();
    
    if ($selected.val() == '3') {
        document.getElementById("msg").textContent="<?php echo Yii::t("default","only number")?>";
        document.getElementById("msg").style.display= '';
   
    } else if ($selected.val() == '1') {
        document.getElementById("msg").textContent="<?php echo Yii::t("default","abn only number")?>";
        document.getElementById("msg").style.display= '';
    } else {
        document.getElementById("msg").textContent="";
        document.getElementById("msg").style.display= '';
   }
});

</script>
