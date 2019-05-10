<?php
    include 'connection.php';

    $id= $_POST['id'];

    //elimino riga
    $stmt = $connection->prepare("DELETE FROM todolist WHERE id=?"); 
    $stmt->bind_param("s",$id);

    $var = $stmt->execute();
    //ERRORE DI CONNESSIONE
    if(!$var) echo "Error: " . $stmt . "<br>" . $connection->error;

    $stmt->close();

    header("Location: index.php");
?>