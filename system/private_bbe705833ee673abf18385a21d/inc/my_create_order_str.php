<?php
function my_create_order_str($arr) {
    $str = json_encode($arr);
    $str = base64_encode($str);
    return $str;
}
?>