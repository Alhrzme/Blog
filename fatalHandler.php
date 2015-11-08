<?php
function fatalHandler() {
    $lastError = error_get_last();
    if (!is_null($lastError)) {
            echo ($lastError['message'] . ' in "' . $lastError['file'] . '" line ' . $lastError['line']);
    }
}

register_shutdown_function('fatalHandler');