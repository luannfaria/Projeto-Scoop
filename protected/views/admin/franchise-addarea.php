<div class="uk-width-1">

</div>

<?php
if (isset($_GET['id'])) {
	if (!$data = FunctionsV3::getAreaFranchise($_GET['id'])) {
		echo "<div class=\"uk-alert uk-alert-danger\">" .
			Yii::t("default", "Sorry but we cannot find what your are looking for.") . "</div>";
		return;
	}
}
?>

<div class="spacer"></div>

<div id="error-message-wrapper"></div>

<form class="uk-form uk-form-horizontal forms" id="forms">
	<?php echo CHtml::hiddenField('action', 'addAreaFranchise');
	FunctionsV3::addCsrfToken(false);
	
	?>
	<?php echo CHtml::hiddenField('area_id', isset($data['area_id']) ? $data['area_id'] : ""); ?>
	<?php if (!isset($_GET['id'])) : ?>
		<?php echo CHtml::hiddenField("redirect", Yii::app()->request->baseUrl . "/admin/areafranchise/") ?>
	<?php endif; ?>


	<?php

	$admin_id = Yii::app()->functions->getAdminId();
	$admin_info = Yii::app()->functions->getAdminUserInfo($admin_id);


	$city = Yii::app()->functions->getFranchiseInfo($admin_info['franchise_id']);

	?>

	<div class="uk-form-row">

		<input type="hidden" name="city_id" value="<?php echo $city['cidade_atendida_id'] ?>">
		<label class="uk-form-label"><?php echo Yii::t("default", "Bairro") ?></label>
		<?php
		echo CHtml::textField(
			'name',
			isset($data['name']) ? $data['name'] : "",
			array('class' => "uk-form-width-large", 'data-validation' => "required")
		)
		?>
	</div>


	<div class="uk-form-row">
		<label class="uk-form-label"></label>
		<input type="submit" value="<?php echo Yii::t("default", "Save") ?>" class="uk-button uk-form-width-medium uk-button-success">
	</div>

</form>