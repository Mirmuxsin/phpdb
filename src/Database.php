<?php

require "Table.php";

class Database
{
    public function __construct(public string $database) {}

    public function table(string $table): Table
    {
        return new Table($this->database, $table);
    }

    public static function create(string $database): Database
    {
        if (file_exists("./data/".$database)) {
            colorLog("Database $database already exists", 'w');
        }

        if (mkdir("./data/".$database)) {
            colorLog("Database $database created", 's');
        } else {
            colorLog("Failed to create database $database", 'e');
        }
        return new Database($database);
    }

    public function check(): bool
    {
        return file_exists("./data/".$this->database);
    }
}