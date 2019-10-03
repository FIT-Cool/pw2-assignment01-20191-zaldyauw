<?php

function getAllInsurance()
{
    $link = new PDO("mysql:host=localhost;dbname=pwl20191", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM insurance ORDER BY id";
    $result = $link->query($query);
    $link = null;
    return $result;
}

function addInsurance($name)
{
    $link = new PDO("mysql:host=localhost;dbname=pwl20191", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "INSERT INTO insurance(name_class) VALUES (?)";
    $link->prepare($query);
    $statement = $link->prepare($query);
    $statement->bindParam(1, $name, PDO::PARAM_STR);
    $link->beginTransaction();
    if ($statement->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
}

function deleteInsurance($id){
    $link = new PDO("mysql:host=localhost;dbname=pwl20191", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "DELETE FROM insurance WHERE id = ?";
    $link->prepare($query);
    $statement = $link->prepare($query);
    $statement->bindParam(1, $id, PDO::PARAM_INT);
    $link->beginTransaction();
    if ($statement->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
}

function updateInsurance($id, $name){
    $link = new PDO("mysql:host=localhost;dbname=pwl20191", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "UPDATE insurance SET name_class = ? WHERE id = ?";
    $link->prepare($query);
    $statement = $link->prepare($query);
    $statement->bindParam(1, $name,
        PDO::PARAM_STR);
    $statement->bindParam(2, $id, PDO::PARAM_INT);
    $link->beginTransaction();
    if ($statement->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
}

function getInsurance($id){
    $link = new PDO("mysql:host=localhost;dbname=pwl20191", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM insurance WHERE id = ? LIMIT 1";
    $statement = $link -> prepare($query);
    $statement->bindParam(1, $id, PDO::PARAM_INT);
    $statement -> execute();
    $result = $statement -> fetch();
    $link = null;
    return $result;
}
?>