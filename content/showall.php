<h2>All Results</h2>

<?php 

$find_sql = "SELECT * FROM `quotes`
JOIN author ON(`author`.`Author_ID` = `quotes`.`Author_ID`)
";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);

// loop through results and display them... 
do {

    $quote = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/', ' ', $find_rs['Quote']);

    ?>
<div class="results">
    <?php echo $quote; ?>

</div>

<br />

<?php

} // end of display results 'do'

while($find_rs = mysqli_fetch_assoc($find_query))

?>