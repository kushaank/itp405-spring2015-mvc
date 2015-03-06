
/**
 * Created by PhpStorm.
 * User: kush2
 * Date: 2/23/15
 * Time: 11:41 PM
 */


<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DVD reviews</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/results.css')?>" type="text/css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand">Reviews</span>
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
    <br/>
    <h3>Submit a review for <?php echo $info[0]->title ?> </h3>

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

        <tr>
            <td><?php echo $info[0]->title ?></td>
            <td><?php echo $info[0]->rating_name ?></td>
            <td><?php echo $info[0]->genre_name ?></td>
            <td><?php echo $info[0]->label_name ?></td>
            <td><?php echo $info[0]->sound_name ?></td>
            <td><?php echo $info[0]->format_name ?></td>
            <td><?php echo DATE_FORMAT(new DateTime($info[0]->release_date), 'm-d-Y') ?></td>
        </tr>

</table>

    <div class="row">
    <div>
        <h3>Write your review</h3>
        <form role="form" method ="post" action= "/dvds/review">
            <input type="hidden" name="id" value="<?php echo $info[0]->id; ?>">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text"  name= "title" placeholder="title" value="<?php echo Request::old('title') ?>" class="search-query">
                <div>
                    <label for="rating">Rating</label>
                    <select class="form-control" name="rating">
                        <?php foreach($ratings as $rating):?>
                            <?php if ($rating == Request::old('rating')) : ?>
                                <option selected="selected">
                                    <?php echo $rating?>
                                </option>
                            <?php else :?>
                                <option>
                                    <?php echo $rating?>
                                </option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>

                </div>


                <div class="form-group">

                    <label for="review">Review</label>
                    <textarea class="form-control" name="review" rows="5" id="comment"><?php echo Request::old('comment')?></textarea>
                </div>

            </div>
            <div class="form-group">
                <button type="submit" class="btn" name="submit"><i class="icon-search">Submit</i></button>
            </div>
            <?php foreach($errors->all() as $errorMessage):?>
                    <?php echo $errorMessage?>
                <br>
            <?php endforeach ?>
            <?php if (Session::has('success')) : ?>
                    <h3><?php echo Session::get('success') ?></h3>
               <br>
            <?php endif ?>
        </form>
    </div>


</div>
<div >
    <h4 class="text-center">Previous Reviews</h4>
    <table class="table table-bordered">
        <thread>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Rating</th>
            </tr>
        </thread>
        <tbody>
        <?php foreach($reviews as $review):?>
            <tr>
                <td><?php echo $review->title ?></td>
                <td><?php echo $review->description ?></td>
                <td><?php echo $review->rating ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
</div><!-- /.container -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>
</html>