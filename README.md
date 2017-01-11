# GMS
GSuite Management System

This product is functioning in BETA.  

I will continue working on the project, by adding more features over time.  I however will not be implementing features by request.  If you would like a feature added to the system, feel free to contract Richard at rhconsultingllc.com.  They have done a great job helping me with this project and understand it as well, if not better than, me.


If you would like to donate to the project I will use it to further development for items under the Project section of this page.
# Donation Button

[![](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SSHAPEDWFJ2MS)

GSuite Management System, for allowing District admins to better manage GAFE

# Service Account Setup

I am working on this.  Here are a few links if it helps and I will build documentation soon.
You will need a service account in the Google API for this program to work

https://developers.google.com/identity/sign-in/web/
https://console.developers.google.com/projectselector/apis

Once you build your service account you will need to download the .p12 file and upload that to GMS -- again more documentation coming on that

# Creating a Cron Job
This is only an example, but you will need to create a Cron Job to run the /CRON_JOBS/smart_sync.php file.  Again the following is only an example of how to do it on a linux machine

 $  crontab -l

----------------------------------------------------------------------------
 *     *     *   *    *        command to be executed
 -     -     -   -    -
 |     |     |   |    |
 |     |     |   |    +----- day of week (0 - 6) (Sunday=0)
 |     |     |   +------- month (1 - 12)
 |     |     +--------- day of        month (1 - 31)
 |     +----------- hour (0 - 23)
 +------------- min (0 - 59)
----------------------------------------------------------------------------

MAILTO="Youremail@domain.com"
GMS=/home/site/public_html/hosting/gms
LOGS=/home/site/public_html/hosting/gms_logs
SHELL=/bin/bash

-- run every 4 hours 
0 */4 * * * cd $GMS/CRON_JOBS; php smart_sync.php dev >> $LOGS/cron.log 2>&1
