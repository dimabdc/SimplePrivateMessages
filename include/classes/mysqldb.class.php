<?php
class mysqldb {
    function mysqldb($mysql_host, $mysql_user, $mysql_pass, $mysql_db, $mysql_charset) {
        if (!$id = @mysql_connect($mysql_host, $mysql_user, $mysql_pass, true)) {
            die("[" . mysql_errno() . "] dbconn: mysql_connect: " . mysql_error());
        }
        mysql_select_db($mysql_db) or die("dbconn: mysql_select_db: " + mysql_error());
        mysql_query("SET NAMES $mysql_charset");
        mysql_query("SET CHARACTER_SET_CLIENT='" . $mysql_charset . "'");
        mysql_query("SET CHARACTER_SET_RESULTS='" . $mysql_charset . "'");
        mysql_query("SET COLLATION_CONNECTION='" . $mysql_charset . "_general_ci'");
    }

    function fetch_array($query) {
        $query = mysql_fetch_array($query);
        return $query;
    }

    function fetch_assoc($query) {
        $query = mysql_fetch_assoc($query);
        return $query;
    }

    function query($sql) {
        $query = mysql_query($sql) or die(mysql_error());
        return $query;
    }

    function result($query, $row) {
        $query = mysql_result($query, $row);
        return $query;
    }

    function num_rows($query) {
        $query = mysql_num_rows($query);
        return $query;
    }

    function fetch_row($query) {
        $query = mysql_fetch_row($query);
        return $query;
    }
}
