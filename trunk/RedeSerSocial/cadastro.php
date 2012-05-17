<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>Rede Ser Social - Cadastro</title>
        <link rel="stylesheet" href="estilos/cadastro.css" type="text/css"/>
    </head>

    <body>
        <!--Início do Topo-->
        <div id="topo">
            <div class="cAlign">
                <a href="http://www.joaquimnabuco.edu.br/" > <img src="images/logo.png" alt="Ser Social"> </a>  <!--<span><a href="http://www.joaquimnabuco.edu.br/" >Joaquim Nabuco</a> </span><span><a href="http://www.joaquimnabuco.edu.br/" >Facebook</a> </span> <span><a href="http://www.mauriciodenassau.edu.br/" >Faculdade Maurício de Nassau</a> </span>--></div>
        </div>
        <!--Fim do Topo-->


        <div class="cAlign">
            <!--Início do Conteúdo-->
            <div id="content">

                <h1>Cadastre-se!</h1>
                <!-- Início do Formulário-->
                <div id="formulario">
                    <?php
                    if (isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST')
                        extract($_POST);
                    //Mudar essas verificações (fazer com javascript)
                    if ($nome == '' or strlen($nome) < 3) {
                        echo 'Digite seu nome corretamente!';
                    } elseif ($sobrenome == '' or strlen($sobrenome) < 5) {
                        echo 'Digite seu sobrenome corretamente!';
                    } elseif ($email == '') {
                        echo 'Digite seu e-mail!';
                    } elseif (!preg_match("/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,4}$/i", $email)) {
                        echo 'Digite um e-mail válido!';
                    } else {
                        include ('classes/DB.class.php');
                        $verificar = DB::getConn()->prepare("SELECT `id` FROM `usuarios` WHERE `email`=?");
                        if ($verificar->execute(array($email))) {
                            if ($verificar->rowCount() >= 1) {
                                echo 'Este e-mail já está cadastrado em nosso sistema';
                            } elseif ($senha == '') {
                                echo 'Digite sua senha!';
                            } elseif (strlen($senha) <= 4) {
                                echo 'A senha deve conter mais que 4 caracteres';
                            }
                            //Consertar o Captcha
                            ////elseif (strtolower($captcha) <> strtolower($_SESSION['captchaCadastro'])) {
                            //echo 'O código digitado não corresponde a imagem! ';
                            //echo $captcha;
                            // } else {
                            $nascimento = "$ano-$mes-$dia";
                            $senhaInsert = sha1($senha);
                            $inserir = DB::getConn()->prepare("INSERT INTO`usuarios` SET `email`=?,`senha`=?, `nome`=?, `sobrenome`=?,`sexo`=?,`nascimento`=?, `cadastro`=NOW()");
                            if ($inserir->execute(array($email, $senhaInsert, $nome, $sobrenome, $sexo, $nascimento))) {
                                header('Location ./');
                            }
                        }
                    }
                    ?>
                    <form name="cadastro" method="post" action="">
                        <div>
                            <div class="inputFloat">
                                <span>Nome</span>
                                <input type="text" name="nome" class="inputTxt" value="<?php if (isset($nome)) echo $nome; ?>"/>                                
                            </div>

                            <div class="inputFloat">
                                <span>Sobrenome</span>
                                <input type="text" name="sobrenome" class="inputTxt"value="<?php if (isset($sobrenome)) echo $sobrenome; ?>"/>                                
                            </div>
                            <!--
                                                      <div class="inputFloat">
                                                            <span>Matrícula</span>
                                                            <input type="text" name="matricula" class="inputTxt"/>                                
                                                        </div>-->

                        </div>

                        <span class="spanHide">Eu sou</span>
                        <select name="sexo">
                            <option <?php if ($sexo == 'homem') echo 'selected="selected"'; ?> value="homem">Homem&nbsp;</option>
                            <option <?php if ($sexo == 'mulher') echo 'selected="selected"'; ?>value="mulher">Mulher&nbsp;</option>
                            <option <?php if ($sexo == 'travesti') echo 'selected="selected"'; ?>value="travesti">Travesti&nbsp;</option>
                            <option <?php if ($sexo == 'sapatao') echo 'selected="selected"'; ?>value="sapatao">Sapatão&nbsp;</option> 
                        </select>

                        <span class="spanHide">Data de nascimento</span>
                        <select name="dia">
                            <?php
                            for ($d = 1; $d <= 31; $d++) {

                                if ($d < 10) {
                                    $zero = 0;
                                }
                                else
                                    $zero = '';
                                if ($zero . $d == $dia) {
                                    echo '<option selected="selected" value="', $zero, $d, '">', $zero, $d, ' &nbsp;</option>';
                                } else {
                                    echo '<option value="', $zero, $d, '">', $zero, $d, ' &nbsp;</option>';
                                }
                            }
                            ?>
                        </select>


                        <select name="mes">
                            <?php
                            $meses = array('', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');

                            for ($m = 1; $m <= 12; $m++) {

                                $zero = ($m < 10) ? 0 : '';
                                if ($zero . $m == $mes) {
                                    echo '<option selected="selected" value="', $zero, $m, '">', $meses[$m], ' &nbsp;</option>';
                                } else {
                                    echo '<option value="', $zero, $m, '">', $meses[$m], ' &nbsp;</option>';
                                }
                            }
                            ?>
                        </select>

                        <select name="ano">
                            <?php
                            for ($a = date('Y'); $a >= (date('Y') - 100); $a--) {
                                if ($a == $ano) {
                                    echo '<option selected="selected" value="', $a, '">', $a, '</option>';
                                } else {
                                    echo '<option value="', $a, '">', $a, '</option>';
                                }
                            }
                            ?>

                        </select>

                        <span class="spanHide">E-mail</span>
                        <input type="text" name="email" class="inputTxt" value="<?php echo $email; ?>"/> 

                        <span class="spanHide">Senha</span>
                        <input type="password" name="senha" class="inputTxt" value="<?php echo $senha; ?>"/>

                        <span class="spanHide">Verificação contra fraudes</span>
                        <div>
                            <div class="captchaFloat"><img src="captcha/captcha.php" width="200" height="60" alt="Captcha">
                            </div>

                            <div class="inputFloat">
                                <span>Digite os caracteres</span>
                                <input type="text" name="palavra" class="inputTxt"/>
                            </div>
                        </div>
                        <span>&nbsp;</span>
                        <input type="submit" value="" class="submitCadastro" name="Cadastrar"/>
                    </form>
                </div><!-- Fim do Formulário-->

            </div><!-- Fim do Conteúdo-->

        </div><!--Fim do cAlign-->

        <!--Início do Rodapé-->
        <div id="footer">
            <p>&COPY; Copyright - <a href="#" target="_blank">Ser Social 2012</a> - Todos os Direitos Reservados</p>
            <p><a href="#" target="_blank">Sobre</a> - <a href="#" target="_blank">Desenvolvedores</a> · <a href="#" target="_blank">Privacidade</a> · <a href="#" target="_blank">Termos</a> · <a href="#" target="_blank">Ajuda</a>
        </div><!--Fim do Rodapé-->
    </body>

</html>
