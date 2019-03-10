function create_user {
	useradd $ssh_user
	mkdir /home/$ssh_user
}

function init_ssh {
	mkdir /home/$ssh_user/.ssh/
	echo "../id_rsa.pub" >> /home/$ssh_user/.ssh/authorized_keys
	sed -i "s|#Port 22|Port $ssh_port|" /etc/ssh/sshd_config
	sed -i "s|#PermitRootLogin prohibit-password|PermitRootLogin no|" /etc/ssh/sshd_config
	sed -i "s|#PubkeyAuthentication yes|PubkeyAuthentication yes|" /etc/ssh/sshd_config
	sed -i "s|#PasswordAuthentication yes|PasswordAuthentication no|" /etc/ssh/sshd_config
	chown -R $ssh_user:$ssh_user /home/$ssh_user
	service sshd restart
}

function sudo_user {
	usermod -aG sudo $ssh_user
	echo "$ssh_user ALL=(ALL:ALL) NOPASSWD:ALL" >> /etc/sudoers
}

function deploy_ssh {
	if [ "$ssh_deploy" == "true" ]; then
		create_user
		init_ssh
		if [ "$ssh_sudo" == "true" ]; then
			sudo_user
		fi
		echo -e "${GREEN}SSH deployment finish."
	fi
}
