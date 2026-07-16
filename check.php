<?php

$files = [
    'app/Models/Customer.php',
    'app/Models/Order.php',
    'app/Models/Medicine.php',
    'app/Http/Controllers/CustomerController.php',
    'app/Http/Controllers/OrderController.php',
    'database/seeders/DatabaseSeeder.php',
    'database/seeders/MedicineSeeder.php',
];

foreach ($files as $f) {
    if (!file_exists($f)) {
        echo $f . " | FILE MISSING" . PHP_EOL;
        continue;
    }
    $bytes = file_get_contents($f);
    $hasBom = substr($bytes, 0, 3) === chr(0xEF).chr(0xBB).chr(0xBF);
    $hasNamespace = strpos($bytes, 'namespace') !== false;
    $hasClass = strpos($bytes, 'class') !== false;
    echo $f . ' | BOM: ' . ($hasBom ? 'YES-PROBLEM' : 'no') . ' | namespace: ' . ($hasNamespace ? 'yes' : 'MISSING') . ' | class: ' . ($hasClass ? 'yes' : 'MISSING') . PHP_EOL;
}
