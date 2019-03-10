function deploy_firewalls {
	if [ "$firewalls_deploy" == "true" ]; then
		/bin/bash ../files/iptables
		echo -e "${GREEN}Firewalls deployment finish."
	fi
}