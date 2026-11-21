<?php

namespace App\Providers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
    static public function render(string $template, $data = [])
    {
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        $twig->addGlobal('asset', ASSET);
        $twig->addGlobal('base', BASE);
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('guest', !isset($_SESSION['fingerPrint']));

        echo $twig->render($template . ".php", $data);
    }

    static public function redirect(string $url)
    {
        header('location:' . BASE . '/' . $url);
        exit;
    }
}
