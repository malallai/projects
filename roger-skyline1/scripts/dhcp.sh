# Edit /etc/network/interfaces
# iface ** inet static
#	adress *.*.*.*
#	netmask *.*.*.*
#	gateway *.*.*.*

sudo nano /etc/network/interfaces
sudo service networking restart
sudo ifdown enp0s3
sudo ifup enp0s3
