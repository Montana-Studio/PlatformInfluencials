<?php
require("master_key.php");
function requiere_actualizar($persona_id){
    $mysqli = mysqli_connect(LOCAL,USER,PASS,BD) or die("Error " . mysqli_error($link)); 
    $mysqli->set_charset('utf8_bin');
    $persona_id=$persona_id;
    $query_no_laboral="SELECT DISTINCT * FROM session_table WHERE persona_id='".$persona_id."' AND working_hours='0'";
    $result_no_laboral=mysqli_query($mysqli,$query_no_laboral)or die (mysqli_error());
    $row_no_laboral= mysqli_fetch_array($result_no_laboral, MYSQLI_BOTH);
    $num_row_no_laboral= mysqli_num_rows($result_no_laboral);
    
    //si el registro existe y estoy fuera del horario laboral entonces no se actualiza la información.
    if($num_row_no_laboral>0){
        $query_actualiza_datos="UPDATE session_table SET ultimo_inicio_sesion='".date("Y-m-d H:i")."' WHERE persona_id='".$persona_id."'";
        $result_actualiza_datos=mysqli_query($mysqli,$query_actualiza_datos)or die (mysqli_error());
        return 0;
    }else{
        $query_actualizado="SELECT DISTINCT * FROM session_table WHERE persona_id='".$persona_id."' AND working_hours='1' AND renovado='1'";
        $result_actualizado=mysqli_query($mysqli,$query_actualizado)or die (mysqli_error());
        $row_actualizado= mysqli_fetch_array($result_actualizado, MYSQLI_BOTH);
        $num_row_actualizado= mysqli_num_rows($result_actualizado);

        $query_actualiza_datos="UPDATE session_table SET ultimo_inicio_sesion='".date("Y-m-d H:i")."' WHERE persona_id='".$persona_id."'";
        $result_actualiza_datos=mysqli_query($mysqli,$query_actualiza_datos)or die (mysqli_error()); 

        //si el registro existe y estoy dentro del horario laboral pero ya he actualizado mis datos en las ultimas 4 horas.
        if($num_row_actualizado>0){
            return 0;
        }else{
            $query_no_actualizado="SELECT DISTINCT * FROM session_table WHERE persona_id='".$persona_id."' AND working_hours='1' AND renovado='0'";
            $result_no_actualizado=mysqli_query($mysqli,$query_no_actualizado)or die (mysqli_error());
            $row_no_actualizado= mysqli_fetch_array($result_no_actualizado, MYSQLI_BOTH);
            $num_row_no_actualizado= mysqli_num_rows($result_no_actualizado);

                       
            //si el registro existe y no ha actualizado su información dentro del horario laboral
            if($row_no_actualizado>0){
                $query_actualiza_datos="UPDATE session_table SET actualizacion_red_social='".date("Y-m-d H:i")."' , renovado='1' WHERE persona_id='".$persona_id."'";
                $result_actualiza_datos=mysqli_query($mysqli,$query_actualiza_datos)or die (mysqli_error());
                //devuelvo datos actualizados
                $query_actualizado="SELECT DISTINCT * FROM session_table WHERE persona_id='".$persona_id."' AND working_hours='1' AND renovado='1'";
                $result_actualizado=mysqli_query($mysqli,$query_actualizado)or die (mysqli_error());
                $row_actualizado= mysqli_fetch_array($result_actualizado, MYSQLI_BOTH);
                return 1;//actualizo base de datos
            
            }else{
                //si el registro no existe (primera vez)
                $query_primera_vez="SELECT DISTINCT * FROM session_table WHERE persona_id='".$persona_id."'";
                $result_primera_vez=mysqli_query($mysqli,$query_primera_vez)or die (mysqli_error());
                $row_primera_vez= mysqli_fetch_array($result_primera_vez, MYSQLI_BOTH);
                $num_row_primera_vez= mysqli_num_rows($result_primera_vez);
                if($num_row_primera_vez==0){

                    if(date('H')>8 && date('H')<22){
                        //inserto datos en tabla de sesión
                        $query_inserta_datos="INSERT INTO session_table (working_hours,renovado, primer_inicio_sesion, actualizacion_red_social, persona_id) VALUES ('1', '1', '".date("Y-m-d H:i")."' ,'".date("Y-m-d H:i")."', ".$persona_id.")";
                        $result_inserta_datos=mysqli_query($mysqli,$query_inserta_datos)or die (mysqli_error());
                        //devuelvo datos insertados
                        $query_inserta_datos="SELECT DISTINCT * FROM session_table WHERE persona_id='".$persona_id."' AND working_hours='1' AND renovado='1'";
                        $result_inserta_datos=mysqli_query($mysqli,$query_inserta_datos)or die (mysqli_error());
                        $row_inserta_datos= mysqli_fetch_array($result_inserta_datos, MYSQLI_BOTH);
                        return 1;
                    }

                }
                
            }
            
        }
    }
}
?>