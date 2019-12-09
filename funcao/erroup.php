<?php
    function erroUp($imagem){
        
        
        $erro = array(
               UPLOAD_ERR_OK =>"CONEXÃO OK",
               UPLOAD_ERR_INI_SIZE=>"ULTRAPASSOU 128MB.!!!",
               UPLOAD_ERR_FORM_SIZE=>"IMAGEM ULTRAPASSOU 15MB.!!!",
               UPLOAD_ERR_PARTIAL=>"ERRO AO CARREGAR",
               UPLOAD_ERR_NO_FILE=>"SEM ARQUIVO",
               UPLOAD_ERR_NO_TMP_DIR=>"PASTA TEMP NÃO ENCONTRADA",
               UPLOAD_ERR_CANT_WRITE=>"ERRO AO GRAVAR",
               UPLOAD_ERR_EXTENSION=>"DEU MERDA"
            );
       
        
        
        
        return $erro[$imagem];
    }
    function uploadName($imagem2){
        
        date_default_timezone_set('America/Fortaleza');
                                                       //tempo
        $agora      = getdate();                       //local da imagem
        $codname    = $agora['year']."_".$agora["yday"];
        $codname   .= $agora['hours'].$agora['minutes'].$agora['seconds'];
        $v_namecomp = "imagens/upload/".$codname.strrchr( $imagem2,".");
        
        return $v_namecomp;
    }
?>