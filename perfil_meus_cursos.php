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

  
  // $cod_curso=$_GET["parametro"];  // recebe o parametro a ser alterado(dados do curso )
  $cod_curso=filter_input(INPUT_GET, "parametro");

  // $valor = filter_input(INPUT_GET, "valor"); //recebe valor via form e salva em var para  usar em query
  
  // $parametro2=filter_input(INPUT_GET, "parametro2");

 $sql= mysqli_query($conn, "select * from cursos where COD_curso='$cod_curso'") or die("Errs");
$dadosCurso =mysqli_fetch_assoc($sql);
    // editando os campos selecionados

  ?>

  <!doctype html>
  <html lang="pt=br">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Busca Curso -CURSO</title>
    <!-- link icones  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Estilos customizados para esse template -->
    <link href="../_css/dashboard.css" rel="stylesheet">
    <link href="../_css/estilo.css" rel="stylesheet">
    <!-- mascara para inputs -->
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <div>

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
      <img src="../_imgs/logo.png" width="135" alt="Busca Curso">
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
          <a class="nav-link" href="home.php">
          <i class="material-icons md-25 icon">assignment</i>
            Meus Cursos 
          </a>
          </li>
          
        <?php } ?>

        <?php 
            if($_SESSION['perm_acesso'] == 1){
        ?>
        <li class="nav-item">
          <a class="nav-link active" href="../adm-cursos.php">
          <i class="material-icons md-25 icon">assignment </i>
            Cursos
          </a>  
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="../add-curso.php">
          <i class="material-icons md-25 icon">add_circle </i>
            Add Curso
          </a>  
        </li>
        

        <?php } ?>


        <li class="nav-item text-nowrap pl-5  ml-5" >
          <a href="../perfil.php"> "olá  <?php echo $_SESSION['login'] ; ?> " <img src="../<?php echo $_SESSION['path_avatar'];  ?>" alt="avatar" width="45" ></a>
        </li>
        <li class="nav-item text-nowrap ">
          <a class="nav-link" href="../logout.php"> | Sair |</a>
        </li>
        </ul>
    </nav> 
  </div>
  </div>
  <!-- aqui termina o navbar -->

    <!-- inicio conteudo -->
    <div class="container ">
        <div class="row container-form-add-curso ">
            <div class="form-add-curso">
                <div class="media-body">
                    <h2>CURSO</h2>
                <img class="align-self-center  " src="../<?php echo $dadosCurso['path_miniatura'] ?>" alt="avatar" width="250">
                    <h3 class="mt-2 "><?php echo $dadosCurso['nome_curso'] ?> </h3>
                    <p>CÓDIGO : <?php echo $dadosCurso['COD_curso'] ?></p>
                    <p>DETALHES : <?php echo $dadosCurso['detalhes'] ?></p>
                    <p>PREÇO : R$<?php echo $dadosCurso['preco'] ?></p>
                    <p>CATEGORIA : <?php echo $dadosCurso['categoria'] ?></p>
                    <p>TIPO : <?php echo $dadosCurso['tipo'] ?></p>
                    <p>LOCALIZAÇÃO : <?php echo $dadosCurso['localizacao'] ?></p>
                    <p>CONTATO : <?php echo $dadosCurso['contato'] ?></p>
                </div>
            </div>

            <!-- form pra editar  o perfil de usuario ###########    -->
            <div class="form-add-curso">
                <h2>Deseja adicionar o curso?</h2>
                <form method="GET" action="../config_meus_cursos.php">
                    <div class="input-group mb-3">
                        <input type="hidden" name="parametro2" value="adicionar">
                        <input type="hidden" name="cod-curso" value="<?php echo $dadosCurso['COD_curso'] ?>">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit" id="button-addon1">adicionar curso</button>
                        </div>
                    </div>
                </form>
                
            </div>
            <!-- fim do form de edição de perfil ################ -->
        </div>
    </div>

   


  </body>

  </html>

<?php } ?>



