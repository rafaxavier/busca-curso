<?php
include('conexao.php');
session_start();
if((!isset($_SESSION['login'])==true) and (!isset($_SESSION['senha'])==true) and (!isset($_SESSION['perm_acesso'])==true))
{
  session_destroy(); # Destruir todas as sessões do navegador
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  unset($_SESSION['path_avatar']);
  header('location:naoAutenticado.php');
  exit;
} else {
  $cod_usuario=$_SESSION['id'];
  $cod_curso=$_GET['cod-curso'];
  $parametro2=$_GET['parametro2'];
  
  
  if ($parametro2 == 'adicionar') {
    $inserir=mysqli_query($conn,"INSERT INTO cursos_aderidos (`COD_usuario`,`COD_curso`) VALUES ('$cod_usuario','$cod_curso')") ;
    if($inserir==true){
      header("location:meus_cursos.php");
    }
  }else if ($parametro2 == 'cancelar') {
    $cancelar=mysqli_query($conn,"DELETE from cursos_aderidos WHERE COD_usuario=$cod_usuario and COD_curso=$cod_curso  " ) ;
    if($cancelar==true){
      header("location:meus_cursos.php");
    }
  }
}
  ?>
