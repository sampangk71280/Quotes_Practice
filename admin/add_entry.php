New quote form will go here

<?php
// cehck user is logged in 
if (isset($_SESSION['admin'])) {

    $author_ID = $_SESSION['Add_Quote'];
    echo "AuthorID: ".$author_ID;

    // Get subject / topic list from database
    $all_tags_sql = "SELECT * FROM `subject` ORDER BY `Subject` ASC ";
    $all_subjects = autocomplete_list($dbconnect, $all_tags_sql, 'Subject');

    // initialise form variables for quote
    $quote = "Please type your quote here";
    $notes = "";
    $tag_1 = "";
    $tag_2 = "";
    $tag_3 = "";

// initialise tag ID's
$tag_1_ID = $tag_2_ID = $tag_3_ID = 0; 

$has_errors = "no";

// set up error fields / visibility
$quote_error = $tag_1_error = "no-error";
$quote_field = "form-ok";
$tag_1_field = "tag-ok";

// Code below executes when the form is submitted...
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get data from form
    $quote = mysqli_real_escape_string($dbconnect, $_POST['quote']);
    $notes = mysqli_real_escape_string($dbconnect, $_POST['notes']);
    
    // check data is valid

    // check quote is not blank
    if ($quote == "Please type your quote here") {
        $has_errors = "yes";
        $quote_error = "error-text";
        $quote_field = "form-error";
    }


} // end submit button if 

} // end if user logged in 

else {

    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");

} // end user not logged in else

?>

<h1>Add Quote...</h1>

<form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/add_entry");?>"
enctype="multipart/form-data">

    <!-- Quote text area -->
    <div class="<?php echo $quote_error; ?>"> 
        This field can't be blank   
    </div>
    
    <textarea class="add-field <?php echo $quote_field?>" name="quote"
    row="6"><?php echo $quote; ?></textarea>
    <br/><br/>

        <input class="add-field <?php echo $notes; ?>" type="text"
        name="notes" value="<?php echo $notes; ?>" placeholder="Notes (optional).."/>

    <br/><br/>

    <!-- Subject 1 -->    
    <div class="<?php echo $tag_1_error ?>">
        Please enter at least one subejct tag
    </div>
    
    <div class="autocomplete"> 
        <input class="<?php echo $tag_1_field; ?>" id="subject1"
        type="text" name="Subject_1" placeholder="Subject 1(Start Typing)...">
    </div>
    

    <!-- Submit Button -->
    <p>
        <input type="submit" value="Submit" />
    </p>

</form>

<!-- script to make autocomplete work -->
<script>
<?php include("autocomplete.php"); ?>

/* Array containing lists */
var all_tags = <?php print("$all_subjects"); ?>;
autcomplete(document.getElementByID("subject1"), all_tags);

</script>