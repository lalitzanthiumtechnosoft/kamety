<?php

include '../../conection.php';
$newsId = $_POST['newsId'];
$query = mysqli_query($con, "UPDATE config_news_list SET status=0 WHERE news_id='$newsId'");
if ($query) {
    echo true;
} else {
    return false;
}
