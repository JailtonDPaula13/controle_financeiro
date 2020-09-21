<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Detalhes</title>
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
                <a href="gasto_diarios.php"><li class="list_menu_li">Despesas</li></a>
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M6 12.796L11.481 8 6 3.204v9.592zm.659.753l5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
                </svg>
                <li class="list_menu_li">Detalhes</li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10">
                    <label>R$: </label>
                    <input type="number" value="2.0" step="0.1">
                    <input type="text" value="almoço">
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="../js/jQuery_v3.5.1"></script>
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../js/gasto_diarios.js"></script>
</html>