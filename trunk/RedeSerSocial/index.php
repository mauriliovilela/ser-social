<?php include('includes/header.php'); ?>        
<div id="amarra-center-left">

    <div class="center">

        <div class="blocos" id="deixar-recados">
            <h1><?php echo $user_nome . ' ' . $user_sobrenome ?></h1>

            <form name="dexar-recado" action="" method="post" enctype="multipart/form-data">
                <input type="text" class="inputTxt" name="recado" value="Deixe um recado para seus amigos"  onfocus="if(this.value=='Deixe um recado para seus amigos')this.value='';" onblur="if(this.value=='')this.value='Deixe um recado para seus amigos';" /><input class="inputSub" type="submit" value="postar" />
            </form>
        </div><!--blocos-->

        <div class="blocos" id="pagina">
            <h2>atualizações</h2>

            <?php
            $e_meu_amigo = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE para=? AND `status`=0');

            $dadosamizade = DB::getConn()->prepare('SELECT `nome` FROM `usuarios` WHERE `id`=? LIMIT 1');

            $e_meu_amigo->execute(array($idDaSessao));
            if ($e_meu_amigo->rowcount() > 0) {
                echo '<ul >';
                while ($resmeuamigo = $e_meu_amigo->fetch(PDO::FETCH_ASSOC)) {

                    $dadosamizade->execute(array($resmeuamigo['de']));
                    $asdadosamizade = $dadosamizade->fetch(PDO::FETCH_ASSOC);

                    echo '<li >' . $asdadosamizade['nome'] . ' ' . $asdadosamizade['sobrenome'] . ' quer ser seu amigo(a) <a href="php/amizade.php?ac=aceitar&id=' . $resmeuamigo['id'] . '">aceitar</a> <a href="php/amizade.php?ac=remover&id=' . $resmeuamigo['id'] . '&de=' . $resmeuamigo['de'] . '&para=' . $idDaSessao . '">recusar</a></li>';
                }
                echo '</ul>';
            }
            ?>

        </div><!--blocos-->

    </div><!--center-->

    <div class="right">

        <div class="blocos" id="publicidade">
            <iframe width="300" height="250" src="http://www.youtube.com/embed/mx2ZOdKSd90" frameborder="0" allowfullscreen></iframe>
        </div><!--blocos-->

        <?php include('includes/amigos.php'); ?>

    </div><!--right-->


</div><!--amarra-center-left-->

<?php include('includes/footer.php'); ?>