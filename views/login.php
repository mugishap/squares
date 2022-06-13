<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php
    include './../utils/connection.php';
    include './../controllers/operations.php';

    use Controllers\Operations;

    $operations = new Operations('users');
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username == '' || $password == '') {
    ?>
            <script>
                window.alert("Please fill in all fields!");
            </script>
    <?php
            return;
        }

        if ($operations->login($username, $password)) {
            echo "Login successful!";
        } else {
            echo "Login failed!";
        }
    }
    ?>
    <div>
        <h1>Login</h1>
        <form class="w-full" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="flex w-full p-1 box-border items-center justify-between"> <label for="username">Username:</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="flex w-full p-1 box-border items-center justify-between"> <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </div>
            <button type="submit" name="login">Login</button>
    </div>
</body>

</html>