<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');

include('conexao.php');

session_start();
if((!isset($_SESSION['login'])==true) and (!isset($_SESSION['senha'])==true) and (!isset($_SESSION['perm_acesso'])==true)){
  session_destroy(); # Destruir todas as sessões do navegador
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  unset($_SESSION['path_avatar']);
  header('location:naoAutenticado.php');
  exit;
} else {

    $nome_curso=$_POST["nome_curso"]; 
    $preco=$_POST["preco"]; 
    if($preco== NULL){
        $preco = 0.00;
    }  
    $tipo=$_POST["tipo"];

    $categoria=$_POST["categoria"];

    $contato=$_POST["contato"]; 
    if($contato== ""){
        $contato = "DEFAULT";
    } 

    $localizacao=$_POST["localizacao"];
    if($localizacao== NULL){
        $localizacao = "DEFAULT";
    } 

    $detalhes=$_POST["detalhes"];
    if($detalhes== NULL){
        $detalhes = "DEFAULT";
    } 
    
      
                  
          
     

    // aqui coemeça o upload
    //verificar se usuario enviou arquivo 
    if(isset($_FILES['arquivo'])){
    // capturando a extensão do arquivo   -4 =  os ultimos 4 caracteres exemplo.png
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
    $novo_nome = md5(time()) . $extensao;//define novo nome da imagem criptgrafado
    $diretorio = "_imgs/"; //define o local onde a img sera armazenada

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
        $insere_curso = mysqli_query($conn ,"INSERT INTO cursos (`nome_curso`,`preco`,`tipo`,`categoria`,`contato`,`path_miniatura`,`localizacao`,`detalhes`) VALUES ('$nome_curso','$preco','$tipo','$categoria','$contato','$diretorio$novo_nome','$localizacao','$detalhes')");

    if($insere_curso){
        header("location: adm-cursos.php");
        echo"<script language='javascript' type='text/javascript'>
        alert('Curso cadastrado com sucesso!');</script>";
    }else{
        echo"<script language='javascript' type='text/javascript'>
        alert('Não foi possível cadastrar esse Curso');</script>";
        

    }

    }


} //aqui acaba o else do isset


?>