<?php
    include 'connection.php';

    $id= $_POST['id'];
    $nuovaDescrizione = strip_tags($_POST['description']);
    $nuovaData = strip_tags($_POST['date']);

    //modifico riga
    $stmt = $connection->prepare("UPDATE todolist SET descrizione=?,scadenza=? WHERE id=?");

    $stmt->bind_param("ssi", $nuovaDescrizione, $nuovaData, $id);

    $var = $stmt->execute();

    $stmt->close();
    
    header("Location: index.php");
?>