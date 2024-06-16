    <?php
    session_start();

    if ($connection = mysqli_connect("127.0.0.1", "root", "", "bazablog")) {

        $login = mysqli_escape_string($connection, $_POST['login']);
        $password = mysqli_escape_string($connection, $_POST['userPassword']);

        $user = mysqli_query($connection, "SELECT * from user WHERE login = '$login'");
        $result = mysqli_fetch_assoc($user);
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
            echo "Wskazany użytkownik nie istnieje.";
            echo "<p><a href='../../index.php'>Kliknij, aby wrócić do strony głównej</p>";
        }
    } else {
        die(mysqli_connect_error());
    }



