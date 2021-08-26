<?php
session_start();
require_once 'functions.php';

// print_r($_POST);
// echo "<hr>";
$_SESSION['rating'] = $_POST['rating'];
$_SESSION['rating-filter'] = $_POST['rating-filter'];
$_SESSION['date'] = $_POST['date'];
$_SESSION['text'] = $_POST['text'];
$json = file_get_contents('data.json');

$json_data = json_decode($json, true);
$new_json_data = [];


// minimum rating
for ($i = 0; $i < count($json_data); $i++) {
    if ($json_data[$i]['rating'] >= $_POST['rating-filter']) {
        $new_json_data[] = $json_data[$i];
    }
}
// echo '<pre>';
// print_r(sortDate($new_json_data, 'ASC'));
if ($_POST['date'] == 0) {
    $new_json_data = sortDate($new_json_data, 'ASC');
    // print_r($new_json_data);
}
if ($_POST['date'] == 1) {
    $new_json_data = sortDate($new_json_data, 'DESC');
    // print_r($new_json_data);
}
// echo '<pre>';
// print_r($new_json_data);
// die();
// print_r($new_json_data);
if ($_POST['rating'] == 1) {
    //no text division
    if ($_POST['text'] == 0) {
        // $new_json_data = [];
        $new_json_data = sortRating($new_json_data, 'DESC');
        $_SESSION['json'] = $new_json_data;
    }
    //text division
    if ($_POST['text'] == 1) {
        $text_json_data = textOnly($new_json_data);
        $no_text_json_data = noTextOnly($new_json_data);
        $sorted_rating_with_text = sortRating($text_json_data, 'DESC');
        $sorted_rating_without_text = sortRating($no_text_json_data, 'DESC');
        $new_json_data = [];
        $new_json_data = sortedTextAndRating($sorted_rating_with_text, $sorted_rating_without_text);
        $_SESSION['json'] = $new_json_data;
    }
}
if ($_POST['rating'] == 0) {
    if ($_POST['text'] == 0) {
        // $new_json_data = [];
        $new_json_data = sortRating($new_json_data, 'ASC');
        $_SESSION['json'] = $new_json_data;
    }
    //text division
    if ($_POST['text'] == 1) {
        $text_json_data = textOnly($new_json_data);
        $no_text_json_data = noTextOnly($new_json_data);
        $sorted_rating_with_text = sortRating($text_json_data, 'ASC');
        $sorted_rating_without_text = sortRating($no_text_json_data, 'ASC');
        $new_json_data = [];
        $new_json_data = sortedTextAndRating($sorted_rating_with_text, $sorted_rating_without_text);
        $_SESSION['json'] = $new_json_data;
    }
}



header("Location: http://localhost/job%20hunt/embed-social-internship/");
