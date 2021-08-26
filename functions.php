<?php

// function for sorting the date in ascending/descending order
function sortDate(array $json_data, string $order)
{
    //creating an auxiliary map array consisting only of date values 
    $aux_date_arr = [];

    foreach ($json_data as $value) {
        $aux_date_arr[] = $value['reviewCreatedOnTime'];
    }

    //sorting auxiliary array with date values in ascending order
    if ($order == 'ASC') {
        sort($aux_date_arr);
    }

    //sorting auxiliary array with date values in descending order
    if ($order == 'DESC') {
        rsort($aux_date_arr);
    }

    $new_json_data = [];

    //looping through the aux. map array
    foreach ($aux_date_arr as $value) {

        //looping through the main array with the decoded json data
        for ($i = 0; $i < count($json_data); $i++) {

            //condition for adding the array elements according to the sorted aux. map array
            if ($value ==  $json_data[$i]['reviewCreatedOnTime']) {

                //creating a new array with the sorted json items by adding elements that have passed the conditional
                $new_json_data[] = $json_data[$i];

                //removing the date value for the passed element in order for it to be skipped on the next loop
                $json_data[$i]['reviewCreatedOnTime'] = '';
            }
        }
    }

    //returning the new, sorted sorted by date, json data array 
    return $new_json_data;
}

// function for sorting the rating in ascending/descending order
function sortRating(array $json_data, string $order)
{
    //creating an auxiliary map array consisting only of rating values 
    $aux_rating_arr = [];

    foreach ($json_data as $value) {
        $aux_rating_arr[] = $value['rating'];
    }

    //sorting auxiliary array with date values in ascending order
    if ($order == 'ASC') {
        sort($aux_rating_arr);
    }

    //sorting auxiliary array with date values in descending order
    if ($order == 'DESC') {
        rsort($aux_rating_arr);
    }

    $new_json_data = [];

    //looping through the aux. map array
    foreach ($aux_rating_arr as $value) {

        //looping through the main array with the decoded json data
        for ($j = 0; $j < count($json_data); $j++) {

            //conditional for adding the array elements according to the sorted aux array
            if ($value ==  $json_data[$j]['rating']) {

                //creating a new array with the sorted json items by adding elements that have passed the conditional
                $new_json_data[] = $json_data[$j];

                //removing the rating value for the passed element in order for it to be skipped on the next loop
                $json_data[$j]['rating'] = '';
            }
        }
    }

    //returning the new, sorted sorted by rating, json data array 
    return $new_json_data;
}

//function for extracting elements from the json array that contain text
function textOnly(array $new_json_data)
{
    $text_json_data = [];

    //looping through the new - sorted only by date - json array
    for ($i = 0; $i < count($new_json_data); $i++) {

        //conditional for adding exclusively array elements that contain text values 
        if ($new_json_data[$i]['reviewText'] != '') {

            //creating a new array consisting of json items by that contain text
            $text_json_data[] = $new_json_data[$i];
        }
    }

    //returning an array consisting only of items from the main json array that contain text
    return $text_json_data;
}

//function for extracting elements from the json array that do not contain text
function noTextOnly(array $new_json_data)
{
    $no_text_json_data = [];

    //looping through the new - sorted only by date - json array
    for ($i = 0; $i < count($new_json_data); $i++) {

        //conditional for adding exclusively array elements that do not contain text values 
        if ($new_json_data[$i]['reviewText'] == '') {

            //creating a new array consisting of json items by that do not contain text
            $no_text_json_data[] = $new_json_data[$i];
        }
    }

    //returning an array consisting only of items from the main json array that do not contain text
    return $no_text_json_data;
}

//function for re-combining the before-split arrays into a single array agin
function sortedTextAndRating(array $sorted_rating_with_text, array $sorted_rating_without_text)
{
    $new_json_data = [];

    //looping through the json data array containing only elements with text
    for ($i = 0; $i < count($sorted_rating_with_text); $i++) {

        //adding them into a new array
        $new_json_data[] = $sorted_rating_with_text[$i];
    }
    //looping through the json data array containing only elements without text
    for ($i = 0; $i < count($sorted_rating_without_text); $i++) {

        //adding them into the array that contains elements with text added in the previous loop 
        $new_json_data[] = $sorted_rating_without_text[$i];
    }

    //returning an array in which the elements are sorted - elements with text come first - elements without text come second
    return $new_json_data;
}

//function for getting the full URL from regardless of what server you are using
function linkURL()
{
    //checking the protocol type
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? $link = "https" : $link = "http";

    //appending the common URL characters
    $link .= "://";

    //appending the host(domain name, ip) to the URL
    $link .= $_SERVER['HTTP_HOST'];

    //appending the requested resource location to the URL
    $link .= $_SERVER['REQUEST_URI'];

    //returning the link
    return $link;
}
