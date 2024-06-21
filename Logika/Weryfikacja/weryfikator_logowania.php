    <?php
    session_start();

    if ($connection = mysqli_connect("127.0.0.1", "root", "", "bazablog")) {

        $login = mysqli_escape_string($connection, $_POST['login']);
        $password = mysqli_escape_string($connection, $_POST['userPassword']);

        $user = mysqli_query($connection, "SELECT * from users WHERE login = '$login'");
        $query_result = mysqli_fetch_assoc($user);
        if ($login == $query_result['login']) {
            if (password_verify($password, $query_result['haslo'])) {
                echo "Jesteś zalogowany jako: " . $query_result['login'];
                echo "<br>";
                echo "<a href='../../index.php'>Kliknij, aby przejsc do strony głównej.</a>";
                $_SESSION['login'] = $query_result['login'];
                $_SESSION['permission'] = $query_result['permission'];
            } else {
                echo "Hasła się nie zgadzają";
                echo "<a href='../logowanie.html'>Kliknij, aby spróbować ponownie</a>";
            }
        } else {
            echo "Wskazany użytkownik nie istnieje.";
            echo "<p><a href='../../index.php'>Kliknij, aby wrócić do strony głównej</p>";
        }
    } else {
        die(mysqli_connect_error());
    }



