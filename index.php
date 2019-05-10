<?php
    include 'connection.php';
?>

<html lang="en">
<head>
    <title>ASL</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>


        button {
            padding: 10px;
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
            <form id="add" action="addToDo.php" method="POST" class="rounded p-4">
                <div class="row">

                    <div class="col-5">
                        <label for="description">Description</label>
                        <input class="form-control" name="description" type="text" placeholder="...">
                    </div>

                    <div class="col-5">
                        <label for="date">Expiring date:</label>
                        <input class="form-control" name="date" type="text" placeholder="yyyy/mm/dd">
                    </div>

                    <div class="col-2 align-self-end">
                        <button type="submit" class="btn btn-outline-primary border border-0 ">
                                <i class="fa fa-plus-circle"></i> Add           
                        </button> 
                    </div>
                </div>
            </form>
            
        </div>
    
            
        <div class="col-12">

            <?php

            $stmt = $connection->prepare("SELECT * FROM todolist ORDER BY scadenza"); 

            $stmt->execute();

            $var = $stmt->get_result();


            //per ogni riga
            foreach($var as $riga):        
            ?>

                <div class="sticker">

                    <p style="width: 900px;"><?=$riga['descrizione'] ?></p>

                    <p class="font-italic scadenza">Exp. <?=$riga['scadenza'] ?></p>

                    <form action="editToDo.php" method="post" class="text-right align-self-end d-inline">
                        <input type="hidden" name="id" value="<?=$riga['id'] ?>">
                        <button style="margin-left: 870px;" type="button" onclick="document.getElementById('description').value = <?=$riga['descrizione'] ?>;"
                                class="btn btn-outline-warning border border-0 align-self-end">
                            <i class="fa fa-pencil"></i> Edit
                        </button>           
                    </form>

                    <form action="deleteToDo.php" method="post" class="text-right align-self-end d-inline">
                        <input type="hidden" name="id" value="<?=$riga['id'] ?>">
                        <button type="submit" class="btn btn-outline-danger border border-0 align-self-end"> 
                            <i class="fa fa-archive"></i> Delete
                        </button> 
                    </form>

                </div>

            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>