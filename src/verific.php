<?php

set_time_limit(0);

function valida_ldap($srv, $usr, $pwd) {

    $ldap_server = $srv;
    $auth_user = $usr;
    $auth_pass = $pwd;
    // Tenta se conectar com o servidor
    $ad = ldap_connect($ldap_server)
            or die("Não foi possivel Conectar ao Servidor!");
    // Versao do protocolo       
    ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
    // Usara as referencias do servidor AD, neste caso nao
    ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);
    // Tenta autenticar no servidor
    $bind = ldap_bind($ad, $auth_user, $auth_pass);
    // se nao validar retorna false

    if ($bind) {
        return true;
    } else {
        return false;
    }
}
//Função para buscar grupos do usuario autenticado no AD
function busca_grupos($conn, $auth_user, $pass, $user) {

    $ad = ldap_connect($conn)
            or die("Não foi possivel Conectar ao Servidor!");
    // Versao do protocolo       
    ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
    // Usara as referencias do servidor AD, neste caso nao
    ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);
    // Tenta autenticar no servidor
    ldap_bind($ad, $auth_user, $pass);
    // se nao validar retorna false
    //filtro de busca ldap
    $filter = "sAMAccountName=$user";
    //base DN
    $base_dn = "DC=####, DC=###, DC=##";
    //busca no ldap
    $search = ldap_search($ad, $base_dn, $filter) or die("Erro ao buscar grupos" . ldap_error($ad));
    //retorna os valores adquiridos na busca
    return ldap_get_entries($ad, $search);
}
//Função para criar um explode de varios parametros
function multiexplode($delimiters, $string) {
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return $launch;
}

//Filtrando entradas vindas do formulario via POST
$filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (isset($filtro['usu'])) {
    $dominio = "####\\";
    $usu = $dominio . $filtro['usu'];
    $senha = $filtro['senha'];
    $ip_server = "##.##.##.##";
}

//Chamando funcão valida_ldap, se verdadeira abre sessao e guarda informações do usuario e abre a aplicação
//Se falsa retor o usuario para a tela de login
if (valida_ldap($ip_server, $usu, $senha)) {
    session_start();
    $info = busca_grupos($ip_server, $usu, $senha, $filtro['usu']);
    $_SESSION['grupos'] = Array();
    $_SESSION['usu'] = $filtro['usu'];
    //salva nome completo do usuario autenticado na sessao
    $_SESSION['nome'] = $info[0]["cn"][0];
    //criar um array para guardar todos os grupos do usuario
    $grupos = Array();
    //filtro para aparecer somente o nome do grupo
    for ($i = 0; $i < $info[0]["memberof"]["count"]; $i++) {
        $explode = multiexplode(array("=", ","), $info[0]["memberof"][$i]);
        $grupos[] = $explode[1];
    }
    //salvando grupos dentro de um array da sessão
    for ($i = 0; $i < sizeof($grupos); $i++) {
        array_push($_SESSION['grupos'], "$grupos[$i]");
    }
    //redirecionado para aplicação
    header("Location: ../src/aplicacao.php");
} else {
    echo "<script>alert('Usuario ou Senha Invalido!');</script>";
    echo '<script>window.location.href="../index.php?usu=' . $filtro['usu'] . '"</script>';
}

