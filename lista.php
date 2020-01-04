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
else
{
    $v_loginl = $_SESSION["v_login"];
}
//=====================================delete registro=====================================================================//
if(isset($_GET['delete']))
{
   $v_delete  = $_GET['delete'];
   $deleteimg = $_GET['move'];
   $movedell  = "../..";
    
   $d_conexao = mysqli_query($conexao_tres,"delete from tb_lista where  id_lista = '$v_delete' and login = '$v_loginl';");
   move_uploaded_file($deleteimg,$movedell);
    
   unset($_GET['delete'], $_GET['move']);
}
//=====================================ok registro=====================================================================//
if(isset($_GET['fim']))
{
   $v_update = $_GET['fim'];
   $d_conexaoup = mysqli_query($conexao_tres,"update tb_lista set  comprado = 'S' where id_lista = '$v_update' and login = '$v_loginl';");

   unset($_GET['fim']);
}
//====================================colsulta opções======================================//
$consulta_op = mysqli_query($conexao_quatro,"select * from tb_status;");
if(!$consulta_op){
    echo("<script>alert('erro ao conectar ao banco !!!')</script>");
}
//===========================================update==========================================/
if(isset($_POST['valor'])){
    $v_valor      = $_POST['valor'];
    $v_prioridade = $_POST['prioridade'];
    $v_btnenvio = $_POST['enviobtn'];
    $v_consulta   = mysqli_query($conexao_cinco, "update tb_lista set valor = '$v_valor', status =  '$v_prioridade', data = now()  where id_lista =  '$v_btnenvio' and login = '$v_loginl';");
}
//====================================insert na tabela=====================================//
    //variavel de preenchimento
    $v_descricao = null;
    $v_valor     = null;
    //consulta de erro de imagem
    if(isset($_POST['descricao']))
    {
        $v_erro_up = $_FILES['imagemup']['error'];
        $v_name    = "imagens/upload/sem_imagem.gif";
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
            
            $v_decricao_ins   = utf8_decode($_POST['descricao']);
            $v_valor_ins      = $_POST['real'];
            $v_prioridade_ins = $_POST['prioridade'];
            
            mysqli_query($conexao_um,"insert into tb_lista	
            (id_lista,descricao,valor,status,imagen,login)
            values
            (null,upper('$v_decricao_ins'),'$v_valor_ins','$v_prioridade_ins','$v_name','$v_loginl');"); 
        }

        
    }
