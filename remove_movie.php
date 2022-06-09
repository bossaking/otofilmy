<?php

ob_start();
include_once('header.php');

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $select = "SELECT * FROM Movie WHERE id_movie = '$id'";

    $conn = OpenConnection();
    $movie = $conn->query($select)->fetch_assoc();

    unlink("images/" . $movie['image']);
    unlink("videos/" . $movie['video']);

    $remove = "DELETE FROM Movie WHERE id_movie = '$id'";

    $conn = OpenConnection();
    $conn->query($remove);

    header('Location: index.php');

}else{
    header('Location: index.php');
}