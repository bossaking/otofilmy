<?php
ob_start();
include_once('header.php');

if(isset($_POST['title'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $video = $_POST['video'];

    $conn = OpenConnection();
    $newMovie = "INSERT INTO Movie (title, description, image, video) VALUES ('$title', '$description', '$image', '$video')";

    $conn->query($newMovie);

    header('Location: index.php');

}

?>

<script src="js/new_movie.js"></script>

<div class="new-movie">
    <form method="post">
        <div class="form-field">
            <label for="title">Nazwa filmu</label>
            <input type="text" name="title" required id="title">
        </div>
        <div class="form-field">
            <label for="description">Opis</label>
            <textarea name="description" required id="description" rows="5"></textarea>
        </div>

        <div class="form-field">
            <label for="image">Obrazek</label>
            <input type="file" name="image" required id="image" accept=".jpg, .png, .svg, .jpeg">
        </div>

        <div class="form-field">
            <label for="video">Plik filmu</label>
            <input type="file" name="video" required id="video" accept=".mp4">
        </div>

        <div class="form-row">
            <button type="submit" class="button accept-button">Dodaj</button>
            <button type="button" class="button cancel-button" id="cancel">Anuluj</button>
        </div>

    </form>
</div>

<?php include_once('footer.php') ?>