//==================================colsa da lista========================================================================//
     $consulta = mysqli_query($conexao_dois, "select
                                                l.id_lista,
                                                l.descricao,
                                                l.valor,
                                                s.status,
                                                date_format(l.data,'%d/%m/%y') ,
                                                l.comprado,
                                                l.imagen
                                            from tb_lista l
                                            inner join tb_status s on s.id_status = l.status
                                            where
                                            l.status = 1 and
                                            l.comprado = 'N' and
                                            l.login = '$v_loginl'
                                            order by l.status;");
     $consultaM = mysqli_query($conexao_dois, "select
                                                l.id_lista,
                                                l.descricao,
                                                l.valor,
                                                s.status,
                                                date_format(l.data,'%d/%m/%y') ,
                                                l.comprado,
                                                l.imagen
                                            from tb_lista l
                                            inner join tb_status s on s.id_status = l.status
                                            where
                                            l.status = 2 and
                                            l.comprado = 'N' and
                                            l.login = '$v_loginl'
                                            order by l.status;");
     $consultaB = mysqli_query($conexao_dois, "select
                                                l.id_lista,
                                                l.descricao,
                                                l.valor,
                                                s.status,
                                                date_format(l.data,'%d/%m/%y') ,
                                                l.comprado,
                                                l.imagen
                                            from tb_lista l
                                            inner join tb_status s on s.id_status = l.status
                                            where
                                            l.status = 3 and
                                            l.comprado = 'N' and
                                            l.login = '$v_loginl'
                                            order by l.status;");

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
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/lista.css">
        <link rel="shortcut icon" href="/imagens/cifrao_origen.png" >
    </head>
    <body>
        <?php
        require_once "navbar.php";
        ?>
        <section class="container-fluid">
<!--========================botão modal=================================================-->
            <div class="row justify-content-center linhaBotoes">
                <div class="col-11 col-sm-11 col-md-11 col-lg-4 col-xl-4  botoesLinha" id="modalDesp">
                    <center>
                    <button class="botaoModal" data-toggle="modal" data-target="#modalExemplo">
                        Cadastro lista de compra
                    </button>
                    </center>
                </div>
            </div>
            <div class="row">
<!--========================modal de cadastro============================================-->
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <!--botão modal-->
                    <!--modal-->
                    <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h2 class="tituloModal">Lista de compras</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="lista.php" method="post" enctype="multipart/form-data">
                          <div class="modal-body corpoLista">
                            <label class="labelstyle">DESCRIÇÃO:</label><br>
                            <input name="descricao" type="text" maxlength="50" size="18" placeholder="NOTEBOOK" value="<?php print_r($v_descricao) ?>" class="inputstyle" required><br>
                            <label class="labelstyle">VALOR:</label><br>
                            <input name="real" type="number" placeholder="0,00" min="0" step="0.01" class="inputstyle" required><br>
                            <label class="labelstyle">PRIORIDADE:</label><br>
                            <select name="prioridade" class="inputstyle" required>
                                <?php while($result_op = mysqli_fetch_row($consulta_op)){ ?>
                                <option value="<?php print_r($result_op[0]) ?>"><?php print_r(utf8_encode($result_op[1])) ?></option>
                                <?php } ?>
                            </select><br>
                            <label class="labelstyle">IMAGEM:</label><br>
                            <input type="hidden" name="MAX_FILE_SIZE" value="15728640" class="inputstyle">
<!--15728640-->
                            <input name="imagemup" type="file" accept=".jpg, .jpeg, .png" class="inputstyle"><br>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="botaoExit" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="botaoCad">Cadastrar Item</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
<!--====================titulo de compras===========================-->
 <div class="row justify-content-center">
     <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 tituloCompra">
         <h2>Lista de compras</h2>
         <p>prioridades</p>
     </div>
 </div>  
            
<!--====================titulo de compras===========================-->
<!--====================lista de compras===========================-->
        
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
    <center>
      <h2 class="mb-0">
        <button class="butaoAlta" type="button" data-toggle="collapse" data-target="#altaPri" aria-expanded="true" aria-controls="collapseOne">
          Alta
        </button>
      </h2>
    </center>
    </div>

<!--=============================================colaps==========================================-->
    <div id="altaPri" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body row linharow">
          <?php while($v_consulta_lista = mysqli_fetch_row($consulta)){ ?>  
          <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 linhaStyleList">
              <img src="<?php print_r($v_consulta_lista[6]);?>" class="imgStyle" alt="nula" width="100%;" height="200pt;" class="imgStyle">
          </div>
          <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 linhaStyleList">
              <h2 class="titulo_intens"><?php print_r(utf8_encode($v_consulta_lista[1]));?></h2>
              <h4><?php print_r("<strong>Valor: </strong>R$".str_replace(".",",",$v_consulta_lista[2]));?></h4>
              <h4><?php print_r("<strong>Alterado: </strong>".$v_consulta_lista[4]);?></h4>
                                          
                <a class="botoesLista" data-toggle="modal" data-target="#exclusaoLista<?php print_r($v_consulta_lista[0]);?>">
                    <img src="imagens/lixeira-red.png" width="30pt" class="botaoUm">
                </a>
                <a class="botoesLista" href="update.php?update=<?php print_r($v_consulta_lista[0]);?>" >
                    <img src="imagens/update.png" width="30pt" class="deleteb"></a>
                <a class="botoesLista" data-toggle="modal" data-target="#compraLista<?php print_r($v_consulta_lista[0]);?>">
                    <img src="imagens/certo.png" width="30pt" class="botaoDois fimupdate">
                </a>
                            
               <!--================================modal=======================================================-->
               <!--modal delete-->
                        <div class="modal fade" id="exclusaoLista<?php print_r($v_consulta_lista[0]);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4>Deseja excluir o seguinte?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body deleteListComp">
                                <h5 class="objList">Descrição:<?php print_r(utf8_encode(" ".$v_consulta_lista[1]));?></h5>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                <a href="lista.php?delete=<?php print_r($v_consulta_lista[0]);?>&move=<?php print_r($v_consulta_lista[6]);?>">
                                  <button type="submit" class="btn btn-primary">Sim</button>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--modal compra-->
                        <div class="modal fade" id="compraLista<?php print_r(" ".$v_consulta_lista[0]);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4>O item a seguir foi comprado?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h5 class="objList"><?php print_r(utf8_encode($v_consulta_lista[1]));?></h5>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                <a href="lista.php?fim=<?php print_r($v_consulta_lista[0]);?>">
                                  <button type="submit" class="btn btn-primary">Sim</button>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                <!--================================modal=======================================================-->
          </div>
          <?php }?> 
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <center>
      <h2 class="mb-0">
        <button class="butaoMedia" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Média
        </button>
      </h2>
      </center>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <div class="card-body row linharow">
          <?php while($v_consulta_lista = mysqli_fetch_row($consultaM)){ ?>  
          <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 linhaStyleList">
              <img src="<?php print_r($v_consulta_lista[6]);?>" class="imgStyle" alt="nula" width="100%;" height="200pt;" class="imgStyle">
          </div>
          <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 linhaStyleList">
              <h2 class="titulo_intens"><?php print_r(utf8_encode($v_consulta_lista[1]));?></h2>
              <h4><?php print_r("<strong>Valor: </strong>R$".str_replace(".",",",$v_consulta_lista[2]));?></h4>
              <h4><?php print_r("<strong>Alterado: </strong>".$v_consulta_lista[4]);?></h4>
                                          
                <a class="botoesLista" data-toggle="modal" data-target="#exclusaoLista<?php print_r($v_consulta_lista[0]);?>">
                    <img src="imagens/lixeira-red.png" width="30pt" class="botaoUm">
                </a>
                <a class="botoesLista" href="update.php?update=<?php print_r($v_consulta_lista[0]);?>" >
                    <img src="imagens/update.png" width="30pt" class="deleteb"></a>
                <a class="botoesLista" data-toggle="modal" data-target="#compraLista<?php print_r($v_consulta_lista[0]);?>">
                    <img src="imagens/certo.png" width="30pt" class="botaoDois fimupdate">
                </a>
                            
               <!--================================modal=======================================================-->
               <!--modal delete-->
                        <div class="modal fade" id="exclusaoLista<?php print_r($v_consulta_lista[0]);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4>Deseja excluir o seguinte?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body deleteListComp">
                                <h5 class="objList">Descrição:<?php print_r(utf8_encode(" ".$v_consulta_lista[1]));?></h5>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                <a href="lista.php?delete=<?php print_r($v_consulta_lista[0]);?>">
                                  <button type="submit" class="btn btn-primary">Sim</button>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--modal compra-->
                        <div class="modal fade" id="compraLista<?php print_r($v_consulta_lista[0]);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4>O item a seguir foi comprado?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h5 class="objList"><?php print_r(utf8_encode($v_consulta_lista[1]));?></h5>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                <a href="lista.php?fim=<?php print_r($v_consulta_lista[0]);?>">
                                  <button type="submit" class="btn btn-primary">Sim</button>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                <!--================================modal=======================================================-->
          </div>
          <?php }?> 
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <center>
      <h2 class="mb-0">
        <button class="butaoBaixa" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Baixa
        </button>
      </h2>
      </center>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
    <div class="card-body row linharow">
          <?php while($v_consulta_lista = mysqli_fetch_row($consultaB)){ ?>  
          <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 linhaStyleList">
              <img src="<?php print_r($v_consulta_lista[6]);?>" class="imgStyle" alt="nula" width="100%;" height="200pt;" class="imgStyle">
          </div>
          <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 linhaStyleList">
              <h2 class="titulo_intens"><?php print_r(utf8_encode($v_consulta_lista[1]));?></h2>
              <h4><?php print_r("<strong>Valor: </strong>R$".str_replace(".",",",$v_consulta_lista[2]));?></h4>
              <h4><?php print_r("<strong>Alterado: </strong>".$v_consulta_lista[4]);?></h4>
                                          
                <a class="botoesLista" data-toggle="modal" data-target="#exclusaoLista<?php print_r($v_consulta_lista[0]);?>">
                    <img src="imagens/lixeira-red.png" width="30pt" class="botaoUm">
                </a>
                <a class="botoesLista" href="update.php?update=<?php print_r($v_consulta_lista[0]);?>" >
                    <img src="imagens/update.png" width="30pt" class="deleteb"></a>
                <a class="botoesLista" data-toggle="modal" data-target="#compraLista<?php print_r($v_consulta_lista[0]);?>">
                    <img src="imagens/certo.png" width="30pt" class="botaoDois fimupdate">
                </a>
                            
               <!--================================modal=======================================================-->
               <!--modal delete-->
                        <div class="modal fade" id="exclusaoLista<?php print_r($v_consulta_lista[0]);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4>Deseja excluir o seguinte?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body deleteListComp ">
                                <h5 class="objList">Descrição:<?php print_r(utf8_encode(" ".$v_consulta_lista[1]));?></h5>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                <a href="lista.php?delete=<?php print_r($v_consulta_lista[0]);?>">
                                  <button type="submit" class="btn btn-primary">Sim</button>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--modal compra-->
                        <div class="modal fade" id="compraLista<?php print_r($v_consulta_lista[0]);?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4>O item a seguir foi comprado?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h5 class="objList"><?php print_r(utf8_encode($v_consulta_lista[1]));?></h5>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                <a href="lista.php?fim=<?php print_r($v_consulta_lista[0]);?>">
                                  <button type="submit" class="btn btn-primary">Sim</button>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                <!--================================modal=======================================================-->
          </div>
          <?php }?> 
      </div>
    </div>
  </div>
</div>
<!--=============================================colaps==========================================-->
</section>
        <!--SCRIPTS===============================================================-->   
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <!--<script src="js/jquery-3.3.1.slim.min.js"></script>-->
    <?php
        unset($_POST['descricao'],$v_decricao_ins);
    ?>
    </body>
</html>