<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EmbedSocial Internship - Filip Manev</title>
</head>

<body>
    <!-- title -->
    <h3>Filter reviews</h3>

    <!-- form -->
    <form action="" type="POST">

        <!-- rating highest/lowest -->
        <div>
            <label for="rating">Order by rating:</label>
            <select name="rating" id="rating">
                <option selected disabled>Please choose an option</option>
                <option value="1">Highest first</option>
                <option value="0">Lowest first</option>
            </select>
        </div>

        <!-- minimum rating filter -->
        <div>
            <label for="rating-filter">Minimum rating:</label>
            <select name="rating-filter" id="rating-filter">
                <option selected disabled>Please choose an option</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <!-- date newest/oldest -->
        <div>
            <label for="date">Order by date:</label>
            <select name="date" id="date">
                <option selected disabled>Please choose an option</option>
                <option value="1">Newest</option>
                <option value="0">Oldest</option>
            </select>
        </div>

        <!-- text prioritisation -->
        <div>
            <label for="text">Prioritize by text:</label>
            <select name="text" id="text">
                <option selected disabled>Please choose an option</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <!-- submit button -->
        <button>Filter</button>

    </form>
</body>

</html>