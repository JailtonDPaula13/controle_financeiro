<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Despesas</title>
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
    <div class="col-12">
       <!-- Botão para acionar modal -->
            <button class="caddesp" data-toggle="modal" data-target="#modalExemplo">
              Cadastro de despesa
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
    </div>
<!--==========================================seleção de dados==============================================-->
    <div class="container-fluid">
        <div class="row">
            <div class="pasta col-md-12">
                <div class="tabbable" id="tabs-450075">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab1" data-toggle="tab">Despesas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab2" data-toggle="tab">Crédito</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active abas" id="tab1">
                           <!--inicio tabela-->
                           <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">First</th>
                                  <th scope="col">Last</th>
                                  <th scope="col">Handle</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>Mark</td>
                                  <td>Ottosdfdsfdsfdsfds</td>
                                  <td>@mdofdfsfsfdsfdsfs</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Jacob</td>
                                  <td>Thornton</td>
                                  <td>@fat</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>Larry</td>
                                  <td>the Bird</td>
                                  <td>@twitter</td>
                                </tr>
                              </tbody>
                            </table>
                           <!--fim tabela-->
                        </div>
                        <div class="tab-pane abas" id="tab2">
                            <!--inicio tabela-->
                            <p>pasta 2</p>
                            <!--fim tabela-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--==========================================insert tabela=================================================-->
<?php
    
    include_once "conexao/conect.php";
    
    $valor    =isset($_POST['real'])?$_POST['real']:null;
    $descricao=isset($_POST['descricao'])?$_POST['descricao']:null;
    $local    =isset($_POST['local'])?$_POST['local']:null;
    $data     =isset($_POST['data'])?$_POST['data']:null;
    
    $insert   =mysqli_query($conexao_um,"insert into tb_despesa_mes values(null,'$valor','$descricao','$local','$data');");
?>
</div>
<!--SCRIPTS===============================================================-->
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
</div>
</body>
</html>