<?php
    if(isset($_POST['n_valor'])){
        $conexao_cad = mysqli_connect('localhost','root','1234','db_financeiro');
        if(mysqli_connect_error()){
            $retorno['error']    = 1;
            $retorno['mensagem'] = 'Houve um erro ao conectar ao banco de dados';
            $retorno['cod']      = mysqli_connect_error();
        }
        else{
            $valor     = $_POST['n_valor'];
            $descricao = $_POST['nm_despesa'];
            $local     = $_POST['nm_local'];
            $data      = $_POST['n_date'];
            $qtd       = $_POST['n_qt'];
            $tipo      = $_POST['n_tipo'];
            $obs       = $_POST['n_obs'];
            $cad = "call pr_add_despesas('$valor','$descricao','$local','$data','$tipo','$obs','$qtd')";
            $return_cad = mysqli_query($conexao_cad, $cad);
            if(!$return_cad){
                $retorno['error']    = 2;
                $retorno['mensagem'] = 'Houve problemas ao cadastrar produtos';
                $retorno['cod']      = mysqli_error($conexao_cad);
            }
            else{
                $retorno['error']    = 0;
                $retorno['mensagem'] = 'Produtos Cadastrados';
                $retorno['cod']      = 'Sem Erros';
            }
        }
        mysqli_close($conexao_cad);
        
        $var_return = json_encode($retorno);
        echo($var_return);
    }
?>