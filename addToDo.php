<?php
    include 'connection.php';

    if(isset($_POST['description']) && isset($_POST['date'])){

        //aggiunta codice
        $description = $_POST['description'];
        $date = $_POST['date'];
        
        //inserimento nuova riga
        $stmt = $connection->prepare("INSERT INTO todolist (descrizione, scadenza) VALUES (?,?)"); 
        $stmt->bind_param("ss",$description,$date);

        $stmt->execute();
        
        $var = $stmt->get_result();
       
        $stmt->close();
        
    }
    header("Location: index.php");
?>