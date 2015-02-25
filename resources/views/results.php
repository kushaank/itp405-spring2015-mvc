
/**
 * Created by PhpStorm.
 * User: kush2
 * Date: 2/17/15
 * Time: 1:30 AM
 */

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DVD Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/results.css')?>" type="text/css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand">Search results</span>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li><a href="<?php echo "/dvds/search" ?>">Back to search</a></li>
            </ul>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <?php if ($genre || $rating) : ?>
        <br/>
        <h3>Search results for
            <?php if ($title) : ?>
                Title: '<?php echo $title?>, '
            <?php endif ?>
            Genre: '<?php echo $genre ?>', Rating: '<?php echo $rating ?>'</h3>
    <?php endif ?>

    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Rating</th>
            <th>Genre</th>
            <th>Label</th>
            <th>Sound</th>
            <th>Format</th>
            <th>Release Date</th>
        </tr>

        <?php foreach($movies as $movie) : ?>
            <tr>
                <td><?php echo $movie->title ?></td>
                <td><?php echo $movie->rating_name ?></td>
                <td><?php echo $movie->genre_name ?></td>
                <td><?php echo $movie->label_name ?></td>
                <td><?php echo $movie->sound_name ?></td>
                <td><?php echo $movie->format_name ?></td>
                <td><?php echo DATE_FORMAT(new DateTime($movie->release_date), 'm-d-Y') ?></td>
                <td><a href="<?php echo "dvds/".$movie->id ?>"> Write Review</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div><!-- /.container -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>
</html>