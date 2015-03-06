@extends('resultsgenre')
@section('body')
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand">Search results for genre</span>
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
<br><br>
        <br/>
        <h3>Search results for <?php echo $genre_name ?>


    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Rating</th>
            <th>Genre</th>
            <th>Label</th>

        </tr>

        <?php foreach($movies as $movie) : ?>
            <tr>


                <td><?php echo $movie->title ?></td>
                <td><?php echo $movie->rating['rating_name']?></td>
                <td><?php echo $movie->genre->genre_name ?></td>
                <td><?php echo $movie->label['label_name'] ?></td>


            </tr>
        <?php endforeach; ?>
    </table>
@stop
