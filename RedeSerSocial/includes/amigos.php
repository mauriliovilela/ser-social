<div class="blocos" id="meus-amigos">

    <?php
      require_once('classes/DB.class.php');
    $selAmigos = DB::getConn()->prepare('SELECT u.id, u.nome, u.sobrenome, u.imagem FROM usuarios u 
									INNER JOIN amizade a ON (((u.id=a.de) AND (a.para=?)) OR ((u.id=a.para) AND (a.de=?))) AND a.status=1');

    $selAmigos->execute(array($idExtrangeiro, $idExtrangeiro));

    $numamigos = $selAmigos->rowCount();
    ?>

    <span>Meus amigos(<?php echo $numamigos ?>) <a href="#">Todos</a></span>
    <ul>
        <?php
        if ($numamigos > 0) {

            while ($resAmigos = $selAmigos->fetch(PDO::FETCH_NUM)) {

                $imagemamigo = (file_exists('/uploads/usuarios/' . $resAmigos[3])) ? $resAmigos[3] : 'default.png';

                echo '<li><a href="perfil.php?uid=' . $resAmigos[0] . '"><img src="uploads/usuarios/' . $imagemamigo . '" alt="" title="' . $resAmigos[1] . ' ' . $resAmigos[2] . '" /></a></li>';
            }
        } else {
            echo 'Você não tem amigos';
        }
        ?>
    </ul>
</div><!--blocos-->