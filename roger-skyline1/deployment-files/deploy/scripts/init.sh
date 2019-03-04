function update_apt {
	apt-get update
	apt-get upgrade
}

function install_default {
	apt-get install -y sudo
	apt-get install -y net-tools
	apt-get install -y dnsutils
	apt-get install -y iptables-persistent
	apt-get install -y mailutils
	apt-get install -y fail2ban
}

function install_web {
	apt-get install -y apache2
	apt-get install -y mysql-server
	apt-get install -y mysql-client
	apt-get install -y phpmyadmin
}

function sudo_user {
	usermod -aG sudo ${user}
	echo "${user} ALL=(ALL:ALL) NOPASSWD:ALL" >> /etc/sudoers
}
