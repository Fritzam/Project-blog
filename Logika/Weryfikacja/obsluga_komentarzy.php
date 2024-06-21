<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!isset($_POST['username'])) {
        $username = $_SESSION['login'];
    } else {
        $username = $_POST['username'];
    }

    $data = date("Y-m-d H.i.s");
    $tresc = $_POST['tresc'];
    $sciezka = "../../Posty/" . $_SESSION['obecnyPost'];
    $sciezkaKomentarza = $sciezka . "/" . "komentarze/komentarz%" . $data . ".html";
    $komentarz = fopen($sciezkaKomentarza, "w+");
    $trescKomentarza = "<div>\n\t<span>Autor: $username</span>\n";
    $trescKomentarza .= "\t<span>Dnia: $data</span>\n";
    $trescKomentarza .= "\t<span>Napisał/a: $tresc</span>\n</div>";
    fwrite($komentarz, $trescKomentarza);

}

?>
<p>Dodano komentarz!</p>
<a href="../../index.php">Kliknij, aby wrócić do strony głównej.</a>