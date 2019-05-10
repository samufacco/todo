<?php
    include 'connection.php';

    $id= $_POST['id'];

    
    $stmt = $connection->prepare("SELECT * FROM todolist WHERE id=?");
    $stmt->bind_param("s",$id);
    $stmt->execute();

    $r = $stmt->get_result();
    //controllo se esiste 
    if($r->num_rows()!=0){

        //elimino riga
        $stmt = $connection->prepare("DELETE FROM todolist WHERE id=?"); 
        $stmt->bind_param("i",$id);
        $stmt->execute();
    }

    $stmt->close();

    header("Location: index.php");
?>