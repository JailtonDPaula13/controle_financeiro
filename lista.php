<?PHP
    require_once "conexao/conect.php";
    require_once "funcao/erroup.php";
    require_once "funcao/prioridade.php";
//===========================validação de login============================================//
session_start();
if(!$_SESSION["v_login"])
{
    header("location:login.php?lista=1");
}
//====================================insert na tabela=====================================//
    //variavel de preenchimento
    $v_descricao = null;
    $v_valor     = null;
    //consulta de erro de imagem
    if(isset($_POST['descricao']))
    {
        $v_erro_up = $_FILES['imagemup']['error'];
        $v_name    = "imagens/upload/Mordomo_Menta.webp";
        $v_temp    = null;

       //verificação se houve erro ao carregar imagens
        if($v_erro_up != 4 && $v_erro_up != 0){ 
            $print_er= erroUp($v_erro_up);
            print_r("<script>alert('$print_er')</script>");
            $v_descricao = $_POST['descricao'];
            $v_valor     = $_POST['real']; 
        }
        else{
            //caso tenha upload
            if( $v_erro_up == 0 and (strrchr($_FILES['imagemup']['name'],".") == ".jpg" or
                                     strrchr($_FILES['imagemup']['name'],".")==".png" or
                                     strrchr($_FILES['imagemup']['name'],".")==".jpeg"))
            {
                $v_name = uploadName($_FILES['imagemup']['name']); //nome padrão dos arquivos
                $v_temp = $_FILES['imagemup']['tmp_name'];         //pasta temp 
                move_uploaded_file($v_temp,$v_name);               //movendo arquivo para pasta
            }
            
            $v_decricao_ins   = $_POST['descricao'];
            $v_valor_ins      = $_POST['real'];
            $v_prioridade_ins = $_POST['prioridade'];
            
            mysqli_query($conexao_um,"insert into tb_lista	
            (id_lista,descricao,valor,status,imagen)
            values
            (null,'$v_decricao_ins','$v_valor_ins','$v_prioridade_ins','$v_name');"); 
//            mysqli_query($conexao_um,"call pr_lista('$v_decricao_ins','$v_valor_ins','$v_prioridade_ins','$v_name');");
        }

        
    }
//==================================colsa da lista========================================================================//
     $consulta = mysqli_query($conexao_dois, "select id_lista,descricao,valor,status,date_format(data,'%d/%m/%y') ,comprado,imagen from tb_lista where comprado = 'N' and status <> 0 order by 4;");
     if(!$consulta){
          echo("<script>alert('erro ao conectar ao banco !!!')</script>");
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
                            <img src="imagens/compras2.0.png" alt="compras" width="30%">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="lista.php" method="post" enctype="multipart/form-data">
                          <div class="modal-body">
                            <label>DESCRIÇÃO:</label><br>
                            <input name="descricao" type="text" maxlength="50" placeholder="NOTEBOOK" value="<?php print_r($v_descricao) ?>" required><br>
                            <label>VALOR:</label><br>
                            <input name="real" type="number" placeholder="0,00" min="0" required><br>
                            <label>PRIORIDADE:</label><br>
                            <select name="prioridade" required>
                                <option value="1">Urgênte</option>
                                <option value="2">Necessário</option>
                                <option value="3">Moderado</option>
                                <option value="4">Desnecessário</option>
                                <option value="0" selected  >!!! Inútil !!!</option>
                            </select><br>
                            <label>IMAGEM:</label><br>
                            <input type="hidden" name="MAX_FILE_SIZE" value="15728640">
<!--                              15728640-->
                            <input name="imagemup" type="file" accept=".jpg, .jpeg, .png"><br>
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
            <div class="row idcard">
                    <?php while($v_consulta_lista = mysqli_fetch_row($consulta)){ ?>
                <div class="col-12 col-sm-6 col-md-12 col-lg-3 col-xl-3">
                    <div class="card card0" style="width: 18rem;">
                        <img src="<?php print_r($v_consulta_lista[6]);?>" class="card-img-top" alt="nula" width="361px;" height="200px;">
                          <div class="card-body">
                            <h5 class="card-title"><?php print_r($v_consulta_lista[1]);?></h5>
                            <p class="card-text listap"><?php print_r("<b> ID: </b>".$v_consulta_lista[0]);?></p>
                            <p class="card-text listap"><?php print_r("<b>Valor: </b>R$".$v_consulta_lista[2]);?></p>
                            <p class="card-text listap"><?php print_r("<b>Prioridade: </b>".retornoPrioridade($v_consulta_lista[3]));?></p>
                            <p class="card-text listap"><?php print_r("<b>Alterado: </b>".$v_consulta_lista[4]);?></p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                          </div>
                    </div>
                </div>
                    <?php } ?>
            </div>
        </section>
        <!--SCRIPTS===============================================================-->   
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    <?php
        unset($_POST['descricao'],$v_decricao_ins);
        include_once("rodape.php");
    ?>
    </body>
</html>