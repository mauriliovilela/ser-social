<?php
include ('classes/DB.class.php');
include ('classes/Login.class.php');

$objLogin = new Login;

//Se não estiver logan, será incluso a página de login
if (!$objLogin->logado()) {
    include ('login.php');
    exit();
}

if (true == $_GET['sair']) {
    $objLogin->sair();
    header('Location: ./');
}

$dados = $objLogin->getDados($_SESSION['sersocial_usuario']);

if (!isset($dados)) {
    extract($dados, EXTR_PREFIX_ALL, 'user');
} else {
    header('Location: ./');
}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>Rede Ser Social - Home</title>
        <link rel="stylesheet" href="estilos/cadastro.css" type="text/css"/>
    </head>
    <body>
        Logado: <a href="?sair=true">sair</a> 
    </body>
</html>