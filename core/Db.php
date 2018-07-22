<?php

namespace core;

class Db
{
    use Singleton;

    private $dbh;

    public function __construct()
    {
        try {
            $this->dbh = new \PDO(DB_DSN, DB_USER, DB_PASSW);
        } catch (\PDOException $e) {
            throw new \PDOException('Connection to the database failed: ' . $e->getMessage());
        }
    }

    public function execute($sql) {
        return $this->dbh->exec($sql);
    }

    public function get($sql) {
        $res = $this->dbh->query($sql);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }
}