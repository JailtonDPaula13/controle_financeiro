<?php
    require_once("conexao/conect.php");
    session_start();
//===========================deslogar ao tentar cadastrar==================//
if(isset($_SESSION["v_login"]))
{
    unset($_SESSION["v_login"]);
}
//============================cadastro=====================================//
if(isset($_POST['enviocad']))
{
    $v_loginn = $_POST['log'];
    $consulta_log = mysqli_fetch_row(mysqli_query($conexao_um, "select login from tb_usuario where login = '$v_loginn';"))    ;
    
    if(empty($consulta_log))
    {
        if($_POST['passone'] == $_POST['passtwo'])
        {
           $v_name       =$_POST['namecad'];
           $v_senha      =$_POST['passone'];
           $v_mail       =isset($_POST['email'])?$_POST['email']:null;
            
           $conexao_inst = mysqli_query($conexao_dois, "insert into tb_usuario values(null,'$v_loginn','$v_senha','$v_name','$v_mail');");
            
           header('location: login.php');
        }
        else
        {
            $verro   = "Senhas não confere !!!";
            $v_nome  = $_POST['namecad'];
            $v_login = $_POST['log'];
            $v_email = $_POST['emailcad'];
        }
    }
    else
    {
        $verro   = "Login já existe !!!";
        $v_nome  = $_POST['namecad'];
        $v_email = $_POST['emailcad'];
    }
}
?>
<!DOCTPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>LOGIN</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/cadastro.css">
        <link rel="shortcut icon" href="/imagens/cifrao_origen.png" >
    </head>
    <body>
    <?php
        require_once "navbar.php";
    ?>
    <section class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 sectionuno">
                <form action="cadastro.php" method="post">
                    <label>LOGIN:</label><br>
                    <input type="text" name="log" maxlength="10" placeholder="AAAAA..." onkeyup="this.value = this.value.toUpperCase();" value="<?php if(isset($v_login)){print_r($v_login);} ?>" required><br>
                    <label>NOME:</label><br>
                    <input type="text" name="namecad" maxlength="50" placeholder="NOME COMPLETO" value="<?php if(isset($v_nome)){print_r($v_nome);} ?>" required><br>
                    <label>SENHA:</label><br>
                    <input type="password" name="passone" maxlength="6" required><br>
                    <label>REPITA A SENHA:</label><br>
                    <input type="password" name="passtwo" maxlength="6" required><br>
                    <label>E-MAIL:</label><br>
                    <input type="email" maxlength="50" placeholder="exemple@exemple.com" name="emailcad" value="<?php if(isset($v_email)){print_r($v_email);} ?>"><br>
                    <input type="submit" name="enviocad" id="envioc" value="CADASTRAR">
                </form> 
                <?php if(isset($verro)){ print_r("<p id='msg'>$verro</p>");}?>
            </div>
        </div>
    </section>
    <?php
        require_once "rodape.php";
    ?>
    <!--SCRIPTS===============================================================-->   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    </body>
</html>