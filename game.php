<!DOCTYPE html>
<html lang="en">
<?php include ('header.php');
      $usuario_id = $_POST['usuario'];
      $carro = $_POST['carro'];

      if($carro){
        $sql = "UPDATE usuarios set carro_id = :carro_id where Id = :Id";
        $stmt = $PDO->prepare($sql);
        $stmt->bindValue(':carro_id', $carro);
        $stmt->bindValue(':Id', $usuario_id);
        $stmt->execute();
      }
     
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$titulo?></title>
</head>

<body>
    <?php
    $sql = "SELECT * FROM usuarios 
    left join carros on carros.carro_id = usuarios.carro_id
    where Id = :Id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':Id', $usuario_id);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {?>
        <?php $result = $stmt->fetch(); 
        // echo"<pre>";
        // print_r($result);
        // exit;
        ?>


        <style>
            .car {
                background: url('<?= $result['carro'] ?>');
                background-repeat: no-repeat;
                background-size: 100% 100%;
                height: <?= $result['altura'] ?>px;
                width: <?= $result['largura'] ?>px;
                position: absolute;
                top: 520px;
            }

            
.Opponents {
    background: url(core/imagens/oponent.png);
    background-repeat: no-repeat;
    background-size: 100% 100%;
    height: 100px;
    width: 50px;
    position: absolute;
    top: 900px;
}

.Opponent2 {
    background: url(core/imagens/oponent2.png);
    background-repeat: no-repeat;
    background-size: 100% 100%;
    height: 112px;
    width: 55px;
    position: absolute;
    top: 1500px;
}

.Opponent4 {
    background: url(core/imagens/oponent4.png);
    background-repeat: no-repeat;
    background-size: 100% 100%;
    height: 100px;
    width: 52px;
    position: absolute;
    top: 900px;
}

            
.gameArea {
    height: 100vh;
    width: 430px;
    margin: 0 auto;
    position: relative;
    background-color: #909090;
    overflow: hidden;
    border-left: 15px solid yellow;
    border-right: 15px solid yellow;
    z-index: 1;
}

.classificacao{
    position: absolute;
    top: 80px;
    left: 5px;
    text-align: left;
    background-color: rgb(100, 224, 156);
    width: 400px;
    color: rgb(59, 40, 40);
    line-height: 14pt;
    border-radius: 4px;
    font-size: 12pt;
}


.classificacao2{
    text-align: left;
    background-color: rgb(100, 224, 156);
    width: 60%;
    color: black;
    line-height: 14pt;
    border-radius: 4px;
    font-size: 12pt;
    padding: 10px;
    margin: 15px auto;
}


        </style>

        <div class="game">
            <div class="score" id="score"></div>
            <div class="highScore"></div>
            <div class="classificacao">
                <span style="font-size: 8pt">Um oferecimento de:</span> <img src="core/imagens/logo.png" width="120" alt="">
                <?php 
                   $sql = "SELECT a.Id, a.usuario, 
                   (select max(b.pontos) from score b left join usuarios on usuarios.Id = a.usuario WHERE b.usuario = a.usuario) as pts
                   from score a group by a.usuario order by pts desc";
                   $stmt = $PDO->prepare($sql);
                   $stmt->execute();

                    $cont=1;
                    echo"<table style='width: 100%; border: 1px solid black'>";
                    while($result = $stmt->fetch()){
                        $sql_2 = "SELECT nome FROM usuarios 
                            where Id = :Id";
                            $stmt_2 = $PDO->prepare($sql_2);
                            $stmt_2->bindValue(':Id', $result['usuario']);
                            $stmt_2->execute();
                            $result_2 = $stmt_2->fetch();
                            echo"<tr style='padding: 5px; border-bottom: 1px dashed'>
                                <td>".$cont."°</td><td> ".$result_2['nome']."</td><td>".$result['pts']."</td>
                                </tr>";
                            $cont++;
                    }
                    echo"</table>";
                ?>
            </div>
            <div class="startScreen">

                <h1>Leia as instruções!</h1><br>
                <p>Use as setas do teclado, para mover o carro!</p>
                <img src="core/imagens/setas.png" alt="" width="200">
                <p class="ClickToStart"><i class="lni lni-road" style="font-size: 25pt"></i> Race!</p>
                <div class="classificacao2" style=" height: 250px; overflow-y: auto;">

                    <?php 
                        $sql = "SELECT a.Id, a.usuario, 
                        (select max(b.pontos) from score b left join usuarios on usuarios.Id = a.usuario WHERE b.usuario = a.usuario) as pts
                        from score a group by a.usuario order by pts desc";
                        $stmt = $PDO->prepare($sql);
                        $stmt->execute();

                        $cont=1;
                        echo"<table style='width: 100%; border: 1px solid black;'>";
                        while($result = $stmt->fetch()){
                            $sql_2 = "SELECT nome FROM usuarios 
                            where Id = :Id";
                            $stmt_2 = $PDO->prepare($sql_2);
                            $stmt_2->bindValue(':Id', $result['usuario']);
                            $stmt_2->execute();
                            $result_2 = $stmt_2->fetch();
                            echo"<tr style='padding: 5px; border-bottom: 1px dashed'>
                                <td>".$cont."°</td><td> ".$result_2['nome']."</td><td>".$result['pts']."</td>
                                </tr>";
                            $cont++;
                        }
                        echo"</table>";
                    ?>
                </div>
            
            </div>
            <div class="startScreen2 hide">
                <h1>Game over</h1><br>
                <form action="envia-dados" method="post">
                        <label for="">Seus pontos</label><br>
                        <input type="text" name="score" id="campo_score" readonly require>
                        <input type="hidden" require name="acao" value="score">
                        <input type="hidden" require name="usuario" value="<?=$usuario_id?>"><br><br>
                        <h4>Deseja trocar de carro?</h4><br><br>
                        <?php 	
                                $sql = "SELECT * FROM carros";
                                $stmt = $PDO->prepare($sql);
                                $stmt->execute();
                                if ($stmt->rowCount() > 0) {
                                    while($result = $stmt->fetch()){?>


                                    <label for="<?=$result['carro_id']?>">

                                        <img src="<?=$result['carro']?>" alt="" width="40" style="border: 1px solid #ffff; padding: 5px; border-radius: 10px">
                                    </label>
                                    <input type="radio" <?=($result['carro_id'] == $carro ? 'checked' : '')?> name="carro" value="<?=$result['carro_id']?>" id="<?=$result['carro_id']?>">

                                        
                                    
                                    <?php }
                                }
                            
                        ?>
                        <br><br><input type="submit" class="enviar" value="Recomeçar">
                </form>
             
            </div>
            <div class="gameArea"></div>
        </div>
        <script src="core/mod_includes/js/game.js"></script>

    <?php } ?>

</body>

</html>