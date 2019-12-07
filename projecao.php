<?php
ini_set('display_errors', FALSE);
require_once('conexao/conect.php');
    session_start();
//========================verificação de segurança==============================================//
if( !isset($_SESSION["v_login"])){
    header("location:login.php");
}
//=====================delete registros=================================
if(isset($_POST['deleteId']))
{
    $delete = $_POST['deleteId'];
    mysqli_query($conexao_dois, "delete from tb_despesa_fut where id_des = '$delete';");
}if(isset($_POST['deleteIS']))
{
    $delete = $_POST['deleteIS'];
    mysqli_query($conexao_dois, "delete from tb_saldo_fut where id_saldo_fut = '$delete';");
}
//======================primeiro modal============================================
$valor     = isset($_POST['realF'])?$_POST['realF']:null;
$descricao = isset($_POST['descricaoF'])?$_POST['descricaoF']:null;
$datam     = isset($_POST['datam'])?$_POST['datam']:null;
$dataa     = isset($_POST['dataa'])?$_POST['dataa']:null;

mysqli_query($conexao_um, "call pr_despesas_futura('$valor','$descricao','$datam','$dataa');");
//=====================segundo modal===================================================
$valors     = isset($_POST['realSF'])?$_POST['realSF']:null;
$descricaos = isset($_POST['descricaoSF'])?$_POST['descricaoSF']:null;
$datams    = isset($_POST['datamS'])?$_POST['datamS']:null;
$dataas    = isset($_POST['dataaS'])?$_POST['dataaS']:null;

mysqli_query($conexao_um, "call pr_saldo_fut('$valors','$descricaos','$datams','$dataas');");

unset($_POST['realSF'],$_POST['realF']);
//=============================selecção de abas================================//
if(isset($_POST['clicksaldo']) or isset($_POST['click3']) or isset($_POST['click4']) or isset($_POST['click5']))
         {
            $v_abaC = 'active';
            $v_abaD = null;
         }
      else
         {
          $v_abaD = 'active';
          $v_abaC = null;
         }
      //unset($_POST['clickCsaldo'],$_POST['click3'],$_POST['click4'],$_POST['click5']);
//=============================consulta despesas futura===========================
if(isset($_POST['pesquisaD1'])){
    $v_dateum     = $_POST['pesquisaD1'];
    $v_consulta   = mysqli_query($conexao_um, "select id_des, valor, descricao, date_format(mes, '%m/%y') as data, mes from tb_despesa_fut where substr(mes,1,7) = '$v_dateum' order by 5 desc;");
    $v_consultadf = mysqli_fetch_row(mysqli_query($conexao_tres, "select sum(valor) from tb_despesa_fut where substr(mes,1,7) = '$v_dateum';"));
}
else{
    $v_consulta = mysqli_query($conexao_um, "select id_des, valor, descricao, date_format(mes, '%m/%y') as data, mes from tb_despesa_fut order by 5 desc;");
    $v_consultadf = mysqli_fetch_row(mysqli_query($conexao_tres, "select sum(valor) from tb_despesa_fut;"));
}
//=============================consulta Crédito futura===========================
if(isset($_POST['pesquisaD2'])){
    $v_dateums     = $_POST['pesquisaD2'];
    $v_consultas   = mysqli_query($conexao_quatro, "select id_saldo_fut, valor, descricao, date_format(data, '%m/%y'), data from tb_saldo_fut where substr(data,1,7) = '$v_dateums' order by 5 desc;");
    $v_consultasf = mysqli_fetch_row(mysqli_query($conexao_tres, "select sum(valor) from tb_saldo_fut where substr(data,1,7) = '$v_dateums' order by 1 desc;"));
}
else{
    $v_consultas = mysqli_query($conexao_quatro, "select id_saldo_fut, valor, descricao, date_format(data, '%m/%y'), data from tb_saldo_fut order by 5 desc;");
    $v_consultasf = mysqli_fetch_row(mysqli_query($conexao_tres, "select sum(valor) from tb_saldo_fut;"));
}
?>
<!--======================inicio do HTML============================================-->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Projeção</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/despesas.css">
        <link rel="shortcut icon" href="/imagens/cifrao_origen.png" >
    </head>
    <body>
        <?php
            require_once('navbar.php');
        ?>
