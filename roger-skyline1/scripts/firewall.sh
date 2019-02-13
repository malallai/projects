function firewall {

}

function reset_firewall {
	iptables -F
	iptables -X
	iptables -t mangle -F
	iptables -t mangle -X
}

function keep_connection {
	iptables -A OUTPUT -m state --state RELATED,ESTABLISHED -j ACCEPT
	iptables -A INPUT -m state --state RELATED,ESTABLISHED -j ACCEPT
}

function protection_dos {
	iptables -t mangle -A PREROUTING -m conntrack --ctstate INVALID -j DROP
	iptables -t mangle -A PREROUTING -p tcp ! --syn -m conntrack -ctstate NEW -j DROP
}
