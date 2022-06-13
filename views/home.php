<?php

include './../utils/checkLoggedIn.php';

$entries = $operations->getEntries($user->username);
$last = 0;

echo "<h1>Welcome, " . $user->firstname . " " . $user->lastname . "!</h1>";

if (isset($_POST['newentry'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $operations->createEntry($user->username, $title,  $amount, $price, $description);
    if (!$entries) {
        echo "Error creating entry!";
    }
}

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
        <table>
            <thead>
                <th>No</th>
                <th>Date</th>
                <th>title</th>
                <th>Amount</th>
                <th>Price</th>
                <th>Description</th>
                <th>Edit</th>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($entries); $i++) {
                    echo "<tr>";
                    echo "<td>" . $entries[$i]['count'] . "</td>";
                    echo "<td>" . $entries[$i]['date'] . "</td>";
                    echo "<td>" . $entries[$i]['title'] . "</td>";
                    echo "<td>" . $entries[$i]['amount'] . "</td>";
                    echo "<td>" . $entries[$i]['price'] . "</td>";
                    echo "<td>" . $entries[$i]['description'] . "</td>";
                    echo "<td><a href='edit.php?id=" . $entries[$i]['entry_id'] . "'>Edit</a></td>";
                ?>
                <?php
                    echo "</tr>";
                    $last = $entries[$i]['count'];
                }
                ?>
                <form action="#" method="POST" onsubmit="(e)=>{e.preventDefault()}">
                    <tr class="w-full h-full">
                        <td><input type="text" name="number" id="" placeholder="No" readonly class="" value="<?=$last + 1?>"></td>
                        <td><input type="text" name="date" id="" placeholder="Date" value="<?= time() ?>" readonly class=""></td>
                        <td><input type="text" name="title" required id="" placeholder="Title.." class=""></td>
                        <td><input type="text" name="amount" required id="" placeholder="Amount...." class=""></td>
                        <td><input type="text" name="price" required id="" placeholder="Price..." class=""></td>
                        <td><input type="text" name="description" required id="" placeholder="Description..." class=""></td>
                        <td><button type="submit" name="newentry">Create new entry</button></td>
                    </tr>
                </form>
            </tbody>
        </table>
        <?php
        if (!$entries) {
        ?>
            <div>You have no entries in your databaase</div>
        <?php
        }
        ?>
    </div>
</body>

</html>