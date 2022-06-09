<?php
ob_start();
include_once('header.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $conn = OpenConnection();
    $select = "SELECT * FROM Movie WHERE id_movie = '$id'";
    $movie = $conn->query($select)->fetch_assoc();

} else {
    header('Location: index.php');
}

?>
<div style="display: flex">
    <div class="video-header">
        <h2 class="movie-header"><?= $movie['title'] ?></h2>
        <?php
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 0) {
            ?>
            <a href="remove_movie.php?id=<?=$movie['id_movie']?>" class="button cancel-button">Usuń film</a>
            <?php
        }
        ?>
    </div>
</div>


<hr class="red-hr" style="width: 50%">

<div class="video-container">
    <video class="video-player" controls>
        <source src="videos/<?= $movie['video'] ?>" type="video/mp4">
    </video>
</div>


<?php include_once('footer.php') ?>
