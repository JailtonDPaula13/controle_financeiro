<?php
ini_set('display_errors', FALSE);
require_once('conexao/conect.php');
    session_start();
//========================verificação de segurança==============================================//
if( !isset($_SESSION["v_login"])){
    header("location:login.php?projecao=1");
}
else
{
    $v_loginp = $_SESSION["v_login"];
}
//=====================delete registros=================================
//despesas
if(isset($_GET['deleteId']))
{
    $delete = $_GET['deleteId'];
    mysqli_query($conexao_dois, "delete from tb_despesa_fut where id_des = '$delete' and login = '$v_loginp';");
}
//crédito
if(isset($_GET['deleteIS']))
{
    $delete = $_GET['deleteIS'];
    mysqli_query($conexao_dois, "delete from tb_saldo_fut where id_saldo_fut = '$delete' and login = '$v_loginp';");
}
//====consulta tipo========//
 $v_tipo = mysqli_query($conexao_sete,"select * from tb_tipo_compras;");
 $v_tipo2 = mysqli_query($conexao_sete,"select * from tb_tipo_compras;");
//======================primeiro modal=================insert====================//
if(isset($_POST['realF']))
{
    $valor     = $_POST['realF'];
    $descricao = isset($_POST['descricaoF'])?$_POST['descricaoF']:null;
    $datam     = $_POST['datam'];
    $dataa     = $_POST['dataa'];
    $v_tipoin  = $_POST['futDesp'];

    mysqli_query($conexao_um, "call pr_despesas_futura('$valor','$descricao','$datam','$dataa','$v_loginp','$v_tipoin');");
    
    unset($_POST['realF']);
}
//=====================segundo modal===================================================
if(isset($_POST['realSF']))
{
    $valors     = $_POST['realSF'];
    $descricaos = isset($_POST['descricaoSF'])?$_POST['descricaoSF']:null;
    $datams     = $_POST['datamS'];
    $dataas     = $_POST['dataaS'];

    mysqli_query($conexao_um, "call pr_saldo_fut('$valors','$descricaos','$datams','$dataas','$v_loginp');");
    
    unset($_POST['realSF']);
}


//=============================selecção de abas================================//
if(isset($_POST['clicksaldo']) or isset($_GET['click3']) or isset($_GET['deleteIS']))
         {
            $v_abaC = 'active';
            $v_abaD = null;
         }
      else
         {
          $v_abaD = 'active';
          $v_abaC = null;
         }
