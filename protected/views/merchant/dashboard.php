<?php if (Yii::app()->functions->hasMerchantAccess("DashBoard")) : ?>

    <div id="page_content_inner">
        <?php $idmerchant = Yii::app()->functions->getMerchantID(); ?>
        <?php $message_merchant = Yii::app()->functions->messageMerchant($idmerchant); ?>
        <?php if ($message_merchant != false) { ?>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <div class="uk-alert" data-uk-alert="">
                        <a data-id="<?php echo $message_merchant['id_message']; ?>" href="#" id="closeAlert" class="uk-alert-close uk-close closeAlert"></a>
                        <?php echo $message_merchant['message']; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <br>



        <form id="frm_table_list" method="POST" class="report uk-form uk-form-horizontal merchant-dashboard">
            <h3><?php echo Yii::t("default", "New Order List For Today") ?>
                <?php

                echo FormatDateTime(date('c'), false);
                ?>
            </h3>

            <input type="hidden" name="action" id="action" value="recentOrder">
            <input type="hidden" name="tbl" id="tbl" value="item">
            <table id="table_list" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                <!--<caption>Merchant List</caption>-->
                <thead>
                    <tr>
                        <th width="3%"><?php echo Yii::t('default', "Date") ?></th>
                        <th width="2%"><?php echo Yii::t('default', "Ref#") ?></th>
                        <th width="5%"><?php echo Yii::t('default', "Name") ?></th>
                        <th width="3%"><?php echo Yii::t('default', "Contact#") ?></th>
                        <th width="5%"><?php echo Yii::t('default', "Item") ?></th>
                        <th width="3%"><?php echo Yii::t('default', "TransType") ?></th>
                        <th width="3%"><?php echo Yii::t('default', "Payment Type") ?></th>
                        <!-- <th width="3%"><?php echo Yii::t('default', "Total") ?></th>
            <th width="3%"><?php echo Yii::t('default', "Tax") ?></th> -->
                        <th width="3%"><?php echo Yii::t('default', "Total W/Tax") ?></th>
                        <th width="3%"><?php echo Yii::t('default', "Status") ?></th>
                        <!-- <th width="3%"><?php echo Yii::t('default', "Platform") ?></th> -->
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="clear"></div>
        </form>

        <?php if ($cancel_order_enabled == 1) : ?>
            <hr style="margin-top:20px;margin-bottom:20px;">
            </hr>

            <div class="request_cancel_order_wrap">
                <h3><?php echo t("New request cancel order") ?></h3>
                <form id="frm_table_list2" method="POST" class="report uk-form uk-form-horizontal merchant-dashboard">
                    <input type="hidden" name="action" id="action" value="requestCancelOrderList">
                    <input type="hidden" name="tbl" id="tbl" value="item">
                    <table id="table_list2" class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                        <thead>
                            <tr>
                                <th width="2%"><?php echo Yii::t('default', "Ref#") ?></th>
                                <th width="5%"><?php echo Yii::t('default', "Name") ?></th>
                                <th width="3%"><?php echo Yii::t('default', "Contact#") ?></th>
                                <th width="5%"><?php echo Yii::t('default', "Item") ?></th>
                                <th width="3%"><?php echo Yii::t('default', "TransType") ?></th>
                                <th width="3%"><?php echo Yii::t('default', "Payment Type") ?></th>
                                <!--    <th width="3%"><?php echo Yii::t('default', "Total") ?></th>
            <th width="3%"><?php echo Yii::t('default', "Tax") ?></th> -->
                                <th width="3%"><?php echo Yii::t('default', "Total W/Tax") ?></th>
                                <th width="3%"><?php echo Yii::t('default', "Status") ?></th>
                                <th width="3%"><?php echo Yii::t('default', "Date") ?></th>
                                <!--    <th width="3%"><?php echo Yii::t('default', "Platform") ?></th> -->
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
            </div>
        <?php endif; ?>

        <hr style="margin-top:20px;margin-bottom:40px;">
        </hr>

    <?php else : ?>
        <h2><?php echo Yii::t("default", "Welcome") ?></h2>
    <?php endif; ?>

    <?php $comercioid = Yii::app()->functions->getMerchantID();
    if ($comercioid != 7) { ?>

        <!-- ALERTA DASHBOARD -->
        <!-- alert(Yii::t("default","mensagem_alerta"));


<script type='text/javascript'>alert('<?php echo Yii::t('default', "mensagem_alerta") ?>');</script>"; -->


    <?php } ?>