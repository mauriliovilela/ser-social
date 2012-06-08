<?php include('includes/header.php'); ?>        
<div id="amarra-center-left">

    <div class="center">

        <div class="blocos" id="pagina">
            <h2><?php echo ($idDaSessao <> $idExtrangeiro) ? 'Atualizações de ' . $user_fullname : 'Minhas Atualizações'; ?></h2>
            <?php include ('includes/form_recados.php'); ?>
            <?php
            $solicitacoes = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE para=? ANd `status`=0');
            $solicitacoes->execute(array($idDaSessao));

            $dadosamizade = DB::getConn()->prepare('SELECT `nome`,`sobrenome` FROM `usuarios` WHERE `id`=? LIMIT 1');

            if ($solicitacoes->rowcount() > 0) {
                $link = '<a href="php/amizade.php?ac=';
                echo '<ul>';
                while ($resmeuamigo = $solicitacoes->fetch(PDO::FETCH_ASSOC)) {

                    $dadosamizade->execute(array($resmeuamigo['de']));
                    $asdadosamizade = $dadosamizade->fetch(PDO::FETCH_ASSOC);

                    echo '<li>' . $asdadosamizade['nome'] . ' ' . $asdadosamizade['sobrenome'] . ' quer ser seu amigo ' .
                    $link . 'aceitar|' . $resmeuamigo['id'] . '">aceitar</a> ' .
                    $link . 'remover|' . $resmeuamigo['de'] . '|' . $idDaSessao . '|' . $resmeuamigo['id'] . '">recusar</a></li>';
                }
                echo '</ul>';
            }
            ?>

        </div><!--blocos-->

    </div><!--center-->

    <div class="right">

        <?php include('includes/amigos.php'); ?>

    </div><!--right-->


</div><!--amarra-center-left-->

<?php include('includes/footer.php'); ?>