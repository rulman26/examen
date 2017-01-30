<?php

//incluir el archivo principal
include("Slim/Slim.php");

//registran la instancia de slim
\Slim\Slim::registerAutoloader();
//aplicacion 
$app = new \Slim\Slim();

//listado de todos los empleados
$app->get(
    '/',function() use ($app){
    	
        //url : rulman/index.php

        //obtenemos los datos del archivo json
    	$todo=file_get_contents("employees.json");

        //decodificamos el json y convertimos en un arreglo
        $user = json_decode($todo,true);

        //creamos una tabla con las cabeceras
       
     echo "<table>";
     echo"
     <tdead>
     <tr>
    <th>name</th>
    <th>email</th>
    <th>position</th>
    <th>salary</th>
    <th>LEER</th>
    <th><input type='text' placeholder='email' name=''></th>
    <th><button>Buscar</button></th>
    </tr>
    </tdead>
  
  <tbody>";

  //recorremos el arreglo y mostramos los datos solicitados.
     foreach($user as $valor) {

        echo '<tr> ';
        echo '<td> ' . $valor['name'] . '</td>';
        echo '<td> ' . $valor['email'] . '</td>';
        echo '<td> ' . $valor['position'] . '</td>';
        echo '<td> ' . $valor['salary'] . '</td>';
        echo '<td> <a href="index.php/empleado/' . $valor['id'] . '" target="_blank">LEER</a></td>';
        echo '</tr> ';
        }

        echo "</tbody>
        </table>";
         
    }

);

//leemos el detalle del empleado
$app->get(
    '/empleado/:id',function($id) use ($app){

        //url : rulman/index.php/empleado/id
        
        $emplo=file_get_contents("employees.json");
        $buscar = json_decode($emplo,true);
        
        echo "Detalle Empleado<br>";

        foreach($buscar as $valo) {
            if ($valo["id"]==$id) {
                echo "NAME : ".$valo['name']."<br>";
                echo "EMAIL : ".$valo['email']."<br>";
                echo "PHONE : ".$valo['phone']."<br>";
                echo "ADDRESS : ".$valo['address']."<br>";
                echo "POSITION : ".$valo['position']."<br>";
                echo "SALARY : ".$valo['salary']."<br>";
                echo "SKILL : ";

                foreach ($valo['skills'] as  $value) {
                   echo $value['skill']," ";
                }

                break;
            }
       }
   }
);

//listado de empleados segun el rango de su salario.
$app->get(
    '/salario/:min/:max',function($min, $max) use ($app){
        
        //url : rulman/index.php/salario/min/max
        
        $salario=file_get_contents("employees.json");
        $all_salario = json_decode($salario,true);

        //funcion que convierte un texto a numeros para comparar.
        function moneda_a_decimal($str)
                {
                    return preg_replace("/([^0-9\\.])/i", "", $str);
                }

         //funcion para convertir json a un XML       
         function convertir_json_xml(array $arr, SimpleXMLElement $xml)
                {
                    foreach ($arr as $k => $v) {
                        is_array($v)
                            ? convertir_json_xml($v, $xml->addChild($k))
                            : $xml->addChild($k, $v);
                    }
                    return $xml;
                }   
                    
             //creamos el arreglo       
            $resultado=array();     
        foreach($all_salario as $valor) {
            

            if (moneda_a_decimal($valor['salary'])>=$min && moneda_a_decimal($valor['salary'])<=$max) {
                //si el salario esta entre el rango agregamos al arreglo
                array_push($resultado,$valor);
            }
        
        }
        
        //Imprimimos el XML
        print_r(convertir_json_xml($resultado, new SimpleXMLElement('<empleado/>'))->asXML());

    }
);


//inicializamos la aplicacion(API)
$app->run();

