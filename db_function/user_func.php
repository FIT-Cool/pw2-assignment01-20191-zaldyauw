<?php
function login($username, $password) {
    $link = createMySQLConnection();
    $query = "SELECT id, username, name, role_id FROM user WHERE username = ? AND password = ? LIMIT 1";
    $statement = $link->prepare($query);
    $statement->bindParam(1, $username, PDO::PARAM_STR);
    $statement->bindParam(2, $password, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch();
    $link = null;
    return $result;
}
function getAllUser() {
    $link = createMySQLConnection();
    $query = 'SELECT *,  u.name AS uname, u.id AS uid, r.id AS rid, r.name AS rname FROM user u  JOIN role r ON r.id = u.role_id;';
    $result = $link->query($query);
    $link = null;
    return $result;
}
function getAllRole() {
    $link = createMySQLConnection();
    $query = 'SELECT * FROM role;';
    $result = $link->query($query);
    $link = null;
    return $result;
}
function addUser($username, $password, $name, $role) {
    $link = createMySQLConnection();
    $link->beginTransaction();
    $query = 'INSERT INTO user(username, password, name, role_id) VALUES(?, ?, ?, ?)';
    $statement = $link->prepare($query);
    $statement->bindParam(1, $username, PDO::PARAM_STR);
    $statement->bindParam(2, $password, PDO::PARAM_STR);
    $statement->bindParam(3, $name, PDO::PARAM_STR);
    $statement->bindParam(4, $role, PDO::PARAM_INT);
    if ($statement->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
}
function deleteUser($id) {
    $link = createMySQLConnection();
    $link->beginTransaction();
    $query = 'DELETE FROM user WHERE id = ?';
    $statement = $link->prepare($query);
    $statement->bindParam(1, $id, PDO::PARAM_INT);
    if ($statement->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
}
function updateUser($id, $username, $password, $name, $role) {
    $link = createMySQLConnection();
    $link->beginTransaction();
    $query = 'UPDATE user SET username = ?, password = ?, name = ?, role_id = ? WHERE id = ?';
    $statement = $link->prepare($query);
    $statement->bindParam(1, $username, PDO::PARAM_STR);
    $statement->bindParam(2, $password, PDO::PARAM_STR);
    $statement->bindParam(3, $name, PDO::PARAM_STR);
    $statement->bindParam(4, $role, PDO::PARAM_INT);
    $statement->bindParam(5, $id, PDO::PARAM_INT);
    if ($statement->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
}
function getUser($id) {
    $link = createMySQLConnection();
    $query = 'SELECT *, u.name AS uname FROM user u JOIN role r ON r.id = u.role_id WHERE u.id = ?;';
    $statement = $link->prepare($query);
    $statement->bindParam(1, $id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch();
    $link = null;
    return $result;
}