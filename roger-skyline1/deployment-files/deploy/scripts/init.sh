function update_apt {
	apt-get update
	apt-get upgrade
}

function install_default {
	apt-get install -y sudo
	apt-get install -y net-tools
	apt-get install -y dnsutils
	apt-get install -y mailutils
	apt-get install -y fail2ban
}

function install_web {
	apt-get install -y apache2
	#apt-get install -y mysql-server
	#apt-get install -y mysql-client
}

function custom_repo {
	if [ "$packages_usecustom" == "true" ]; then
		OLD_IFS=$IFS
		IFS='|' read -ra ADDR <<< "$packages_customrepo"
		for i in "${ADDR[@]}"; do
			echo $i >> /etc/apt/sources.list
		done
		update_apt
		read -ra ADDR <<< "$packages_custompackages"
		for i in "${ADDR[@]}"; do
			apt-get install -y $i
		done
		IFS=$OLD_IFS
	fi
}

function deploy_init {
	if [ "$packages_deploy" == "true" ]; then
		update_apt
		install_default
		install_web
		custom_repo
		echo -e "${GREEN}Init deployment finish."
	fi
}
