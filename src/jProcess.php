<?php
include_once "vendor/autoload.php";

use Jtrw\Process\jProcessWorker;

try {
    $jProcess = new jProcessWorker();
    $jProcess->run();
} catch (Throwable $exp) {
    echo $exp->getMessage();
}
