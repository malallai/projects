function init_ssh {
	echo ${ssh_pubkey} >> /home/${user}/.ssh/authorized_keys
	sed -i 's/#Port 22/Port 2201/' /etc/ssh/sshd_config
	sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin no/' /etc/ssh/sshd_config
	sed -i 's/#PubkeyAuthentication yes/PubkeyAuthentication yes/' /etc/ssh/sshd_config
	sed -i 's/#PasswordAuthentication yes/PasswordAuthentication no/' /etc/ssh/sshd_config
	service sshd restart
}

function sudo_user {
	usermod -aG sudo ${user}
	echo "${user} ALL=(ALL:ALL) NOPASSWD:ALL" >> /etc/sudoers
}
