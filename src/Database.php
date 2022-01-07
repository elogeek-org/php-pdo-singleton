<?php
namespace Elodie\PhpPdoSingleton;

use PDO;
use PDOException;

final class  Database {

    private  static ?PDO $pdo;

    // Database related
    private string $host;
    private string $db;
    private string $user;
    private string $password;


    /**
     *  my DB constructor.
     */
    public function __construct() {
        try {
            self::$pdo = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->user, $this->password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception) {
            echo "Erreur de connexion: " . $exception->getMessage();
        }
    }

    /**
     * Return the database PDO connection
     * @return PDO|null
     */
    public static function getInstance(): ?PDO {
        if(null === self::$pdo) {
            new self();
        }
        return self::$pdo;
    }

}
