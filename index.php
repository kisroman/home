<?php
try {
    require_once('classes/ClassCreator.php');

    include 'template/index.phtml';

} catch (\Error $e) {
    $res = file_put_contents('log/exception.log', $e->getMessage());
    echo 'EXCEPTION!!! See logs';
} catch (\Exception $e) {
    file_put_contents('log/exception.log', $e->getMessage());
    echo 'EXCEPTION!!! See logs';
}
