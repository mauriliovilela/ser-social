<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Ser Social - Login</title>
        <style type="text/css">		
            body{ background:#ededed;}
            *{ margin:0; padding:0;}
            div#login{ width:240px; left:50%; height:310px; top:50%; margin-top:-155px; position:absolute; margin-left:-125px;}
            div.boxLogin{ padding:10px; background:#fff; margin-bottom:15px;}
            div#login span{ display:block; margin-top:10px; color:#666;}
            div.boxLogin a{ color:#900;}
            div.boxLogin h5{ display:block; text-align:center; color:#ac208d; font-size:18px; font-family:Arial, Helvetica, sans-serif; font-weight:normal;}
            div#login input#t{ border:1px solid #ccc; padding:5px; background:#FFF; width:94.5%;}
            div#login input[type="submit"]{ background:#ac208d; color:#FFF; padding:2px 5px; border:1px solid #999; cursor:pointer;}
            div.boxLogin2{ text-align:center;}
            div.boxLogin2 h5{ color:#fff; font-weight:normal; font-size:16px; display:block; background:#ac208d;}
            div.boxLogin2 a{ border-radius:5px; background:#2b9fe5; color:#FFF; padding:5px 10px; text-decoration:none; position:absolute; left:50%; margin-left:-62px; box-shadow:0 0 3px #000; margin-top:10px;}
        </style>
    </head>

    <body>    
        <div id="login">
            <img src="images/logo.png" alt="" />
            <div class="boxLogin">
                <h5>Acesse sua conta</h5>
                <span>
                    <?php
                     require_once('classes/Login.class.php');
                      extract($_POST);
                 
                    
    
                    if (isset($_POST['logar'])){
                     
                    $login = new Login();	
                    $login->setSenha($_POST['senha']);
                    $login->setUsuario($_POST['email']);
                    if (!isset($_POST['lembrar'])){
                        $_POST['lembrar']=false;
                    }
                    $login->setLembrar($_POST['lembrar']);
                        if ($login->logar()) {
                            echo "<script>alert('Login efetuado com sucesso!');document.location='perfil.php'</script>";                       
                            exit;
                        } else {
                        echo "<script>alert('Por favor verifique se os dados informados estão corretos!');document.location='login.php'</script>";                        }
                    }
                    ?>
                </span>            
                <form name="login" method="post" enctype="multipart/form-data" action="">
                    <span>E-mail:</span>
                    <input id="emailId" type="text" name="email" />
                    <span>Senha:</span>
                    <input id="senhaId" type="password" name="senha" />
                    <span></span>
                    <input type="checkbox" value ="false" name="lembrar" />
                    Lembrar<span></span>
                    <input type="submit" name="logar" value="Entrar" />
                </form>
            </div><!--boxLogin-->

            <div class="boxLogin2">
                <h5>Ainda não é cadastrado?</h5>
                <h4><a href="cadastro.php">Cadastre-se!</a></h4>
            </div><!--box login-->
        </div><!--login-->
    </body>
</html>