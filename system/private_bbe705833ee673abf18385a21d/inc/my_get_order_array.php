<?php
function my_get_order_array($str) {
    $str = base64_decode($str);
    $arr = json_decode($str, 1);
    return $arr;
}
?>