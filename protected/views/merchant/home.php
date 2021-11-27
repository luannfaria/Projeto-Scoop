
<?php if ( Yii::app()->functions->hasMerchantAccess("Home")):?>

        <?php $idmerchant = Yii::app()->functions->getMerchantID(); ?>

        <h3><?php echo Yii::t("default","Desempenho hoje")?> <span class="uk-text-success">
        <?php echo FormatDateTime(date('c'),false); //echo date('F d, Y')?></span></h3>

        <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler" data-uk-sortable data-uk-grid-margin>
            <div>
                <div class="new_box_set">
                    <div class="uk-panel-box  h70">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="uk-icon-small uk-icon-star" style="color: #ffce0f;"></i></div>
                        <span class="uk-text-muted uk-text-medium">Avaliação média</span>
                        <h2 class="uk-margin-remove"><?php $ratings = Yii::app()->functions->getRatings($idmerchant);
                                                        echo $ratings['ratings']; ?>/5</h2>
                        <span style="font-size:12px">Total de avaliações: <?php echo $ratings['votes']; ?></span>
                    </div>
                </div>
            </div>


            <div>
                <div class="new_box_set">
                    <div class="uk-panel-box  h70">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"> <i class="uk-icon-small uk-icon-list" style="color: #f75d34;"></i></div>
                        <span class="uk-text-muted uk-text-medium">Nº Pedidos</span>
                        <h2 class="uk-margin-remove"><?php echo Yii::app()->functions->newOrdersTodayMerchant($idmerchant); ?></h2>
                        <span style="font-size:12px">Pedidos válidos hoje</span>

                        <span></span>
                    </div>
                </div>
            </div>


            <div>
                <div class="new_box_set">
                    <div class="uk-panel-box  h70">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"> <i class="uk-icon-small uk-icon-ban" style="color: red"></i></div>
                        <span class="uk-text-muted uk-text-medium">Cancelados </span>
                        <h2 class="uk-margin-remove"><?php echo Yii::app()->functions->canceledOrdersTodayMerchant($idmerchant); ?></h2>
                        <span style="font-size:12px"><?php echo Yii::app()->functions->totalcanceledOrdersTodayMerchant($idmerchant); ?> - é quanto deixou de ganhar</span>
                    </div>
                </div>
            </div>

            <div>
                <div class="new_box_set">
                    <div class="uk-panel-box  h70">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"> <i class="uk-icon-small uk-icon-ban" style="color: red"></i></div>
                        <span class="uk-text-muted uk-text-medium">Recusados</span>
                        <h2 class="uk-margin-remove"><?php echo Yii::app()->functions->declinedOrdersTodayMerchant($idmerchant); ?></h2>
                        <span style="font-size:12px"><?php echo Yii::app()->functions->totaldeclinedOrdersTodayMerchant($idmerchant); ?> - deixou de ganhar</span>
                    </div>
                </div>
            </div>
        </div>
<br>
        <div class="uk-grid uk-grid-width-large-1-5 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler" data-uk-sortable data-uk-grid-margin>
            
            <div>
                <div class="new_box_set">
                    <div class="uk-panel-box  h70">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"> <i class="uk-icon-small uk-icon-money" style="color: green"></i></div>
                        <span class="uk-text-muted uk-text-medium">Vendas</span></span>
                        <h2 class="uk-margin-remove"><?php echo Yii::app()->functions->totalOrdersTodayMerchant($idmerchant); ?></h2>
                        <span style="font-size:12px">Total das vendas válidas hoje</span>
                    </div>
                </div>
            </div>
            
            <div>
                <div class="new_box_set">
                    <div class="uk-panel-box h70">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"> <i class="uk-icon-small uk-icon-ticket" style="color: #f75d34"></i></div>
                        <span class="uk-text-muted uk-text-medium">Ticket médio</span>
                        <h2 class="uk-margin-remove"><?php echo Yii::app()->functions->ticketMedioTodayMerchant($idmerchant); ?></h2>
                        <span style="font-size:12px">Média gasta por pedido</span>
                    </div>
                </div>
            </div>

            <div>
                <div class="new_box_set">
                    <div class="uk-panel-box  h70">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="uk-icon-small uk-icon-money" style="color: green"></i></div>
                        <span class="uk-text-muted uk-text-medium">Comissão a pagar</span>
                        <h2 class="uk-margin-remove"><?php echo Yii::app()->functions->totalcomissionTodayMerchant($idmerchant);?></h2>
                        <span style="font-size:12px">Sobre as vendas de hoje</span>
                    </div>
                </div>
            </div>


            <div>
                <div class="new_box_set">
                    <div class="uk-panel-box  h70">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"> <i class="uk-icon-small fa fa-motorcycle"></i></div>
                        <span class="uk-text-muted uk-text-medium">Entregas <span style="font-size:12px"> (hoje)</span></span>
                        <h2 class="uk-margin-remove"><?php echo Yii::app()->functions->totaldeliveryTodayMerchant($idmerchant);?></h2>
                        <span style="font-size:12px">A repassar ao entregador</span>
                        <span></span>
                    </div>
                </div>
            </div>   
            
            <div>
                <div class="new_box_set">
                    <div class="uk-panel-box  h70">
                        <div class="uk-float-right uk-margin-top uk-margin-small-right"> <i class="uk-icon-small fa fa-TICKET"></i></div>
                        <span class="uk-text-muted uk-text-medium">CUPONS <span style="font-size:12px"> (hoje)</span></span>
                        <h2 class="uk-margin-remove"><?php echo Yii::app()->functions->ValueVoucherTodayMerchant($idmerchant);?></h2>
                        <span style="font-size:12px"><?php echo Yii::app()->functions->totalVoucherTodayMerchant($idmerchant); ?> cupons aplicados</span>
                        <span></span>
                    </div>
                </div>
            </div> 

        </div> <!-- GRID -->
    <br><br>




<br>

<h3><?php echo Yii::t("default","Desempenho no período")?></h3>
<div id="total_sales_chart" class="chart"></div>
<div id="total_sales_chart_by_item" class="chart"></div> 
<div id="total_sales_by_area" class="chart"></div> 



<?php else :?>
<h2><?php echo Yii::t("default","Welcome")?></h2>
<?php endif; ?>


