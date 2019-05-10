<?php
    include 'connection.php';

    $id= $_POST['id'];
    $nuovaDescrizione = $_POST['description'];

    //elimino riga
    $comando="UPDATE todolist SET descrizione='$nuovaDescrizione' WHERE id='$id'";

    $var = $connection->query($comando);
    //ERRORE DI CONNESSIONE
    if (!$var) echo "Error: " . $comando . "<br>" . $connection->error;

    $connection->close();
    
    header("Location: index.php");
?>