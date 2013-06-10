Most issues are fixed by moving to newer images, and your beaglebone is likely out of date. So start with the latest eMMc flasher image.
First install the current image from beagleboard.org, put the image on an SD card and boot the beaglebone 
with the user button pressed.  Wait approx 45minutes for the eMMc to get programmed.

remove sdcard and boot, maybe kick it a couple of times here
ssh to beaglebone.local

Install support packages using opkg
You need to install lightppd, mysql5, and php to run the Anubis front end.  Lighttpd needs to have fast-cgi enabled for php.
This also requires disabling the built in beaglebone webserver (bonescript).

You need to install the appropriate USB packages inlcuding libusb-1.0-dev for Cgminer.  Cgminer 3.1.1 is stable working on BeagleBone Black. 
Grab a cgminer tarball from http://ck.kolivas.org/apps/cgminer/ and configure/build it to your tastes.

You can either do all this by hooking the bone up to a monitor/keyboard mouse, or ssh to the bone and do it that way.

