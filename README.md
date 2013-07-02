upload-and-install-packages-in-concrete5
========================================
Install new packages in Concrete5 by just uploading your package (zip file) and pressing a button.
Forget uploading files by FTP, uncompressing them, setting permissions, etc...
That package allows you to make that stuff by just uploading your package (zip file) and pressing a button. 
It installs a link on the Dashboard. Log as Admin and click that link. Then click "select file", select your package, and then press blue button. It's done. 


How to get from GitHub and make it works
========================================
Just download this package from Github to a folder named "uploadandinstallpackages"  in your Concrete5/packages folder, go to your "Add functionality" and install that new package. 

 --> Handle <--
 uploadandinstallpackages

--> Screencast <--
http://youtu.be/2GNUqBJCUPg
 
 
 


That package needs to be installed like any other regular Concrete5's package.  Once installed, you can install new packages by using its functionality from the Dashboard as Administrator

--> Roadmap <--

Version 0.9.1:  
Added $user->isSuperUser(). Only Admin SuperUser can add new packages. Users in Group Administrators are warned that they are not allowed to install packages
Removed void php file which raised an error in Marketplace

Version 0.9.2:
When package is uploaded and uncompressed, it takes you to the Add Functionality page.
When updating package, it copies old package folder to .../files/package_YYYYMMDD_hms folder.