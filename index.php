<?php
    include 'connection.php';

    if(isset($_GET['edit']) && $_GET['edit'] == 'on'){

        $id= $_POST['id'];

        //prelevo risultato
        $stmt = $connection->prepare("SELECT * FROM todolist WHERE id=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $ris = $stmt->get_result();

        //INSERISCO DATI SOPRA
        
        $stmt->close();
    }   
?>

<html lang="en">
<head>
    <title>ASL</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>

        * {
            font-family: 'Open Sans'; 
        }

        #add {
            background-color: rgb(220, 229, 230);
        }

        .scadenza {
            font-size: 14px;
            color: grey;
        }

        .sticker {

            margin: 10px 0px 10px 0px;
            padding: 15px;
            border-radius: 5px;
            background-color: rgb(242, 248, 249);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

    </style>

</head>
<body>

    <div class="container">

        <h1 class="text-center">Welcome to your TODO list</h1>

        <div class="col-12">
            <form id="add" action="update.php" method="post" class="rounded p-4">
                <div class="row">

                    <div class="col-5">
                        <label for="description">Description</label>
                        <input class="form-control" id="description" name="description" type="text" placeholder="...">
                    </div>

                    <div class="col-5">
                        <label for="date">Expiring date:</label>
                        <input class="form-control" id="date" name="date" type="text" placeholder="yyyy/mm/dd">
                    </div>

                    <?php

                        if(isset($_GET['edit']) && $_GET['edit'] == 'on'){

                            echo '<div class="col-2 align-self-end">
                                    <input type="hidden" name="id" value="'.$_GET['id'].'">
                                    <button type="submit" class="btn btn-outline-success border border-0 ">
                                            <i class="fa fa-check-square"></i> Edit           
                                    </button> 
                                  </div>';
                        }else{
                            
                            echo '<div class="col-2 align-self-end">
                                    <button type="submit" class="btn btn-outline-primary border border-0 ">
                                            <i class="fa fa-plus-circle"></i> Add           
                                    </button> 
                                  </div>';
                        }
                    ?>
                </div>
            </form> 
        </div>

        <div class="col-12">

            <?php

            if(isset($_GET['m']) && $_GET['m'] == 'error'){
                
                echo '<div class="alert alert-danger" role="alert">
                ERRORE! Inserimento non valido o non permesso.</div>'; 
            }

            $stmt = $connection->prepare("SELECT * FROM todolist WHERE done='0' ORDER BY scadenza");
            $stmt->execute();

            $var = $stmt->get_result();

            //per ogni riga di non fatti
            foreach($var as $riga){    
                echo ' <div class="sticker">
                        <p style="width: 900px;">'.$riga['descrizione'].'</p>
                        <p class="font-italic scadenza">Exp. '.$riga['scadenza'].'</p>

                        <form action="index.php?edit=on&id='.$riga['id'].'" method="post" class="text-right align-self-end d-inline">
                            <input type="hidden" name="id" value="'.$riga['id'].'">
                            <button style="margin-left: 870px;" type="submit" class="btn btn-outline-warning border border-0 align-self-end">
                                <i class="fa fa-pencil"></i> Edit
                            </button>           
                        </form>

                        <form action="doneToDo.php" method="post" class="text-right align-self-end d-inline">
                            <input type="hidden" name="id" value="'.$riga['id'].'">
                            <button type="submit" class="btn btn-outline-success border border-0 align-self-end"> 
                                <i class="fa fa-check-square"></i> Done
                            </button> 
                        </form>
                       </div>';
                
            }

            $stmt2 = $connection->prepare("SELECT * FROM todolist WHERE done='1' ORDER BY scadenza"); 

            $stmt2->execute();

            $var2 = $stmt2->get_result();

            foreach($var2 as $riga){
                echo ' <div class="sticker" style="background-color: rgb(120, 255, 120);">
                        <p style="width: 900px;">'.$riga['descrizione'].'</p>
                        <p class="font-italic scadenza">Exp. '.$riga['scadenza'].'</p>

                        <form action="deleteToDo.php" method="post" class="text-right align-self-end d-inline">
                            <input type="hidden" name="id" value="'.$riga['id'].'">
                            <button type="submit" onclick="if(confirm("Do you want to delete this?")) return true; return false;"
                                class="btn btn-outline-danger border border-0 align-self-end"> 
                                <i class="fa fa-archive"></i> Delete
                            </button> 
                        </form> 
                
                    </div>';
                
            }

            $stmt2->close();
            ?>
                  
        </div>    
        
    </div>

</body>
</html>