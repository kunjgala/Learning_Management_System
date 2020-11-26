<!DOCTYPE html>
<html>
<body>



<?php

    
    
 

function gcd($x,$y){

    echo"<h1>GCD of two numbers using Functions</h1> ";
    $u = $x;
    $v = $y;
    while ($x != $y)
    {
        if ($x > $y)
        $GLOBALS['x'] = $GLOBALS['x'] - $GLOBALS['y'];
        else
        $GLOBALS['y'] = $GLOBALS['y'] - $GLOBALS['x'];
    }

    echo "GCD of $u and $v is: $x";

}
gcd(10,6);
?>

</body>
</html>