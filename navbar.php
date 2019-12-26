
<style>
/*===fonts=====*/
    @import url('https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap');
/*font-family: 'Bebas Neue', cursive;*/
/*===fonts=====*/
    body{
        background-color: #0939A6;
    }
    .navbar{
        background-color:#0A2D7F;
        border-bottom: 4px solid #6F88C0;
        
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
    .item_menu{
        color: #000;
        padding: 7pt;
        font-family: 'Bebas Neue', cursive;
    }
    .item_menu:hover{
        text-decoration: none;
        color: #fff;
    }
</style>
<nav class="navbar navbar-expand-lg">
  <a class="navbar-brand" href="index.php">
      <img src="imagens/cifrao_origen.png" width="30" height="30" alt="Cifrão">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class=""><img src="imagens/listamenu.png" alt="lista" width="30"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="item_menu" href="index.php">HOME <span class="sr-only">(current)</span></a>
      <a class="item_menu" href="despesas.php">MOVIMENTAÇÃO</a>
      <a class="item_menu" href="projecao.php">PROJEÇÃO</a>
      <a class="item_menu" href="visaogeral.php">VISÃO GERAL</a>
      <a class="item_menu" href="lista.php">LISTA DE COMPRAS</a>
      <li class="item_menu dropdown">
        <a class="item_menu dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          LOGIN
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="login.php">LOGIN</a>
          <a class="dropdown-item" href="login.php?logoff=1">LOGOFF</a>
        </div>
      </li>
        <?php if(isset($_SESSION["v_login"])){ ?> 
      <a class="item_menu">
            ADM:&nbsp;<?php print_r($_SESSION["v_login"]); ?>
      </a>
        <?php } ?>
    </div>
  </div>
</nav>