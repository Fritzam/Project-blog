<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === "POST"){
    try {
        //Nazwiązanie połączenia z bazą danych
        $connection = mysqli_connect('127.0.0.1', "root", '', 'bazablog');

        //Zapisanie tytulu i tresci do zmiennych
        $tytul = $_POST['tytul'];
        $tresc = $_POST['tresc'];

        //Zapisanie daty do zmiennej i sanityzacja tytulu posta
        $post_date = date("Y-m-d H.i.s");
        $sanitized_title = str_replace(' ', '_', $tytul);

        //Utworzenie folderu posta
        mkdir($path = "../../Posty/" . $post_date . "&". $sanitized_title, 0777, true);

        //Stworzenie pliku post.html
        $post = fopen($path . "/" . "post.html", 'w+');
        $blog_content = "<div>\n\t<h1>$tytul</h1>\n";
        $blog_content .= "\t<h2>Data publikacji: $post_date</h2>\n";

        //Obsługa obrazka
        if (isset($_FILES['obrazek']) && $_FILES['obrazek']['error'] === 0) {
            $extension = pathinfo($_FILES['obrazek']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['obrazek']['tmp_name'], "$path" . "/obrazek." . $extension);
            $obrazek = $_FILES['obrazek'];
            $obrazek_path = "$path" . "/obrazek." . $extension;
            $blog_content .= "\t<img width='200px' height='200px' src='$obrazek_path' alt='Obrazek'>\n";
        }

        //Reszta danych do post.html, stworzenie folderu na komentarze.
        $blog_content .= "\t<p>$tresc</p>\n";
        $blog_content .= "</div>\n";
        mkdir($path . "/komentarze", 0777, true);

        //Zamknięcie pliku.
        fwrite($post, $blog_content);
        fclose($post);

        echo "Post dodany!<br>";
        echo "<a href='../../index.php'>Kliknij, aby wrócić strony głównej</a>";
        $_SESSION['post'] = count(scandir("../../Posty")) - 1;

        //Zapis posta do bazy danych
        $tytul = mysqli_escape_string($connection, $_POST['tytul']);
        $tresc = mysqli_escape_string($connection, $_POST['tresc']);
        if (isset($_FILES['obrazek']) && $_FILES['obrazek']['error'] === 0) {
            $extension = pathinfo($_FILES['obrazek']['name'], PATHINFO_EXTENSION);
            $obrazek_path = "$path" . "/obrazek." . $extension;
            $obrazek_name = basename($obrazek_path);
            $obrazek_data = file_get_contents($obrazek_path);
            $escaped_data = mysqli_real_escape_string($connection, $obrazek_data);
            mysqli_query($connection, "insert into posty(data, tytul, tresc, obrazek) VALUES ('$post_date', '$tytul', '$tresc', '$escaped_data')");
        } else {
            mysqli_query($connection, "INSERT INTO posty(data, tytul, tresc, obrazek) VALUES('$post_date', '$tytul', '$tresc', NULL)");
        }
    } catch(Exception $e) {
        echo "<span>Nie można połączyć się z bazą</span><br>" .
            "<a href='../stworzPost.html'>Proszę kliknąć, aby spróbować ponownie.</a>";
    }
}