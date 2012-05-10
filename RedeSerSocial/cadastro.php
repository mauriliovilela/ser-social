<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>Rede Ser Social</title>
        <link rel="stylesheet" href="estilos/cadastro.css" type="text/css"/>
    </head>


    <body>
        <!--Início do Topo-->
        <div id="topo">
            <div class="cAlign">
                <a href="#" > <img src="images/logo.png" alt="Ser Social"> </a> <span> <a href="http://www.joaquimnabuco.edu.br/" target="_blank">Faculdade Joaquim Nabuco</a> </span>
            </div>
        </div>
        <!--Fim do Topo-->

        <!--Início do Conteúdo-->
        <div class="cAlign">
            <div id="content">

                <!-- Início do Conteúdo da Esquerda-->

                <div id="left">   
                    <ul>
                        <li>Sexo</li>
                        <li>Data de Nascimento</li>
                        <li>E-mail</li>
                        <li>Senha</li>
                    </ul>

                </div><!-- Fim do Conteúdo da Esquerda-->

                <!-- Início do Formulário-->
                <div id="formulario">
                    <form name="cadastro" method="post" action="cadastrar.php">
                        <div>
                            <div class="inputFloat">
                                <span>Nome</span>
                                <input type="text" name="nome" class="inputTxt"/>                                
                            </div>

                            <div class="inputFloat">
                                <span>Sobrenome</span>
                                <input type="text" name="sobrenome" class="inputTxt"/>                                
                            </div>

                        </div>

                        <span class="spanHide">Sexo</span>
                        <select name="sexo">
                            <option value="">Escolha seu sexo</option>
                        </select>

                        <span class="spanHide">Data de nascimento</span>
                        <select name="dia">
                            <option value="">Dia:</option>
                        </select>

                        <select name="mes">
                            <option value="">Mês:</option>
                        </select>

                        <select name="ano">
                            <option value="">Ano:</option>
                        </select>

                        <span>E-mail</span>
                        <input type="text" name="email" class="inputTxt"/> 

                        <span>Senha</span>
                        <input type="password" name="senha" class="inputTxt"/>

                        <div>
                            <div class="captchaFloat"><img src="#" width="200" height="60" alt="Captcha">
                            </div>
                            
                            <div class="captchaFloat">
                                <span>Digite os caracteres ao lado</span>
                                <input type="text" name="palavra" class="inputTxt"/>
                            </div>
                        </div>
                        <span>&nbsp;</span>
                        <input type="submit" value="" name="Cadastrar"/>
                    </form>
                </div><!-- Fim do Formulário-->

            </div>

        </div><!-- Fim do Conteúdo-->
    </body>





</html>