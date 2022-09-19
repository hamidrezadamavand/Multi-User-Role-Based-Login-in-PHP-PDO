<?php
function user_input($data)
{
    $data1 = trim($data);
    $data2 = stripslashes($data1);
    $data3 = htmlspecialchars($data2);
    return $data3;
}
?>