<?php



class ClearPar {

    function build($entrada) {
        
        $arr1 = str_split($entrada);

$x="";
$final="";
for ($index = 0; $index < count($arr1) && $index!=count($arr1)-1; $index++) {
    
    
    if($arr1[$index]=="(" && $arr1[$index+1]==")")
    {
        $x=$arr1[$index].$arr1[$index+1];
        $index++;  
        
    } else {
    $x="";    
    }
    $final=$final.$x;
}
echo $final;
        
    }

}

$entrada='())()(((((()()((()(()';
echo "entrada : ".$entrada."<br>";
echo "salida : ";
$parentesis=new  ClearPar();
$parentesis->build($entrada);

?>
