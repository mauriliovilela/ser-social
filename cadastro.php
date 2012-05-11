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
                <a href="http://www.joaquimnabuco.edu.br/" > <img src="images/logo.png" alt="Ser Social"> </a>  <span><a href="http://www.joaquimnabuco.edu.br/" >Joaquim Nabuco</a> </span><span><a href="http://www.joaquimnabuco.edu.br/" >Facebook</a> </span> <span><a href="http://www.joaquimnabuco.edu.br/" >Google</a> </span></div>
        </div>
        <!--Fim do Topo-->


        <div class="cAlign">
            <!--Início do Conteúdo-->
            <div id="content">

                <!-- Início do Conteúdo da Esquerda-->

                <div id="left">   
                    <ul>
                        <li>Sexo</li>
                        <li>Data de Nascimento</li>
                        <li>E-mail</li>
                        <li>Senha</li>
                        <li>Verificação contra fraudes</li>
                    </ul>

                </div><!-- Fim do Conteúdo da Esquerda-->
                <h1>Cadastre-se!</h1>
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
                            
                            <div class="inputFloat">
                                <span>Matrícula</span>
                                <input type="text" name="matricula" class="inputTxt"/>                                
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

                        <span class="spanHide">E-mail</span>
                        <input type="text" name="email" class="inputTxt"/> 

                        <span class="spanHide">Senha</span>
                        <input type="password" name="senha" class="inputTxt"/>

                        <span class="spanHide">Verificação contra fraudes</span>
                        <div>
                            <div class="captchaFloat"><img src="#" width="200" height="60" alt="Captcha">
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
        </div><!--Fim do Rodapé-->
    </body>

</html>