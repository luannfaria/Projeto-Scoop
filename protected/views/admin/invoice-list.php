 <div class="uk-grid">
	   <div class="uk-width-1">
           <a href="<?php echo Yii::app()->createUrl('/admin/invoice')?>" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
           <a href="<?php echo Yii::app()->createUrl('/admin/invoiceunpaid')?>" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","Unpaid")?></a>
       </div>
</div>


<form id="frm_table_list" method="POST" >
<input type="hidden" name="action" id="action" value="InvoiceList">
<input type="hidden" name="tbl" id="tbl" value="invoice">
<input type="hidden" name="clear_tbl"  id="clear_tbl" value="clear_tbl">
<input type="hidden" name="server_side" id="server_side" value="1">
<input type="hidden" name="whereid" id="whereid" value="invoice_number">
<table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed"> 
   <thead>
        <tr>
            <th width="7%"><?php echo t("Invoice number")?>
            <th width="8%"><?php echo t("Merchant id")?></th>
            <th width="15%"><?php echo t("Merchant")?></th>             
            <th width="10%"><?php echo t("Invoice terms")?></th>             
            <th width="15%"><?php echo t("Period")?></th> 
            <th width="8%"><?php echo t("Total")?></th> 
            <th width="10%"><?php echo t("Status")?></th> 
            <th width="10%"><?php echo t("Payment Status")?></th> 
            <th width="10%"><?php echo t("PDF")?></th> 
            <th width="7%"><?php echo t("Boleto")?></th>
        </tr>
    </thead>
    <tbody>    
    </tbody>
</table>
<div class="clear"></div>
</form>