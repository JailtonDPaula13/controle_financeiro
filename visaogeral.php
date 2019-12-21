<?php
    session_start();
    ini_set('display_errors', FALSE);
    require_once ('conexao/conect.php');
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
<!--=======================meng===========================================-->
           <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 msg">    
                <h5 id='principio'>
                    “Quando saímos do foco, esquecemos que são nossos sonhos que estão em jogo, deixamos de lado muitas coisas importantes, e acabamos colocando em risco tudo que conquistamos.”
                </h5>
                </div>
            </div>
<!--===================projeção de gasto no mês===========================-->
            <div id="accordion">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Projeção de saldo do mês:
                    </button>
                  </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                   <h5>
                       Para gasto unifome entre os dias do mês vigente e não gerar despesas para o mês posterior o valor máximo aceito de despesa hoje é:
                   </h5>
                   <p class="valor">
                       R$:&nbsp;<?php print_r($v_conct1[0]); ?>
                   </p>
                  </div>
                  <div class="card-body">
                   <h5>
                       Saldo restante para o mês vijente é:
                   </h5>
                   <p class="valor">
                       R$:&nbsp;<?php print_r($v_conct2[0]); ?>
                   </p>
                  </div>

                </div>
              </div>
            </div>
<!--===================projeção de futuros===========================-->
            <div id="accordion">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                      Projeção de saldo futuro:
                    </button>
                  </h5>
                </div>

                <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                   <h5>
                       Para gasto unifome entre os dias do mês posterior e não gerar despesas para o mês seguinte o valor máximo aceito de despesa diária é:
                   </h5>
                   <p class="valor">
                       R$:&nbsp;<?php print_r($v_conct4[0]); ?>
                   </p>
                  </div>
                  <div class="card-body">
                   <h5>
                       Projeção de saldo restante para o mês posterior é:
                   </h5>
                   <p class="valor">
                       R$:&nbsp;<?php print_r($v_conct3[0]); ?>
                   </p>
                  </div>

                </div>
              </div>
            </div>
<!--===================projeção de futuros 2 meses===========================-->
            <div id="accordion">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                      Projeção de saldo futuro dois meses a frente:
                    </button>
                  </h5>
                </div>

                <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                   <h5>
                       Para gasto unifome entre os dias dois meses posterior e não gerar despesas para o mês seguinte o valor máximo aceito de despesa diária é:
                   </h5>
                   <p class="valor">
                       R$:&nbsp;<?php print_r($v_conct6[0]); ?>
                   </p>
                  </div>
                  <div class="card-body">
                   <h5>
                       Projeção de saldo restante para dois meses posterior é:
                   </h5>
                   <p class="valor">
                       R$:&nbsp;<?php print_r($v_conct5[0]); ?>
                   </p>
                  </div>

                </div>
              </div>
            </div>
        </section>
        
<!--SCRIPTS===============================================================-->   
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
<?php
    include_once("rodape.php");
            if(!$conexao_seis or !$conexao_um or !$conexao_tres or !$conexao_dois or !$conexao_quatro or !$conexao_cinco )
    {
         echo("<script> alert('Erro ao conectar no banco!!!') </script>");
    }
?>
    </body>
</html>