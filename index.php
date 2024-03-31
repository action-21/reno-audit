<?php

require_once('./vendor/autoload.php');

ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

use Renolab\Dpe\DpeService;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Extra\Intl\IntlExtension;

$entity = (new DpeService)->get('foo');
$start = new \DateTime();
$data = $entity->normalize();
$duration = $start->diff(new \DateTime());

$loader = new FilesystemLoader('./templates');
$twig = new Environment($loader, []);
$twig->addExtension(new IntlExtension());
$template = $twig->load('index.html.twig');

echo $template->render(['entity' => $entity, 'data' => $data, 'duration' => $duration]);
