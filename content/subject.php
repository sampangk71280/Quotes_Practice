
<?php 

if(!isset($_REQUEST['subjectID']))
{
    header('Location: index.php');
}

$subject_to_find = $_REQUEST['subjectID'];

    // get subject heading... 
    $sub_sql = "SELECT * FROM `subject` WHERE `Subject_ID` = $subject_to_find";
    $sub_query = mysqli_query($dbconnect, $sub_sql);
    $sub_rs = mysqli_fetch_assoc($sub_query);
?>

<h2>Subject Results (<?php echo $sub_rs['Subject'] ?></h2>

<?php 

// get quotes
$find_sql = "SELECT * FROM `quotes`
JOIN author ON(`author`.`Author_ID` = `quotes`.`Author_ID`)
WHERE `Subject1_ID` = $subject_to_find
OR `Subject2_ID` = $subject_to_find
OR `Subject3_ID` = $subject_to_find
";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);
$count = mysqli_num_rows($find_query);


if($count > 0) {

// loop through results and display them... 
do {

    $quote = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/', ' ', $find_rs['Quote']);

    // get author name
    include("get_author.php");

    ?>
<div class="results">
    <p>
        <?php echo $quote; ?><br />
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

while($find_rs = mysqli_fetch_assoc($find_query));
    } // end if results exist if 

else {
    // no results - display error
?>

<h2>Oops!</h2>

    <div class="error">
        Sorry - there are no subjects that match the search term <i><b>
        <?php echo $quick_find?></b></i>. Please try again.
    </div>

<p>&nbsp;</p>

<?php
}

?> 