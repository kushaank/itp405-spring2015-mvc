
/**
* Created by PhpStorm.
* User: kush2
* Date: 2/17/15
* Time: 1:30 AM
*/

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/search.css')?>" type="text/css">
    <link rel="icon" href="../../favicon.ico">

    <title>DVD Search</title>

</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Movie Database</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>


            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <br>
    <br>
    <br>
    <div class="starter-template">


    </div>
    <div class="row">
        <div>
            <h3>Search for a movie:</h3>
            <form role="form" method ="get" action= "/dvds">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text"  name= "title" class="search-query">
                    <div>
                        <label for="artist">Genre:</label>
                        <select class="form-control" name="genre" id="genre" placeholder="Genre">
                            <option>All</option>
                            <?php foreach($genres as $genre) : ?>
                                <div>
                                    <option> <?php echo $genre->genre_name ?> </option>
                                </div>
                            <?php endforeach; ?>
                        </select>

                    </div>

                    <div class="form-group">

                        <label for="genre">Rating:</label>

                        <select class="form-control" name="rating" id="rating" placeholder="Rating">
                            <option>All</option>
                            <?php foreach($ratings as $rating) : ?>
                             <div>
                                <option><?php echo $rating->rating_name ?> </option>
                             </div>
                            <?php endforeach; ?>

                        </select>

                    </div>
                </div>
                <button type="submit" class="btn"><i class="icon-search">Search</i></button>
            </form>
        </div>
    </div>

    <div class = " container col-md-4" >
        <h2>Genres</h2>
        <?php foreach($genres as $genre) : ?>
            <br>
            <a href="/genres/<?php echo $genre->genre_name ?>/dvds"><?php echo $genre->genre_name ?></a>
        <?php endforeach ?>
    </div>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>