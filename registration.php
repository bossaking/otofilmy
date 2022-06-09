<?php
ob_start();
include_once('header.php');

$username = "";
$password = "";
$repeatPassword = "";

if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}

if (isset($_POST['register'])) {

    $errors = array();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];

    if (strcmp($password, $repeatPassword) === 0) {
        $conn = OpenConnection();
        $checkUniqueUsername = "SELECT * FROM User WHERE username = '$username'";

        if($conn->query($checkUniqueUsername)->num_rows != 0){
            array_push($errors, "Podana nazwa użytkownika już zarejestrowana");
        }


        if(count($errors) == 0){
            $insert = "INSERT INTO User (username, password) VALUES 
                ('$username', '$password')";
            if($conn->query($insert) === true){
                $_SESSION['user']['username'] = $username;
                $_SESSION['user']['role'] = 1;
                header('Location:index.php');
                exit();
            }else{
                array_push($errors, $conn->error);
            }
        }

    } else {
        array_push($errors, "Hasła nie są ze soba zgodne");
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
                <input type="text" name="username" required id="username" placeholder="JKowalski" value="<?=$username?>">
            </div>

            <div class="form-field">
                <label for="password">Hasło</label>
                <input type="password" name="password" required id="password" value="<?=$password?>">
            </div>

        <div class="form-field">
            <label for="repeatPassword">Powtóż hasło</label>
            <input type="password" name="repeatPassword" required id="repeatPassword" value="<?=$repeatPassword?>">
        </div>

        <button type="submit" class="primary-button button" name="register">Zarejestruj się</button>
    </form>

    <div class="sign-question">
        <span>Masz już konto?</span>
        <a href="login.php">Przejdź do logowania!</a>
    </div>

</div>


<?php include_once('footer.php') ?>
