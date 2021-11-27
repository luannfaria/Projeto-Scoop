<div id="page_content_inner">

    <div class="uk-grid">
        <div class="uk-width-1-1">
            <div class="md-card">
                <div class="md-card-content">
                    <div id="total_sales_all_merchant_chart" class="chartadmin"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="uk-grid">
        <div class="uk-width-1-1">
            <div class="md-card">
                <div class="md-card-content">
                    <div id="total_sales_by_city_chart" class="chartadmin"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="uk-grid">
        <div class="uk-width-1-2">
            <div class="md-card">
                <div class="md-card-toolbar">
                <h4 class="heading_a uk-margin-top"><?php echo Yii::t("default", "TOP 10 Parceiros") ?></h4>
                </div>
                <div class="md-card-content">

                    <?php $topsales = Yii::app()->functions->top10SalesMerchant(); ?>
                    <table class="uk-table">


                        <?php foreach ($topsales as $val) : ?>
                            <tr>
                                <td class="uk-width-3-10 uk-text-nowrap">
                                    R$ <?php
                                        echo Price_Formatter::formatNumber($val['total']);
                                        ?>
                                </td>
                                <td class="uk-width-5-10 uk-text-nowrap">
                                    <?php echo $val['restaurant_name']; ?>
                                </td>
                                <td class="uk-width-2-10 uk-text-nowrap">
                                    <?php echo $val['pedidos']; ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>
                    </table>

                </div>
            </div>
        </div>
        <div class="uk-width-1-2">
            <div class="md-card">
            <div class="md-card-toolbar">
                <h4 class="heading_a uk-margin-top"><?php echo Yii::t("default", "TOP 10 Parceiros") ?></h4>
                </div>
                <div class="md-card-content">

                    <?php $topsales = Yii::app()->functions->top10SalesMerchant(); ?>
                    <table class="uk-table">


                        <?php foreach ($topsales as $val) : ?>
                            <tr>
                                <td class="uk-width-3-10 uk-text-nowrap">
                                    R$ <?php
                                        echo Price_Formatter::formatNumber($val['total']);
                                        ?>
                                </td>
                                <td class="uk-width-5-10 uk-text-nowrap">
                                    <?php echo $val['restaurant_name']; ?>
                                </td>
                                <td class="uk-width-2-10 uk-text-nowrap">
                                    <?php echo $val['pedidos']; ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <div class="uk-grid">
        <div class="uk-width-1-2">
            <div class="md-card">
                <div class="md-card-toolbar">
                <h4 class="heading_a uk-margin-top"><?php echo Yii::t("default", "Clientes TOP 5") ?></h4>
                </div>
                <div class="md-card-content">
                <?php $topsales = Yii::app()->functions->top5Customers(); ?>




                <ul class="md-list md-list-addon">
                 <!--   <table class="uk-table">

                        -->
                        <?php foreach ($topsales as $val) : ?>
                            <li>
                            <div class="md-list-addon-element" style="font-size: 24px;margin-top: 4px; color: #727272;">
                            <?php echo $val['pedidos']; ?>

                            </div>

                            <div class="md-list-content">
                                        <span class="md-list-heading">  <?php echo $val['first_name']; ?></span>
                                        <span class="uk-text-small uk-text-muted">    R$  <?php
                                        echo Price_Formatter::formatNumber($val['total']);
                                        ?></span>
                                    </div>
                          <!--  <tr>
                                <td class="uk-width-3-10 uk-text-nowrap">
                                    R$ <?php
                                        echo Price_Formatter::formatNumber($val['total']);
                                        ?>
                                </td>
                                <td class="uk-width-5-10 uk-text-nowrap">


                                </td>
                                <td class="uk-width-2-10 uk-text-nowrap">

                                </td>

                            </tr>-->
                            </li>
                        <?php endforeach; ?>
                <!--    </table>-->

                </ul>
                </div>
            </div>
        </div>
        <div class="uk-width-1-2">
            <div class="md-card">
                <div class="md-card-toolbar">

                </div>
                <div class="md-card-content">
                <div id="sales_city" class="chartadmin"></div>
                </div>
            </div>
        </div>
    </div>

</div>