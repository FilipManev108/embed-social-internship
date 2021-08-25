<?php

print_r($_POST);
echo "<hr>";

$json = file_get_contents('data.json');

$json_data = json_decode($json, true);
$new_json_data = [];


// minimum rating start
for ($i = 0; $i < count($json_data); $i++) {
    if ($json_data[$i]['rating'] >= $_POST['rating-filter']) {
        $new_json_data[] = $json_data[$i];
    }
}

function textOnly($new_json_data)
{
    $text_json_data = [];
    for ($i = 0; $i < count($new_json_data); $i++) {
        if ($new_json_data[$i]['reviewText'] != '') {
            $text_json_data[] = $new_json_data[$i];
        }
    }
    return $text_json_data;
}

function noTextOnly($new_json_data)
{
    $no_text_json_data = [];
    for ($i = 0; $i < count($new_json_data); $i++) {
        if ($new_json_data[$i]['reviewText'] == '') {
            $no_text_json_data[] = $new_json_data[$i];
        }
    }
    return $no_text_json_data;
}

function sortRatingDesc($json_data)
{
    //creating an auxiliary array consisting only of rating values 
    $ratingArr = [];
    foreach ($json_data as $value) {
        $ratingArr[] = $value['rating'];
    }
    //sorting auxiliary array with descending rating values 
    rsort($ratingArr);

    $new_json_data = [];
    foreach ($ratingArr as $value) {

        for ($j = 0; $j < count($json_data); $j++) {
            //condition for adding the array elements according to the sorted aux array
            if ($value ==  $json_data[$j]['rating']) {
                $new_json_data[] = $json_data[$j];
                //removing the rating value for the passed element in order for it to be skipped on the next loop
                $json_data[$j]['rating'] = '';
            }
        }
    }
    return $new_json_data;
}

function sortRatingAsc($json_data)
{
    //creating an auxiliary array consisting only of rating values 
    $ratingArr = [];
    foreach ($json_data as $value) {
        $ratingArr[] = $value['rating'];
    }
    //sorting auxiliary array with descending rating values 
    sort($ratingArr);

    $new_json_data = [];
    foreach ($ratingArr as $value) {

        for ($j = 0; $j < count($json_data); $j++) {
            //condition for adding the array elements according to the sorted aux array
            if ($value ==  $json_data[$j]['rating']) {
                $new_json_data[] = $json_data[$j];
                //removing the rating value for the passed element in order for it to be skipped on the next loop
                $json_data[$j]['rating'] = '';
            }
        }
    }
    return $new_json_data;
}

function sortedTextAndRating($sorted_rating_with_text, $sorted_rating_without_text)
{
    $new_json_data = [];
    for ($i = 0; $i < count($sorted_rating_with_text); $i++) {
        $new_json_data[] = $sorted_rating_with_text[$i];
    }
    for ($i = 0; $i < count($sorted_rating_without_text); $i++) {
        $new_json_data[] = $sorted_rating_without_text[$i];
    }

    return $new_json_data;
}


echo '<pre>';
// print_r($new_json_data);
// die();
//no text division
if ($_POST['rating'] == 1) {
    if ($_POST['text'] == 0) {
        $new_json_data = [];
        $new_json_data = sortRatingDesc($json_data);
    }
    //text division
    if ($_POST['text'] == 1) {
        $text_json_data = textOnly($new_json_data);
        $no_text_json_data = noTextOnly($new_json_data);
        $sorted_rating_with_text = sortRatingDesc($text_json_data);
        $sorted_rating_without_text = sortRatingDesc($no_text_json_data);
        $new_json_data = [];
        $new_json_data = sortedTextAndRating($sorted_rating_with_text, $sorted_rating_without_text);
    }
}
if ($_POST['rating'] == 0) {
    if ($_POST['text'] == 0) {
        $new_json_data = [];
        $new_json_data = sortRatingAsc($json_data);
    }
    //text division
    if ($_POST['text'] == 1) {
        $text_json_data = textOnly($new_json_data);
        $no_text_json_data = noTextOnly($new_json_data);
        $sorted_rating_with_text = sortRatingAsc($text_json_data);
        $sorted_rating_without_text = sortRatingAsc($no_text_json_data);
        $new_json_data = [];
        $new_json_data = sortedTextAndRating($sorted_rating_with_text, $sorted_rating_without_text);
    }
}



// print_r($text_json_data);
// print_r($no_text_json_data);
// print_r(sortRatingDesc($text_json_data));
// print_r(sortRatingDesc($no_text_json_data));
// sortRatingDesc($text_json_data);
// sortRatingDesc($no_text_json_data);
// print_r();




print_r($new_json_data);
die();
$ratingArr = [];
foreach ($json_data as $value) {
    $ratingArr[] = $value['rating'];
}
print_r($ratingArr);
rsort($ratingArr);
print_r($ratingArr);
// sort($dateArr);

for ($i = 0; $i < count($json_data); $i++) {
    for ($j = 0; $j <  count($json_data); $j++) {
        if ($ratingArr[$i] ==  $json_data[$j]['rating']) {
            $new_json_data[] = $json_data[$j];
        }
    }
}
print_r($new_json_data);


function sortDateAsc($json_data)
{
    $dateArr = [];
    foreach ($json_data as $value) {
        $dateArr[] = $value['reviewCreatedOnTime'];
    }
    sort($dateArr);
    $new_json_data = [];
    for ($i = 0; $i < count($json_data); $i++) {
        for ($j = 0; $j <  count($json_data); $j++) {
            if ($dateArr[$i] ==  $json_data[$j]['reviewCreatedOnTime']) {
                $new_json_data[] = $json_data[$j];
            }
        }
    }
    return $new_json_data;
}
// print_r(sortDateDesc($json_data));
// print_r($json_data);
