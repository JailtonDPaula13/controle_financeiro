
<style>
    .navbar{
        background-color:rgb(0, 31, 104);
        border-bottom: 4px solid #005389;
        
    }
    .loginn{
        margin-left: 150px;
    }
    #logoff{
        background-color: #005389;
        border: 2px solid #00164a;
        box-shadow: 0 0 2px #000;
        border-radius: 7px;
        margin-top: 8%;
        color: #fff;
    }
    #logoff:hover{
            border: 2px solid rgb(214, 181, 12);
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="index.php">
      <img src="imagens/cifrao_origen.png" width="30" height="30" alt="Cifrão">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="index.php">HOME <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link active" href="despesas.php">MOVIMENTAÇÃO</a>
      <a class="nav-item nav-link active" href="projecao.php">PROJEÇÃO</a>
      <a class="nav-item nav-link active" href="visaogeral.php">VISÃO GERAL</a>
      <a class="nav-item nav-link active" href="lista.php">LISTA DE COMPRAS</a>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          LOGIN
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="login.php">LOGIN</a>
          <a class="dropdown-item" href="login.php?logoff=1">LOGOFF</a>
        </div>
      </li>
    </div>
    <?php
    if(isset($_SESSION["v_login"])){
    ?> 
    <span class="navbar-text loginn">
            USUÁRIO:&nbsp;<?php print_r($_SESSION["v_login"]); }?>
    </span>
  </div>
</nav>