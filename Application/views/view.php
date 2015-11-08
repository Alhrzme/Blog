<?php

namespace application\views;

class View
{
    public $template = 'template.php';

    function generate($content_view, $data = null)
    {
        $path = 'application/views/'.$this->template;
        require_once $path;
    }
}