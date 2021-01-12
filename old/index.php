<?php
try {
    require_once('code/ClassCreator.php');

    include 'template/index.phtml';

} catch (\Error $e) {
    file_put_contents('log/exception.log', $e->getMessage() . "\n", FILE_APPEND);
    file_put_contents('log/exception.log', $e->getTraceAsString() . "\n", FILE_APPEND);
    echo 'EXCEPTION!!! See logs';
} catch (\Exception $e) {
    file_put_contents('log/exception.log', $e->getMessage() . "\n", FILE_APPEND);
    file_put_contents('log/exception.log', $e->getTraceAsString() . "\n", FILE_APPEND);
    echo 'EXCEPTION!!! See logs';
}
