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
        $username = $_POST["username"];
        $password = $_POST["password"];

        session_start();

        if (
            UserModel::userExists($this->connection, $username) &&
            password_verify(
                $password,
                UserModel::getPassword($this->connection, $username),
            )
        ) {
            $_SESSION["username"] = $username;
            $_SESSION["authenticated"] = true;

            header("Location: /admin");
            exit();
        }

        header("Location: /login");
        exit();
    }

    public function render()
    {
        LoginView::render();
    }
}
?>
