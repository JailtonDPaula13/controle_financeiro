<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Minhas Finanças</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="imagens/cifrao_origen.png">
</head>
<dody>
   <?php
     include_once('navbar.php');
    ?>
<!--Menus=================================================================-->
<!--MOVIMENTAÇÃO-->
<section class="container-fluid">
<!--título===============================================================================================-->
<div class="row justify-content-center">
<div class="col-12 col-sm-12 col-md-12 col-lg-11 col-xl-11 assunto">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 titulo_index">
            <h2>UTILITÁRIOS</h2>
        </div>
    </div>
    <!--==================================================DESCRIÇÃO================================================================-->
    <!--MOVIMENTAÇÃO FINANCEIRA-->
        <div class="row artigos">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 sub_artigo">
                <div class="row justify-content-center">
                   <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <img src="imagens/salario-rec.jpg" alt="salário" width="100%" class="rounded-circle img_cent">
                   </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <h3 class="mov_text"><b>Movimentações Financeira</b></h3>
                <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Despesas diárias</li>
                <p>Cadastro de despesa diárias detalhando valor, data, descrição, tipo e local.</p>
                <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Cadastro do capital</li>
                <p>Cadastro do capital do mês vigente com definição de valores, descrição e data tendo.</p>
                <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Visualização despesas</li>
                <p>visualização das despesas já feita podendo filtra por tipo, périodo ou dia.</p>
                <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Visualização do capital</li>
                <p>visualização do capital já recebido podendo filtra por périodo ou dia.</p>    
                    </div>
                </div>
            </div>
        </div>
    <!--PROJEÇÃO DE DESPESAS DOS MESES A SEGUIR-->
        <div class="row artigosv">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sub_artigo">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 sub_artigo">
                <div class="row justify-content-center">
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <img src="imagens/pessoa_tempo-rec.jpg" alt="salário" width="100%" class="rounded-circle img_centV">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <h3 class="mov_textV"><b>Projeção de Despesas e Saldo</b></h3>
                <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Cadastro das despesas futuras</li>
                <p>Cadastros das despesas posteriores com valor, descrição, tipo e mês referente.</p>
                <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Cadastro do capital futuros</li>
                <p>Cadastros do capital posteriores com valor descrição e mês referente.</p>
                <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Visualização das despesas futura.</li>
                <p>visualização das despesas posteriores com valor descrição, tipo e mês referente.</p>
                <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Visualização do Capital futuros</li>
                <p>visualização do capital posteriores com valor descrição e mês referente.</p>    
                    </div>
                </div>
            </div>
        </div>
    <!--VISÃO GERAL-->
        <div class="row artigos">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 sub_artigo">
                <div class="row justify-content-center">
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <img src="imagens/visao-rec.jpg" alt="salário" width="100%" class="rounded-circle img_cent">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <h3 class="mov_text"><b>Visão Geral</b></h3>
                <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Projeção de saldo</li>
                <p>Projeção de saldo unifome diário e mensal do mês vigente.</p>
                <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Projeção de saldo de meses posteriores</li>
                <p>Projeção de saldo unifome diário e mensal dos dois meses posteriores.</p>
                    </div>
                </div>
            </div>
        </div>
        <!--lista de compras-->
        <div class="row artigosv">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sub_artigo">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 sub_artigo">
                <div class="row justify-content-center">
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <img src="imagens/compras-rec.jpg" alt="salário" width="100%" class="rounded-circle img_centV">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <h3 class="mov_textV"><b>Lista de Desejo</b></h3>
                <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Cadastro de compras</li>
                <p>Cadastro de lista de compras o que deseja compra com nível de prioridade e valores.</p>
                <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Visualização da lista de compras</li>
                <p>Visualizaçao da lista de compras ordernado por prioridade podendo deletar ou marcar como compradas.</p>
                        <li class="listadesc"><img src="imagens/moeda-peq.png" alt="moeda de ouro" width="3%">Update do item</li>
                <p>modificação dos valores ou prioridade do item.</p>            
                    </div>
                </div>
            </div>
        </div>
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