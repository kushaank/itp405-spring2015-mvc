
/**
 * Created by PhpStorm.
 * User: kush2
 * Date: 3/5/15
 * Time: 4:18 PM
 */

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DVD Insert Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/results.css')?>" type="text/css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand">Insert DVD</span>
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
<br><br><br>
<form method="post" action="<?php echo url("/dvds/submitrequest")?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">


    <div class="form-group">
        <label>Title:</label>
        <input type="text"  name= "title" placeholder="title" value="<?php echo Request::old('title') ?>" class="search-query">
    </div>

    <div class="form-group">
        <label>Genre:</label>
        <select class="form-control" name="genre">

            <?php foreach($genres as $genre) : ?>
                <?php if ($genre->id == Request::old('genre')) : ?>
                    <?php echo " <option selected=\"selected\" value=\" $genre->id \"> $genre->genre_name </option>"?>
                <?php else :?>
                    <?php echo " <option value=\" $genre->id \"> $genre->genre_name </option>"?>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Labels:</label>
        <select class="form-control" name="label">

            <?php foreach($labels as $label) : ?>
                <?php if ($label->id == Request::old('label')) : ?>
                    <?php echo " <option selected=\"selected\" value=\" $label->id \"> $label->label_name </option>"?>
                <?php else :?>
                    <?php echo " <option value=\" $label->id \"> $label->label_name </option>"?>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Sounds:</label>
        <select class="form-control" name="sound">

            <?php foreach($sounds as $sound) : ?>
                <?php if ($sound->id == Request::old('sound')) : ?>
                    <?php echo " <option selected=\"selected\" value=\" $sound->id \"> $sound->sound_name </option>"?>
                <?php else :?>
                    <?php echo " <option value=\" $sound->id \"> $sound->sound_name </option>"?>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Ratings:</label>
        <select class="form-control" name="rating">

            <?php foreach($ratings as $rating) : ?>
                <?php if ($rating->id == Request::old('rating')) : ?>
                    <?php echo " <option selected=\"selected\" value=\" $rating->id \"> $rating->rating_name </option>"?>
                <?php else :?>
                    <?php echo " <option value=\" $rating->id \"> $rating->rating_name </option>"?>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Format:</label>
        <select class="form-control" name="format">

            <?php foreach($formats as $format) : ?>
                <?php if ($format->id == Request::old('format')) : ?>
                    <?php echo " <option selected=\"selected\" value=\" $format->id \"> $format->format_name </option>"?>
                <?php else :?>
                    <?php echo " <option value=\" $format->id \"> $format->format_name </option>"?>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>

    <style>
        .successMessage {
            background-color: green;

        }

        .errorMessage {
            background-color: red;

        }
    </style>
    <div class="errorMessage">
    <?php foreach($errors->all() as $errorMessage):?>
        <?php echo $errorMessage?>
        <br>
    <?php endforeach ?>
    </div>
    <div class="successMessage">
    <?php if (Session::has('success')) : ?>
        <h3><?php echo Session::get('success') ?></h3>
        <br>
    <?php endif ?>
    </div>

</form>
</div>
</body>
</html>