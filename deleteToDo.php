<?php
    include 'connection.php';

    $id= $_POST['id'];

    //elimino riga
    $stmt = $connection->prepare("DELETE FROM todolist WHERE id=?"); 
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $stmt->close();

    header("Location: index.php");
?>