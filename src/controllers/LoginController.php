<?php
declare(strict_types=1);

class LoginController
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function authenticate()
    {
        session_start();

        // 1. Prüfen, ob POST-Daten überhaupt ankommen
        if (empty($_POST)) {
            die("ERROR: POST-Daten sind leer!");
        }

        // 2. Prüfen, ob Header bereits gesendet wurden
        if (headers_sent($file, $line)) {
            die("ERROR: Headers already sent in $file:$line");
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        if (
            UserModel::userExists($this->connection, $username) &&
            password_verify(
                $password,
                UserModel::getPassword($this->connection, $username),
            )
        ) {
            $_SESSION["username"] = $username;
            $_SESSION["authenticated"] = true;

            header("Location: " . BASE_URL . "/admin");
            exit();
        }

        header("Location: " . BASE_URL . "/login");
        exit();
    }

    public function render()
    {
        LoginView::render();
    }
}
?>
