<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Minhas Finanças</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="/imagens/cifrao_origen.png" >
</head>
<dody>
   <?php
     require_once('navbar.php');
    ?>
<!--Menus=================================================================-->
<!--MOVIMENTAÇÃO-->
<section class="container-fluid">
    <div class="row artigos">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 sub_artigo">
            <img src="imagens/salario-rec.jpg" alt="salário" width="40%" class="rounded-circle img_cent">
            <h3 class="mov_text"><b>Movimentações Financeira</b></h3>
            <li><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%"> Despesa</li>
            <p>Cadastro de despesa com definição de valores descrição, local e data tendo visão geral com soma de valores gasto das despesa com opção de filtra por data .</p>
            <li><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%"> Crédito</li>
            <p>Cadastro do crédito com definição de valores, descrição e data tendo visão geral com soma de valores podendo filtra por data.</p>    
        </div>
    </div>
<!--VISÕA GERAL-->
    <div class="row artigosv">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 sub_artigo">
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 sub_artigo">
            <img src="imagens/visao-rec.jpg" alt="salário" width="40%" class="rounded-circle img_centV">
            <h3 class="mov_textV"><b>Visão Geral</b></h3>
            <li><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Projeção diária</li>
            <p>Projeção de gasto diários, onde definir quanto pode ser gasto por dia para que não tenha despesas no mês seguinte referente a gasto do mês anterior.</p>    
        </div>
    </div>
</section>


<!--SCRIPTS===============================================================-->
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    
</dody>
</html>