RewriteEngine On
# Se o arquivo ou pasta não existir
 %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
# -f significa não é um arquivo
# -d significa não é um diretório
# Redireciona tudo o que o usuario digitou na url para index.php
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]


<?
session_start();
require_once "../app/config/config.php";
require_once "../app/controllers/controller.php";
// Pega a URL
$url = isset($_GET['url']) ? $_GET['url'] : '';
// Se a url estiver vazia, vai para a página inicial
if(empty($url))
{
$url = "home/index";
}
// Divide controller e método
$url = explode("/", $url);
$controller = ucfirst($url[0])."Controller"; // UsuarioController
$metodo = isset($url[1]) ? $url[1] : "index";
// Caminho do controller
$caminho = "../app/controllers/".$controller.".php";
if(file_exists($caminho))
{
 require_once $caminho;
 $obj = new $controller();
 if(method_exists($obj, $metodo))
{
 $parametros = array_slice($url, 2);
 call_user_func_array(array($obj, $metodo), $parametros);
}
else
{
 echo "Método não encontrado!"; // substituir depois para direcionamento para a página inicial
 }
}else{
 echo "Controller não encontrado!"; // substituir depois para direcionamento para a página inicial
}

?>