//=============================consulta despesas futura===========================
if(isset($_GET['pesquisaD1'])){
    $v_dateum     = $_GET['pesquisaD1'];
    if($_GET['pesdfut'] == 0)
    {
      $v_pesfut = "is not null";  
    }
    else
    {    
      $v_pesfut = "=".$_GET['pesdfut'];
    }
    $v_consulta   = mysqli_query($conexao_um, "select
                                                id_des,
                                                valor,
                                                descricao,
                                                date_format(mes, '%m/%y') as data,
                                                c.ds_tipo,
                                                mes
                                               from
                                                tb_despesa_fut f
                                               inner join
                                                tb_tipo_compras c on f.id_tipo = c.id_tipo
                                               where
                                                    f.id_tipo  $v_pesfut
                                                and substr(mes,1,7) = '$v_dateum' and login = '$v_loginp'
                                                order by 6 desc;");
    $v_consultadf = mysqli_fetch_row(mysqli_query($conexao_tres,"select
                                                                  sum(valor)
                                                                 from
                                                                  tb_despesa_fut f
                                                                 where
                                                                      substr(mes,1,7) = '$v_dateum'
                                                                  and f.id_tipo  $v_pesfut
                                                                  and login = '$v_loginp'
                                                                  and mes > now();"));
}
else{
    $v_consulta = mysqli_query($conexao_um, "select
                                                id_des,
                                                valor,
                                                descricao,
                                                date_format(mes, '%m/%y') as data,
                                                c.ds_tipo,
                                                mes
                                            from
                                                tb_despesa_fut f
                                            inner join
                                                tb_tipo_compras c on f.id_tipo = c.id_tipo
                                            where
                                                    login = '$v_loginp'
                                                and mes > now()
                                                order by 6 desc;");
    $v_consultadf = mysqli_fetch_row(mysqli_query($conexao_tres, "select sum(valor) from tb_despesa_fut where login = '$v_loginp' and mes > now();"));
}
//=============================consulta Crédito futura===========================
if(isset($_GET['pesquisaD2'])){
    $v_dateums     = $_GET['pesquisaD2'];
    $v_consultas   = mysqli_query($conexao_quatro, "select id_saldo_fut, valor, descricao, date_format(data, '%m/%y'), data from tb_saldo_fut where substr(data,1,7) = '$v_dateums' and login = '$v_loginp' and data > now() order by 5 desc;");
    $v_consultasf = mysqli_fetch_row(mysqli_query($conexao_tres, "select sum(valor) from tb_saldo_fut where substr(data,1,7) = '$v_dateums' and login = '$v_loginp'  and data > now() order by 1 desc;"));
}
else{
    $v_consultas = mysqli_query($conexao_quatro, "select id_saldo_fut, valor, descricao, date_format(data, '%m/%y'), data from tb_saldo_fut where login = '$v_loginp' and data > now() order by 5 desc;");
    $v_consultasf = mysqli_fetch_row(mysqli_query($conexao_tres, "select sum(valor) from tb_saldo_fut where login = '$v_loginp' and data > now();"));
}
?>
<!--======================inicio do HTML============================================-->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Projeção</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/despesas.css">
        <link rel="stylesheet" href="css/projecao.css">
        <link rel="shortcut icon" href="/imagens/cifrao_origen.png" >
    </head>
    <body>
        <?php
            require_once('navbar.php');
        ?>
<!--==================================modal=====================================================-->
<section class="container-fluid">
<div class="row justify-content-center linhaBotoes">
    <div class="col-5 col-sm-5 col-md-5 col-lg-4 col-xl-4  botoesLinha" id="modalDesp">
        <center>
            <button class="botaoModal" data-toggle="modal" data-target="#despesasfuturas">
              Cadastro de despesa futura
            </button>
        </center>
    </div>
    <div class="col-5 col-sm-5 col-md-5 col-lg-4 col-xl-4  botoesLinha" id="modalCred">
        <center>
            <button class="botaoModal" data-toggle="modal" data-target="#modalsaldofut">
              Cadastro de saldo futuro
            </button>
        </center>
    </div>
</div>
</section>
                <!-- Modal -->
                    <div class="modal fade" id="despesasfuturas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h2 class="tituloModal">Cadastro Despesas Futuras</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="projecao.php" method="post"> 
                          <div class="modal-body modalCadFut">
                            <label class="labelstyle">R$:</label><br>
                            <input name="realF" id="real" type="number" step="0.01" placeholder="0,00" min="0" max="9999" class="inputstyle" required><br>
                            <label class="labelstyle">DESCRIÇÃO:</label><br>
                            <input name="descricaoF" id="descricao" type="text" size="18" maxlength="50" placeholder="Parcela Moto" class="inputstyle" required><br>
                            <label class="labelstyle">DATA:</label><br>
                            <select name="datam" class="inputstyle">
                                <?php
                                   for($v_mes = 01; $v_mes < 13; $v_mes ++){  
                                ?>
                                <option value="<?php print_r($v_mes); ?>"><?php print_r($v_mes); }?></option>
                            </select>
                            <select name="dataa" class="inputstyle">
                                <?php
                                   for($v_ano = 2020; $v_ano < 2050; $v_ano ++){  
                                ?>
                                <option value="<?php print_r($v_ano); ?>"><?php print_r($v_ano); }?></option>
                            </select><br>
                            <label class="labelstyle">TIPO:</label><br>    
                            <select name="futDesp" class="inputstyle">
                                <?php while($v_rettipo = mysqli_fetch_row($v_tipo)){ ?>
                                <option value="<?php print_r($v_rettipo[0]); ?>"><?php print_r($v_rettipo[1]); ?></option>
                                <?php } ?>
                            </select>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="botaoExit" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="botaoCad">Cadastrar</button>
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
                                <h2 class="tituloModal">Cadastro Saldo Futuras</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="projecao.php" method="post">
                              <div class="modal-body modalSaldoCadFut">
                                <label class="labelstyle">R$:</label><br>
                                <input name="realSF" id="realD" type="number" step="0.01" placeholder="0,00" min="0" max="9999" class="inputstyle" required><br>
                                <label class="labelstyle">DESCRIÇÃO:</label><br>
                                <input name="descricaoSF" id="descricaoC" type="text" size="18" maxlength="50" placeholder="Salário" class="inputstyle" required><br>
                                <label class="labelstyle">DATA:</label><br>
                                <select name="datamS" class="inputstyle">
                                <?php
                                   for($v_mes = 01; $v_mes < 13; $v_mes ++){  
                                ?>
                                <option value="<?php print_r($v_mes); ?>"><?php print_r($v_mes); }?></option>
                               </select>
                               <select name="dataaS" class="inputstyle">
                                <?php
                                   for($v_ano = 2019; $v_ano < 2050; $v_ano ++){  
                                ?>
                                <option value="<?php print_r($v_ano); ?>"><?php print_r($v_ano); }?></option>
                               </select>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="botaoExit" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="botaoCad" name="clicksaldo" value="1">Cadastrar</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
<!--==================================titulo======================================================-->
<section class="container-fluid">
    <section class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
           <h2 class="tituloDC">Lista de despesas e capital futuros</h2>
        </div>
    </section>
</section><!--container dois-->
<!--==================================abas modal======================================================-->
<div class="tabbable" id="tabs-450075">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link d_aba <?php print_r($v_abaD); ?>" href="#tab1" data-toggle="tab">Despesas futura</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d_aba <?php print_r($v_abaC); ?>" href="#tab2" data-toggle="tab">Saldo futuro</a>
                    </li>
                </ul>
<!--=============================inicio tabelas========================================================================-->
                <div class="tab-content">
<!--=============================primeira aba==========================================================================-->
                    <div class="tab-pane <?php print_r($v_abaD); ?> abaUmTotal" id="tab1">
                        <section class="container-fluid">
                                  <form action="projecao.php" method="get" class="formsstyle row justify-content-lg-center">
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-auto col-xl-auto">
                                          <label class="pesquisaTabela">De:</label>
                                          <input name="pesquisaD1" id="pesquisaD1" type ="month" min="2019-01" max="2050-01" class="inputPesquisa" placeholder="YYYY-MM" size="7" required>
                                      </div>
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-auto col-xl-auto">
                                          <label class="pesquisaTabela">Tipo:</label>
                                          <select class="inputPesquisa" name="pesdfut">
                                              <option value="0">TODOS</option>
                                              <?php while($v_tipolist = mysqli_fetch_row($v_tipo2)){ ?>
                                              <option value="<?php print_r($v_tipolist[0]);?>"><?php print_r($v_tipolist[1]);?></option>
                                              <?php } ?>
                                          </select>
                                      </div>
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-auto col-xl-auto butoesData">
                                          <button type="submit" class="botaoPesquisaData"><img src="imagens/tempo-pq.png" alt="tempo" width="30"></button>
                                          <a href="projecao.php"><img src="imagens/atualizacao.png" alt="atualiza" width="34" class="resetPagina"></a>
                                      </div>
                                  </form>
                            </section>
                           <!--========inicio primeira tabela==========-->
                    <div class="tabelaStyle">
                       <table class="table">
                          <thead class="cabecalhoTabela">
                            <tr>
                              <th scope="col">Valor</th>
                              <th scope="col">Descrição</th>
                              <th scope="col">Tipo</th>
                              <th scope="col">Delete</th>
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
                              <th scope="row"><?php print_r('R$: '.str_replace(".",",",$consulta_despesas[1]));?></th>
                              <td><?php print_r($consulta_despesas[2]);?></td>
                              <td><?php print_r($consulta_despesas[4]);?></td>
                                <td>
                                    <a data-toggle="modal" data-target="#despFutura<?php print_r($consulta_despesas[0]);?>">
                                     <img src="imagens/lixeira-red.png" alt="lixeira" width="30px" class="excList rounded-circle">
                                    </a>
                                </td>
                              <td><?php print_r($consulta_despesas[3]);?></td>
                              <!-- Modal -->
                                <div class="modal fade" id="despFutura<?php print_r($consulta_despesas[0]);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                      <h4>Deseja excluir o item a seguir?</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div> 
                                      <div class="modal-body exclusaoModal">
                                          <center><h5 class="descriDel">Descrição:&nbsp;<?php print_r($consulta_despesas[2]);?></h5></center>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="botaoExit" data-dismiss="modal">Não</button>
                                          <a href="projecao.php?deleteId=<?php print_r($consulta_despesas[0]); if($v_dateum){echo("&pesquisaD1=".$_GET['pesquisaD1']."&pesdfut=".$_GET['pesdfut']);}?>">
                                        <button type="submit" class="botaoCad">Sim</button>
                                          </a>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            <?php }} ?>
                            </tr>
                          </tbody>
                        <!--========total tabela de despesa futura===============-->
                          <tbody class="cabecalhoTabela">
                           <tr>

                              <th scope="col"><?php print_r('R$: '.$v_consultadf[0]); ?></th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                              <th scope="col"></th>

                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>
                    <!--=====fim primeira tabela despesa=====-->
                    <div class="tab-pane <?php print_r($v_abaC); ?> abas" id="tab2">
        <!--===============inicio tabela dois===================-->
                        <section class="container-fluid">
                                  <form action="projecao.php" method="get" class="formsstyle row justify-content-lg-center">
                                      <div class="col-6 col-sm-6 col-md-6 col-lg-auto col-xl-auto">
                                          <label  class="pesquisaTabela">De:</label>
                                          <input name="pesquisaD2" id="pesquisaD2" type ="month" min="2019-01" max="2050-01" placeholder="YYYY-MM" size="7" class="inputPesquisa" required>
                                      </div>
                                      <div class="col-12 col-sm-12 col-md-12 col-lg-auto col-xl-auto butoesData">
                                          <button type="submit" class="botaoPesquisaData" name="click3" value="1"><img src="imagens/tempo-pq.png" alt="tempo" width="30"></button>
                                          <a href="projecao.php?click3=1"><img src="imagens/atualizacao.png" alt="atualiza" width="34" class="resetPagina"></a>
                                      </div>
                                  </form>
                        </section>
                           <!--========inicio primeira tabela==========-->
                        <div class="tabelaStyle">
                            <table class="table">
                          <thead class="cabecalhoTabela">
                            <tr>
                              <th scope="col">Valor</th>
                              <th scope="col">Descrição</th>
                              <th scope="col">Delete</th>
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
                              <th scope="row"><?php print_r('R$: '.str_replace(".",",",$consulta_saldo[1]));?></th>
                              <td><?php print_r($consulta_saldo[2]);?></td>
                              <td>
                                  <a data-toggle="modal" data-target="#saldoFutura<?php print_r($consulta_saldo[0]);?>">
                                   <img src="imagens/lixeira-red.png" alt="lixeira" width="30px" class="excList rounded-circle">
                                  </a>
                              </td>
                              <td><?php print_r($consulta_saldo[3]);?></td>
                            <!-- Modal 04-->
                                <div class="modal fade" id="saldoFutura<?php print_r($consulta_saldo[0]);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                      <h4>Deseja excluir o item?</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div> 
                                      <div class="modal-body exclusaoModal">
                                          <center><h5 class="descriDel"><?php print_r($consulta_saldo[2]);?></h5></center>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="botaoExit" data-dismiss="modal">Não</button>
                                          <a href="projecao.php?deleteIS=<?php print_r($consulta_saldo[0]); if($v_dateums){echo("&pesquisaD2=".$_GET['pesquisaD2']."&click3=1");} ?>">
                                        <button type="submit" class="botaoCad">Sim</button>
                                          </a>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <?php }} ?>
                            </tr>
                          </tbody>
                        <!--========total tabela de despesa futura===============-->
                          <tbody class="cabecalhoTabela">
                           <tr>

                              <th scope="col"><?php print_r('R$: '.$v_consultasf[0]); ?></th>
                              <th scope="col"></th>
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