<?php 

class ChangeString 
{

//convertimos la entrada a un arreglo.
    function build($str)
    {
    
//convertimos la entrada a un arreglo.
$arr1 = str_split($str);
//creamos el arreglo de las letras a validar
$letras = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z');
    
//iniciamos variable x que me permitira concatenar
$x="";
//varible final despues de concatenarse segun la condicion
$final="";
//recorremos el arreglo de entrada
for ($i=0; $i <count($arr1); $i++) { 
//recorremos el arreglo de las letras 
	for ($j=0; $j <count($letras) ; $j++) { 
                //convertimos a minuscula y comparamos con el arreglo de letras
                //le entrada debe de ser diferente de z
		if (strtolower($arr1[$i])==$letras[$j] && strtolower($arr1[$i])!="z") {
                    //si la letra de entrada es mayuscula el resutado tambien
                    if(ctype_upper($arr1[$i]))
                    {
                        //asignamos la la siguiente letra
                       $x=strtoupper($letras[$j+1]);
			break; 
                    }//la letra es minuscula entonces no convertimos nada
                    else{
                        $x=$letras[$j+1];
			break;                        
                    }
					
		}//conerimos minuscula y comparamos con z
                else if (strtolower($arr1[$i])=="z"){
                    if(ctype_upper($arr1[$i]))
                    {//asignamos la primera letra y convertimos a mayucula
                       $x=strtoupper($letras[0]);
			break; 
                    }else{
                        $x=$letras[0];
			break;                        
                    }
			 
		}// si la entrada no esta dentro del arreglo de letras.
                else{
			$x=$arr1[$i];
		}
	}
	$final=$final.$x;
}
echo $final;
    }
    

}

//entrada de caracteres
$dato_entrada= '"**Casa 52Z"'."<br>";
echo "entrada : ".$dato_entrada."<br>";
//creamos el objeto y llamamos a su metodo
$clase=new ChangeString();

echo "salida : ";
$clase->build($dato_entrada);

?>  