<!--==================================modal=====================================================-->
        <section class="container-fluid">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-6 ">
                   <!-- Botão para acionar modal -->
                        <button class="botaoModal" data-toggle="modal" data-target="#despesasfuturas">
                          Cadastro de despesa futura
                        </button>
                </div>
                <div class="col-6">
                        <button class="botaoModal" data-toggle="modal" data-target="#modalsaldofut">
                          Cadastro de saldo futuro
                        </button>

                    <!-- Modal -->
                        <div class="modal fade" id="despesasfuturas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <img src="imagens/grafico.png" alt="cifrão" width="30%">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="projecao.php" method="post"> 
                              <div class="modal-body">
                                <label>R$:</label><br>
                                <input name="realF" id="real" type="number" step="0.01" placeholder="0,00" min="0" max="9999" required><br>
                                <label>DESCRIÇÃO:</label><br>
                                <input name="descricaoF" id="descricao" type="text" size="20" maxlength="50" placeholder="Bila" required><br>
                                <label>DATA:</label><br>
                                <select name="datam">
                                    <?php
                                       for($v_mes = 01; $v_mes < 13; $v_mes ++){  
                                    ?>
                                    <option value="<?php print_r($v_mes); ?>"><?php print_r($v_mes); }?></option>
                                </select>
                                  <select name="dataa">
                                    <?php
                                       for($v_ano = 2019; $v_ano < 2050; $v_ano ++){  
                                    ?>
                                    <option value="<?php print_r($v_ano); ?>"><?php print_r($v_ano); }?></option>
                                </select>
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
                        <div class="modal fade" id="modalsaldofut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <img src="imagens/imagens.png" alt="cifrão" width="30%">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="projecao.php" method="post">
                                  <div class="modal-body">
                                    <label>R$:</label><br>
                                    <input name="realSF" id="realD" type="number" step="0.01" placeholder="0,00" min="0" max="9999" required><br>
                                    <label>DESCRIÇÃO:</label><br>
                                    <input name="descricaoSF" id="descricaoC" type="text" size="20" maxlength="50" placeholder="Salário" required><br>
                                    <label>DATA:</label><br>
                                    <select name="datamS">
                                    <?php
                                       for($v_mes = 01; $v_mes < 13; $v_mes ++){  
                                    ?>
                                    <option value="<?php print_r($v_mes); ?>"><?php print_r($v_mes); }?></option>
                                   </select>
                                   <select name="dataaS">
                                    <?php
                                       for($v_ano = 2019; $v_ano < 2050; $v_ano ++){  
                                    ?>
                                    <option value="<?php print_r($v_ano); ?>"><?php print_r($v_ano); }?></option>
                                   </select>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary" name="clicksaldo" value="1">  Salvar mudanças</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                </div>
            </div>
<!--==================================abas modal======================================================-->
        <div class="row">
            <div class="pasta col-12 col-md-12">
                <div class="tabbable" id="tabs-450075">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link d_aba <?php print_r($v_abaD); ?>" href="#tab1" data-toggle="tab">Despesas futura</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d_aba <?php print_r($v_abaC); ?>" href="#tab2" data-toggle="tab">Saldo futuro</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane <?php print_r($v_abaD); ?> abas" id="tab1">
