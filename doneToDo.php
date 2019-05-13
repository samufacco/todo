<?php
    include 'connection.php';

    $id= $_POST['id'];

    //modifico riga
    $stmt = $connection->prepare("UPDATE todolist SET done='1' WHERE id=?");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->close();

    header("Location: index.php");
?>