<?php

class Amizade extends DB {

    static function list_amigos($idExtrangeiro) {
        $selAmigos = self::getConn()->prepare('SELECT u.id, u.nome, u.sobrenome, u.imagem FROM usuarios u 
									INNER JOIN amizade a ON (((u.id=a.de) AND (a.para=?)) OR ((u.id=a.para) AND (a.de=?))) AND a.status=1');

        $selAmigos->execute(array($idExtrangeiro, $idExtrangeiro));

        $d['num'] = $selAmigos->rowCount();

        $d['dados'] = $selAmigos->fetchAll();

        return $d;
    }

}

?>
