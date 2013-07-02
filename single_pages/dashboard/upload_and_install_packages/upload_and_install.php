<?php
/**
 *  @author arequaldev@gmail.com
 */
defined('C5_EXECUTE') or die(_("Access Denied."));

echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Uploading and Installing packages'), t('Just select a Concrete5 package (zip file) and click "Upload and install" button.<br/>Your package will be installed and ready'), null, false);
if ($isSuperUser === true) {

    $form = Loader::helper('form');
    ?>
    <form enctype="multipart/form-data" method="post" name="fileupload">
        <div class="ccm-pane-body">
            <p><?php echo $status ?></p>
            <?php
            echo $form->hidden('method', 'fileupload');
            echo $form->file('package');
            ?>
        </div>
        <div class="ccm-pane-footer">
            <a href="<?php echo $this->url('/dashboard') ?>" class="btn"><?php echo t('Cancel') ?></a>
            <button type="submit" value="<?php echo t('Upload and install this package') ?>" class="btn primary ccm-button-right"><?php echo t('Upload and install this package') ?> <i class="icon-share icon-white"></i></button>
        </div>
    </form>
    <?php
}
else {
    ?> <div class="ccm-pane-body">
        <div class="alert alert-error"><?php echo t('You are not allowed to do that'); ?></div>
    </div>
    <div class="ccm-pane-footer">
        <a href="<?php echo $this->url('/dashboard') ?>" class="btn btn-danger"><?php echo t('Get me outta here!!!') ?></a>
    </div>
    <?php
}

echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper();
?>