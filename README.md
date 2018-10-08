## Moodle 
With the button below, you can easily deploy the Moodle to Azure.   
[![Deploy to Azure](http://azuredeploy.net/deploybutton.png)](https://azuredeploy.net/)

### Won't be maintained
* Lastest version is 3.5.2+.

### Links
* [What is Moodle?](README.txt)
* [Transitioning to HTTPS](https://docs.moodle.org/33/en/Transitioning_to_HTTPS#Setting_up_your_Moodle)

### Manage Moodle On Azure
1. FTP
    * Use any FTP tool you prefer to connect to the site (you can get the credentials on Azure portal);
    * Change directory to */home/site/wwwroot* and customize app file, e.g. *config.php*.
2. [KUDU](https://blogs.msdn.microsoft.com/benjaminperkins/2014/03/24/using-kudu-with-windows-azure-web-sites/)
    * Access your KUDU console with using your DEPLOYMENT credentials;
    * Change directory to */home/site/wwwroot* via command or GUI.
    * ```
        https://<your sitename>.scm.azurewebsites.net/DebugConsole
        cd /home/site/wwwroot
      ```

