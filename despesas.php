<?php
    require_once "conexao/conect.php";
    setlocale(LC_ALL, "PT-BR");
    session_start();
//========================verificação de segurança==============================================//
if( !isset($_SESSION["v_login"])){
    header("location:login.php");
}
//=============================delete de registro=====================================================
//despesa       
     if(isset($_POST['deleteId']))
       {
           $v_deleteD = $_POST['deleteId'];
           $resultado = mysqli_query($conexao_seis, "delete from tb_despesa_mes where id_compra = '$v_deleteD';");
       }
    if(isset($_POST['deleteIC']))
       {
           $v_deleteC = $_POST['deleteIC'];
           $resultado = mysqli_query($conexao_seis, "delete from tb_credito_mes where id_compra = '$v_deleteC';");
       }
//<!--==========================================insert tabela=================================================-->
    
    //modal despesa
    $valor    =isset($_POST['real'])?$_POST['real']:"";
    $descricao=isset($_POST['descricao'])?$_POST['descricao']:null;
    $local    =isset($_POST['local'])?$_POST['local']:null;
    $data     =isset($_POST['data'])?$_POST['data']:null;
    //modal crédito
    $valorC    =isset($_POST['realD'])?$_POST['realD']:"";
    $descricaoC=isset($_POST['descricaoC'])?$_POST['descricaoC']:null;
    $dataC     =isset($_POST['dataC'])?$_POST['dataC']:null;
    
    $insert   =mysqli_query($conexao_um,"call pr_despesas ('$valor','$descricao','$local','$data');");
    $insert   =mysqli_query($conexao_tres,"call pr_credito ('$valorC','$descricaoC','$dataC');");
    
    unset($_POST['realD'], $_POST['real']);
//===========================================seleção de abas ao carregar=========================


//<!--===================consulta data e lista de despesas=======================================-->

    if(isset($_POST['pesquisaD1']) and isset($_POST['pesquisaD2']) and $_POST['pesquisaD1'] == $_POST['pesquisaD2'])
    {
//                                       echo("valores iguais");
       $v_data_inicial = $_POST['pesquisaD1'];
       $v_total        = mysqli_query($conexao_cinco, "select sum(valor)  from tb_despesa_mes where data = '$v_data_inicial';");
       $v_consulta = mysqli_query($conexao_dois,"select id_compra, valor, descricao, local, date_format(data, '%d/%m/%y') from tb_despesa_mes where data = '$v_data_inicial' order by 5 desc;");
    }
    elseif(isset($_POST['pesquisaD1']) and isset($_POST['pesquisaD2']) and $_POST['pesquisaD1'] < $_POST['pesquisaD2'])
    {  
//                                       echo("valores <>");
       $v_data_inicial = $_POST['pesquisaD1'];
       $v_data_final   = $_POST['pesquisaD2'];
       $v_total        = mysqli_query($conexao_cinco, "select sum(valor)  from tb_despesa_mes where data between '$v_data_inicial' and '$v_data_final'");
       $v_consulta = mysqli_query($conexao_dois,"select id_compra, valor, descricao, local, date_format(data, '%d/%m/%y') from tb_despesa_mes where data between '$v_data_inicial' and '$v_data_final' order by 5 desc;"); 
    }
  elseif(isset($_POST['pesquisaD1']) and $_POST['pesquisaD2'] == null)
    {
//                                       echo("valores um");
       $v_data_inicial = $_POST['pesquisaD1'];
       $v_total        = mysqli_query($conexao_cinco, "select sum(valor)  from tb_despesa_mes where data = '$v_data_inicial';");
       $v_consulta = mysqli_query($conexao_dois,"select id_compra, valor, descricao, local, date_format(data, '%d/%m/%y') from tb_despesa_mes where data = '$v_data_inicial' order by 5;");
    }
  elseif(isset($_POST['pesquisaD1']) and isset($_POST['pesquisaD2']) and $_POST['pesquisaD1'] > $_POST['pesquisaD2'])
    {  
//                                       echo("valores troc");
       $v_data_inicial = $_POST['pesquisaD1'];
       $v_data_final   = $_POST['pesquisaD2'];
       $v_total        = mysqli_query($conexao_cinco, "select sum(valor)  from tb_despesa_mes where data between '$v_data_final' and '$v_data_inicial'");
       $v_consulta = mysqli_query($conexao_dois,"select id_compra, valor, descricao, local, date_format(data, '%d/%m/%y') from tb_despesa_mes where data between '$v_data_final' and '$v_data_inicial' order by 5 desc;");
    }
  else
    {  
//                                       echo("valores");
       $v_data_inicial = isset($_POST['pesquisaD1'])?$_POST['pesquisaD1']:null;
       $v_data_final   = isset($_POST['pesquisaD2'])?$_POST['pesquisaD2']:null;
       $v_total        = mysqli_query($conexao_cinco, "select sum(valor)  from tb_despesa_mes;");
       $v_consulta = mysqli_query($conexao_dois,"select id_compra, valor, descricao, local, date_format(data, '%d/%m/%y') from tb_despesa_mes order by 5 desc;");
    }
  $v_resltotal = mysqli_fetch_row($v_total);
