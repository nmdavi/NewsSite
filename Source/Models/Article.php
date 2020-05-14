<?php

require_once "Connection.php";
require_once "Author.php";

class Article
{
    private $connection;


    function __construct()
    {
        $this->author = new Author();
        $this->connection = new Connection();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create(string $title, $image, string $text)
    {
        try {
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('d/m/Y H:i:s');

            $id = $_SESSION["id"];

            $query = "INSERT INTO articles VALUES (null, ?, ?, ?, ?, ?)";

            $command = $this->connection->prepare($query);
            $command->execute([$title, $id, $date, $image, $text]);

            return $command->rowCount() > 0 ?: $this->auditing("Erro, não foi possível criar o artigo!", __METHOD__);
        } catch (Exception $error) {
            $this->auditing($error->getMessage(), __METHOD__, false);
        }
    }

    public function findAll(string $where = null, int $limit = null)
    {
        try {
            $query = "SELECT ar.id, title, fk_author, DATE_FORMAT(date, '%d/%m/%Y %H:%i' ) as date, fk_category, fk_subcategory, fk_subsubcategory, image, au.name, au.au_img FROM articles ar 
            INNER JOIN (SELECT id, CONCAT(first_name, ' ', last_name) AS name, image AS au_img FROM authors) au 
            ON au.id = ar.fk_author ";

            if (strpos($where, "limit") && isset($limit)) {
                $this->auditing("Erro, limite definido duas vezes!", __METHOD__);
            }

            if (isset($where)) {
                $query .= "WHERE $where ";
            }

            $query .= "ORDER BY RAND() ";

            if (isset($limit)) {
                $query .= "LIMIT " . $limit;
            }

            $command = $this->connection->prepare($query);
            $command->execute();
            if ($command->rowCount() > 0) {
                $result = $command->fetchAll();
            }

            return !empty($result) ? $result : $this->auditing("Nenhum resultado encontrado!", __METHOD__);
        } catch (Exception $error) {

            $this->auditing($error->getMessage(), __METHOD__, true);
        }
    }

    public function findById(int $id)
    {
        try {
            $query = "SELECT * FROM articles WHERE id = ?";

            $command = $this->connection->prepare($query);
            $command->execute([$id]);
            if ($command->rowCount() > 0) {
                $result = $command->fetch();
            }

            $date = DateTime::createFromFormat("Y-m-d H:i:s", $result["date"]);
            $result["date"] = $date->format("d/m/Y");


            return !empty($result) ? $result : $this->auditing("Artigo não encontrado!", __METHOD__);
        } catch (Exception $error) {

            $this->auditing($error->getMessage(), __METHOD__, false);
        }
    }

    public function findPreview(int $limit = null)
    {
        try {
            $query =
                "SELECT DISTINCT ar.id, title, fk_author, image, DATE_FORMAT(date, '%d/%m/%Y') AS date, text, au.name, au.au_img FROM articles ar 
                INNER JOIN (SELECT id, CONCAT(first_name, ' ', last_name) AS name, image AS au_img FROM authors) au 
                ON au.id = ar.fk_author ORDER BY RAND() ";

            if (isset($limit)) {
                $query .= "LIMIT $limit";
            }

            $command = $this->connection->prepare($query);
            $command->execute();
            if ($command->rowCount() > 0) {
                $result = $command->fetchAll();
            }

            return !empty($result) ? $result : $this->auditing("Nenhum resultado encontrado!", __METHOD__);
        } catch (Exception $error) {
            $this->auditing($error->getMessage(), __METHOD__, false);
        }
    }

    public function findPreviewResume(int $limit = null)
    {
        try {
            $query =
                "SELECT DISTINCT ar.id, title, fk_author, image, DATE_FORMAT(date, '%d/%m/%Y') AS date, text, au.name, au.au_img FROM articles ar 
                INNER JOIN (SELECT id, CONCAT(first_name, ' ', last_name) AS name, image AS au_img FROM authors) au 
                ON au.id = ar.fk_author ORDER BY date ASC ";

            if (isset($limit)) {
                $query .= "LIMIT $limit";
            }

            $command = $this->connection->prepare($query);
            $command->execute();
            if ($command->rowCount() > 0) {
                $result = $command->fetchAll();
            }

            foreach ($result as $key => $value) {
                $result[$key]["text"] = strip_tags(substr($value["text"], 0, 180));
            }

            return !empty($result) ? $result : $this->auditing("Nenhum resultado encontrado!", __METHOD__);
        } catch (Exception $error) {
            $this->auditing($error->getMessage(), __METHOD__);
        }
    }

    public function findNameCategory(int $idCategory = null, int $idSubcategory = null, int $idSubsubcategory = null)
    {
        try {
            $query = "SELECT name FROM ";

            if (isset($idCategory)) {
                $query .= "categories WHERE id = $idCategory";
            } else if (isset($idSubcategory)) {
                $query .= "subcategories WHERE id = $idSubcategory";
            } else if (isset($idSubsubcategory)) {
                $query .= "subsubcategories WHERE id = $idSubsubcategory";
            }

            $command = $this->connection->prepare($query);
            $command->execute();
            if ($command->rowCount() > 0) {
                $name = ($command->fetch())["name"];
            }

            return !empty($name) ? $name : $this->auditing("Nenhum resultado encontrado!", __METHOD__);
        } catch (Exception $error) {
            $this->auditing($error->getMessage(), __METHOD__);
        }
    }

    public function delete(int $id)
    {
        try {
            $query = "DELETE FROM articles WHERE id = ?";

            $command = $this->connection->prepare($query);
            $command->execute([$id]);

            return $command->rowCount() > 0 ?: $this->auditing("Artigo não encontrado!", __METHOD__);
        } catch (Exception $error) {
            $this->auditing($error->getMessage(), __METHOD__, false);
        }
    }

    public function pagination(int $numPage, int $idCategory = null, int $idSubcategory = null, int $idSubsubcategory = null, bool $lastNotice)
    {
        try {
            $amount = 15;

            $begin = $numPage == 1 || $numPage == 0 ? 0 :  $numPage * $amount;

            if ($lastNotice) {
                $query = "SELECT DISTINCT ar.id, title, fk_author, image, DATE_FORMAT(date, '%d/%m/%Y') AS date, text, au.name, au.au_img FROM articles ar 
                INNER JOIN (SELECT id, CONCAT(first_name, ' ', last_name) AS name, image AS au_img FROM authors) au 
                ON au.id = ar.fk_author ORDER BY date ASC LIMIT $begin, $amount";
            } else {
                $query = "SELECT DISTINCT ar.id, title, fk_author, image, DATE_FORMAT(date, '%d/%m/%Y') AS date, text, au.name, au.au_img FROM articles ar 
                INNER JOIN (SELECT id, CONCAT(first_name, ' ', last_name) AS name, image AS au_img FROM authors) au 
                ON au.id = ar.fk_author WHERE ";

                if (isset($idCategory)) {
                    $query .= "fk_category = $idCategory ";
                } else if (isset($idSubcategory)) {
                    $query .= "fk_subcategory = $idSubcategory ";
                } else if (isset($idSubsubcategory)) {
                    $query .= "fk_subsubcategory = $idSubsubcategory ";
                }

                $query .= "ORDER BY date ASC LIMIT $begin, $amount";
            }

            $command = $this->connection->prepare($query);
            $command->execute();
            if ($command->rowCount() > 0) {
                $result = $command->fetchAll();

                foreach ($result as $key => $value) {
                    $result[$key]["text"] = strip_tags(substr($value["text"], 0, 180));
                }
            }

            return !empty($result) ? $result : $this->auditing("Artigo não encontrado!", __METHOD__, true);
        } catch (Exception $error) {
            $this->auditing($error->getMessage(), __METHOD__, true);
        }
    }

    public function paginationCss(int $numPage, int $idCategory = null, int $idSubcategory = null, int $idSubsubcategory = null, bool $lastNotice)
    {
        try {
            $amount = 15;

            if ($lastNotice) {
                $query = "SELECT COUNT(id) as num FROM articles";
            } else {
                $query = "SELECT COUNT(id) as num FROM articles WHERE ";

                if (isset($idCategory)) {
                    $query .= "fk_category = $idCategory ";
                } else if (isset($idSubcategory)) {
                    $query .= "fk_subcategory = $idSubcategory ";
                } else if (isset($idSubsubcategory)) {
                    $query .= "fk_subsubcategory = $idSubsubcategory ";
                }
            }

            $command = $this->connection->prepare($query);
            $command->execute();
            if ($command->rowCount() > 0) {
                $num = ($command->fetch())["num"];
            }
            $rowCount = floor($num / $amount);

            echo "<section class='pagination'><ul class='pagenum-list'>";

            if ($numPage !== 1) {
                $n = $numPage - 1;
                echo "<a href='Pages.php?category=$idCategory&num=$n'><li class='pagenum-item pagenum-previous'>&#10094;</li></a>";
            }

            $offset = 0;
            for ($i = ($numPage - 1); $i <= $rowCount; $i++) {

                if ($offset == 4) {
                    break;
                }

                if ($i == 0) {
                    $i++;
                } else if ($i == -1) {
                    $i += 2;
                }

                echo "<a href='Pages.php?category=$idCategory&num=$i'> <li class='pagenum-item'>$i</li></a>";

                $offset++;
            }

            if ($numPage != $rowCount && $rowCount != 0) {
                $n = $numPage + 1;
                echo "<a href='Pages.php?category=$idCategory&num=$n'><li class='pagenum-item pagenum-next'>&#10095;</li></a>";
            }

            echo "</ul></section>";
        } catch (Exception $error) {
            $this->auditing($error->getMessage(), __METHOD__, false);
        }
    }

    public function auditing(string $message, $method, bool $message_in_die = true)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $date_time = date('d/m/Y H:i:s');
        // $author = $_SESSION["author_id"];
        $view = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

        // $query = "INSERT INTO portal_auditing_br ($author, $message, $method, $view, $date_time)";

        // $command = $this->connection->prepare($query);
        // $command->execute();

        $message_in_die ? die($message) : die("Erro!");
    }
}