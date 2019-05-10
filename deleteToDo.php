<?php
    include 'connection.php';

    $id= $_POST['id'];

    
    $stmt = $connection->prepare("SELECT * FROM todolist WHERE id=?");
    $stmt->bind_param("s",$id);
    $stmt->execute();

    //controllo se esiste 
    if($stmt->get_result()){

        //elimino riga
        $stmt = $connection->prepare("DELETE FROM todolist WHERE id=?"); 
        $stmt->bind_param("s",$id);
        $stmt->execute();
    }

    $stmt->close();

    header("Location: index.php");
?>