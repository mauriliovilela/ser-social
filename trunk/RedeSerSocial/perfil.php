<?php include('includes/header.php'); ?>        
<div id="amarra-center-left">

    <div class="center">

        <div class="blocos" id="deixar-recados">
            <h1><?php echo $user_nome . ' ' . $user_sobrenome ?>

                <?php
                if ($idDaSessao <> $idExtrangeiro) {
                    $e_meu_amigo = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
                    $e_meu_amigo->execute(array($idDaSessao, $idExtrangeiro, $idDaSessao, $idExtrangeiro));

                    if ($e_meu_amigo->rowCount() == 0) {
                        echo '<a href="php/amizade.php?ac=convite&de=' . $idDaSessao . '&para=' . $idExtrangeiro . '">adicionar amigo</a>';
                    } else {
                        $asstatusamizade = $e_meu_amigo->fetch(PDO::FETCH_ASSOC);
                        if ($asstatusamizade['status'] == 0) {
                            echo '<a href="php/amizade.php?ac=remover&id=' . $asstatusamizade['id'] . '&de=' . $idDaSessao . '&para=' . $idExtrangeiro . '">cancelar pedido</a>';
                        } else {
                            echo '<a href="php/amizade.php?ac=remover&id=' . $asstatusamizade['id'] . '&de=' . $idDaSessao . '&para=' . $idExtrangeiro . '">remover amigo</a>';
                        }
                    }
                }
                ?>

                <span></span></h1>

            <form name="dexar-recado" action="" method="post" enctype="multipart/form-data">
                <input type="text" class="inputTxt" name="recado" value="Deixe um recado para seus amigos"  onfocus="if(this.value=='Deixe um recado para seus amigos')this.value='';" onblur="if(this.value=='')this.value='Deixe um recado para seus amigos';" /><input class="inputSub" type="submit" value="postar" />
            </form>
        </div><!--blocos-->

        <div class="blocos" id="pagina">
            <h2>perfil</h2>


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