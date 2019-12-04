<?php
   include_once "conexao/conect.php";
   session_start();
if(isset($_GET['logoff']))
{
    unset($_SESSION["v_login"]);
}
//====================CONEXÃO CO LOGIN===================================//
   if(isset($_POST['login'])){
       $login     = $_POST['login'];
       $senha     = $_POST['senha'];
       $v_conexao = mysqli_fetch_row(mysqli_query($conexao_um, "select * from tb_usuario where login = '$login' and senha = '$senha'"));
       
        if(empty($v_conexao))
        {
           $v_retorno = "LOGIN ou SENHA invalida.";
        }
       else
       {
           $_SESSION["v_login"] = $v_conexao[3];
           header("location:index.php");
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
                        <input name="senha" type="text" size="18" maxlength="6" placeholder="SENHA" onkeyup="this.value = this.value.toUpperCase();" required><br>
                        <input type="submit" value="LOGIN">
                        <?php if(isset($v_retorno)){?> <p><?php print_r($v_retorno); }?></p>
                        <?php if(isset($_SESSION["v_login"])){?><p>USUÁRIO:&nbsp;<?php print_r($_SESSION["v_login"]); }?></p>
                    </form>

                </div>
            </div>
        </section>
<!--SCRIPTS===============================================================-->   
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    </body>
</html>