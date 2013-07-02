Upload and Install Packages in Concrete5
========================================
Install new packages in Concrete5 by just uploading your package (zip file) and pressing a button.
Forget uploading files by FTP, uncompressing them, setting permissions, etc...
That package allows you to make that stuff by just uploading your package (zip file) and pressing a button. 
It installs a link on the Dashboard. Log as Admin and click that link. Then click "select file", select your package,
and then press blue button. Now you can finish your installation by using Concrete5 "Add functionality" screen.


How to get from GitHub and make it works
========================================
Just download this package from Github to a folder named "uploadandinstallpackages" in your Concrete5/packages folder,
go to your "Add functionality" and install that new package. 
Once installed, you can install new packages by using this package's functionality from the Dashboard as Administrator.
Only Admin SuperUser can add new packages. Users in Group Administrators are warned that they are not allowed to 
install packages When package is uploaded and uncompressed, it takes you to the Add Functionality page.
When updating package, it copies old package folder to .../files/package_YYYYMMDD_hms folder.

Warning: If you have a package which uses a database (with a db.xml file inside), click on blue "upgrade" button 
as quick as you can in order to avoid incoherences between different versions. Or even better, run Concrete5 
in Maintenance mode and then upgrade packages. 

Handle: uploadandinstallpackages

Screencast: http://youtu.be/2GNUqBJCUPg
 
