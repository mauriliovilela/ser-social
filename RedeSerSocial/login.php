<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>Rede Ser Social - Login</title>
        <link rel="stylesheet" href="estilos/cadastro.css" type="text/css"/>
    </head>
    <body>
        <div id="login">
            <?php
            if (isset($_POST['logar'])) {
                //Se logar, vai para o index, senão exibe o erro
                if ($objLogin->logar($_POST['email'], $_POST['senha'], $_POST['lembrar'])) {
                    header('location: ./');
                } else {
                    echo $objLogin->erro;
                }
            }
            ?> 

            <form name="login" enctype="multipart/form-data" action="" method="post">

                <input type="text" name="email"/>
                <input type="password" name="senha"/>
                <input type="checkbox" name="lembrar"/>
                <input type="submit" name="logar" value="logar"/>

            </form>

        </div>
    </body>
</html>