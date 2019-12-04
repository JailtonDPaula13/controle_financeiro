<?PHP
    require_once "conexao/conect.php";  
//====================================insert na tabela=====================================//
if(isset($_GET['real']))
{
    $v_valor  = $_GET['real'];
    $v_desc   = $_GET['descricao'];
    $v_status = $_GET['status'];
    $v_imagem = $_GET['imagem'];
    
    mysqli_query($conexao_um, "insert into tb_list values (null, '$v_desc','$v_valor','$v_status','$v_imagem');");
    
    unset($_GET['real']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Lista de Compra</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/lista.css">
        <link rel="shortcut icon" href="/imagens/cifrao_origen.png" >
    </head>
    <body>
        <?php
        require_once "navbar.php";
        ?>
        <section class="container-fluid">
            <div class="row">
<!--========================modal de cadastro============================================-->
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <!--botão modal-->
                    <button class="botaoModal" data-toggle="modal" data-target="#modalExemplo">
                        Cadastro lista de compra
                    </button>
                    <!--modal-->
                    <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <img src="imagens/cifrao_modal.png" alt="cifrão" width="30%">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="lista.php" method="get">
                          <div class="modal-body">
                            <label>R$:</label><br>
                            <input name="real" id="real" type="number" step="0.01" placeholder="0,00" min="0" max="9999" required><br>
                            <label>DESCRIÇÃO:</label><br>
                            <input name="descricao" id="descricao" type="text" size="20" maxlength="50" placeholder="SMART TV 4k" required><br>
                            <label>PRIORIDADE:</label><br>
                            <input name="status" id="status" type="number" min="1" max="4" placeholder="1-4" required><br>
                            <label>IMAGEM:</label><br>
                            <input name="imagem" id="imagem" type="file" accept=".jpg, .jpeg, .png"><br>
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
            </div>
<!--====================lista de compras===========================-->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-12 col-lg-4 col-xl-4">
                    
                </div>
            </div>
        </section>
        <!--SCRIPTS===============================================================-->   
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    </body>
</html>