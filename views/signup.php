<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup to squares</title>
</head>

<body>
    <?php
    include './../utils/connection.php';
    include './../controllers/operations.php';

    use Controllers\Operations;

    $operations = new Operations('users');
    if (isset($_POST['signup'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $company = $_POST['company'];

        if ($username == '' || $password == '' || $email == '' || $firstname == '' || $lastname == '' || $company == '' || $password != $_POST['cpassword']) {
    ?>
            <script>
                window.alert("Please fill in all fields!");
            </script>
        <?php
            return;
        }
        $check = $operations->checkIfNoOtherUsername($username);
        $check2 = $operations->checkIfNoOtherEmail($email);
        $check3 = $operations->checkIfNoOtherCompany($company);
        if (!$check || !$check2 || !$check3) {
        ?>
            <script>
                window.alert("Username or email or company already exists!");
            </script>
    <?php
            return;
        }

        $insert = $operations->createAccount($username, $password, $email, $firstname, $lastname, $company);

        if (!$insert) {
            echo "Error creating account!";
            return;
        }
    }
    ?>
    <div class="rounded">
        <h1>Signup to squares</h1>
        <form class="w-full" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="flex w-full p-1 box-border items-center justify-between"> <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" id="firstname">
            </div>
            <div class="flex w-full p-1 box-border items-center justify-between"> <label for="firstname">Lastname:</label>
                <input type="text" name="lastname" id="lastname">
            </div>
            <div class="flex w-full p-1 box-border items-center justify-between"> <label for="username">Username:</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="flex w-full p-1 box-border items-center justify-between"> <label for="email">Email:</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="flex w-full p-1 box-border items-center justify-between"> <label for="email">Company:</label>
                <input type="text" name="company" id="company">
            </div>
            <div class="flex w-full p-1 box-border items-center justify-between"> <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="flex w-full p-1 box-border items-center justify-between"> <label for="password">Confirm Password:</label>
                <input type="password" name="cpassword" id="password">
            </div>
            <button type="submit" name="signup">Signup</button>
    </div>
</body>

</html>