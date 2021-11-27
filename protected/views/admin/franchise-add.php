<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/franchiseAdd" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/franchise" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>

<div class="uk-width-1">
	<!--<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/Ratings/Do/Add" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default", "Add New") ?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/Ratings" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default", "List") ?></a>-->
</div> <?php
		if (isset($_GET['id'])) {
			if (!$data = FunctionsV3::getFranchise($_GET['id'])) {
				echo "<div class=\"uk-alert uk-alert-danger\">" .
					Yii::t("default", "Sorry but we cannot find what your are looking for.") . "</div>";
				return;
			}
		}
		?> <div class="spacer"></div>

<ul data-uk-tab="{connect:'#tab-content'}" class="uk-tab uk-active">
	<li class="uk-active"><a href="#"><?php echo t("Franquia") ?></a></li>
	<li class=""><a href="#"><?php echo Yii::t("default", "Responsável") ?></a></li>
</ul>
<div class="uk-panel uk-panel-box">
	<form class="uk-form uk-form-horizontal forms" id="forms"> <?php echo CHtml::hiddenField('action', 'addFranchise');
																FunctionsV3::addCsrfToken(false); ?>
		<?php echo CHtml::hiddenField('id', isset($_GET['id']) ? $_GET['id'] : ""); ?> <?php if (!isset($_GET['id'])) : ?>
			<?php echo CHtml::hiddenField("redirect", Yii::app()->request->baseUrl . "/admin/Franchise/") ?> <?php endif; ?> <ul class="uk-switcher uk-margin " id="tab-content">
			<li class="uk-active">
				<fieldset>
					<h2><?php echo t("Franquia") ?></h2>
					<div class="uk-form-row">

						<label class="uk-form-label"><?php echo Yii::t("default", "Razão social") ?></label>
						<?php
						echo CHtml::textField(
							'razaosocial',
							isset($data['razao_social']) ? $data['razao_social'] : "",
							array('class' => "uk-form-width-large", 'data-validation' => "required")
						)
						?>
					</div>
					<div class="uk-form-row">
						<label class="uk-form-label"><?php echo Yii::t("default", "CNPJ") ?></label>
						<?php
						echo CHtml::textField(
							'cnpj',
							isset($data['cnpj']) ? $data['cnpj'] : "",
							array(
							'class' => "uk-form-width-large abn",
							'maxlength'=>"18",
              				'minlength'=>"14", 
							'data-validation' => "required")
						)
						?>
					</div>
					<div class="uk-form-row">
						<label class="uk-form-label"><?php echo Yii::t("default", "Telefone comercial") ?></label>

						<?php
						echo CHtml::textField(
							'telefone',
							isset($data['telefone']) ? $data['telefone'] : "",
							array(
							'class' => "uk-form-width-large numeric_only telefonebr",
							'data-validation' => "required")
						)
						?>
					</div>
					<div class="uk-form-row">
						<label class="uk-form-label"><?php echo Yii::t("default", "Endereço comercial") ?></label>
						<?php
						echo CHtml::textField(
							'endereco',
							isset($data['endereco']) ? $data['endereco'] : "",
							array('class' => "uk-form-width-large", 'data-validation' => "required")
						)
						?>
					</div>
					<div class="uk-form-row">
						<label class="uk-form-label"><?php echo Yii::t("default", "CEP") ?></label>
						<?php

						echo CHtml::textField(
							'cep',
							isset($data['cep']) ? $data['cep'] : "",
							array(
							'class' => "uk-form-width-large cep",
							'data-validation' => "required")
						);

						?>
					</div>
                    
					 <div class="uk-form-row">
		              <label class="uk-form-label"><?php echo Yii::t("default", "Cidade atendida") ?></label>

		              <?php $size_list = Yii::app()->functions->cidadesList();
		              echo CHtml::dropDownList('cidadeatendida[]',
                        isset($data['cidade_atendida_id']) ? $data['cidade_atendida_id'] : "",$size_list
                        ,array(
                        'class' => "uk-form-width-large",
                        'data-validation'=>"required"
                        )) ?>
		              </div>
                    
					<div class="uk-form-row">
						<label class="uk-form-label"><?php echo Yii::t("default", "Estado") ?></label>

						<?php
						echo CHtml::textField(
							'estado',
							isset($data['estado']) ? $data['estado'] : "",
							array('class' => "uk-form-width-large", 'data-validation' => "required")
						)
						?>
					</div>
					<div class="uk-form-row">
						<label class="uk-form-label"><?php echo Yii::t("default", "Taxa") ?></label>

						<?php
						echo CHtml::textField(
							'taxa',
							isset($data['taxa']) ? $data['taxa'] : "",
							array('class' => "uk-form-width-medium numeric_only", 'data-validation' => "required")
						)
						?>
					</div>
					<div class="uk-form-row">
						<label class="uk-form-label"><?php echo Yii::t("default", "Status") ?></label>

						<?php echo CHtml::dropDownList(
							'status',
							isset($data['status']) ? $data['status'] : "",
							(array)statusDefault(),
							array(
								'class' => 'uk-form-width-large',
								'data-validation' => "required"
							)
						) ?>
					</div>
				</fieldset>
			</li>
			<li>
				<h2><?php echo t("Responsável") ?></h2>
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo Yii::t("default", "Nome") ?></label>

					<?php
					echo CHtml::textField(
						'nome',
						isset($data['nome_franqueado']) ? $data['nome_franqueado'] : "",
						array('class' => "uk-form-width-large", 'data-validation' => "required")
					)
					?>
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo Yii::t("default", "CPF") ?></label>

					<?php
					echo CHtml::textField(
						'cpf',
						isset($data['cpf_franqueado']) ? $data['cpf_franqueado'] : "",
						array(
						'class' => "uk-form-width-large numeric_only cpf",
						'data-validation' => "required")
					)
					?>
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo Yii::t("default", "RG") ?></label>

					<?php
					echo CHtml::textField(
						'rg',
						isset($data['rg_franqueado']) ? $data['rg_franqueado'] : "",
						array('class' => "uk-form-width-large numeric_only", 'data-validation' => "required")
					)
					?>
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo Yii::t("default", "Telefone responsável") ?></label>

					<?php
					echo CHtml::textField(
						'telefone_responsavel',
						isset($data['telefone_responsavel']) ? $data['telefone_responsavel'] : "",
						array('class' => "uk-form-width-large numeric_only", 'data-validation' => "required")
					)
					?>
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo Yii::t("default", "Email") ?></label>

					<?php
					echo CHtml::textField(
						'email_responsavel',
						isset($data['email_responsavel']) ? $data['email_responsavel'] : "",
						array('class' => "uk-form-width-large")
					)
					?>
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo Yii::t("default", "Endereço") ?></label>

					<?php
					echo CHtml::textField(
						'endereco_responsavel',
						isset($data['endereco_responsavel']) ? $data['endereco_responsavel'] : "",
						array('class' => "uk-form-width-large", 'data-validation' => "required")
					)
					?>
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label"><?php echo Yii::t("default", "Cidade") ?></label>

					<?php
					echo CHtml::textField(
						'cidade_responsavel',
						isset($data['cidade_responsavel']) ? $data['cidade_responsavel'] : "",
						array('class' => "uk-form-width-large", 'data-validation' => "required")
					)
					?>
				</div>
			</li>
			<li>
			</li>
		</ul>
		<div class="uk-form-row">
			<label class="uk-form-label"></label>
			<input type="submit" value="<?php echo Yii::t("default", "Save") ?>" class="uk-button uk-form-width-medium uk-button-success">
		</div>
	</form>


</div>