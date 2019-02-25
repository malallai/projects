#!/bin/bash

if [ $(id -u) -ne 0 ]; then
	echo "You need to be root or sudo to use this script!"
	exit 0
fi;

printf "\nUpdate logs : $(date +%F_%T)\n\n" >> /var/log/update_script.log
apt-get upgrade -y >> /var/log/update_script.log
apt-get update -y >> /var/log/update_script.log
