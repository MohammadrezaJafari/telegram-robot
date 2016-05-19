<?php

namespace Module\UI;


class Asset {
    protected  $css = [];
    protected $js = [];
    public function add()
    {

    }

    public function css($path)
    {
        $this->css[] =  config('ui.basePath') . $path;
    }

    public function js($path)
    {
        $this->js[] =  config('ui.basePath') . $path;
    }

    public function styles()
    {
        foreach ($this->css as $css) {
            echo "<link href='$css' rel='stylesheet' type='text/css'>" . "\r\n";
        }

    }

    public function scripts()
    {
        foreach ($this->js as $js) {
            print "<script type='text/javascript' src='$js'></script>" . "\r\n";
        }

    }
}