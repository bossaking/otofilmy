<?php
ob_start();
include_once('header.php');

if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}

if(isset($_POST['username'])){
    $errors = array();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = OpenConnection();

    $checkQuery = "SELECT * FROM User WHERE username = '$username'";
    $result = $conn->query($checkQuery);
    if($result->num_rows == 0){
        array_push($errors, "Niepoprawna nazwa użytkownika lub adres e-mail");
    }else{
        $user = $result->fetch_assoc();
        if(strcmp($user['password'], $password) !== 0){
            array_push($errors, "Niepoprawne hasło");
        }else{
            $_SESSION['user']['username'] = $user['username'];
            $_SESSION['user']['role'] = $user['role'];
            header('Location:index.php');
            exit();
        }

    }
    $_SESSION['errors'] = $errors;
}

?>


<div class="form-container">

    <?php
    if (isset($_SESSION['errors'])) {
        ?>
        <div class="form-errors">
            <ul>
                <?php
                foreach ($_SESSION['errors'] as $error) {
                    echo '<li>' . $error . '</li>';
                }
                ?>
            </ul>
        </div>
        <?php
    }
    ?>


    <form method="post">

        <div class="form-field">
            <label for="username">Nazwa użytkownika</label>
            <input type="text" name="username" required id="username">
        </div>
        <div class="form-field">
            <label for="password">Hasło</label>
            <input type="password" name="password" required id="password">
        </div>

        <button type="submit" class="primary-button button">Zaloguj się</button>
    </form>

    <div class="sign-question">
        <span>Nie masz konta w naszym serwisie?</span>
        <a href="registration.php">Przejdź do rejestracji!</a>
    </div>

</div>


<?php include_once('footer.php') ?>