//<!--===================fim consulta data e lista de despesas=======================================-->
//<!--===================consulta data e lista de crédito=======================================-->

    if(isset($_POST['pesquisaD3']) and isset($_POST['pesquisaD4']) and $_POST['pesquisaD3'] == $_POST['pesquisaD4'])
    {
//                                       echo("valores iguais");
       $v_data_inicial_C = $_POST['pesquisaD3'];
       $v_total_h        = mysqli_query($conexao_cinco, "select sum(valor)  from tb_credito_mes where data = '$v_data_inicial_C';");
       $v_consulta_C = mysqli_query($conexao_quatro,"select id_compra, valor, descricao, date_format(data, '%d/%m/%y') from tb_credito_mes where data = '$v_data_inicial_C' order by 4 desc;");
    }
    elseif(isset($_POST['pesquisaD3']) and isset($_POST['pesquisaD4']) and $_POST['pesquisaD3'] < $_POST['pesquisaD4'])
    {  
//                                       echo("valores <>");
       $v_data_inicial_C = $_POST['pesquisaD3'];
       $v_data_final   = $_POST['pesquisaD4'];
       $v_total_h        = mysqli_query($conexao_cinco, "select sum(valor)  from tb_credito_mes where data between '$v_data_inicial_C' and '$v_data_final'");
      $v_consulta_C = mysqli_query($conexao_quatro,"select id_compra, valor, descricao, date_format(data, '%d/%m/%y') from tb_credito_mes where data between '$v_data_inicial_C' and '$v_data_final' order by 4 desc;");
    }
  elseif(isset($_POST['pesquisaD3']) and $_POST['pesquisaD4'] == null)
    {
//                                       echo("valores um");
       $v_data_inicial_C = $_POST['pesquisaD3'];
       $v_total_h        = mysqli_query($conexao_cinco, "select sum(valor)  from tb_credito_mes where data = '$v_data_inicial_C';");
       $v_consulta_C = mysqli_query($conexao_quatro,"select id_compra, valor, descricao, date_format(data, '%d/%m/%y') from tb_credito_mes where data = '$v_data_inicial_C' order by 4 desc;");
    }
  elseif(isset($_POST['pesquisaD3']) and isset($_POST['pesquisaD4']) and $_POST['pesquisaD3'] > $_POST['pesquisaD4'])
    {  
//                                       echo("valores troc");
       $v_data_inicial_C = $_POST['pesquisaD3'];
       $v_data_final   = $_POST['pesquisaD4'];
       $v_total_h        = mysqli_query($conexao_cinco, "select sum(valor)  from tb_credito_mes where data between '$v_data_final' and '$v_data_inicial_C'");
       $v_consulta_C = mysqli_query($conexao_quatro,"select id_compra, valor, descricao, date_format(data, '%d/%m/%y') from tb_credito_mes where data between '$v_data_final' and '$v_data_inicial_C' order by 4 desc;");
    }
  else
    {  
//                                       echo("valores");
       $v_data_inicial_C = isset($_POST['pesquisaD3'])?$_POST['pesquisaD3']:null;
       $v_data_final   = isset($_POST['pesquisaD4'])?$_POST['pesquisaD4']:null;
       $v_total_h        = mysqli_query($conexao_cinco, "select sum(valor)  from tb_credito_mes;");
       $v_consulta_C = mysqli_query($conexao_quatro,"select id_compra, valor, descricao, date_format(data, '%d/%m/%y') from tb_credito_mes order by 4 desc;");
    }
  $v_resltotal_C = mysqli_fetch_row($v_total_h);

//<!--===================fim consulta data e lista de crédito=======================================-->
//=======================================aba crédito ou despesa ao carregar?===============================
      if(isset($_POST['clickC']) or isset($_POST['click']) or isset($_POST['click3']) or isset($_POST['click4']))
         {
            $v_abaC = 'active';
            $v_abaD = null;
         }
      else
         {
          $v_abaD = 'active';
          $v_abaC = null;
         }
      unset($_POST['clickC'], $_POST['click'], $_POST['click3'],$_POST['click4']);
   
  ?>
