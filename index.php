<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Sistema de Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="css/login.css" rel="stylesheet" type="text/css">
        <script src="js/login.js" type="text/javascript"></script>
    </head>

    <body class="geral">
        <?php $value = filter_input_array(INPUT_GET, FILTER_DEFAULT);?>
        <img src="imagens/intranet.png" id="imgcabecalho"/>
        <div id="cabecalho">            
            <p id="p1">############################, <br/>####################################</p><br/>
                <p id="p2">#######</p>
                <img src="#"/>
        </div>
        <br/>
        <hr>
        <strong></strong><div id="form" align="left" class="formlogin">            
            <form action="src/verific.php" method="post" name="login" id="login"
                  AUTOCOMPLETE='ON' onsubmit="return valida()">
                <h1>Login</h1>
                <div class="margem">
                    <div id="user_div" onMouseOver="" onMouseOut=""> 
                        <!--<span id="user_div_span" class="dica">Digite sua identificação de usuário!</span> --->
                        <!--<img src="imagens/user.jpg" name="user_img" width="24" height="24" border="0" align="middle"/>-->
                        <label>Matricula:</label><br/>
                        <input name="usu" type="text" size="50" maxlength="50" id="user" class="cxtext" 
                               value="<?php echo $value['usu']; ?>">
                    </div>
                    <div id="pwd_div" onMouseOver="" onMouseOut=""> 
                        <label>Senha:</label><br/>
                        <input name="senha" type="password" size="50" maxlength="50" id="pwd" class="cxtext">
                    </div>
                    <div id="enter_img_div" onMouseOver="" onMouseOut=""> 
                        <!--<span id="enter_img_div_span" class="dica">Clique uma vez aqui para realizar 
                            sua autenticação!</span>-->
                        <input type="checkbox" name="lembrar" value="ON" /><label>Lembrar</label><br/><br/>
                        <input type="submit" value="Entrar">
                    </div>
                    
                </div>
                
            </form>
        </div>
        <br/><br/>
        <hr>
        <img src="#" id="rodape"/>
    </body>
</html>
