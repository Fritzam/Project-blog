<?php
session_start();

try {
    $connection = mysqli_connect("127.0.0.1", "root", "", "bazablog");
    $hash = password_hash($_POST['userPassword'], PASSWORD_DEFAULT);
    $login = $_POST['login'];
    $email = $_POST['userEmail'];
    mysqli_query($connection, "insert into user(login, haslo, email) values('$login', '$hash', '$email')");
    echo "Dziękujemy za rejestrację " . $login . "!";
    echo "<a href=../../index.php>Kliknij, aby przejsc do strony glownej!";
    $_SESSION['login'] = $login;
} catch (Exception $e) {
    echo "Wystąpił niespodziewany błąd.";
}

mysqli_close($connection);

