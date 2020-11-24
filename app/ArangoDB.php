<?php
namespace App;

use ArangoDBClient\Connection;
use ArangoDBClient\ConnectionOptions as ConnOpts;
use ArangoDBClient\UpdatePolicy;
use ArangoDBClient\Statement;
use ArangoDBClient\DocumentHandler;

class ArangoDB {
    private static $options = [
        ConnOpts::OPTION_DATABASE => "arango_db",
        ConnOpts::OPTION_ENDPOINT => "tcp://127.0.0.1:8529",
        ConnOpts::OPTION_AUTH_TYPE => "Basic",
        ConnOpts::OPTION_AUTH_USER => "latif@arango_db",
        ConnOpts::OPTION_AUTH_PASSWD => "password",
        ConnOpts::OPTION_CONNECTION => "Keep-Alive",
        ConnOpts::OPTION_TIMEOUT => 3,
        ConnOpts::OPTION_RECONNECT => true,
        ConnOpts::OPTION_CREATE => true,
        ConnOpts::OPTION_UPDATE_POLICY => UpdatePolicy::LAST
    ];

    private static $conn;

    private static function setup() {
        if (isset($conn)) {
            $conn = new ArangoConnection(self::$options);
        }
    }

    public static function query($query) {
        self::setup();
        $statement = new State(self::$conn, $query);
        return $statement->execute();
    }

    public static function find($table, $id) {
        self::setup();
        $handler = new DocumentHandler(self::$conn);
        return $handler->get($table, $id);
    }

    // public static function list($table)
}
?>
