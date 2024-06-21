<?php
/*
try {
    $connection = mysqli_connect('127.0.0.1', 'root', '', 'bazablog');
    $result = mysqli_query($connection, "select obrazek from posty where id = 3");
    if (mysqli_num_rows($result) > 0) {
       $row = mysqli_fetch_assoc($result);
       $image_data = $row['obrazek'];
       $image = base64_encode($image_data);

    } else {
        echo "No image found";
    }
} catch(Exception $e) {
    echo "Nie działa";
}

echo "<p>Wyświetlacz obrazków</p>";
echo '<img src="data:image/jpeg;base64,' . $image . '" alt="Image from BLOB" />';*/

$array = scandir("Posty/");
for ($i = 2; $i < count($array); $i++) {
    echo "$array[$i]<br>";
}