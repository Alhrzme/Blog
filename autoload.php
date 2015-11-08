<?php

function autoload($className)
{
    $className = ltrim($className, '\\'); // удаляет \ из начала строки
    $fileName  = dirname(__FILE__) . '/' . DIRECTORY_SEPARATOR;
    if ($lastNsPos = strrpos($className, '\\')) { // (возвращает позицию первого вхождения подстроки)
        $namespace = substr($className, 0, $lastNsPos); //Задает namespace. (Возвращает подстроку строки $classname, начинающейся с 0 символа по счету и длиной $lastNsPos символов.
        $className = substr($className, $lastNsPos + 1); //Задает имя класса
        $fileName  .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    if (file_exists($fileName)) {
        require $fileName;
    }
}
spl_autoload_register('autoload');