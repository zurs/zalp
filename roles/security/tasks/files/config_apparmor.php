<?php

if(in_array("--test", $argv)) {
    $LSM_PATH = "./lsm"; // "/sys/kernel/security/lsm";
    $EXTLINUX_PATH = "./extlinux.conf"; //"/boot/extlinux.conf";
} else {
    // Hardcoded for Alpine 3.19 for now
    $LSM_PATH = "/sys/kernel/security/lsm";
    $EXTLINUX_PATH = "/boot/extlinux.conf";
}


$lsmContent = trim(file_get_contents($LSM_PATH));
$lsmStmtToInsert = "lsm=" . $lsmContent . ",apparmor";


$extContent = file_get_contents($EXTLINUX_PATH);
$extContent = explode("\n", $extContent);

$newExtFileContent = [];

foreach ($extContent as &$line) {
    if(!str_contains($line, "APPEND")) {
        $newExtFileContent[] = $line;
        continue;
    }

    $newLsmStmtLine = [];

    $stmts = explode(" ", $line);
    foreach($stmts as $stmt) {
        if(!str_contains($stmt, "lsm=")) {
            $newLsmStmtLine[] = $stmt;
        }
    }
    $newLsmStmtLine[] = $lsmStmtToInsert;

    $line = implode(" ", $newLsmStmtLine);
    $newExtFileContent[] = $line;
}

$newExtFileContent = implode("\n", $newExtFileContent);

print $newExtFileContent;

