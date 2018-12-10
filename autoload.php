<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 02/12/2018
 * Time: 16:31
 */

function load($classe){
    $paths = array(
        '',
        'classes/',
        'Model/',
        '../classes/',
        '../Model/',
    );
    foreach ($paths as $path) {
        $finalPath = $path.$classe.'.php';
        if (file_exists($finalPath)){
            require $finalPath;
            break;
        }
    }
}
spl_autoload_register('load');