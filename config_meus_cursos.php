<?php
include('conexao.php');

  $cod_curso=$_GET['cod-curso'];
  $parametro2=$_GET['parametro2'];
  $valor=$_GET['valor'];
  
  if ($parametro2 == 'adicionar') {
    $inserir=mysqli_query($conn,"INSERT INTO cursos_aderidos (`COD_usuario`,`COD_curso`) VALUES (2,'$cod_curso')") ;
    if($inserir==true){
      header("location:perfil_meus_cursos.php/?parametro=$cod_curso");
    }
  }
  ?>