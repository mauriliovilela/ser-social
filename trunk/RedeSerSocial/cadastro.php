<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>Rede Ser Social - Cadastro</title>
        <link rel="stylesheet" href="estilos/cadastro.css" type="text/css"/>
        <script type="text/javascript" src="js/validacoes.js"></script>

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
                    if (isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST') {

                        extract($_POST);

                        echo '<h3>';

                        if ($nome == '' OR strlen($nome) < 4) {
                            echo 'Escreva seu nome corretamente';
                        } elseif ($sobrenome == '' OR strlen($sobrenome) < 4) {
                            echo 'Escreva seu sobrenome corretamente';
                        } elseif ($matricula == '' OR strlen($matricula) < 8) {
                            echo 'Digite corretamente a sua matricula';
                        } elseif (strlen($matricula) > 8) {
                            echo 'A sua matrícula não pode ser maior que 8 digitos!';
                        } elseif ($email == '') {
                            echo 'Escreva seu e-mail';
                        } elseif (!preg_match("/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,4}$/i", $email)) {
                            echo 'Este e-mail é invalido';
                        } else {

                            include('classes/DB.class.php');

                            try {

                                $verificar = DB::getConn()->prepare("SELECT `id` FROM `usuarios` WHERE `email`=?");
                                if ($verificar->execute(array($email))) {
                                    if ($verificar->rowCount() >= 1) {
                                        echo 'Este e-mail ja esta cadastrado em nosso sistema';
                                    } elseif ($senha == '' OR strlen($senha) < 4) {
                                        echo 'Digite sua senha, ela tem de ter mais de 4 caracteres';
                                    }
                                    //elseif(strtolower($captcha) <> strtolower($_SESSION['captchaCadastro'])){
                                    //echo 'O código digitado no captcha não corresponde com a imagem';
                                    //}
                                    else {
                                        $senhaInsert = sha1($senha);
                                        $nascimento = "$ano-$mes-$dia";

                                        $inserir = DB::getConn()->prepare("INSERT INTO `usuarios` SET `email`=?, `senha`=?, `nome`=?, `matricula`=?,`sobrenome`=?, `sexo`=?, `nascimento`=?, `cadastro`=NOW()");

                                        if ($inserir->execute(array($email, $senhaInsert, $nome, $matricula, $sobrenome, $sexo, $nascimento))) {
                                            header('Location: ./');
                                        }
                                    }
                                }
                            } catch (PDOException $e) {
                                echo 'Sistema indisponível';
                                logErros($e);
                            }
                        }
                        echo '</h3>';
                    }
                    ?>
                    <form name="cadastro" method="post" action="">
                        <div>
                            <div class="inputFloat">
                                <span>Nome *</span>
                                <input type="text" name="nome" class="inputTxt" value="<?php if (isset($nome)) echo $nome; ?>"/>                                
                            </div>

                            <div class="inputFloat">
                                <span>Sobrenome *</span>
                                <input type="text" name="sobrenome" class="inputTxt"value="<?php if (isset($sobrenome)) echo $sobrenome; ?>"/>                                
                            </div>

                            <div class="inputFloat">
                                <span>Matrícula *</span>
                                <input type="text" name="matricula" class="inputTxt" id="inumeros" onkeypress="mascara(this,soNumeros)" value="<?php if (isset($matricula)) echo $matricula; ?>"/>                                
                            </div>

                        </div>
                        

                        <span class="spanHide">Eu sou</span>
                        <select name="sexo">
                            <option <?php if ($sexo == 'homem') echo 'selected="selected"'; ?> value="homem">Homem&nbsp;</option>
                            <option <?php if ($sexo == 'mulher') echo 'selected="selected"'; ?>value="mulher">Mulher&nbsp;</option>
                            <option <?php if ($sexo == 'travesti') echo 'selected="selected"'; ?>value="travesti">Travesti&nbsp;</option>
                            <option <?php if ($sexo == 'viado') echo 'selected="selected"'; ?>value="viado">Viado&nbsp;</option>
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

                                <!-- <span class="spanHide">Verificação contra fraudes</span>
                                <div>
                                <div class="captchaFloat"><img src="captcha/captcha.php" width="200" height="60" alt="Captcha">
                                </div>

                                <div class="inputFloat">
                                <span>Digite os caracteres</span>
                                <input type="text" name="captcha" class="inputTxt"/>
                                        </div>
                                        </div>-->
                        <span>&nbsp;</span>
                        <input type="submit" value="" class="submitCadastro" name="Cadastrar"/>
                        <span class="campos">* Campos obrigatórios</span><br/><br/>
                        
                    </form>
                </div><!-- Fim do Formulário-->

            </div><!-- Fim do Conteúdo-->

        </div><!--Fim do cAlign-->

        <!--Início do Rodapé-->
        <?php include('includes/footer.php'); ?><!--Fim do Rodapé-->
    </body>

</html>
