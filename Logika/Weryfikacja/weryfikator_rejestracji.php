<?php
session_start();

try {
    $login = $_POST['login'];
    $haslo = $_POST['userPassword'];
    $email = $_POST['userEmail'];
    $connection = mysqli_connect("127.0.0.1", "root", "", "bazablog");
    $hash = password_hash( $haslo, PASSWORD_DEFAULT);
    mysqli_query($connection, "insert into users(login, haslo, email, permission) values('$login', '$hash', '$email', 'user')");
    echo "Dziękujemy za rejestrację " . $login . "!";
    echo "<a href=../../index.php>Kliknij, aby przejsc do strony glownej!";
    $_SESSION['login'] = $login;
    $_SESSION['permission'] = 'user';
} catch (Exception $e) {
    echo "Wystąpił niespodziewany błąd.";
}

mysqli_close($connection);