<!--=============================inicio tabelas========================================================================-->
                 <!--===========consulta tabela despesas=========-->
                           <table class="table">
                                  <div class="row">
                                      <form action="projecao.php" method="post">
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                          <label class="pesquis">De:</label>
                                          <input name="pesquisaD1" id="pesquisaD1" type ="month" min="2019-01" max="2050-01" class="pesquisaDI" placeholder="YYYY-MM" size="7" required>
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
                               <!-- ========================delete registro========================-->
                               <div class="row">
                                <form acition="projecao.php" method="post">
                                   <div class="col-12 col-sm-4 col-md-2 col-lg-2 col-xl-2">
                                           <label class="pesquis">
                                               Excluir ID:
                                           </label>
                                           <input name="deleteId" type="number" min="0" class="pesquisaDI" required>
                                   </div>
                                   <div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
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
                                      while($consulta_despesas = mysqli_fetch_row($v_consulta))
                                      {                                  
                                 ?>
                                <tr class="linhaTabela">
                                  <th scope="row"><?php print_r($consulta_despesas[0]);?></th>
                                  <th scope="row"><?php print_r('R$: '.$consulta_despesas[1]);?></th>
                                  <td><?php print_r($consulta_despesas[2]);?></td>
                                  <td><?php print_r($consulta_despesas[3]); }}?></td>    
                                </tr>
                              </tbody>
                            <!--========total tabela de despesa futura===============-->
                              <tbody class="cabecalhoTabela">
                               <tr>
                                   
                                  <th scope="col"></th>
                                  <th scope="col"><?php print_r('R$: '.$v_consultadf[0]); ?></th>
                                  <th scope="col"></th>
                                  <th scope="col"></th>
                                  
                                </tr>
                              </tbody>
                            </table>
                        </div>
                        <!--=====fim primeira tabela despesa=====-->
                        <div class="tab-pane <?php print_r($v_abaC); ?> abas" id="tab2">
            <!--===============inicio tabela dois===================-->
            <!--===========pesquisa======================-->
                         <table class="table">
                                  <div class="row">
                                      <form action="projecao.php" method="post">
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                          <label class="pesquis">De:</label>
                                          <input name="pesquisaD2" id="pesquisaD2" type ="month" min="2019-01" max="2050-01" class="pesquisaDI" placeholder="YYYY-MM" size="7" required>
                                      </div>
                                      <div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
                                          <button type="submit" class="botaoPesquisaData" name="click3" value="1"><img src="imagens/tempo-pq.png" alt="tempo" width="60%"></button>
                                      </div>
                                      </form>
                                      <form method="post">
                                      <div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
                                          <button type="submit" class="botaoPesquisaData" name="click4" value="1"><img src="imagens/atualizacao.png" alt="atualiza" width="60%"></button>
                                      </div>
                                      </form>
                                  </div>
                               <!-- ========================delete registro========================-->
                               <div class="row">
                                <form acition="projecao.php" method="post">
                                   <div class="col-12 col-sm-4 col-md-2 col-lg-2 col-xl-2">
                                           <label class="pesquis">
                                               Excluir ID:
                                           </label>
                                           <input name="deleteIS" type="number" min="0" class="pesquisaDI" required>
                                   </div>
                                   <div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
                                          <button type="submit" class="botaoPesquisaData" name="click5" value="1"><img src="imagens/lixeira-red.png" alt="atualiza" width="60%"></button>
                                   </div>
                                 </form>
                               </div>
                               <!--========inicio primeira tabela==========-->
                              <thead class="cabecalhoTabela">
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">Valor</th>
                                  <th scope="col">Descrição</th>
                                  <th scope="col">Data</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  //$v_consulta configurado no incio -- whie permanece para visualização sem erro
                                  if(!$v_consultas)
                                  {
                                      echo("Erro de conexão D:");
                                  }
                                  else
                                  {
                                      while($consulta_saldo = mysqli_fetch_row($v_consultas))
                                      {                                  
                                 ?>
                                <tr class="linhaTabela">
                                  <th scope="row"><?php print_r($consulta_saldo[0]);?></th>
                                  <th scope="row"><?php print_r('R$: '.$consulta_saldo[1]);?></th>
                                  <td><?php print_r($consulta_saldo[2]);?></td>
                                  <td><?php print_r($consulta_saldo[3]); }}?></td>    
                                </tr>
                              </tbody>
                            <!--========total tabela de despesa futura===============-->
                              <tbody class="cabecalhoTabela">
                               <tr>
                                   
                                  <th scope="col"></th>
                                  <th scope="col"><?php print_r('R$: '.$v_consultasf[0]); ?></th>
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