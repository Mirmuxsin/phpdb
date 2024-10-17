<?php

require "Query.php";

class Table
{
    public function __construct(public string $database, public string $table) {}

    public function query(): Query
    {
        return new Query($this->database, $this->table);
    }

    public function checkTable(): bool
    {
        if (file_exists("./data/".$this->database."/".$this->table)) {
            colorLog("Table ".$this->table." exists", 's');
            return true;
        } else {
            colorLog("Table ".$this->table." not found", 'e');
            return false;
        }
    }

    public function createTable(): void
    {
        if (file_exists("./data/".$this->database."/".$this->table)) {
            colorLog("Table ".$this->table." already exists", 'w');
        }

        if (mkdir("./data/".$this->database."/".$this->table)) {
            colorLog("Table ".$this->table." created", 's');
        } else {
            colorLog("Failed to create table ".$this->table, 'e');
        }
    }
}