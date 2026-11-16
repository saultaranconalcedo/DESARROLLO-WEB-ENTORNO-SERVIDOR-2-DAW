<?php
function multiplicar($numero, $iterador){
    // hasta cuando se hace
    if($iterador >= 10) return;
    echo $numero . ' x ' .$iterador . '='.$numero * $iterador . '<br>';
    multiplicar($numero, $iterador + 1 );

}
multiplicar(7,0);
?>