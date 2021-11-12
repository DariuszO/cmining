Setup Instructions


All working files of the script itself are located in the application folder
Settings are made in the config folder

In the config.php file, you need to change the site address to your own in the $config['base_url']

In the database.php file, change the database data to your own

The settings.php file is the main script settings file. Each setting is commented. If something is not clear, then I will explain myself.


The main controller file is Dashboard.php. It contains all the methods for the work of the cabinet.

templates are located in the view folder. They are also divided into groups and languages.




In order for the TxId of the transaction to be shown in the stat after payment for users, it is necessary to put the file on crowns using the wget command

Example: wget http://site.ru/Callback/UpdateTxHash



Link to admin panel http://site.ru/Flatpanel
Admin data is stored in the main settings file



The script was fully tested on several projects with a large number of users (up to 50k users) and no problems were observed. Everything can work fully automatically, Replenishment and payments are all automatic.