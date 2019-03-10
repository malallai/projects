function config_fail2ban {
	cp ${RSFOLDER}/files/jail.local /etc/fail2ban/jail.local
	cp ${RSFOLDER}/files/http-get-dos.conf /etc/fail2ban/filter.d/http-get-dos.conf
	service fail2ban restart
}

function deploy_dos {
	if [ "$dos_deploy" == "true" ]; then
		config_fail2ban
		echo -e "${GREEN}DOS deployment finish."
	fi
}
