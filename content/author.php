<?php 

if(!isset($_REQUEST['authorID']))
{
    header('Location: index.php');
}

$author_to_find = $_REQUEST['authorID'];
echo "Author: ".$author_to_find;

$find_sql = "SELECT * FROM `quotes`
JOIN author ON(`author`.`Author_ID` = `quotes`.`Author_ID`) 
WHERE `quotes`.`Author_ID` = $author_to_find
";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);
?>

<h2>All Results</h2>

<?php
// loop through results and display them... 
do {

    $quote = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/', ' ', $find_rs['Quote']);

    include("get_author.php");

    ?>
<div class="results">
    <p>
        <?php echo $quote; ?><br />
       
       <!-- display author name -->
        <a href="index.php?page=author&authorID=<?php echo $find_rs['Author_ID'];
        ?>">
            <?php echo $full_name; ?>
        </a>
    </p>

    <?php include("show_subjects.php"); ?>

</div>

<br />

<?php

} // end of display results 'do'

while($find_rs = mysqli_fetch_assoc($find_query))

?>