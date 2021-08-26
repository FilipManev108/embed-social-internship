<?php

function sortDate($json_data, string $order)
{
    //creating an auxiliary array consisting only of date values 
    $aux_date_arr = [];
    foreach ($json_data as $value) {
        $aux_date_arr[] = $value['reviewCreatedOnTime'];
    }
    //sorting auxiliary array with descending date values
    if ($order == 'ASC') {
        sort($aux_date_arr);
    }
    if ($order == 'DESC') {
        rsort($aux_date_arr);
    }

    $new_json_data = [];
    foreach ($aux_date_arr as $value) {

        for ($i = 0; $i < count($json_data); $i++) {
            //condition for adding the array elements according to the sorted aux array
            if ($value ==  $json_data[$i]['reviewCreatedOnTime']) {
                $new_json_data[] = $json_data[$i];
                //removing the date value for the passed element in order for it to be skipped on the next loop
                $json_data[$i]['reviewCreatedOnTime'] = '';
            }
        }
    }
    return $new_json_data;
}

function sortRating($json_data, string $order)
{
    //creating an auxiliary array consisting only of rating values 
    $aux_rating_arr = [];
    foreach ($json_data as $value) {
        $aux_rating_arr[] = $value['rating'];
    }
    //sorting auxiliary array with ascending rating values 
    if ($order == 'ASC') {
        sort($aux_rating_arr);
    }
    //sorting auxiliary array with descending rating values 
    if ($order == 'DESC') {
        rsort($aux_rating_arr);
    }

    $new_json_data = [];
    foreach ($aux_rating_arr as $value) {

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
// die();

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