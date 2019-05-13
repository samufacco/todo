<?php
    include 'connection.php';

    $id= $_POST['id'];
    $nuovaDescrizione = $_POST['description'];
    $nuovaData = $_POST['date'];

    //modifico riga
    $stmt = $connection->prepare("UPDATE todolist SET descrizione=?,scadenza=? WHERE id=?");

    $stmt->bind_param("ssi", $nuovaDescrizione, $nuovaData, $id);

    $var = $stmt->execute();

    $stmt->close();
    
    header("Location: index.php");
?>