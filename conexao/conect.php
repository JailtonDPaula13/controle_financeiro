<?php
   //débito
   //cadastro de despesas futura
   //cadastro de saldo futuro
   //pesquisa de despesa futura
   //consulta saldo diario
   //consulta login
   $conexao_um = mysqli_connect('localhost','root','','db_money');
   if(!$conexao_um)
   {
       echo("teste de erro");
   }
   //delete de despesas futura
   //consulta saldo mensal
   $conexao_dois = mysqli_connect('localhost','root','','db_money');
   if(!$conexao_um)
   {
       echo("teste de erro");
   }
   //consulta projeção mes  
   $conexao_cinco = mysqli_connect('localhost','root','','db_money');
   if(!$conexao_um)
   {
       echo("teste de erro");
   }
   //delete 
   //projeção saldo diario
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
//consulta saldo futuro
   $conexao_quatro = mysqli_connect('localhost','root','','db_money');
   if(!$conexao_um)
   {
       echo("teste de erro");
   }
   
?>