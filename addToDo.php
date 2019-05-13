<?php
    include 'connection.php';

    if(isset($_POST['description']) && isset($_POST['date'])){

        $description = strip_tags($_POST['description']);
        $date = strip_tags( $_POST['date']);

        //inserimento nuova riga
        $stmt = $connection->prepare("INSERT INTO todolist (descrizione, scadenza) VALUES (?,?)"); 
        $stmt->bind_param("ss",$description,$date);

        $stmt->execute();
        
        $stmt ->close();
    }
    header("Location: index.php");
?>