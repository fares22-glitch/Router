<?php


function authMiddleware(PDO $pdo): bool
{
    if (isset($_SESSION['user'])) {
        $statement = $pdo->prepare("SELECT count(*) FROM users WHERE id = :id LIMIT 1");
        $statement->bindParam(':id', $_SESSION['user'], PDO::PARAM_INT);
        $statement->execute();
        return $statement->rowCount() === 1;
    }

    return false;
}
