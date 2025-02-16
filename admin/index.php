<?php
require '../functions.php';

if (isset($_POST['add_album'], $_POST['artist_id'], $_POST['album_name'], $_POST['release_date'], $_POST['genre'])) {
    addAlbum( $_POST['album_name'], $_POST['artist_id'], $_POST['release_date'], $_POST['genre']);
}

if(isset($_POST['delete_artist'])) {
    $errmsg = deleteArtist($_POST['artist_id']);
}

$artists = fetchArtists();
$albums = fetchAlbums();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Album</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php if(isset($errmsg)) : ?>
        <div class="error"><?= $errmsg; ?></div>
    <?php endif; ?>


    <h1>Add Album</h1>
    <form method="post" action="">
        <label for="album_name">Album Name:</label>
        <input type="text" id="album_name" name="album_name" required><br><br>
        <label for="artist_id">Artist:</label>
        <select id="artist_id" name="artist_id" required>
            <?php foreach ($artists as $artist): ?>
                <option value="<?php echo $artist->id; ?>"><?php echo $artist->name; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="release_date">Release Date:</label>
        <input type="date" id="release_date" name="release_date" required><br><br>
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required><br><br>
        <input type="submit" name="add_album" value="Add Album">
    </form>

    <h2>ARTISTS</h2>
    <?php
    foreach ($artists as $artist) :
    ?>
        <form action="." method="post" class="artist">
            <input type=text class="title" name="name" value="<?= $artist->name ?>">
            <input type=text class="formed_year" name="formed_year" value="<?= $artist->formed_year ?>">
            <input type=text class="country" name="country" value="<?= $artist->country ?>">
            <input type=hidden name="artist_id" value="<?= $artist->id ?>">
            <input type="submit" value="update" name="update">
            <input type="submit" value="delete" name="delete_artist">
        </form>

    <?php
    endforeach;
    ?>

    <h2>ALBUMS</h2>
    <?php
    foreach ($albums as $album) :
    ?>
        <form action="." method="post" class="album">
            <input type=text class="title" value="<?= $album->title ?>">
            <select id="artist_id" name="artist_id">
                <?php foreach ($artists as $artist): ?>
                    <option value="<?php echo $artist->id; ?>" <?php echo $artist->id == $album->artist_id ? "selected" : ""; ?>><?php echo $artist->name; ?></option>
                <?php endforeach; ?>
            </select>
            <input type=date class="year" value="<?= $album->release_date ?>">
            <input type=text class="genre" value="<?= $album->genre ?>">
            <input type="submit" value="delete" name="delete">
        </form>

    <?php
    endforeach;
    ?>

</body>
</html>
