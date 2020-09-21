<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Despesas</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/despesas.css">
        <link rel="shortcut icon" href="../imagens/moeda2.png">
    </head>
    <body>
        <div class="container-fluid alerta_load">
          <div class="row justify-content-center">
              <div class="col-6 col-sm-6 col-md-6 col-lg-2 col-xl-2 divisao">
                  <img src='../imagens/load.gif' width='100%'>
              </div>
          </div>
        </div>
        <header class="cl_header">
            <h1>
            Meu Saldo
            </h1>
        </header>
        <nav class="cl_navegacao">
            <ul class="list_menu">
                <a href="../"><li class="list_menu_li">Home</li></a>
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M6 12.796L11.481 8 6 3.204v9.592zm.659.753l5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
                </svg>
                <li class="list_menu_li">Despesas</li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bloco_selecao">
                    <button class="button_add" data-toggle="modal" data-target="#botao_cadastro"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-folder-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M9.828 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H9.828zm-2.95-1.707L7.587 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293z"/>
                      <path fill-rule="evenodd" d="M13.5 10a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                      <path fill-rule="evenodd" d="M13 12.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
                    </svg>
                    </button>
                    <button class="button_add" data-toggle="modal" data-target="#botao_delete"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-folder-minus" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.828 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H9.828zm-2.95-1.707L7.587 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293z"/>
                      <path fill-rule="evenodd" d="M11 11.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/></svg>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="botao_cadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="titolomodal">Cadastro de Despesas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form id='id_cadastrar_despesas'>
                          <div class="modal-body">
                            <label class="lb_cad_des">Valor:</label>
                            <label class="lb_cad_des">Despesa:</label>
                            <input type='number' step="0.01" min='0.05' max='9999999.99' placeholder='R$' class="lb_cad_des cl_input" name='n_valor' required>
                            <input type='text' maxlenght='50' name='nm_despesa' class="lb_cad_des cl_input" placeholder='lanche' required>
                            <label class="lb_cad_des">Local:</label>
                            <label class="lb_cad_des">Data:</label>
                            <input type='text' maxlenght='50' name='nm_local' placeholder='mercado x' class='lb_cad_des cl_input'>
                            <input type='date' name='n_date' class="lb_cad_des cl_input" required>
                            <label class="lb_cad_des">Quantidade:</label>
                            <label class="lb_cad_des">Tipo:</label>
                            <input type='number' step='1' name='n_qt' class="lb_cad_des cl_input" value='1' required>
                            <select class="lb_cad_des cl_input" name='n_tipo'>
                                <option value='1'>Comida</option>
                                <option value='2'>Transporte</option>
                                <option value='3'>Lazer</option>
                                <option value='4'>Saúde</option>
                                <option value='5'>Trabalho</option>
                                <option value='6'>Educação</option>
                                <option value='7'>Casa</option>
                                <option value='8'>Higiene</option>
                                <option value='9'>outros</option>
                            </select>
                            <label class="lb_cad_des">Observação</label>
                            <textarea class="cl_select cl_input" name='n_obs' maxlength="1000"></textarea>
                            <p id='alerta_add'>
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" d="M4 0a2 2 0 0 0-2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4zm4.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.178.178 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.178.178 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.178.178 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.178.178 0 0 1-.134-.098L8.16 4.1z"/>
                                </svg>
                                Produto(s) Cadastrado;
                            </p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="botao_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button><br>
                            <center>
                              <img src='../imagens/interrogacao.jpg' width='50%'>
                              <h4 class='cl_line'>Deseja Excluir os Itens Marcados?</h4>
                            </center>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary"   data-dismiss="modal"  id="ex_despesas">Excluir</button>
                          </div>
                        </div>
                      </div>
                    </div>

                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 bloco_Pesquisa">
                <form id="pesquisa_lista">
                    <label class='lb_pesquisa'>De: </label>
                    <input type='date' class='cl_inpt' id='dt_inicial' required>
                    <label class='lb_pesquisa'>a </label>
                    <input type='date' class='cl_inpt' id='dt_final' required>
                    <label class='lb_pesquisa'>Tipo: </label>
                    <select class='cl_inpt cl_inpt_sl' id='idTipoSlc'>
                        <option value='0'>Todos</option>
                        <option value='1'>
                         <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-egg-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path d='M14 10a6 6 0 0 1-12 0C2 5.686 5 0 8 0s6 5.686 6 10z'/></svg>
                        Comida
                        </option>
                        <option value='2'>Transporte</option>
                        <option value='3'>Lazer</option>
                        <option value='4'>Saúde</option>
                        <option value='5'>Trabalho</option>
                        <option value='6'>Educação</option>
                        <option value='7'>Casa</option>
                        <option value='8'>Higiene</option>
                        <option value='9'>outros</option>
                    </select>

                    <button type='submit' class='botao_p' id='botao_de_pesquisa'>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                      <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                    </button>
                    <button type='button' class='botao_p' id='reset_pesquisa' title="limpar pesquisa">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-clockwise" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                              <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg>                    
                    </button>
                </form>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 bloco_selecao">
                    <div class="table-responsive">
                    <table class="table table-sm table-dark table-hover" id="tb_heg">
                      <thead>
                        <tr class='bg-primary'>
                          <th scope="col">R$:</th>
                          <th scope="col">Objeto</th>
                          <th scope="col">data</th>
                          <th scope="col">tipo</th>
                          <th scope="col">detalhes</th>
                          <th scope="col"><input type='checkbox' id='id_mc_full'></th>
                        </tr>
                      </thead>
                      <tbody id="id_td_list">
                            
                      </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="../js/jQuery_v3.5.1"></script>
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../js/gasto_diarios.js"></script>
</html>