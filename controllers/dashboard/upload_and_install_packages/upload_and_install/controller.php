<?php

defined('C5_EXECUTE') or die(_("Access Denied."));

/**
 *  @author arequaldev@gmail.com
 */
class DashboardUploadAndInstallPackagesUploadAndInstallController extends Controller {

    function on_start() {
        $user = new User();
        $isSuperUser = $user->isSuperUser();
        $this->set('isSuperUser', $isSuperUser);

        if ($this->post('method') === 'fileupload' && $_FILES['package']['error'] === 0) {
            if ($isSuperUser) { //Only Admin can install packages it. If an user forces Concrete5 by modifying the view and sending a file, this code will reject that operation
                if ($this->checkFileIsOk()) {
                    $this->action_fileupload();
                }
            }
            else {
                Log::addEntry(t('ALERT: User %1$s [User Id: %2$s] tried to install a new package %3$s', $user->getUserName(), $user->getUserID(), $_FILES['package']['name']));
                $this->redirect('/login/logout');
            }
        }
        else {
            $this->set('status', '<div class = "alert alert-info">' . t('Select a Concrete5 package (zip file)') . '</div>

');
        }
    }

    private function checkFileIsOk() {
        if ($_FILES['package']['size'] <= 0) {
            $this->set('status ', '<span class = "alert alert-error">' . t('ERROR. Empty file"') . '</span>');
            return false;
        }
        if ($_FILES['package']['type'] != 'application/zip' && $_FILES['package']['type'] != 'application/x-zip-compressed') {
            $this->set('status', '<div class=  "alert alert-error">' . t('ERROR. File MUST BE a valid ZIP file') . '</div>');
            return false;
        }
        return true;
    }

    private function action_fileupload() {
        if (file_exists($_FILES['package']['tmp_name'])) {

            // If the package dir already exists, then it is an update
	        $pkg =basename($_FILES['package']['name'], '.zip');
	        if (file_exists(DIR_PACKAGES.'/'.$pkg)){
	        	$update = true;
	        }

			// Remove any old temporary file for the zip
        	if (file_exists(DIR_BASE . '/files/tmp/' . $_FILES['package']['name'])){
            	unlink(DIR_BASE . '/files/tmp/' . $_FILES['package']['name']);
            }

            // Move the new zip into the c5 temp area
            rename($_FILES['package']['tmp_name'], DIR_BASE . '/files/tmp/' . $_FILES['package']['name']);

            // Install
            Loader::library('myzip', $this->getCollectionObject()->getPackageHandle());
            $archive = new MyZIP();
          	$archive->install(str_replace('.zip', '', $_FILES['package']['name']), true);

            //TO DO Apply right permissions if needed rwx------

            // go to update or install pages, whichever is most relevant
            if ($update){
            	$this->redirect('/dashboard/extend/update/');
            } else {
            	$this->redirect('/dashboard/extend/');
            }
        }
        else {
            $this->set('status', '<div class = "alert alert-error">' . t('ERROR. File not uploaded') . '</div>');
        }
    }

}

?>
