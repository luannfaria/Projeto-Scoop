<?php
/**
 * CronController Controller
 *
 */
//if (!isset($_SESSION)) { session_start(); }


class BoletocronController extends CController
{
	
	
	

		public function actionGeraBoleto(){


//	sleep(10);

			$conta = "94342830";
			$cnpj = "40131655000113";
		

 //$upload_path=FunctionsV3::uploadPath();	
			$estadoPagador = "SP";


			Yii::app()->setImport(array(
			'application.vendor.boleto.*'
			));
  							require_once('init.php');

				$DbExt=new DbExt;

				$stmt="SELECT a.invoice_number, a.invoice_total, b.restaurant_name,b.bairro, b.restaurant_phone, b.street,b.city,
				b.post_code, b.abn 
				FROM {{invoice}} a left join {{merchant}} b ON a.merchant_id = b.merchant_id WHERE a.boleto='1' AND
				b.gerar_boleto='2' AND a.invoice_total>'10' ORDER BY a.invoice_number DESC LIMIT 0,10";

								if (isset($_GET['debug'])){ dump($stmt); }

								if ($res=$DbExt->rst($stmt)){

									foreach ($res as $row) {

										$banco = new ctodobom\APInterPHP\BancoInter($conta,'/home/u585332159/domains/scoopdelivery.com.br/public_html/upload/cert/certificado.crt','/home/u585332159/domains/scoopdelivery.com.br/public_html/upload/cert/chave.key');
                                      //  $banco = new ctodobom\APInterPHP\BancoInter($conta,'/home/u585332159/domains/scoopdelivery.com.br/public_html/protected/vendor/boleto/cert/certificado.crt','/home/u585332159/domains/scoopdelivery.com.br/public_html/protected/vendor/boleto/cert/chave.key');
echo $row['restaurant_name'];
                //    echo (preg_replace("/[^0-9]/", "", $row['street']));
               //     echo '<br>';
                 //   echo $row['bairro'];
                //    echo'<br>';
                        echo(preg_replace("/[^0-9]/", "", $row['street']));
										$pagador = new ctodobom\APInterPHP\Cobranca\Pagador();

										if((strlen(preg_replace("/[^0-9]/", "", $row['abn'])))>11){
										$pagador->setTipoPessoa("JURIDICA");
										}else{
										$pagador->setTipoPessoa("FISICA");
										}

										$pagador->setNome($row['restaurant_name']);
									 
										$pagador->setEndereco(preg_replace("/[^a-zA-Z\s]/", "", $row['street']));
										$pagador->setNumero(preg_replace("/[^0-9]/", "", $row['street']));
										$pagador->setBairro($row['bairro']);
										$pagador->setCidade($row['city']);
										$pagador->setCep(preg_replace("/[^0-9]/", "", $row['post_code']));
$doc=preg_replace("/[^0-9]/", "", $row['abn']);
										$pagador->setCnpjCpf(substr($doc,0,15));
								//		echo $doc;
								//		
							//			echo (number_format($row['invoice_total'], 2, '.', ''));
										$pagador->setUf($estadoPagador);

										$mora = new ctodobom\APInterPHP\Cobranca\Mora();
										$mora->setTaxa(1.00);
										$mora->setData(date_add(new DateTime() , new DateInterval("P15D"))->format('Y-m-d'));

										$multa = new ctodobom\APInterPHP\Cobranca\Multa();
										$multa->setData(date_add(new DateTime() , new DateInterval("P15D"))->format('Y-m-d'));
										$multa->setTaxa(10.00);

										$boleto = new ctodobom\APInterPHP\Cobranca\Boleto();
										$boleto->setCnpjCPFBeneficiario($cnpj);
										$boleto->setPagador($pagador);
										$boleto->setMora($mora);
										$boleto->setMulta($multa);
										$boleto->setSeuNumero($row['invoice_number']);
										$boleto->setDataEmissao(date('Y-m-d'));
										$boleto->setValorNominal(number_format($row['invoice_total'], 2, '.', ''));
										$boleto->setDataVencimento(date_add(new DateTime() , new DateInterval("P14D"))->format('Y-m-d'));

										try {
										$banco->createBoleto($boleto);
										$criouboleto = $boleto->getSeuNumero();
										if(isset($criouboleto)){

											$params=array(
											'boleto'=>"2"
											
											);
											if (isset($_GET['debug'])){ dump($params); }
											$DbExt->updateData("{{invoice}}",$params,'invoice_number',$row['invoice_number']);

							



										}
										else{

										}
										echo "\nGerando Boleto...\n";
										echo "<br>";
										echo "\n seuNumero: ".$boleto->getSeuNumero();
										echo "\n nossoNumero: ".$boleto->getNossoNumero();
										echo "\n codigoBarras: ".$boleto->getCodigoBarras();
										echo "\n linhaDigitavel: ".$boleto->getLinhaDigitavel();
									
										} catch ( ctodobom\APInterPHP\BancoInterException $e ) {
										echo "\n\n".$e->getMessage();
										echo "\n\nCabeçalhos: \n";
										echo $e->reply->header;
										echo "\n\nConteúdo: \n";
										echo $e->reply->body;
										}

										try {
										echo "\Download do PDF\n";
									//	echo $upload_path;
										// upload/boleto
										
										
										$pdf = $banco->getPdfBoleto($boleto->getNossoNumero(),'/home/u585332159/domains/scoopdelivery.com.br/public_html/upload/boleto/');
										$boletopdf = str_replace('/home/u585332159/domains/scoopdelivery.com.br/public_html/upload/boleto/','',$pdf);
										
										
										if(isset($boletopdf)){


											$params2=array(
											'pdf_boleto'=>$boletopdf

											);


											$DbExt->updateData("{{invoice}}",$params2,'invoice_number',$row['invoice_number']);
									
										}

										echo "\n\nSalvo PDF em ".$pdf."\n";
										} catch ( ctodobom\APInterPHP\BancoInterException $e ) {
										echo "\n\n".$e->getMessage();
										echo "\n\nCabeçalhos: \n";
										echo $e->reply->header;
										echo "\n\nConteúdo: \n";
										echo $e->reply->body;
										}
										echo "\n\n";

									}


								}



								else {
								if (isset($_GET['debug'])){ echo "no results"; }
								}


		}
	
	
	
	}
	
/* END CLASS*/