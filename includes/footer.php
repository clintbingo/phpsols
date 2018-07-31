<footer>
    <p>&copy;
    <?php
    $startYear=2006;
    $thisYear=date("Y");
    if($startYear==$thisYear)
    {
    	echo $startYear;
    }else
    {
    	echo "{$startYear}&ndash;{$thisYear}";
    }
    ?> 
Clint Bingo</p> 
</footer>