<?php

require_once('PackageDependencies.php');

$packages = [
    'A'=>[
        'name'=>'B',
        'dependencies'=>['B','C'],
    ],
    'B'=>[
        'name'=>'B',
        'dependencies'=>[],
    ],
    'C'=>[
        'name'=>'C',
        'dependencies'=>['B','D'],
    ],
    'D'=>[
        'name'=>'D',
        's'=>[],
    ],
    'E'=>[
        'name'=>'E',
        'dependencies'=>[],
    ],
];

try {
    $base = new PackageDependencies();
    var_dump($base->getAllPackageDependencies($packages,'A'));
}
catch (PackageDependencies $e) {
    echo $e->getMessage();
}