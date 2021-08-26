<?php
session_start();

require_once 'functions.php'; //access to the functions.php file

//writing the full index.php URL into session to be used for redirecting back from logic.php
$_SESSION['linkURL'] = linkURL(); //function explained in detail in functions.php on line 153

//default values for dropdown options on first load
$rating = 0;
$rating_filter = 1;
$date = 0;
$text = 0;

//arrays used in the construction of the dropdown option forms
$binary_choice = [1, 0];
$rating_choice = [1, 2, 3, 4, 5];

//empty array for later handling of the sorted data received from the logic.php file
$new_json_data = [];

if (isset($_SESSION['json'])) {

    //rewriting the defailt values for the dropdowns - used for remembering the old selected values on window reload/form submission
    $rating = $_SESSION['rating'];
    $rating_filter = $_SESSION['rating-filter'];
    $date = $_SESSION['date'];
    $text = $_SESSION['text'];

    //receiveing the fully sorted json data array from logic.php file
    $new_json_data = $_SESSION['json'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>EmbedSocial - Filip Manev</title>
</head>

<body>
    <section class="sec1">
        <!-- title -->
        <h1 class="font">Filter reviews</h1>

        <!-- form -->
        <form class="font" action="logic.php" method="POST">

            <!-- rating highest/lowest -->
            <div>
                <label for="rating">Order by rating:</label>
                <select name="rating" id="rating">

                    <!-- loop for rating dropdown options construction -->
                    <?php foreach ($binary_choice as $choice) { ?>

                        <option value="<?= $choice ?>" <?php if ($choice == $rating) { ?> selected <?php } ?>><?= ($choice) ? "Highest first" : "Lowest First" ?></option>

                    <?php } ?>

                </select>
            </div>

            <!-- minimum rating filter -->
            <div>
                <label for="rating-filter">Minimum rating:</label>
                <select name="rating-filter" id="rating-filter">

                    <!-- loop for rating-filter dropdown options construction -->
                    <?php foreach ($rating_choice as $choice) { ?>

                        <option value="<?= $choice ?>" <?php if ($choice == $rating_filter) { ?> selected <?php } ?>><?= $choice ?></option>

                    <?php } ?>

                </select>
            </div>

            <!-- date newest/oldest -->
            <div>
                <label for="date">Order by date:</label>
                <select name="date" id="date">

                    <!-- loop for date dropdown options construction -->
                    <?php foreach ($binary_choice as $choice) { ?>

                        <option value="<?= $choice ?>" <?php if ($choice == $date) { ?> selected <?php } ?>><?= ($choice) ? "Newest first" : "Oldest First" ?></option>

                    <?php } ?>

                </select>
            </div>

            <!-- text prioritisation -->
            <div>
                <label for="text">Prioritize by text:</label>
                <select name="text" id="text">

                    <!-- loop for text dropdown options construction -->
                    <?php foreach ($binary_choice as $choice) { ?>

                        <option value="<?= $choice ?>" <?php if ($choice == $text) { ?> selected <?php } ?>><?= ($choice) ? "Yes" : "No" ?></option>

                    <?php } ?>

                </select>
            </div>

            <!-- submit button -->
            <button type="submit">Filter</button>

        </form>
    </section>
    <section class="sec2">
        <!-- table -->
        <table class="font">

            <!-- table header -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Rating</th>
                    <th>Date</th>
                    <th>Review Text</th>
                </tr>
            </thead>

            <!-- table body -->
            <tbody>
                <?php if (count($new_json_data) == 0) { ?>
                    <tr>
                        <td class='first_time' colspan='4'><b>Please configure your filter settings and click on 'Filter' button</b>
                        <td>
                    </tr>
                <?php } ?>
                <!-- looping through the fully sorted new json data array -->
                <?php foreach ($new_json_data as $value) { ?>

                    <tr>
                        <td><?= $value['id'] ?></td>
                        <td><?= $value['rating'] ?></td>
                        <td><?= $value['reviewCreatedOnDate'] ?></td>
                        <td><?= ($value['reviewText'] == '') ? 'no text' : $value['reviewText'] ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </section>
</body>

</html>