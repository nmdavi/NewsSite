<?php

require_once "Connection.php";

class Author
{
    private $connection;

    function __construct()
    {
        $this->connection = new Connection();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function register(string $first_name, string $last_name, string $email, string $password, string $Confirmpassword)
    {
        try {
            if ($password == $Confirmpassword) {
                $email_exist = "SELECT email FROM authors WHERE email = ? LIMIT 1";
                $email_exist = $this->connection->prepare($email_exist);
                $email_exist->execute([$email]);

                if ($email_exist->rowCount() > 0) {
                    return "E-mail já cadastrado!";
                }

                $query = "INSERT INTO authors VALUES (null, ?, ?, ?, ?, ?, null, 0)";

                $command = $this->connection->prepare($query);
                $command->execute([$first_name, $last_name, $email, $password, "StandardImage.png"]);
                return $command->rowCount() > 0 ?: $this->auditoria("Erro, não foi possível registrar author(a)!", __METHOD__);
            } else {
                return "As senhas não coincidem!";
            }
        } catch (Exception $error) {
            $this->auditoria($error->getMessage(), __METHOD__, false);
        }
    }

    public function login($email, $password)
    {
        try {
            $account_exist = "SELECT id, CONCAT(first_name, ' ', last_name) as name, email FROM authors WHERE email = ? AND password = ? LIMIT 1";
            $account_exist = $this->connection->prepare($account_exist);
            $account_exist->execute([$email, $password]);

            if ($account_exist->rowCount() > 0) {
                $author = $account_exist->fetch();
                $_SESSION["id"] = $author["id"];
                $_SESSION["name"] = $author["name"];
                $_SESSION["email"] = $author["email"];
            } else {
                if (isset($_SESSION["id"])) {
                    unset($_SESSION["id"], $_SESSION["name"], $_SESSION["email"]);
                }

                return "Email or password is incorret!";
            }

            return isset($_SESSION["id"]) ?: $this->auditoria("Erro, não foi possível logar o author(a)!", __METHOD__);
        } catch (Exception $error) {
            $this->auditoria($error->getMessage(), __METHOD__, false);
        }
    }

    public function findAll(string $where = null, int $limit = null)
    {
        try {
            $query = "SELECT * FROM authors WHERE 1=1";

            if (strpos($where, "limit") && isset($limit)) {
                $this->auditoria("Erro, limite definido duas vezes!", __METHOD__);
            }

            if (isset($where) && isset($limit)) {
                $query .= $where . $limit;
            }

            if (isset($where) && !isset($limit)) {
                $query .= $where;
            }

            if (!isset($where) && isset($limit)) {
                $query .= $limit;
            }

            $command = $this->connection->prepare($query);
            $command->execute();
            $result = $command->fetchAll();

            return !empty($result) ? $result : $this->auditoria("Nenhum resultado encontrado!", __METHOD__);
        } catch (Exception $error) {

            $this->auditoria($error->getMessage(), __METHOD__, false);
        }
    }

    public function findById(int $id)
    {
        try {
            $query = "SELECT * FROM authors WHERE id = ?";

            $command = $this->connection->prepare($query);
            $command->execute([$id]);
            $result = $command->fetch();

            return !empty($result) ? $result : $this->auditoria("Autor(a) não encontrado(a)!", __METHOD__);
        } catch (Exception $error) {

            $this->auditoria($error->getMessage(), __METHOD__, false);
        }
    }

    public function findPreview(int $limit = null)
    {
        try {
            $query =
                "SELECT first_name, last_name, image FROM authors ";

            if (isset($limit)) {
                $query .= "LIMIT $limit";
            }

            $command = $this->connection->prepare($query);
            $command->execute();
            $result = $command->fetchAll();

            shuffle($result);

            return !empty($result) ? $result : $this->auditoria("Nenhum resultado encontrado!", __METHOD__);
        } catch (Exception $error) {
            $this->auditoria($error->getMessage(), __METHOD__, false);
        }
    }

    public function delete(int $id)
    {
        try {
            $query = "DELETE FROM authors WHERE id = ?";

            $command = $this->connection->prepare($query);
            $command->execute([$id]);

            return $command->rowCount() > 0 ?: $this->auditoria("Autor(a) não encontrado(a)!", __METHOD__);
        } catch (Exception $error) {
            $this->auditoria($error->getMessage(), __METHOD__, false);
        }
    }

    public function auditoria(string $message, $method, bool $message_in_die = true)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $date_time = date('d/m/Y H:i:s');
        // $author = $_SESSION["id"];
        $view = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

        // $query = "INSERT INTO portal_auditoria_br ($author, $message, $method, $view, $date_time)";

        // $command = $this->connection->prepare($query);
        // $command->execute();

        $message_in_die ? die($message) : die("Erro!");
    }
}