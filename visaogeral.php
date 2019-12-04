<?php
    session_start();
//======================================Consulta gasto diário==============================//
   //require_once ('conexao/connect_class.php');
   require_once ('conexao/conect.php');
   $v_conct1 = mysqli_fetch_row(mysqli_query($conexao_um,"select * from vw_valor_d;"));
   $v_conct2 = mysqli_fetch_row(mysqli_query($conexao_dois,"select * from vw_valor_m;"));
   $v_conct3 = mysqli_fetch_row(mysqli_query($conexao_cinco,"select * from vw_consulta_saldo_f;"));
   $v_conct4 = mysqli_fetch_row(mysqli_query($conexao_seis,"select * from vw_consulta_saldom_f;"));
   
   if(!$conexao_um){
       echo("erro de conexão na projeção do mês");
   }
   
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Visão Geral</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
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
                       Para gasto unifome entre os dias do mês vigente e não gerar despesas para o mês posterior o valor máximo aceito de despesa hoje é:
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
        </section>
<!--SCRIPTS===============================================================-->   
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    </body>
</html>