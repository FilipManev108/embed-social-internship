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
            <tr>
                <td>1</td>
                <td>Rating 1</td>
                <td>Date 1</td>
                <td>Review Text 1</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Rating 2</td>
                <td>Date 2</td>
                <td>Review Text 2</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Rating 3</td>
                <td>Date 3</td>
                <td>Review Text 3</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Rating 4</td>
                <td>Date 4</td>
                <td>Review Text 4</td>
            </tr>
        </tbody>
    </table>
</body>

</html>