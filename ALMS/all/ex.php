<?php

try{
        $a = 1;
        $b = 5;
        if($a == 0)
        {
            throw new Exception('Divide by zero<br>');
        }
        $d=$b/$a;
        echo "Division = $d<br>";
    try
    {
        $c = 5;
        $d = 1;
        if($c == -5)
        {
            throw new Exception("Negative number error<br>");
        }
        $e = $c / $d;
        echo "Division of $e<br>"; 
    }
    catch(Exception $a)
    {
        echo $a->getMessage();
    }
}
catch(Exception $e)
{
    echo $e->getMessage();
}
finally
{
    print "Successful<br>";
}
?>