<?php

defined('C5_EXECUTE') or die(_("Access Denied."));

/**
 *  @author arequaldev@gmail.com
 */
class UploadandinstallpackagesPackage extends Package {

    protected $pkgHandle = 'uploadandinstallpackages';
    protected $appVersionRequired = '5.6.1';
    protected $pkgVersion = '0.9.4';

    public function getPackageDescription() {
        return t('Uploads and installs packages by Administrator. Forget uploading packages by FTP, uncompressing them, etc');
    }

    public function getPackageName() {
        return t('Upload and Install Packages');
    }

    private $newSinglePages = array(
        array(
            'path' => 'dashboard/upload_and_install_packages',
            'title' => 'Upload and install packages',
            'icon_dashboard' => 'icon-share'
        ), array(
            'path' => 'dashboard/upload_and_install_packages/upload_and_install',
            'title' => 'Upload and install packages',
            'icon_dashboard' => 'icon-share'
        )
    );

    public function install() {
        $pkg = parent::install();
        $this->updateComponents($pkg);
    }

    public function upgrade() {
        parent::upgrade();
        $pkg = Package::getByHandle($this->pkgHandle);
        $this->updateComponents($pkg);
    }

    private function addNewSinglePages($package) {
        Loader::model('single_page');
        foreach ($this->newSinglePages as $newSinglePageName) {
            $newSinglePage = SinglePage::getByPath('/' . $newSinglePageName['path']);
            if ($newSinglePage->error) {
                $newSinglePage = SinglePage::add($newSinglePageName['path'], $package);
                $newSinglePage->addAttribute('icon_dashboard', $newSinglePageName['icon_dashboard']);
                $newSinglePage->update(array('akName' => t($newSinglePageName['title'])));
            }
        }
    }

    private function updateComponents($package) {
        $this->addNewSinglePages($package);
    }

}
