
<?php
include('conexao.php');
session_start();
if((!isset($_SESSION['login'])==true) and (!isset($_SESSION['senha'])==true) and (!isset($_SESSION['perm_acesso'])==true))
	{
    session_destroy(); # Destruir todas as sessões do navegador
    // unset ($_SESSION['COD_Usuario']);
		unset ($_SESSION['login']);
    unset ($_SESSION['senha']);
    unset ($_SESSION['perm_acesso']);
    unset ($_SESSION['path_avatar']);
		header('location:naoAutenticado.php');
		exit;

     
	}else{
    
    // AQUI FAZ A BUSCA DA SOMA  DE TODOS OS VALORE NOS RESPECTIVOS MESES
    echo ("logado com sucesso");
    echo $_SESSION['perm_acesso'];
    

    // AQUI FAZ A BUSCA DE TODAS A MOVIMENTAÇÕES NOS RESPECTIVOS ANOS DETALHADAS POR MESES 
    //PARA EXIBIR NO GRAFICO E NA TABELA
    

    
   
?>

<!doctype html>
<html lang="pt=br">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Busca Curso - Início</title>
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
      <img src="_imgs/logo.png" width="135" alt="cash plus">
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
    <div class="container-form-add-curso" > 
      <div>
      <div class="form-add-curso" >
          <form id="formCadastro" name="formulario" action="inserir-curso.php" method="POST" enctype="multipart/form-data" >
          <fieldset>
          <legend>CADASTRAR NOVO CURSO</legend>
          <label for="nome">NOME DO CURSO:</label>
          <input type="text" id="nome" class="form-control"  name="nome_curso"  placeholder="Nome Do Curso" required >
          <br>
          <label for="desc" >DESCRIÇÃO:</label><br>
          <textarea name="detalhes" class="form-control"  id="desc" cols="40" wrap="soft" placeholder="  Insira Detalhes Do Curso" required ></textarea>
          <br><br>
          <label for="dinheiro">VALOR:</label>
          <input type="text" id="dinheiro" class="dinheiro form-control" name="preco" placeholder="R$0,00">
          <br>
          <label for="file">IMAGEM (.png ou .jpg):</label>
          <input id="file" class="form-control" type="file" name="arquivo"  accept="image/png, image/jpeg" required  /> 
          <br>
        </div >
        <div class="form-add-curso" >
          <label for="sel2">CATEGORIA:</label>
          <select class="form-control" id="sel2" name="categoria">
          <?php
          $categoria= mysqli_query($conn, "select categoria from tb_categorias ") or die("Erro");
            while ($aux = mysqli_fetch_assoc($categoria)) {
              echo "<option value=\"". $aux['categoria'] ."\" >" . $aux['categoria'] . "</option>";
              }
          ?>
          </select>
          <br>
           <!-- select que define se input aparece ou não  -->
          <label for="sel1">TIPO DE CURSO:</label>
          <select class="form-control" id="sel1" name="tipo">
          <?php
            $tipo = mysqli_query($conn, "select tipo from tipos_de_curso ") or die("Erro");
            while ($aux = mysqli_fetch_assoc($tipo)) {
              echo "<option value=\"". $aux['tipo'] ."\" >" . $aux['tipo'] ."</option>";
            }
          ?>
          </select><br>
          <!-- input acultos por javascript -->
          <div id="inputOculto">
          <legend>CONTATO</legend>
            <label for="email">email:</label>
            <input type="text" id="email" class="email form-control" name="contato" placeholder="E-mail"  ><br>
            
            <label for="local">Localização:</label><br>
            <textarea name="localizacao" id="local" cols="40" wrap="soft" placeholder="   N°, Rua , Bairro , Cidade ..."  ></textarea>
          <br>
          </div>
          <br>
                
          <button class="btn btn-lg btn-success btn-block" type="submit">Cadastrar</button>
          </fieldset>
          </form>
        </div>
      </div>
    </div>



    <!-- função pra ocultar/exibir inputs de acordo com a resposta do usuario -->
    <script type="text/javascript">
      $(document).ready(function() {
      $('#inputOculto').hide();
      $('#sel1').change(function() {
        if ($('#sel1').val() == 'PRESENCIAL') {
            $('#inputOculto').show();
        } else {
            $('#inputOculto').hide();
        }
      });
});
    </script>

    <!-- mascara do form -->
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script>
      $('.telefone').mask('00000000000');
      $('.dinheiro').mask('####0.00', {
        reverse: true
      });

    </script>
  </body>
</html>

<?php } ?>
