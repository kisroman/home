<?php
try {
    require_once('classes/ClassCreator.php');
    /** @var \classes\Db\Connection $connection */
    $connection = \classes\ClassCreator::includeClass(\classes\Db\Connection::class);

    include 'setup/version_1.php';
    $result = $connection->select('db_version');
    $row = $result->fetch_row();
    if (!$row) {
        $connection->insert('db_version', '"version_1"');
    } else {
        $nextVersion = substr($row[0], 0, -1) . ((int)substr($row[0], -1) + 1);
        if (file_exists('setup/' . $nextVersion . '.php')) {
            include 'setup/' . $nextVersion . '.php';
            $connection->update('db_version', 'version = "' . $nextVersion . '"', 'version = "' . $row[0] . '"');
        }
    }
} catch (Error $e) {
    $res = file_put_contents('../log/exception.log', $e->getMessage());
    echo 'EXCEPTION!!! See logs';
} catch (\Exception $e) {
    file_put_contents('../log/exception.log', $e->getMessage());
    echo 'EXCEPTION!!! See logs';
}
