<?php

class Query
{
    public function __construct(public string $database, public string $table) {}

    public function insert (array $data): bool
    {
        try {
            foreach ($data as $key => $value) {
                // add $value to $key file in at the end of the file
                if (file_put_contents("./data/".$this->database."/".$this->table."/".$key, $value.PHP_EOL, FILE_APPEND))
                {
                    colorLog("Data inserted successfully", 's');
                } else {
                    colorLog("Failed to insert data", 'e');
                }
            }
            return true;
        } catch (Exception $e) {
            colorLog("Failed to insert data. Error: ".$e->getMessage(), 'e');
            return false;
        }
    }
}