<?php
    session_start();
?>
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
     include_once('navbar.php');
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
<!--PROJEÇÃO DE DESPESAS DOS MESES A SEGUIR-->
    <div class="row artigosv">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 sub_artigo">
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 sub_artigo">
            <img src="imagens/pessoa_tempo-rec.jpg" alt="salário" width="40%" class="rounded-circle img_centV">
            <h3 class="mov_textV"><b>Projeção de Despesas dos Meses a Seguir</b></h3>
            <li><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Cadastro das despesas futuras</li>
            <p>Cadastros das despesas dos mês a posteriores para assim ter uma previsão de gasto de saldo e dividas dos meses a seguir.</p>
            <li><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Cadastro dos créditos futuros</li>
            <p>Cadastros dos crédito dos mês a posteriores para assim ter uma previsão de gasto de saldo e dividas dos meses a seguir.</p>    
        </div>
    </div>
<!--VISÃO GERAL-->
    <div class="row artigos">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 sub_artigo">
            <img src="imagens/visao-rec.jpg" alt="salário" width="40%" class="rounded-circle img_cent">
            <h3 class="mov_text"><b>Visão Geral</b></h3>
            <li><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Projeção de saldo</li>
            <p>Projeção de saldo unifome diário e mensal do mês vigente.</p>
            <li><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Projeção de saldo do mês posterior</li>
            <p>Projeção de saldo unifome diário e mensal do mês posterior.</p>
        </div>
    </div>
    <!--lista de compras-->
    <div class="row artigosv">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 sub_artigo">
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 sub_artigo">
            <img src="imagens/compras-rec.jpg" alt="salário" width="40%" class="rounded-circle img_centV">
            <h3 class="mov_textV"><b>Lista de Desejo</b></h3>
            <li><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Cadastro de compras</li>
            <p>Cadastro de lista de compras o que deseja compra com nível de prioridade e valores.</p>
            <li><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Organização da lista de compras</li>
            <p>Ordenação da lista de compras por prioridades e valores.</p>    
        </div>
    </div>
</section>
<?php
    include_once('rodape.php');
?>


<!--SCRIPTS===============================================================-->
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    
</dody>
</html>