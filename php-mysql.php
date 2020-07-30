<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require "health.inc";

$uuid = rtrim(file_get_contents("/proc/sys/kernel/random/uuid"));

$mysqli = new mysqli($server, $user, $password, $db);

if ($mysqli -> connect_errno) {
	http_response_code(503);
        echo("Failed to connect to MySQL: " . $mysqli -> connect_error);
        exit();
}

$query = "INSERT INTO checks (id) VALUES ('" . $uuid . "')";

if ($mysqli -> query($query) != TRUE) {
	http_response_code(503);
        echo("Error: " . $sql . "<br>" . $mysqli -> error);
        exit();
}

$query = "SELECT SQL_NO_CACHE * FROM checks WHERE id = '" . $uuid . "'";

if ($result = $mysqli -> query($query)) {
        $row = $result -> fetch_row();
        if ($row[0] == $uuid) {
                echo("OK: uuid = " . $row[0] . ", datetime = " . $row[1]);
        } else {
		http_response_code(503);
                echo("NOT OK");
		exit();
        }
        $result -> free_result();
} else {
	http_response_code(503);
        echo("NOT OK");
        exit();
}

$mysqli -> close();

?>
