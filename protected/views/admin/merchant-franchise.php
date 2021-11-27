
<div class="uk-width-1" style="display:none">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/merchantAdd" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>

<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/merchantAddBulk" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Upload Bulk CSV")?></a>

<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/merchant" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>

<form id="frm_table_list" method="POST" >
<input type="hidden" name="action" id="action" value="merchantListFranchise">
<input type="hidden" name="tbl" id="tbl" value="merchant">
<input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
<input type="hidden" name="whereid"  id="whereid" value="merchant_id">
<input type="hidden" name="slug" id="slug" value="merchantAdd">
<table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
  <caption><?php echo Yii::t("default","Merchant List")?></caption>
   <thead>
        <tr>
            <th width="3%"><?php echo Yii::t("default","")?></th>
            <th width="17%"><?php echo Yii::t("default","Merchant Name")?></th>                
            <th width="3%"><?php echo Yii::t("default","Status")?></th>
        </tr>
    </thead>
    <tbody>    
    </tbody>
</table>
<div class="clear"></div>
</form>