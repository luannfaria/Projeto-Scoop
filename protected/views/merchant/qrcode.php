<!DOCTYPE html>
<html lang="pt-br">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          	
    <div>
    <label><?php echo t("text_merchant_qrcode")?></label>                                  
    </div>  
    
    <h3>Display de Mesa e QrCode </h3>
    <p> Para que o cliente possa visualizar o cardápio, será necessário um display de mesa, que vai conter orientações do processo e também um QrCode, que é um “código de barras” que pode ser usado para fazer a leitura do cardápio através de um celular.<br>
        Para isso, ele pode utilizar um aplicativo específico ou mesmo leitores de QR Code padrão que vêm junto a alguns aparelhos.
        O próximo passo é gerar e imprimir os QR Codes que serão colocados nas mesas. <br>
        Para salvar cada QR Code, é só clicar com o botão direito do mouse, e depois em em Salvar Imagem como. 
    </p>
    
<?php

$merchant_id=Yii::app()->functions->getMerchantID();
	$merchant_info = (array)Yii::app()->functions->getMerchantInfo(); 
			$merchant_user_type = $_SESSION['kr_merchant_user_type']; 
    	
			
		$url= websiteUrl(). "/menu-" . $merchant_info[0]->restaurant_slug;
	$qrcode=	yii::app()->functions->generateqrcode($url);
		echo $qrcode;
?>

</html>

		


