<?php
    if($_POST['deleteE']){
        $conexao_del = mysqli_connect('localhost','root','1234','db_financeiro');
        if(mysqli_connect_error()){
            $delete['error']    = 1;
            $delete['Mensagem'] = 'Erro ao connectar no banco de dados !!!';
            $delete['cod']      = mysqli_connect_error();
        }
        else{
            $id_despesas  = $_POST['deleteE'];
            $query_delete = "delete from tb_despesas where id_despesa = '$id_despesas'";
            $mysql_query  = mysqli_query($conexao_del, $query_delete);
            if(!$mysql_query){
                $delete['error']    = 2;
                $delete['Mensagem'] = 'Erro deletar arquivo !!!';
                $delete['cod']      = mysqli_error($conexao_del);
            }
            else{
                $delete['error']    = 0;
                $delete['Mensagem'] = 'Excluido';
                $delete['cod']      =  'Sem Erros';                
                mysqli_close($conexao_del);
                $return_del   = json_encode($delete);
                echo($return_del);
            }
        }
    }
?>