<?php
    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!-- Reference
https://www.w3docs.com/snippets/php/how-can-i-sanitize-user-input-with-php.html -->