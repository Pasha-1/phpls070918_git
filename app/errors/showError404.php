<?php
header('HTTP/1.1 404 Not Found');
header("Status: 404 Not Found");
?><!doctype html>
<html lang="en">
<head>
    <title>404 Not Found</title>
</head>
<body>
<center><h1>Sorry, Page is not found.</h1>
<?php if (APPLICATION_TYPE == 'log') {
    echo '<br>Произошла ошибка: <br>';
    echo 'Line:' . $e->getLine() . "<br>";
    echo 'File:' . $e->getFile() . "<br>";
    echo $e->getMessage() . "<br>";
    echo $e->getTraceAsString();
}
?>
</center>
</body>
</html>
<?php
exit();