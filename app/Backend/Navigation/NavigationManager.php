<?php
namespace App\Backend\Navigation;
use Illuminate\Filesystem\Filesystem;

class NavigationManager {
    protected $navigation = [];
    protected $domainPath;
    protected $fileSystem;
    protected $navTheme;
    public function __construct($domainPath, Filesystem $filesystem, $navThemePath)
    {
        $this->domainPath = $domainPath;
        $this->fileSystem = $filesystem;
        $this->navTheme = $navThemePath;
    }
    public function initNavigation()
    {
        $directories = $this->fileSystem->directories($this->domainPath);
        foreach ($directories as $directory) {
            if($this->fileSystem->exists($directory. "/Navigation")){
                if($this->fileSystem->exists($directory. "/Navigation/nav.php")){
                    $this->navigation = array_merge($this->navigation,$this->fileSystem->getRequire($directory. "/Navigation/nav.php"));
                }
            }
        }
    }

    public function renderNav()
    {
        return view($this->navTheme, ['navigation' => $this->navigation]);
    }
}