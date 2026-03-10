<?php
class Conexao
{
 // Atributo estático que armazenará a instância de conexão
 private static $conexao;
 // Construtor privado para impedir instância direta
 private function __construct() {}
 // Método público e estático que retorna a instância de conexão
 public static function getInstance()
 {
 // Verifica se a conexão já foi criada
 if (!isset(self::$conexao)) {
 try {
 // Opções de configuração do PDO
 $opcoes = [
 PDO::ATTR_PERSISTENT => true, // Conexão persistente
 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Lançar exceções em erros
 PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'" //Corrigir acentuação
 ];
 // Criação da instância PDO com os parâmetros de conexão
 self::$conexao = new PDO(
 "mysql:host=localhost;dbname=meubanco", // DSN
 "root", // Usuário
 "", // Senha
 $opcoes // Opções
 );
 } catch (PDOException $e) {
 // Exibe o erro de conexão
 die("Erro de conexão: " . $e->getMessage());
 }
 }
 // Retorna a conexão já existente
 return self::$conexao;
 }
}
?>