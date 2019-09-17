
<?php
include('conexao.php');
session_start();
if((!isset($_SESSION['login'])==true) and (!isset($_SESSION['senha'])==true) and (!isset($_SESSION['perm_acesso'])==1))
  {
    session_destroy(); # Destruir todas as sessões do navegador
    unset ($_SESSION['login']);
    unset ($_SESSION['senha']);
    unset ($_SESSION['path_avatar']);
    header('location:naoAutenticado.php');
    exit;

     
  }else{
    $lista_cursos = mysqli_query($conn,"select * from cursos ") or die("Erro");

  // $categoria = mysqli_query($conn,"select DESC_CATEGORIA from categoria ") or die("Erro");
  // $movimentacoes = mysqli_query($conn,"select * from movimentacoes WHERE COD_Usuario=".$_SESSION['id']." ORDER BY idFINANCAS DESC ") or die("Erro");
  // $forma_pg = mysqli_query($conn,"select FORMA_PAGAMENTO from forma_pagamento ") or die("Erro");
    
?>

<!doctype html>
<html lang="pt=br">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Busca Curso - ADD Curso</title>
    <!-- link icones  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Estilos customizados para esse template -->
    <link href="_css/dashboard.css" rel="stylesheet">
    <!-- mascara para inputs -->
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  </head>

  <body>
  <div>   
 <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
  </div>
  

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow  ">
      <a href="home.php"><img src="_imgs/logo.png" width="135" alt="cash plus"></a>
      <ul class="nav flex ">
      

        <?php 
            if($_SESSION['perm_acesso'] == 0){
        ?>
          <li class="nav-item ">
          <a class="nav-link" href="home.php">
          <i class="material-icons md-25 icon">home</i>
            Início 
          </a>
          </li>
          <li class="nav-item ">
          <a class="nav-link" href="buscar-cursos.php">
          <i class="material-icons md-25 icon">search</i>
            Buscar 
          </a>
          </li>
          <li class="nav-item ">
          <a class="nav-link" href="meus_cursos.php">
          <i class="material-icons md-25 icon">assignment</i>
            Meus Cursos 
          </a>
          </li>
          
        <?php } ?>

        <?php 
            if($_SESSION['perm_acesso'] == 1){
        ?>
        <li class="nav-item">
          <a class="nav-link active" href="adm-cursos.php">
          <i class="material-icons md-25 icon">assignment </i>
            Cursos
          </a>  
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="add-curso.php">
          <i class="material-icons md-25 icon">add_circle </i>
            Add Curso
          </a>  
        </li>
        <li class="nav-item">
          <a class="nav-link" href="config.php">
          <i class="material-icons md-25 icon">settings</i>
            Configurações
          </a>
        </li>

        <?php } ?>


        <li class="nav-item text-nowrap pl-5  ml-5" >
          <a href="perfil.php"> "olá  <?php echo $_SESSION['login'] ; ?> " <img src="<?php echo $_SESSION['path_avatar'];  ?>" alt="avatar" width="45" ></a>
        </li>
        <li class="nav-item text-nowrap ">
          <a class="nav-link" href="logout.php"> | Sair |</a>
        </li>
        </ul>
    </nav> 
  </div>
  </div>
  <!-- aqui termina o navbar -->

            
    <!--aqui começa o conteudo da página  -->
    <?php while ($aux = mysqli_fetch_assoc($lista_cursos)){ ?> 


        <?php 
            if($_SESSION['perm_acesso'] == 1){
        ?>
              <?php 
                $paremetro= $aux["COD_curso"];
                echo "<a href=\"perfil_curso_adm.php/?parametro=$paremetro\"\>";
              ?>
      <?php } ?>

      <?php 
            if($_SESSION['perm_acesso'] == 0){
        ?>
            <?php 
                $paremetro= $aux["COD_curso"];
                echo "<a href=\"perfil_meus_cursos.php/?parametro=$paremetro\"\>";
              ?>
       <?php } ?>


     <div class="card shadow mb-4 m-3 float-left" style="width:300px; height:250px">
      <div class="card-header py-3 ">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo $aux["nome_curso"] ?></h6>
        </div>
        <div class="card-body">
        <img align="left"  src="<?php echo $aux["path_miniatura"] ?>" style="margin: 10px; width:100px;height:100px;" />
        <h6><?php echo$aux["detalhes"] ?></h6>
        <div class="h3 mb-0 font-weight-bold text-gray-800">
          <?php 
            if ($aux["preco"]<=0) 
            {
              echo "Gratuito";
            }else {
                     echo "R$",$aux["preco"];
                  }
          ?>
        </div>
        </div>
      </div>
     <?php  } 
     ?>
  </body>
</html>

<?php } ?>
