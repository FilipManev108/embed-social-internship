<?php
session_start();

require_once 'functions.php'; //access to the functions.php file

//writing the full URL from index.php for redirecting back after all the operations are done
$link_index = $_SESSION['linkURL'];

//assigning the $_POST values passed from index.php to $_SESSION variables - to be used back in index.php for functionality of the dropdown form inputs
$_SESSION['rating'] = $_POST['rating'];
$_SESSION['rating-filter'] = $_POST['rating-filter'];
$_SESSION['date'] = $_POST['date'];
$_SESSION['text'] = $_POST['text'];

$json = file_get_contents('data.json'); //getting the data from the data.json file

$json_data = json_decode($json, true); //transforming the json format into a PHP associative array

$new_json_data = []; //empty array in which all the magic happens later on

//looping through the main, unfiletered json data array - if the configured minimum rating is less than 5, the working array is shortened thus contributing to optimization
for ($i = 0; $i < count($json_data); $i++) {

    //conditional for filtering the configured minimum rating elements, as selected in the index.php form
    if ($json_data[$i]['rating'] >= $_POST['rating-filter']) {

        //adding the filtered elements into a new json data array
        $new_json_data[] = $json_data[$i];
    }
}

//conditional for sorting the new json data array by descending date order
if ($_POST['date'] == 1) {
    $new_json_data = sortDate($new_json_data, 'DESC');  //this function is explained in detail in the functions.php file starting on line 3
}

//conditional for sorting the new json data array by ascending date order
if ($_POST['date'] == 0) {
    $new_json_data = sortDate($new_json_data, 'ASC'); //this function is explained in detail in the functions.php file starting on line 3 
}

//conditional for sorting the new json data array by ascending rating order
if ($_POST['rating'] == 1) {

    //no text division
    if ($_POST['text'] == 0) {
        $new_json_data = sortRating($new_json_data, 'DESC'); //function explained in detail in functions.php on line 47  
        $_SESSION['json'] = $new_json_data; //passing the fully sorted new json data array in session, used in the construction of the table body
    }

    //text division
    if ($_POST['text'] == 1) {
        $text_json_data = textOnly($new_json_data); //function explained in detail in functions.php on line 91  
        $no_text_json_data = noTextOnly($new_json_data); //function explained in detail in functions.php on line 111  
        $sorted_rating_with_text = sortRating($text_json_data, 'DESC'); //function explained in detail in functions.php on line 47  
        $sorted_rating_without_text = sortRating($no_text_json_data, 'DESC'); //function explained in detail in functions.php on line 47  
        $new_json_data = sortedTextAndRating($sorted_rating_with_text, $sorted_rating_without_text); //function explained in detail in functions.php on line 131  
        $_SESSION['json'] = $new_json_data; //passing the fully sorted new json data array in session, used in the construction of the table body
    }
}

//conditional for sorting the new json data array by ascending rating order
if ($_POST['rating'] == 0) {

    //no text division
    if ($_POST['text'] == 0) {
        $new_json_data = sortRating($new_json_data, 'ASC'); //function explained in detail in functions.php on line 47  
        $_SESSION['json'] = $new_json_data; //passing the fully sorted new json data array in session, used in the construction of the table body
    }

    //text division
    if ($_POST['text'] == 1) {
        $text_json_data = textOnly($new_json_data); //function explained in detail in functions.php on line 91 
        $no_text_json_data = noTextOnly($new_json_data); //function explained in detail in functions.php on line 111  
        $sorted_rating_with_text = sortRating($text_json_data, 'ASC'); //function explained in detail in functions.php on line 47  
        $sorted_rating_without_text = sortRating($no_text_json_data, 'ASC'); //function explained in detail in functions.php on line 47  
        $new_json_data = sortedTextAndRating($sorted_rating_with_text, $sorted_rating_without_text); //function explained in detail in functions.php on line 131  
        $_SESSION['json'] = $new_json_data; //passing the fully sorted new json data array in session, used in the construction of the table body
    }
}


//redirecting back to index.php  
header('Location: ' . $link_index);
