<?php
require 'config.php';
$stmt = $pdo->query("SHOW CREATE TABLE leads");
echo $stmt->fetchColumn();
echo "\n\n";
$stmt = $pdo->query("DESCRIBE leads");
print_r($stmt->fetchAll());
