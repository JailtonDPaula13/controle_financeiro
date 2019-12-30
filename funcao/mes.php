<?php
   function mesAno($v_ano)
   {     
       $mesano = array
                    (
                        "Janeiro",
                        "Fervereiro",
                        "Março",
                        "Abril",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro"
                    );
        if($v_ano >= 13)
        {
            $v_ano = $v_ano-12;
        }
       return $mesano[$v_ano-1];
   }
?>