<?php

    if(!empty($_POST['data_i'])){
        $dataInicial = $_POST['data_i'];
        $dataFinal   = $_POST['data_f'];
        $condicao    = "data >= '$dataInicial' and data <= '$dataFinal'";
    }
    else{
        $dataInicial = date('Y-m-01');
        $condicao    = "data >= '$dataInicial' and data <= last_day('$dataInicial')";
    }

    if($_POST['vtipo'] != 0){
        $tipon =$_POST['vtipo'];
        $tipo  = " and tipo = $tipon";
        $condicao = $condicao.$tipo;
    }

    $conexao_lista = mysqli_connect('localhost', 'root', '1234', 'db_financeiro');
    if(mysqli_connect_error()){
        $error_listd['error_c']  = 1;
        $error_listd['Mensagem'] = 'Erro ao conectar ao banco de dados.';
        $error_listd['Errorm']   = mysqli_connect_error();
    }
    else{
        $lista_des  = "select id_despesa, valor, despesas, local, date_format(data,'%d/%m/%Y') as 'data', tipo, obs, dt_registro ";
        $lista_des  = $lista_des."from tb_despesas where ";
        $lista_des  = $lista_des.$condicao;
        $lista_des  = $lista_des."  order by 5 desc, 8 desc, 5 desc, 4;";
        $retunr_des = mysqli_query($conexao_lista,$lista_des);
        if(!$retunr_des){
            $error_listd['error_c']  = 2;
            $error_listd['Mensagem'] = 'Erro realizar consulta no banco de dados.';
            $error_listd['Errorm']   = mysqli_error($conexao_lista);
        }
        elseif($retunr_des->num_rows == 0){
            $error_listd['error_c']  = 3;
            $error_listd['Mensagem'] = 'Lista Vazia';
            $error_listd['Errorm']   = 'não houve erro';
        }
        else{
            while($var_lista = mysqli_fetch_object($retunr_des)){
                $error_listd[] = $var_lista;
            }
        }
        mysqli_close($conexao_lista);
        $var_json = json_encode($error_listd);
        
        echo($var_json);
    }
?>