<?php

    function retornoPrioridade($nivel)
    {
        $v_nivel = array(
            "Inultil",
            "Urgente",
            "Necessário",
            "Moderado",
            "Desnecessário"  
        );
        
        return $v_nivel[$nivel];
    }
?>
