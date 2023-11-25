<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include ('header.php');?>
	<title><?=$titulo?></title>
	<script type="text/javascript" src="core/mod_includes/js/jquery-1.8.3.min.js"></script>
</head>
<body>
    <?php
    include('core/mod_includes/php/funcoes-jquery.php');
	date_default_timezone_set('America/Sao_Paulo');
	$data_criacao = date('d/m/y');

    $nome = strip_tags($_POST['nome']);
	$acao = strip_tags($_POST['acao']);

	if($acao == 'cadastrar'){

		if($nome){
			$sql = "SELECT * FROM usuarios 
			where nome = :nome";
			$stmt = $PDO->prepare($sql);
			$stmt->bindValue(':nome', $nome);
			$stmt->execute();
			
			if ($stmt->rowCount() > 0) {

				$dados['nome_erro_cadastrar'] = 'Este nome já existe!.';
				require_once 'index.php';

			}else{

				$sql = "INSERT INTO usuarios (data_criacao, nome) VALUES (:data_criacao, :nome)";
				$stmt = $PDO->prepare($sql);
				$stmt->bindValue(':data_criacao', $data_criacao);
				$stmt->bindValue(':nome', $nome);
				$stmt->execute(); 
				
				$sql = "SELECT * FROM usuarios
				where nome = :nome";
				$stmt = $PDO->prepare($sql);
				$stmt->bindValue(':nome', $nome);
				$stmt->execute();
				
				$result = $stmt->fetch();
				?>

				<div class="linha home">
					<div class="colunas lg-12 md-12 pq-112">
						<div class="content">
							<h3>Olá, <?=$nome?>! Cadastro realizado com sucesso! </h3><br><br>
							<form action="game" method="post">
									<input type="hidden" required value="<?=$result['Id']?>" name="usuario" >
									<br>

									<?php 
									
										$sql = "SELECT * FROM carros";
										$stmt = $PDO->prepare($sql);
										$stmt->execute();
										if ($stmt->rowCount() > 0) {
											$cont = true;
											while($result = $stmt->fetch()){?>

											
											<label for="<?=$result['carro_id']?>" style="border-radius: 40px; padding: 3px; border: 1px dashed black; display: inline " >
												<img src="<?=$result['carro']?>" alt="" width="60" style="margin-top: 10px">
											</label>
												
											<input type="radio" <?=($cont ? 'checked' : '')?> name="carro" value="<?=$result['carro_id']?>" id="<?=$result['carro_id']?>">
											
											
											<?php $cont = false; }
										}
									
									?>

									<br><br><br><br><input class="enviar" type="submit" value="Click para começar!">

								</form>
						</div>
					</div>
				</div>
				
			<?php }

		}else{
			$dados['nome_erro_logar'] = 'cadastro não encontrado!.';
			require_once 'index.php';
		}


	}else{
		if($acao == 'logar'){

			if($nome){

				$sql = "SELECT * FROM usuarios 
				where nome = :nome";
				$stmt = $PDO->prepare($sql);
				$stmt->bindValue(':nome', $nome);
				$stmt->execute();
				
				if ($stmt->rowCount() > 0) {
					$result = $stmt->fetch();
					?>

					<div class="linha home">
						<div class="colunas lg-12 md-12 pq-112">
							<div class="content">
								<h3>Olá, <?=$result['nome']?>! Escolha seu carro.</h3><br><br>
								<form action="game" method="post">
									<input type="hidden" required value="<?=$result['Id']?>" name="usuario" >
									<br>

									<?php 
									
										$sql = "SELECT * FROM carros";
										$stmt = $PDO->prepare($sql);
										$stmt->execute();
										if ($stmt->rowCount() > 0) {
											$cont = true;
											while($result = $stmt->fetch()){?>

											
											<label for="<?=$result['carro_id']?>" style="border-radius: 40px; padding: 3px; border: 1px dashed black; display: inline " >
												<img src="<?=$result['carro']?>" alt="" width="60" style="margin-top: 10px">
											</label>
												
											<input type="radio" <?=($cont ? 'checked' : '')?> name="carro" value="<?=$result['carro_id']?>" id="<?=$result['carro_id']?>">
											
											
											<?php $cont = false; }
										}
									
									?>

									<br><br><br><br><input class="enviar" type="submit" value="Click para começar!">

								</form>
							</div>
						</div>
					</div>
					
				<?php }else{

					$dados['nome_erro_logar'] = 'cadastro não encontrado!.';
					require_once 'index.php';
				}

			}else{
				$dados['nome_erro_logar'] = 'cadastro não encontrado!.';
				require_once 'index.php';
			}

			
		}else{
			$dados['nome_erro_logar'] = 'cadastro não encontrado!.';
			require_once 'index.php';
		}

		
	}


	?>
	
</body>
</html>


