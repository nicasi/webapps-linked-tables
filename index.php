<?php

require 'functions.php';

$albums = fetchAlbums();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>music</title>
</head>
<body>
    <?php
    foreach ($albums as $album) :
    ?>

        <div class="album">
            <h3><?= $album->title ?></h3>
            <div class="artist"><?= $album->name ?></div>
            <div class="year"><?= $album->release_date ?></div>
            <div class="genre"><?= $album->genre ?></div>
        </div>

    <?php
    endforeach;
    ?>
</body>
</html>