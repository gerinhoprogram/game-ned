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

    $pontos = strip_tags($_POST['score']);
    $acao = strip_tags($_POST['acao']);
    $usuario = strip_tags($_POST['usuario']);


	if($acao == 'score'){

		if($pontos){
		
				$sql = "INSERT INTO score (pontos, usuario) VALUES (:pontos, :usuario)";
				$stmt = $PDO->prepare($sql);
				$stmt->bindValue(':pontos', $pontos);
				$stmt->bindValue(':usuario', $usuario);
				$stmt->execute(); 

                require_once 'game.php';

		}

	}

	?>
	
</body>
</html>


