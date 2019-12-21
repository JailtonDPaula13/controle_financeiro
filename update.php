<?php   
    require_once "conexao/conect.php";
    session_start();
//=================================consulta select==========================================/
if(!$_SESSION["v_login"])
{
    header("location:login.php?lista=1");
}
else
{
    $v_loginup = $_SESSION["v_login"];
}
//=================================consulta=================================================/
if(isset($_GET['update']))
{
    
    $consulta       = $_GET['update'];
    $consulta_opcao = mysqli_query($conexao_dois,"select * from tb_status;");
    $query          = mysqli_fetch_row(mysqli_query($conexao_um, "select id_lista,descricao,valor,status,date_format(data,'%d/%m/%y') ,comprado,imagen from tb_lista where id_lista = '$consulta' and login = '$v_loginup';"));
    if(!$query or !$consulta_opcao){
        echo("<script>alert('Erro ao conectar no banco !!!')</script>");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>UPDATE lista de compras</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/update.css">
        <link rel="shortcut icon" href="/imagens/cifrao_origen.png" >
    </head>
        <body>
            <?php
               require_once "navbar.php";
            ?>
<!--=======================================divisão=========================================-->
            <section class="container-fluid">
                <div class="row linhaup">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <img src="<?php print_r($query[6])?>" width="100%">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                        <form action="lista.php" method="post">
                            <h2>
                                <b><?php print_r(utf8_encode($query[1]))?></b>
                            </h2>

                            <h5>
                                <b>ALTERADO:&nbsp;<?php print_r($query[4])?></b>
                            </h5>
                            <label for="vl">
                                <b>VALOR:&nbsp;</b>
                            </label><br>
                            <input name="valor" id="vl" type="number" value="<?php print_r($query[2])?>" min="0" step="0.01" required><br>
                            <label for="sle"><b>PRIORIDADE:</b></label><br>
                            <select id="sle" name="prioridade">
                                <?php while($v_opcao = mysqli_fetch_row($consulta_opcao))
                                {if($v_opcao[0] == $query[3]) {?>
                                 <option value="<?php print_r($v_opcao[0]) ?>" selected><?php print_r(utf8_encode($v_opcao[1])) ?></option>
                                <?php }else{ ?>
                                 <option value="<?php print_r($v_opcao[0]) ?>"><?php print_r(utf8_encode($v_opcao[1])) ?></option>
                                <?php }} ?>
                            </select><br>
                            <button type="submit" name="enviobtn" id="btnup" value="<?php print_r($query[0]) ?>">UPDATE</button>
                        </form>
                    </div>
                </div>
            </section>
<!--=======================================divisão=========================================-->
            <?php
               require_once "rodape.php";
            ?>
         <!--SCRIPTS===============================================================-->   
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
        </body>
    </head>
</html>