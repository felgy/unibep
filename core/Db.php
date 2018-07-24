<?php

namespace core;

class Db
{
    use Singleton;

    private $dbh;

    public function __construct()
    {
        try {
            $this->dbh = new \PDO(DB_DSN, DB_USER, DB_PASSW, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]);
        } catch (\PDOException $e) {
            throw new \PDOException('Connection to the database failed: ' . $e->getMessage());
        }
    }

    public function execute($sql)
    {
        try {
            return $this->dbh->exec($sql);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    public function quote($value)
    {
        try {
            return $this->dbh->quote($value);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    public function get($sql)
    {
        try {
            $sth = $this->dbh->query($sql);
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }
}