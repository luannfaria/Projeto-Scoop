

<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/franchiseAreaAdd" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>



<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/areafranchise" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>

<form id="frm_table_list" method="POST" >
<input type="hidden" name="action" id="action" value="franchiseAreaList">
<input type="hidden" name="tbl" id="tbl" value="location_area">
<input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
<input type="hidden" name="whereid"  id="whereid" value="area_id">
<input type="hidden" name="slug" id="slug" value="franchiseAreaAdd">
<table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
  <caption><?php echo Yii::t("default","Merchant List")?></caption>
   <thead>
        <tr>
            <th width="5%"><?php echo Yii::t("default","ID")?></th>
			<th width="35%"><?php echo Yii::t("default","Nome")?></th>
			<th width="15%"><?php echo Yii::t("default","CNPJ")?></th>
	
			
        </tr>
    </thead>
    <tbody>    
    </tbody>
</table>
<div class="clear"></div>
</form>
