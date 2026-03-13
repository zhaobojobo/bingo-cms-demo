<?php

/**@var string $message */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INTERNAL SERVER ERROR</title>
    <style>
        body {
            font-family: "Courier New", monospace, sans-serif;
            padding: 1rem;
            background: #0414a7;
            color: #fff;
        }

        ul {
            list-style: none;
            padding: 0;
        }
    </style>
</head>
<body>
<header>
    <h1>INTERNAL SERVER ERROR</h1>
</header>
<main>
    <p><?= $message ?></p>
</main>
<footer>
    <p><?= date('Y/m/d H:s:i.') . microtime(true); ?></p>
</footer>
</body>
</html>