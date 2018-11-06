<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
        <title></title>
    </head>
    <body>
        <pre>
            <?php
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $pdo = new PDO("mysql:host=localhost;db=name", "root", "chkdsk", $options);
            var_dump($pdo);
            ?>

        </pre>
    </body>
</html>
