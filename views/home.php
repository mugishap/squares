<?php

include './../utils/checkLoggedIn.php';

$getEntries = $operations->getEntries($user->username);

echo "<h1>Welcome, " . $user->firstname." " . $user->lastname."!</h1>";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <div class="table">
        <?php
        if(!$getEntries){
            ?>
            <div>You have no entries in your databaase</div>
            <?php
        }
        ?>
    </div>
</body>
</html>