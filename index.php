<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<meta http-equiv="Content-Language" content="pt-br">

<head>
    <?php include ('header.php'); ?>
    <title>
       <?=$titulo?>
    </title>
    <style>
        
        html,
        body {
            overflow: hidden;
        }
    </style>

</head>

<body>
    
    <main>
        <div class="linha home">
            <div class="colunas lg-12 md-12 pq-112">
                <div class="content">
                    <h1>
                        <?=$titulo?>
                    </h1><br><br>
                    <form action="envia-contato" method="post">
                        <label for="">Já tem uma conta?</label><br>
                        <input type="hidden" name="acao" value="logar">
                        <input class="nome" placeholder="Insira seu nickname" type="text" name="nome" required maxlength="20"><br><br>
                        <p class="error">
                            <?=$dados['nome_erro_logar'] ?>
                        </p>
                        <input class="enviar" type="submit" value="Logar">
                    </form>
                    <br>
                    <hr>
                    <br>
                    <form action="envia-contato" method="post">
                        <label for="">Não tem conta?</label><br>
                        <input type="hidden" name="acao" value="cadastrar">
                        <input class="nome" placeholder="Seu nickname aqui" type="text" name="nome" required maxlength="20"><br><br>
                        <p class="error">
                            <?=$dados['nome_erro_cadastrar'] ?>
                        </p>
                        <input class="enviar" type="submit" value="Cadastrar">
                    </form>
                </div>

            </div>
        </div>
        <img class="carro" src="carro1.png" alt="">
        <img class="carro2" src="carro2.png" alt="">
        <img class="carro3" src="carro3.png" alt="">
        <img class="carro9" src="carro9.png" alt="">
        <img class="carro6" src="carro6.png" alt="">
    </main>

</body>

</html>