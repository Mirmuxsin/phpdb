# Database Management Script

This is example of a simple database management script that can be used to manage databases and tables.

### todo
- [ ] Add more queries (select, update, delete)
- [ ] Security checks while inserting data

## Available Commands

- **insert**: Insert data into a table.
  ```sh
  php app.php insert {database} {table} {key1=value1,key2=value2,...}
    ```
- **checkTable**: Check if a table exists.
  ```sh
  php app.php checkTable {database} {table}
    ```
- **createTable**: Create a table.
  ```sh
  php app.php createTable {database} {table}
    ```
- **connect**: Connect to a database.
  ```sh
    php app.php connect {database}
    ```
- **createDatabase**: Create a database.
  ```sh
  php app.php createDatabase {database}
    ```