<!--inicio html =============================================================================-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Movimentações</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/despesas.css">
    <link rel="shortcut icon" href="/imagens/cifrao_origen.png" >
</head>
<body>
    <?php
        require_once('navbar.php');
    ?>
<div class="container-fluid">   
<!--==============================modal=========================================================-->
<div class="row">
    <div class="col-6 col-sm-6 col-md-6 ">
       <!-- Botão para acionar modal -->
            <button class="botaoModal" data-toggle="modal" data-target="#modalExemplo">
              Cadastro de despesa
            </button>
    </div>
    <div class="col-6">
            <button class="botaoModal" data-toggle="modal" data-target="#modalDois">
              Cadastro de Crédito
            </button>
        
        <!-- Modal -->
            <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <img src="imagens/cifrao_modal.png" alt="cifrão" width="30%">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="despesas.php" method="post">
                  <div class="modal-body">
                    <label>R$:</label><br>
                    <input name="real" id="real" type="number" step="0.01" placeholder="0,00" min="0" max="9999" required><br>
                    <label>DESCRIÇÃO:</label><br>
                    <input name="descricao" id="descricao" type="text" size="20" maxlength="50" placeholder="Bila" required><br>
                    <label>LOCAL:</label><br>
                    <input name="local" id="local" type="text" size="20" maxlength="50" placeholder="Budega do Madruga"><br>
                    <label>DATA:</label><br>
                    <input name="data" id="data" type="date" required><br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!--Modal 2-->
            <div class="modal fade" id="modalDois" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <img src="imagens/cofre-porquinho.png" alt="cifrão" width="30%">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="despesas.php" method="post">
                      <div class="modal-body">
                        <label>R$:</label><br>
                        <input name="realD" id="realD" type="number" step="0.01" placeholder="0,00" min="0" max="9999" required><br>
                        <label>DESCRIÇÃO:</label><br>
                        <input name="descricaoC" id="descricaoC" type="text" size="20" maxlength="50" placeholder="Salário" required><br>
                        <label>DATA:</label><br>
                        <input name="dataC" id="dataC" type="date" required><br>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" name="click4" value="1">Salvar mudanças</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
    </div>
<!--==========================================seleção de dados abas==============================================-->
    <div class="container-fluid">
        <div class="row">
            <div class="pasta col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="tabbable" id="tabs-450075">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link d_aba <?php print_r($v_abaD); ?>" href="#tab1" data-toggle="tab">Despesas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d_aba <?php print_r($v_abaC); ?>" href="#tab2" data-toggle="tab">Crédito</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane <?php print_r($v_abaD); ?> abas" id="tab1">
