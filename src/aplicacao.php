<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php
        /* esse bloco de código em php verifica se existe a sessão,
         *  pois o usuário pode simplesmente não fazer o login e digitar 
         * na barra de endereço do seu navegador o caminho para a 
         * página principal do site (sistema), burlando assim a 
         * obrigação de fazer um login, com isso se ele não 
         * estiver feito o login não será criado a session, 
         * então ao verificar que a session não existe a 
         * página redireciona o mesmo para a index.php.
         */
        session_start();
        //$token = md5(session_id());
        if ((!isset($_SESSION['usu']) == true)) {
            unset($_SESSION['usu']);
            unset($_SESSION['senha']);
            echo "<script>alert('É preciso estar logado!');</script>";
            echo "<script>window.location.href='../index.php'</script>";
        }
        $nome = $_SESSION['nome'];
        ?>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo "Bem-Vindo <b>$nome</b> <br/><br/> <b>Seus Grupos São: </b><br/><br/>";
        foreach ($_SESSION['grupos'] as $key) {
            echo $key . '<br/>';
        }
        echo '<br/><a href="logout.php?token=' . md5(session_id()) . '">Sair</a>';
        ?>

    </body>
</html>
