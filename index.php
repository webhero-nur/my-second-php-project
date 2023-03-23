<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
</head>

<body>
    <form action="api/controller/user_controller.php">
        <p>Full Name: <input type="text" name="full_name" id="full-name"></p>
        <p>Username: <input type="text" name="username" id="user-name"></p>
        <p>Password: <input type="password" name="password" id="password"></p>
        <p>Operation: <input type="text" name="op" id="operation" placeholder="insert"></p>
        <input type="submit" value="Go">
    </form>
</body>

</html>