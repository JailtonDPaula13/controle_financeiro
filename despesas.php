<?php
    require_once "conexao/conect.php";
?>
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
<!--=======================================================================================-->
    <div class="row">
    <div class="col-12" style="padding:0;">
        <center>
        <h5 id='principio'>
            “Quando saímos do foco, esquecemos que são nossos sonhos que estão em jogo, deixamos de lado muitas coisas importantes, e acabamos colocando em risco tudo que conquistamos.”
        </h5>
        </center>
    </div>
    </div>
<!--=======================================================================================-->
<div class="row">
    <div class="col-6 col-sm-6 col-md-6 ">
       <!-- Botão para acionar modal -->
            <button class="caddesp" data-toggle="modal" data-target="#modalExemplo">
              Cadastro de despesa
            </button>
    </div>
    <div class="col-6">
            <button class="caddesp" data-toggle="modal" data-target="#modalDois">
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
                        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
    </div>
<!--==========================================seleção de dados==============================================-->
    <div class="container-fluid">
        <div class="row">
            <div class="pasta col-md-12">
                <div class="tabbable" id="tabs-450075">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link d_aba active" href="#tab1" data-toggle="tab">Despesas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d_aba" href="#tab2" data-toggle="tab">Crédito</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active abas" id="tab1">
                           <!--inicio tabela-->
                           <table class="table">
                              <form>
                                  <div class="row">
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                          <label class="pesquis">De:</label>
                                          <input name="pesquisaD" id="pesquisaD" type = text placeholder="00/00/00" class="pesquisaDI">
                                      </div>
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                          <label class="pesquis">A:</label>
                                          <input name="pesquisaD" id="pesquisaD" type = text placeholder="00/00/00" class="pesquisaDI">
                                      </div>
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-1 col-xl-1">
                                          <button type="submit" class="pesquisaDI">Pesquisa</button>
                                      </div>
                                      
                                  </div>
                              </form>
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">Valor</th>
                                  <th scope="col">Descrição</th>
                                  <th scope="col">Local</th>
                                  <th scope="col">Data</th>
                                </tr>
                              </thead>
                              <tbody>
                                <!--Inicio do loop-->
                                <?php
                                  
                                  $v_consulta = mysqli_query($conexao_dois,"select id_compra, valor, descricao, local, date_format(data, '%d/%m/%y') from tb_despesa_mes order by 4;");
                                  if(!$v_consulta)
                                  {
                                      echo("Erro de conexão D:");
                                  }
                                  else
                                  {
                                      while($v_resultado = mysqli_fetch_row($v_consulta))
                                      {                                  
                                 ?>
                                <tr>
                                  <th scope="row"><?php print_r('R$: '.$v_resultado[1]);?></th>
                                  <td><?php print_r($v_resultado[2]);?></td>
                                  <td><?php print_r($v_resultado[3]);?></td>
                                  <td><?php print_r($v_resultado[4]); }}?></td>
                                </tr>
                              </tbody>
                            </table>
                           <!--fim tabela-->
                        </div>
                        <div class="tab-pane abas" id="tab2">
                            <!--inicio tabela-->
                            <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">Valor</th>
                                  <th scope="col">Descrição</th>
                                  <th scope="col">Data</th>
                                </tr>
                              </thead>
                              <tbody>
                                <!--Inicio do loop-->
                                <?php
                                  
                                  $v_consulta = mysqli_query($conexao_quatro,"select id_compra, valor, descricao, date_format(data, '%d/%m/%y') from tb_credito_mes order by 4;");
                                  if(!$v_consulta)
                                  {
                                      echo("Erro de conexão D:");
                                  }
                                  else
                                  {
                                      while($v_resultado = mysqli_fetch_row($v_consulta))
                                      {                                  
                                 ?>
                                <tr>
                                  <th scope="row"><?php print_r('R$: '.$v_resultado[1]);?></th>
                                  <td><?php print_r($v_resultado[2]);?></td>
                                  <td><?php print_r($v_resultado[3]);}}?></td>
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
<!--==========================================insert tabela=================================================-->
<?php
    
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
?>
</div>
<!--SCRIPTS===============================================================-->
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
</div>
</body>
</html>