function deploy_scripts {
	mkdir /root/scripts
	if [ "$scripts_crondiff_deploy" == "true" ]; then
		cp ../files/crondiff.sh /home/root/scripts/crondiff.sh
        	echo "0  0	* * *	root	/home/root/scripts/crondiff.sh" >> /etc/crontab
		echo -e "${GREEN}Crondiff Script deployed."
	fi
   	if [ "$scripts_update_deploy" == "true" ]; then
		cp ../files/update_script.sh /home/root/scripts/update.sh
        	echo "0 4	* * 1	root	/home/root/scripts/update.sh >> /var/log/update_script.log" >> /etc/crontab
        	echo "@reboot		root	/home/root/scripts/update.sh >> /var/log/update_script.log" >> /etc/crontab
		echo -e "${GREEN}Update Script deployed."
	fi
}
