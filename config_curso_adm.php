<?php
include('conexao.php');
// session_start();
// if((!isset($_SESSION['login'])==true) and (!isset($_SESSION['senha'])==true) and (!isset($_SESSION['perm_acesso'])==true))
// {
//   session_destroy(); # Destruir todas as sessões do navegador
//   unset($_SESSION['login']);
//   unset($_SESSION['senha']);
//   unset($_SESSION['path_avatar']);
//   header('location:naoAutenticado.php');
//   exit;
// } else {

  $cod_curso=$_GET['cod-curso'];
  $parametro2=$_GET['parametro2'];
  $valor=$_GET['valor'];
  
    // editando os campos selecionados
  if ($parametro2 == 'NewNomeCurso') {
    $alterar=mysqli_query($conn,"update cursos set nome_curso='$valor' WHERE COD_curso=".$cod_curso." ") ;
    if($alterar==true){
      header("location:perfil_curso_adm.php/?parametro=$cod_curso");
    }
  }else if ($parametro2 == 'NewDetalhes') {
    $alterar=mysqli_query($conn,"update cursos set detalhes='$valor' WHERE COD_curso=".$cod_curso." ") ;
    if($alterar==true){
      header("location:perfil_curso_adm.php/?parametro=$cod_curso");  
    }
  }else if ($parametro2 == 'NewPreco') {
    $alterar=mysqli_query($conn,"update cursos set preco='$valor' WHERE COD_curso=".$cod_curso." ") ;
    if($alterar==true){
      header("location:perfil_curso_adm.php/?parametro=$cod_curso");  
    }
  }else if ($parametro2 == 'NewLocalizacao') {
    $alterar=mysqli_query($conn,"update cursos set localizacao='$valor' WHERE COD_curso=".$cod_curso." ") ;
    if($alterar==true){
      header("location:perfil_curso_adm.php/?parametro=$cod_curso");  
    }
  }else if ($parametro2 == 'NewContato') {
    $alterar=mysqli_query($conn,"update cursos set contato='$valor' WHERE COD_curso=".$cod_curso." ") ;
    if($alterar==true){
      header("location:perfil_curso_adm.php/?parametro=$cod_curso");  
    }
  }else if ($parametro2 == 'excluir') {
    $excluir=mysqli_query($conn,"delete  from cursos  WHERE COD_curso=".$cod_curso." ") ;
    if($excluir==true){
      header("location:perfil_curso_adm.php/?parametro=$cod_curso");  
    }
  }
  ?>