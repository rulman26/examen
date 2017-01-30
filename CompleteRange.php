<?php

class CompleteRange {

    function build($entrad) {
        
        $entrada=substr($entrad, 1, -1);
        $explode = explode(",",$entrada);
        
        $x="";
        $final="[";
        for ($index = min($explode); $index <= max($explode); $index++) {
            $final=$final.$index.",";
        }
        echo substr($final,0,-1)."]";
    }
    
}

$entrad="[1,2,3,4,6]";
echo "entrada : ".$entrad."<br>";
echo "salida : ";

$numero= new CompleteRange();
$numero->build($entrad);

?>


