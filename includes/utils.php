<?php
function doHash($text) {
    $hash = hash("ripemd160", $text);
    $hash = hash("md5", $text);
    return $hash;
}
?>