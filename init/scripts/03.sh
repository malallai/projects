#!/bin/zsh

RED='\033[38;5;1m'
GREEN='\033[38;5;2m'
YELLOW='\033[38;5;3m'
VERSION=0.0.1

while getopts "vh" flag
do
	case $flag in

	v)
		printf "${GREEN}%s : %s\n" "Version" ${VERSION}
		exit
		;;
	h)
		printf "%s -- :\n\t-%s : %s\n\t-%s : %s\n" "Help page" "h" "Open help page" "v" "Print current version"
		exit
		;;
	esac
done
