<?php
function setComment() {
    //Костыль
    $con = mysqli_connect("localhost", "root", "", "test");

    if (!$con) {
        die("Database not found!");
    }

    if(isset($_POST['commentSubmit'])) {
        $date = $_POST['date_note'];
        $title = $_POST['title_note'];
        $message = $_POST['text_note'];
        if (!empty($title) && !empty($message)) {
            $date = $_POST['date_note'];
            $title = $_POST['title_note'];
            $message = $_POST['text_note'];
            $query = "INSERT INTO `test`(`date_note`, `title_note`, `text_note`) VALUES ('$date', '$title', '$message')";
            $result = mysqli_query($con, $query);
        }
        else {
            echo "<br><b><div class ='comment'>Для отправки заметки необходимо заполнить обе ячейки.</div></b>";
        }
    }
}

function getComments($page_count) {

    //Костыль
    $con = mysqli_connect("localhost", "root", "", "test");

    if (!$con) {
        die("Database not found!");
    }

    $query = "SELECT * FROM `test` ORDER BY `id_note` DESC LIMIT 100";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='comment'>
                <div> Написано в <i>".$row['date_note']."</i><br><br><b>".$row['title_note']."</b></div>";

        echo " <div>".$row["text_note"]."</div>";

        echo "<div><br><form method='POST' action='".likeSubmit($row)."'>  <button type='submit' name='".$row['id_note']."' class='like_button'></button>  <br>Оценили: ".$row["like_note"]."</form></div>
        </div><br>";
    }
}

function likeSubmit($row) {

    //Костыль
    $con = mysqli_connect("localhost", "root", "", "test");

    if (!$con) {
        die("Database not found!");
    }

    if(isset($_POST[$row['id_note']])) {
        $id = $row['id_note'];
        $likes = $row['like_note']+1;
        $query = "UPDATE `test` SET `like_note` = '$likes' WHERE `id_note` = '$id'";
        $result = mysqli_query($con, $query);
        header('Location: index.php');
    }
}