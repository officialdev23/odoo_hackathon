<?php

function setFlash($type, $message)
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

function showFlash()
{
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];

        echo "

        <div class='alert alert-{$flash['type']} mt-3'>

            {$flash['message']}

        </div>

        ";

        unset($_SESSION['flash']);
    }
}
