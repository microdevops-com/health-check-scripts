# Prepare Database
```sql
CREATE DATABASE health;
GRANT ALL PRIVILEGES ON health.* TO health@'%' IDENTIFIED BY 'xxxxxxxxxxxxxxxxxxxxx';
USE health;
CREATE TABLE checks (id VARCHAR(36) PRIMARY KEY, timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
```

# Create inc with mysql connect
Edit `health.inc`:
```php
<?php

$server = "localhost:3306";
$user = "health";
$password = "xxxxxxxxxxxxxxxxxxxxx";
$db = "health";

?>
```
