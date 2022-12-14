<?php // db.inc.php - DB class for establishing DB connections
      // use $db = new DB($dbname, $user, $password);
      // Then $db->run("prepared query", [argument array]);
require_once("/etc/db-password.php");

class DB
{
    public $pdo;

    public function __construct(
        $db = 'dbapp',
        $username = 'root', // null
        $password = MYSQL_PASSWORD, // defined in /etc/db-password
        $host = 'db',
        $port = 3306,
        $options = []
    )
    {
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $options = array_replace($default_options, $options);
        $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=utf8mb4";

        try {
            $this->pdo = new \PDO($dsn, $username, $password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    public function run($sql, $args = null)
    {
        if (!$args) {
            return $this->pdo->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
