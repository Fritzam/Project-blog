<?php
if ($_SERVER['REQUEST_METHOD'] === "POST"){
    try {
        $connection = mysqli_connect('127.0.0.1', "root", '', 'bazablog');

        //$tytul = mysqli_escape_string($connection, $_POST['tytul']);
        //$tresc = mysqli_escape_string($connection, $_POST['tresc']);
        $tytul = $_POST['tytul'];
        $tresc = $_POST['tresc'];
        if (isset($_FILES['obrazek']) && $_FILES['obrazek']['error'] === 0) {
            $obrazek = $_FILES['obrazek'];
        }
        $post_date = date("Y-m-d H.i.s");
        $sanitized_title = str_replace(' ', '_', $tytul);
        mkdir($path = "../../Posty/" . $post_date . $sanitized_title, 0777, true);
        $post = fopen($path . "/" . $tytul . ".html", 'w+');
        $blog_content = "<div>\n\t<h1>$tytul</h1>\n";
        $blog_content .= "\t<h2>Data publikacji: $post_date</h2>\n";
        if (isset($_FILES['obrazek']) && $_FILES['obrazek']['error'] === 0) {
            $extension = pathinfo($_FILES['obrazek']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['obrazek']['tmp_name'], "$path" . "/obrazek." . $extension);
            $obrazek = $_FILES['obrazek'];
            $obrazek_path = "$path" . "/obrazek." . $extension;
            $blog_content .= "\t<img width='200px' height='200px' src='$obrazek_path' alt='Obrazek'>\n";
        }
        $blog_content .= "\t<p>$tresc</p>\n";
        $blog_content .= "</div>\n";

        fwrite($post, $blog_content);
        fclose($post);




    } catch(Exception $e) {
        echo "<span>Nie można połączyć się z bazą</span><br>" .
            "<a href='../stworzPost.html'>Proszę kliknąć, aby spróbować ponownie.</a>";
    }
}