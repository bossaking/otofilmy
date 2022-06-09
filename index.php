<?php
ob_start();
include_once('header.php');

$conn = OpenConnection();
$getMovies = "SELECT * FROM Movie";

$result = $conn->query($getMovies);
$movies = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($movies, $row);
    }
}

?>
<?php
if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 0) {
    ?>
    <a href="new_movie.php" class="button accept-button" style="margin: 2rem; text-decoration: none">Dodaj film</a>
    <?php
}
?>
<script src="js/index.js"></script>

    <form style="width: 50%; margin-top: -1rem">
        <div class="form-field">
            <input name="title" id="filter-title" placeholder="Szukaj..." type="text">
        </div>
    </form>


<div class="movies-container">

    <?php
    foreach ($movies as $movie) {
        ?>

        <div class="movie-card" id="<?= $movie['id_movie'] ?>">

            <img src="images/<?= $movie['image'] ?>" alt="movie_img">

            <header>
                <span id="movie-header"><?= $movie['title'] ?></span>
            </header>
            <hr class="green-hr">
            <section class="movie-card-body">
                <p><?= $movie['description'] ?></p>
            </section>

        </div>

        <?php
    }
    ?>
</div>


<?php include_once('footer.php') ?>
