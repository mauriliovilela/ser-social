<?php

class DB {

    private static $conn;

    static function getConn() {
        //Se a variável $conn for vazia ela cria a instância.
        if (is_null(self::$conn)) {
            //Estamos usando conexão PDO para quando quiser mudar o banco futuramente, não ter problemas.
            //PDO é uma classe do PHP onde temos o dns, usuário , senha.
            self::$conn = new PDO('mysql:host=localhost;dbname=sersocial', 'root', 'user00');
        }
        return self::$conn;
    }

}

?>