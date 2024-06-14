<?php
session_start();
try {
    $connection = mysqli_connect("127.0.0.1", "root", "", "bazablog");
    $login = $_POST['login'];
    $password = $_POST['userPassword'];

    try {
        $user = mysqli_query($connection, "SELECT * from user WHERE login = '$login'");
        $result = mysqli_fetch_row($user);
        if ($login == $result[1]) {
            if (password_verify($password, $result[2])) {
                echo "Jesteś zalogowany jako: " . $result[1];
                echo "<br>";
                echo "<a href='../../index.php'>Kliknij, aby przejsc do strony głównej.</a>";
                $_SESSION['login'] = $result[1];
            } else {
                echo "Hasła się nie zgadzają";
                echo "<a href='../logowanie.html'>Kliknij, aby spróbować ponownie</a>";
            }
        } else {
            echo "Taki user nie istnieje";
        }
    } catch (Exception $e) {
        echo "Taki user nie istnieje";
    }
} catch(Exception $e) {
    echo "Przydarzył się niespodziewany błąd.";
}


