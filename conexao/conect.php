<?php
   //débito
   //cadastro de despesas futura
   $conexao_um = mysqli_connect('localhost','root','','db_money');
   if(!$conexao_um)
   {
       echo("teste de erro");
   }
   //consulta despesas futura
   $conexao_dois = mysqli_connect('localhost','root','','db_money');
   if(!$conexao_um)
   {
       echo("teste de erro");
   }
   $conexao_cinco = mysqli_connect('localhost','root','','db_money');
   if(!$conexao_um)
   {
       echo("teste de erro");
   }
         //delete 
   $conexao_seis = mysqli_connect('localhost','root','','db_money');
   if(!$conexao_um)
   {
       echo("teste de erro");
   }
   //crédito
   $conexao_tres = mysqli_connect('localhost','root','','db_money');
   if(!$conexao_um)
   {
       echo("teste de erro");
   }
   $conexao_quatro = mysqli_connect('localhost','root','','db_money');
   if(!$conexao_um)
   {
       echo("teste de erro");
   }
   
?>