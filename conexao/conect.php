<?php
   $conexao_um = mysqli_connect('localhost','root','','db_money');
   if(!$conexao_um)
   {
       echo("teste de erro");
   }
   $conexao_dois = mysqli_connect('localhost','root','','db_money');
   if(!$conexao_um)
   {
       echo("teste de erro");
   }
?>