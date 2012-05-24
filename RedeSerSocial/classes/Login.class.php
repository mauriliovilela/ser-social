<?php

class Login extends DB {

    private $tabela = 'usuarios';
    private $prefix = 'sersocial_';
    private $cookie = true;
    public $erro = '';

//Método para cripritografar a senha
    private function crip($senha) {
        return sha1($senha);
    }

//Este método vai receber o usuário e senha e verifica no banco se o usuário existe.
    private function validar($usuario, $senha) {
        $this->crip($senha);

        try {
            $validar = self::getConn()->prepare('SELECT `id`, FROM `' . $this->tabela . '` WHERE `email`=? AND `senha`=?');
            $validar->execute(array($usuario, $senha));

            return ($validar->rowCount() == 1) ? true : false;
        } catch (PDOException $e) {
            $this->erro = 'Sistema indisponível no momento';
            logErros($e);
            return false;
        }
    }

    function logar($usuario, $senha, $lembrar = false) {
        if ($this->validar($usuario, $senha)) {

            if (!$_SESSION) {
                session_start();
            }
            $_SESSION[$this->prefix . 'usuario'] = $usuario;
            $_SESSION[$this->prefix . 'logado'] = true;
            if ($this->$cookie) {
                $valor = join('#', array($usuario, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']));
                $valor = sha1($valor);
                setcookie($this->prefix . 'token', $valor, 0, '/');
            }
            if ($lembrar) {
                $this->lembrarDados($usuario, $senha);
            }
            return true;
        } else {
            $this->erro = 'Usuário ou senha inválidos';
            return false;
        }
    }

    function logado($cookie = true) {
        if (!$_SESSION) {
            session_start();
        }

        if (!isset($_SESSION[$this->prefix . 'logado']) and !$_SESSION[$this->prefix . 'logado']) {
            if ($cookie) {
                $this->dadosLembrados();
            } else {
                $this->erro = 'Você não está logado';
                return false;
            }
        }
        if ($this->cookie) {
            if (!isset($_COOKIE[$this->prefix . 'token'])) {
                $this->erro = 'Você não está logado';
                return false;
            } else {
                $valor = join('#', array($_SESSION[$this->prefix . 'usuario'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']));
                $valor = sha1($valor);

                if ($_COOKIE[$this->prefix . 'token'] !== $valor) {

                    $this->erro = 'Você não está logado';
                    return false;
                }
            }
        }
        return true;
    }

    private function efetuarLogoff($cookie = true) {
        if (!$_SESSION) {
            session_start();
        }

        unset($_SESSION[$this->prefix . 'usuario']);
        $_SESSION[$this->prefix . 'logado'] = false;

        if ($this->cookie and isset($_COOKIE[$this->prefix . 'token'])) {
            setcookie($this->prefix . 'token', false, (time() - 3600), '/');
            unset($_COOKIE[$this->prefix . 'token']);
        }

        if ($cookie) {

            $this->limparLembrados();
        }
        return !$this->logado(false);
    }

    function getDados($email) {
        if ($this->logado()) {
            $dados = self::getConn()->prepare('SELECT * FROM `' . $this->tabela . '` WHERE `email`=?');
            $dados->execute(array($email));
            return $dados->fetch(PDO::FETCH_ASSOC);
        }
    }

    //Apagamos os nossos dados que foram lembrados
    private function limparLembrados() {
        if (isset($_COOKIE[$this->prefix . 'login_user'])) {
            setcookie($this->prefix . 'login_user', false, (time() - 3600), '/');
            unset($_COOKIE[$this->prefix . 'login_user']);
        }

        if (isset($_COOKIE[$this->prefix . 'login_pass'])) {
            setcookie($this->prefix . 'login_pass', false, (time() - 3600), '/');
            unset($_COOKIE[$this->prefix . 'login_pass']);
        }
    }

    private function dadosLembrados() {
        if (isset($_COOKIE[$this->prefix . 'login_user']) and isset($_COOKIE[$this->prefix . 'login_pass '])) {

            $usuario = base64_decode(substr($_COOKIE[$this->prefix . 'login_user'], 1));
            $senha = base64_decode(substr($_COOKIE[$this->prefix . 'login_pass '], 1));

            return $this->logar($usuario, $senha, true);
        }
        return false;
    }

    private function lembrarDados($usuario, $senha) {
        $tempo = strtotime('+7 day', time());
//criptografar usando base_encode e depois descriptografar com o decode
        $usuario = rand(1, 9) . base64_encode($usuario);
        $senha = rand(1, 9) . base64_encode($senha);

        setcookie($this->prefix . 'login_user', $usuario, $tempo, '/');
        setcookie($this->prefix . 'login_pass', $senha, $tempo, '/');
    }

}

?>