<!--=============================inicio tabelas========================================================================-->
                 <!--===========consulta tabela despesas=========-->
                           <table class="table">
                                  <div class="row">
                                      <form action="despesas.php" method="post">
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                          <label class="pesquis">De:</label>
                                          <input name="pesquisaD1" id="pesquisaD1" type = date class="pesquisaDI" required>
                                      </div>
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                          <label class="pesquis">A:&nbsp;&nbsp;</label>
                                          <input name="pesquisaD2" id="pesquisaD2" type = date class="pesquisaDI">
                                      </div>
                                      <div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
                                          <button type="submit" class="botaoPesquisaData"><img src="imagens/tempo-pq.png" alt="tempo" width="60%"></button>
                                      </div>
                                      </form>
                                      <form>
                                      <div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
                                          <button type="submit" class="botaoPesquisaData"><img src="imagens/atualizacao.png" alt="atualiza" width="60%"></button>
                                      </div>
                                      </form>
                                  </div>
                               <!--========================delete registro========================-->
                               <div class="row">
                                       <form acition="despesas.php" method="post">
                                   <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                           <label class="pesquis">
                                               Excluir ID:
                                           </label>
                                           <input name="deleteId" type="number" min="0" class="pesquisaDI" required>
                                   </div>
                                   <div class="col-4 col-sm-4 col-md-2 col-lg-1 col-xl-1">
                                          <button type="submit" class="botaoPesquisaData"><img src="imagens/lixeira-red.png" alt="atualiza" width="60%"></button>
                                   </div>
                                       </form>
                               </div>
                               <!--========inicio primeira tabela==========-->
                              <thead class="cabecalhoTabela">
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Valor</th>
                                  <th scope="col">Descrição</th>
                                  <th scope="col">Local</th>
                                  <th scope="col">Data</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  //$v_consulta configurado no incio -- whie permanece para visualização sem erro
                                  if(!$v_consulta)
                                  {
                                      echo("Erro de conexão D:");
                                  }
                                  else
                                  {
                                      while($v_resultado = mysqli_fetch_row($v_consulta))
                                      {                                  
                                 ?>
                                <tr class="linhaTabela">
                                  <th scope="row"><?php print_r($v_resultado[0]);?></th>
                                  <th scope="row"><?php print_r($v_resultado[1]);?></th>
                                  <td><?php print_r($v_resultado[2]);?></td>
                                  <td><?php print_r($v_resultado[3]);?></td>
                                  <td><?php print_r($v_resultado[4]); }}?></td>
                                </tr>
                              </tbody>
                            <!--========total tabela de despesa===============-->
                              <tbody class="cabecalhoTabela">
                               <tr>
                                   
                                  <th scope="col"></th>
                                  <th scope="col"><?php print_r('R$: '.$v_resltotal[0]); ?></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  
                                </tr>
                              </tbody>
                            </table>
                        </div>
                        <!--=====fim primeira tabela despesa=====-->
                        <div class="tab-pane <?php print_r($v_abaC); ?> abas" id="tab2">
            <!--===============inicio tabela dois===================-->
                        <!--===========consulta tabela crédito=========-->
                                 <table class="table">
                                 <div class="row">
                                  <form action="despesas.php" method="post">
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                          <label class="pesquis">De:</label>
                                          <input name="pesquisaD3" id="pesquisaD3" type = date class="pesquisaDI" required>
                                      </div>
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                          <label class="pesquis">A:&nbsp;&nbsp;</label>
                                          <input name="pesquisaD4" id="pesquisaD4" type = date class="pesquisaDI">
                                      </div>
                                      <div class="col-4 col-sm-4 col-md-4 col-lg-1 col-xl-1">
                                          <button name="click" type="submit" class="botaoPesquisaData" value="1"><img src="imagens/tempo-pq.png" alt="tempo" width="60%"></button>
                                      </div>
                                  </form>
                                  <form method="post">
                                      <div class="col-4 col-sm-4 col-md-4 col-lg-1 col-xl-1">
                                          <button name="clickC" type="submit" class="botaoPesquisaData" value="1"><img src="imagens/atualizacao.png" alt="tempo" width="60%"></button>
                                      </div>
                                  </form>
                                  </div>
                                     <!--========================delete registro credito========================-->
                               <div class="row">
                                       <form acition="despesas.php" method="post">
                                   <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                           <label class="pesquis">
                                               Excluir ID:
                                           </label>
                                           <input name="deleteIC" type="number" min="0" class="pesquisaDI" required>
                                   </div>
                                   <div class="col-4 col-sm-4 col-md-2 col-lg-1 col-xl-1">
                                          <button type="submit" class="botaoPesquisaData" name="click3" value="1"><img src="imagens/lixeira-red.png" alt="atualiza" width="60%"></button>
                                   </div>
                                       </form>
                               </div>
                       <!--=============tabela dois=================-->
                              <thead class="cabecalhoTabela">
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Valor</th>
                                  <th scope="col">Descrição</th>
                                  <th scope="col">Data</th>
                                </tr>
                              </thead>
                              <tbody>
                                <!--Inicio do loop-->
                                <?php
                                  
                                  
                                  if(!$v_consulta_C)
                                  {
                                      echo("Erro de conexão D:");
                                  }
                                  else
                                  {
                                      while($v_resultado_C = mysqli_fetch_row($v_consulta_C))
                                      {                                  
                                 ?>
                                <tr class="linhaTabela">
                                  <th scope="row"><?php print_r($v_resultado_C[0]);?></th>
                                  <th scope="row"><?php print_r('R$: '.$v_resultado_C[1]);?></th>
                                  <td ><?php print_r($v_resultado_C[2]);?></td>
                                  <td ><?php print_r($v_resultado_C[3]);}}?></td>
                                </tr>
                              </tbody>
                                <!--===========total tabela dois crédito================-->
                              <tbody class="cabecalhoTabela">
                               <tr>
                                  <th scope="col"></th>
                                  <th scope="col"><?php print_r('R$: '.$v_resltotal_C[0]); ?></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                </tr>
                              </tbody>
                            </table>
                            <!--fim tabela-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--SCRIPTS===============================================================-->
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
</div>
</body>
</html>