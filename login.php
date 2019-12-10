<?php
ini_set('display_errors', FALSE);

include_once "conexao/conect.php";

session_start();
//===============erro de conexão==========================//
if(!$conexao_um){
    $v_msgc   = "ERRO DE CONEXÃO !!! D:";
} 

//=======================logoff============================================//
if(isset($_GET['logoff']))
{
    unset($_SESSION["v_login"]);
}
//====================CONEXÃO CO LOGIN===================================//
   if(isset($_POST['login'])){ 
       $login     = $_POST['login'];
       $senha     = $_POST['senha'];
       $v_conexao = mysqli_fetch_row(mysqli_query($conexao_um, "select * from tb_usuario where login = '$login'"));
       if(empty($v_conexao))
       {
           $v_retorno = "LOGIN invalido."; 
       }
       else{
           $v_conexao = mysqli_fetch_row(mysqli_query($conexao_um, "select * from tb_usuario where login = '$login' and senha = '$senha'"));
           if(empty($v_conexao))
           {
             $v_retorno = "SENHA invalida.";
           }
           else
           {
                if(isset($_GET['lista']))
                {
                    $_SESSION["v_login"] = $v_conexao[3];
                    header("location:lista.php");
                }
                elseif(isset($_GET['despesas']))
                {
                    $_SESSION["v_login"] = $v_conexao[3];
                    header("location:despesas.php");
                }
               elseif(isset($_GET['projecao']))
                {
                    $_SESSION["v_login"] = $v_conexao[3];
                    header("location:projecao.php");
                }
               elseif(isset($_GET['visao']))
                {
                    $_SESSION["v_login"] = $v_conexao[3];
                    header("location:visaogeral.php");
                }
                else
                {
                    $_SESSION["v_login"] = $v_conexao[3];
                    header("location:index.php");
                }
            }
       }
   }
            
//======trantando logado ==================================//
  
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>LOGIN</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="shortcut icon" href="/imagens/cifrao_origen.png" >
    </head>
    <body>
        <?php
            require_once "navbar.php";
        ?>
        <section class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 login">
                    <form method="post">
                        <label>LOGIN:</label><br>
                        <input name="login" type="text" size="18" maxlength="10" placeholder="LOGIN" onkeyup="this.value = this.value.toUpperCase();" required><br>
                        <label>SENHA:</label><br>
                        <input name="senha" type="password" size="18" maxlength="6" placeholder="SENHA" onkeyup="this.value = this.value.toUpperCase();" required><br>
                        <input type="submit" value="LOGIN">
                        <?php if(isset($v_retorno)){?> <p><?php print_r($v_retorno); }?></p>
                        <?php if(isset($_SESSION["v_login"])){?><p>USUÁRIO:&nbsp;<?php print_r($_SESSION["v_login"]); }?></p>
                        <?php if(isset($v_msgc)){?><p><?php print_r($v_msgc); }?></p>
                    </form>
                        <a href="login.php?logoff=1"><h6>LOGOFF</h6></a>
                        <?php if(!$_SESSION["v_login"]) {?>
                        <a href="cadastro.php"><h6>CADASTRAR</h6></a>
                        <?php } ?>
                </div>
            </div>
        </section>
<!--SCRIPTS===============================================================-->   
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    </body>
</html>