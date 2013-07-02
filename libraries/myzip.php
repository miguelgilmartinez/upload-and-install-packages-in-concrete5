<?php

defined('C5_EXECUTE') or die("Access Denied.");
Loader::library('archive');

/**
 *  @author arequaldev@gmail.com
 */
class MyZIP extends Archive {

    public function install($noExtension, $inplace = false) {
        $this->targetDirectory = DIR_BASE . '/' . DIRNAME_PACKAGES . '/';

        $directory = $this->targetDirectory . $noExtension;

        //If directory exists then remove it
        if (is_dir($directory) !== false) {
            $this->rrcopy($directory, DIR_BASE . '/files/tmp/' . $noExtension . 'backup_' . date('Y-m-d_His'));
            $this->rrmdir($directory);
        }
        parent::install($noExtension, $inplace);
    }

    public function __construct() {
        parent::__construct();
    }

    //http://stackoverflow.com/questions/9835492/move-all-files-and-folders-in-a-folder-to-another
    function rrmdir($dir) {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    $this->rrmdir("$dir/$file");
                }
            }
            rmdir($dir);
        }
        else if (file_exists($dir))
            unlink($dir);
    }

    // Function to Copy folders and files
    // http://stackoverflow.com/questions/9835492/move-all-files-and-folders-in-a-folder-to-another
    function rrcopy($src, $dst) {
        if (file_exists($dst))
            $this->rrmdir($dst);
        if (is_dir($src)) {
            mkdir($dst);
            $files = scandir($src);
            foreach ($files as $file)
                if ($file != "." && $file != "..")
                    $this->rrcopy("$src/$file", "$dst/$file");
        } else if (file_exists($src))
            copy($src, $dst);
    }

}

?>
