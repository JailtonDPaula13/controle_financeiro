<?php
    session_start();
    ini_set('display_errors', FALSE);
    require_once ('conexao/conect.php');
    require_once ('funcao/mes.php');
    date_default_timezone_set('America/Fortaleza');
//=================================verificar acesso========================================//
if( !isset($_SESSION["v_login"]))
{
    header("location:login.php?visao=1");
}
else
{
    $v_loging = $_SESSION["v_login"];
}
//======================================Consulta gasto diário==============================//
   
   $v_conct1 = mysqli_fetch_row(mysqli_query($conexao_um,"select fn_saldo_dia('$v_loging');"));
   $v_conct2 = mysqli_fetch_row(mysqli_query($conexao_dois,"select fn_saldo_mes('$v_loging');"));
   $v_conct3 = mysqli_fetch_row(mysqli_query($conexao_tres,"select fn_saldo_futuro(1,'$v_loging');"));
   $v_conct4 = mysqli_fetch_row(mysqli_query($conexao_quatro,"select fn_saldo_futuro_dia(1,'$v_loging');"));
   $v_conct5 = mysqli_fetch_row(mysqli_query($conexao_cinco,"select fn_saldo_futuro(2,'$v_loging');"));
   $v_conct6 = mysqli_fetch_row(mysqli_query($conexao_seis,"select fn_saldo_futuro_dia(2,'$v_loging');"));
   
   if(!$conexao_um or !$v_conct2 or !$v_conct3 or !$v_conct4 or !$v_conct5 or !$v_conct6)
   {
       echo("<script>alert('erro de conexão na projeção do mês')</script>");
   }
//=====projeção de data=======================================================================//

$v_datap = getdate();
//print_r($v_datap);
//print_r($v_datap['month']."/".$v_datap['year']);

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Visão Geral</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/visaogeral.css">
        <link rel="shortcut icon" href="/imagens/cifrao_origen.png" >
    </head>
    <body>
        <?php
            require_once('navbar.php');
        ?>
<section class="container-fluid">
<!--=======================titulo===========================================-->
           <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 msg">    
                <h2 id='tituloVisao'>
                    Projeção mensais de saldo e projeção futuras
                </h2>
                </div>
          </div>
<div class="row justify-content-center linhaVisao">
<!--===================projeção de gasto no mês===========================-->
    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 quadrovisao">
        <h4 class="tituloquadro">Visão do saldo de <?php echo mesAno(date(m)); ?></h4>
        <p>Para que não seja necessário o uso do cartão de crédito gerando assim despesas para próximos meses o valor permitido de gasto diário hoje é:</p>
        <h3>R$:&nbsp;<?php print_r(str_replace('.',',',$v_conct1[0])); ?></h3>
        <p>Saldo restante para resto desse mês é:</p>
        <h3>R$:&nbsp;<?php print_r(str_replace('.',',',$v_conct2[0])); ?></h3>
    </div>
<!--===================projeção de futuros===========================-->
    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 quadrovisaodois">
        <h4 class="tituloquadro">Visão do saldo de <?php echo mesAno(date(m)+1); ?></h4>
        <p>Projeção de gasto diário e uniforme para o mês <?php echo mesAno(date(m)+1); ?> para que não torne necessário o uso do cartão de crédito é:</p>
        <h3>R$:&nbsp;<?php print_r(str_replace('.',',',$v_conct4[0])); ?></h3>
        <p>Projeção de saldo pro mês <?php echo mesAno(date(m)+1); ?> é de:</p>
        <h3>R$:&nbsp;<?php print_r($v_conct3[0]); ?></h3>
    </div>
<!--===================projeção de futuros 2 meses===========================-->
    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 quadrovisao">
        <h4 class="tituloquadro">Visão do saldo de <?php echo mesAno(date(m)+2); ?></h4>
        <p>Projeção de gasto diário e uniforme para o mês <?php echo mesAno(date(m)+2); ?> para que não torne necessário o uso do cartão de crédito é:</p>
        <h3>R$:&nbsp;<?php print_r(str_replace('.',',',$v_conct6[0])); ?></h3>
        <p>Projeção de saldo pro mês <?php echo mesAno(date(m)+2); ?> é de:</p>
        <h3>R$:&nbsp;<?php print_r(str_replace('.',',',$v_conct5[0])); ?></h3>
    </div>
</div>
<!--=======================meng===========================================-->
           <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 msg">    
                <h4 id='principio'>
                    “Quando saímos do foco, esquecemos que são nossos sonhos que estão em jogo, deixamos de lado muitas coisas importantes, e acabamos colocando em risco tudo que conquistamos.”
                </h4>
                </div>
            </div>
</section>        
<!--SCRIPTS===============================================================-->   
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
<?php
            if(!$conexao_seis or !$conexao_um or !$conexao_tres or !$conexao_dois or !$conexao_quatro or !$conexao_cinco )
    {
         echo("<script> alert('Erro ao conectar no banco!!!') </script>");
    }
?>
    </body>
</html>