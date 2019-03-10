#!/bin/bash

if [ $(id -u) -ne 0 ]; then
	echo "You need to be root or sudo to use this script!"
	exit 0
fi;

if [ -f /root/crondiff ]; then
	if [ -n "$(diff /etc/crontab /root/crondiff)" ]; then
		echo "Crontab has been edited. Please check new modifications." | mail -s "Crontab edited" root
	fi;
fi;

cp /etc/crontab /root/crondiff
