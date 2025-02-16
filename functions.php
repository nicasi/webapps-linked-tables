<?php

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=music", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Connected successfully
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


function fetchAlbums() {
    global $conn;

    $results = $conn
        ->query('SELECT * FROM albums LEFT JOIN artists ON albums.artist_id = artists.id')
        ->fetchAll(PDO::FETCH_OBJ);

    return $results;
}

function fetchArtists() {
    global $conn;
    
    $sql = "SELECT * FROM artists";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $artists = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $artists;
}

function addAlbum($album_name, $artist_id, $release_date, $genre) {
    global $conn;

    $sql = "INSERT INTO albums (artist_id, title, release_date, genre) VALUES (:artist_id, :album_name, :release_date, :genre)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':artist_id', $artist_id);
    $stmt->bindParam(':album_name', $album_name);
    $stmt->bindParam(':release_date', $release_date);
    $stmt->bindParam(':genre', $genre);

    // Uitvoeren
    $stmt->execute();
}

function deleteArtist($id) {
    global $conn;

    $sql = "DELETE FROM artists WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
    }
    catch (PDOException $e) {
        return "Delete artist failed.";
    }

    return null;
}

function show($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}