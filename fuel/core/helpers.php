<?php

//HELPERS
function date_conv($str_date){
    $date=explode('-',$str_date);
    return $date[2]."-".$date[1]."-".$date[0];
}

function getMes($m){
    switch ($m) {
        case "01":
            return "Enero";
            break;
        case "02":
            return "Febrero";
            break;
        case "03":
            return "Marzo";
            break;
        case "04":
            return "Abril";
            break;
        case "05":
            return "Mayo";
            break;
        case "06":
            return "Junio";
            break;
        case "07":
            return "Julio";
            break;
        case "08":
            return "Agosto";
            break;
        case "09":
            return "Septiembre";
            break;
        case "10":
            return "Octubre";
            break;
        case "11":
            return "Noviembre";
            break;
        case "12":
            return "Diciembre";
            break;
    }
}

function get_percents($entrega){
    $str="Con ";
    if($entrega->rate_picado>0){$str.=$entrega->rate_picado."% picado, ";}
    if($entrega->rate_molestado>0){$str.=$entrega->rate_molestado."% molestado, ";}
    if($entrega->rate_morado>0){$str.=$entrega->rate_morado."% morado, ";}
    if($entrega->rate_mosca>0){$str.=$entrega->rate_mosca."% mosca, ";}
    if($entrega->rate_azofairon>0){$str.=$entrega->rate_azofairon."% azofairón, ";}
    if($entrega->rate_agostado>0){$str.=$entrega->rate_agostado."% agostado, ";}
    if($entrega->rate_granizado>0){$str.=$entrega->rate_granizado."% granizado, ";}
    if($entrega->rate_perdigon>0){$str.=$entrega->rate_perdigon."% perdigón, ";}
    if($entrega->rate_taladro>0){$str.=$entrega->rate_taladro."% taladro";}

    if(strcmp($str,"Con ")==0){
        $str="Sin porcentajes asociados";
    }

    $str=rtrim($str,", ");

    return $str.".";
}
/*
 * Get the average size of the delivered in the current campaign by delivery post
 * */
function getTamMedio($idp,$variedad){
    $total = DB::select('id','tam','total','variedad')->from('entregas')->where(array(array('idpuesto','=', $idp),array('tam','<>',0),array('fecha','>','2024-01-01')))->execute();
    $tam_medio=array();
    $total_kg_medio=array();
    foreach($total as $t){
        $v=$t['variedad'];
        if(isset($tam_medio[$v])){
            $tam_medio[$v] += $t['tam']*$t['total'];
        }
        else{
            $tam_medio[$v] = $t['tam']*$t['total'];
        }
        if($t['tam']!=0){
            if(isset($total_kg_medio[$v])){
                $total_kg_medio[$v] += $t['total'];
            }
            else{
                $total_kg_medio[$v] = $t['total'];
            }
        }

    }
    foreach($tam_medio as $v => $t){
        $tam_medio[$v]=$t/$total_kg_medio[$v];
    }
    if(isset($tam_medio[$variedad])) return $tam_medio[$variedad];
    else return 0;
}