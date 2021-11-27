

<form class="uk-form uk-form-horizontal forms" id="forms">
<?php echo CHtml::hiddenField('action','addMessageNew')?>
<?php echo CHtml::hiddenField('id',isset($_GET['id'])?$_GET['id']:"");?>

<?php if (!isset($_GET['id'])):?>
<?php echo CHtml::hiddenField("redirect",Yii::app()->request->baseUrl."/admin/message/Do/Add")?>
<?php endif;?>


<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","message")?></label>
  <?php echo CHtml::textField('message',$data['message'],
  array(
    'data-validation'=>'required' ,
    'class'=>'uk-form-width-large'
  ))?>
</div>







<?php
$joining_merchant=isset($data['joining_merchant'])?json_decode($data['joining_merchant'],true):'';
?>
<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Applicable to merchant")?></label>
  <?php
echo CHtml::dropDownList('joining_merchant[]',(array)$joining_merchant,
(array)Yii::app()->functions->merchantList(true),array(
  'data-validation'=>"required",
  'multiple'=>true,
  'class'=>"chosen",
  'style'=>"width:500px;"
))
?>
</div>
<p class="uk-text-muted uk-text-small">
<?php echo t("leave empty if you want to apply to all merchants")?>
</p>

<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>
</form>