<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "src/kernel.php";

$commands = [
    'insert' => '{database} {table} {key1=value1,key2=value2,...}',
    'checkTable' => '{database} {table}',
    'createTable' => '{database} {table}',
    'connect' => '{database}',
    'createDatabase' => '{database}',
    'help' => ''
];

if ($argv[1] === 'help') {
    colorLog("Available commands:", 'i');
    foreach ($commands as $command => $args) {
        colorLog("  $command: ", 'i').
        colorLog("    $args", 's');
    }
    exit(0);
}

if (!isset($commands[$argv[1]])) {
    colorLog("Usage: php app.php <command> <database> [table]", 's');
    colorLog("Invalid command", 'e');
    exit(1);
}

if ($argc < 3) {
    echo "Invalid arguments\n";
    exit(1);
}

$command = $argv[1];
$database = $argv[2];
$table = $argv[3] ?? null;
if (isset($argv[4])) {
    foreach (explode(',', $argv[4]) as $arg) {
        [$key, $value] = explode('=', $arg);
        $data[$key] = $value;
    }
} else {
    $data = [];
}

eval("\$command = $command(\$database, \$table, \$data);");

function insert(string $database, string $table, array $data): void
{
    $db = new Database($database);
    $db->table($table)->query()->insert($data);
}

function checkTable(string $database, string $table): bool
{
    $db = new Database($database);
    return $db->table($table)->checkTable();
}

function createTable(string $database, string $table): void
{
    $db = new Database($database);
    $db->table($table)->createTable();
}

function connect(string $database): Database
{
    $db = new Database($database);
    if ($db->check()) {
        colorLog("Connected to $database", 's');
    } else {
        colorLog("Database $database not found", 'e');
    }
    return $db;
}

function createDatabase(string $database): Database
{
    return Database::create($database);
}
