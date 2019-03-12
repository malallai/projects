function deploy_firewalls {
	if [ "$firewalls_deploy" == "true" ]; then
		#/bin/bash ../files/iptables
		if ! [ "`ufw status | grep \"inactive\"`" == "" ]; then
			ufw enable
		fi
		ufw allow 2201/tcp
		ufw allow 80/tcp
		ufw allow 443
		echo -e "${GREEN}Firewalls deployment finish."
	fi
}
