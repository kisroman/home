<?php
try {
    require_once('code/ClassCreator.php');

    $xml = simplexml_load_file('setup/version.xml');

    $nextVersion = substr($xml->current_version, 0, -1) . ((int)substr($xml->current_version, -1) + 1);
    if (file_exists('setup/' . $nextVersion . '.php')) {
        include 'setup/' . $nextVersion . '.php';

        $xml->current_version = $nextVersion;
        $xml->saveXML('setup/version.xml');
    }
} catch (Error $e) {
    $res = file_put_contents('../log/exception.log', $e->getMessage());
    echo 'EXCEPTION!!! See logs';
} catch (\Exception $e) {
    file_put_contents('../log/exception.log', $e->getMessage());
    echo 'EXCEPTION!!! See logs';
}
