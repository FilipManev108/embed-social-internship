<?php
session_start();

$rating = 0;
$rating_filter = 1;
$date = 0;
$text = 0;

$binary_choice = [1, 0];
$rating_choice = [1, 2, 3, 4, 5];

$new_json_data = [];

if (isset($_SESSION['json'])) {
    // echo 'SESSION IS OK';
    $rating = $_SESSION['rating'];
    $rating_filter = $_SESSION['rating-filter'];
    $date = $_SESSION['date'];
    $text = $_SESSION['text'];

    $new_json_data = $_SESSION['json'];
}
$c = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EmbedSocial - Filip Manev</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <!-- title -->
    <h3>Filter reviews</h3>

    <!-- form -->
    <form action="logic.php" method="POST">

        <!-- rating highest/lowest -->
        <div>
            <label for="rating">Order by rating:</label>
            <select name="rating" id="rating">

                <?php foreach ($binary_choice as $choice) { ?>

                    <option value="<?= $choice ?>" <?php if ($choice == $rating) { ?> selected <?php } ?>><?= ($choice) ? "Highest first" : "Lowest First" ?></option>

                <?php } ?>

            </select>
        </div>

        <!-- minimum rating filter -->
        <div>
            <label for="rating-filter">Minimum rating:</label>
            <select name="rating-filter" id="rating-filter">

                <?php foreach ($rating_choice as $choice) { ?>

                    <option value="<?= $choice ?>" <?php if ($choice == $rating_filter) { ?> selected <?php } ?>><?= $choice ?></option>

                <?php } ?>

            </select>
        </div>

        <!-- date newest/oldest -->
        <div>
            <label for="date">Order by date:</label>
            <select name="date" id="date">

                <?php foreach ($binary_choice as $choice) { ?>

                    <option value="<?= $choice ?>" <?php if ($choice == $date) { ?> selected <?php } ?>><?= ($choice) ? "Newest first" : "Oldest First" ?></option>

                <?php } ?>

            </select>
        </div>

        <!-- text prioritisation -->
        <div>
            <label for="text">Prioritize by text:</label>
            <select name="text" id="text">

                <?php foreach ($binary_choice as $choice) { ?>

                    <option value="<?= $choice ?>" <?php if ($choice == $text) { ?> selected <?php } ?>><?= ($choice) ? "Yes" : "No" ?></option>

                <?php } ?>

            </select>
        </div>

        <!-- submit button -->
        <button type="submit">Filter</button>

    </form>

    <!-- table -->
    <table>

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
</body>

</html>