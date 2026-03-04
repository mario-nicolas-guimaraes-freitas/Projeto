<?php

require_once "controller.php"; // adicionando o script controller.php
class UserController extends Controller //herdando o script controller.php
{
    public function cadastro() // para enviar sua rota

    {
        $this->render("user/cadastro");
        /* aqui, chamamos a rotina para cadastrar. Passamos os dados do caminho
        (usuarios/cadastro) para a função render() do script controller.php para que chame a página correspondente. */
    }

    public function cadastrar() //para receber dados do formulário
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                //Validar confirmação de senha: 
                if($_POST['senha'] !== $_POST['senhac'])
                    {
                        $_SESSION['erro'] = "As senhas não coincidem.";
                        header("Location: ". BASE_URL. "user/cadastro");
                        exit;
                    }
                    /* VALIDAR CPF
                    if(!$this->validarCPF($_POST['cpf']))
                    {
                    $_SESSION['erro'] = "CPF inválido.";
                    header("Location". BASE_URL. "user/cadastro");
                    exit;
                    } */

                    require_once "../app/models/user.php";

                    $user = new User();
                    $resultado = $user->cadastrar($_POST);
                    if ($resultado === true)
                        {
                            $_SESSION['sucesso'] = "Usuário cadastrado com sucesso.";
                            header("Location". BASE_URL. "user/login");
                        }
                        elseif($resultado === "duplicado")
                            {
                                $_SESSION['erro'] = "E-mail ou CPF já cadastrado.";
                                header("Location". BASE_URL. "user/casatro");
                            }
                            else
                                {
                                    $_SESSION['erro'] = "Erro ao cadastrar.";
                                    header("Location". BASE_URL. "user/casatro");
                                }
                                exit;
            }
    }

    /*private function validarCPF($cpf)
    {
    //Remove tudo que não for número
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if(strlen($cpf) !=11) return false;

    // Bloqueia CPFs repetidos(11111111111 etc)
    if(preg_match('/(\d)\1{10}/', $cpf)) return false;

    //Primeiro dígito
    for ($t = 9; $t < 11; $t ++) {
    for ($d = 0, $c = 0; $c < $t; $c++) {
    $d += $cpf[$c] * (($t + 1) - $c);
    }
    $d = ((10 * $d) % 11 ) % 10;
    if($cpf[$c] != $d) {
    return false;
    }

    }
    return false;
    } */

}



?>