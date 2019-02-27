function init_ssh {
	echo ${idrsa} >> /home/${user}/.ssh/authorized_keys
	sed -i 's/#Port 22/Port 2201/' /etc/ssh/sshd_config
	sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin no/' /etc/ssh/sshd_config
	sed -i 's/#PubkeyAuthentication yes/PubkeyAuthentication yes/' /etc/ssh/sshd_config
	sed -i 's/#PasswordAuthentication yes/PasswordAuthentication no/' /etc/ssh/sshd_config
	service sshd restart
}
