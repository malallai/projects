#!/bin/bash

RED="\033[38;5;1m"
GREEN="\033[38;5;70m"
YELLOW="\033[38;5;3m"
VERSION=0.0.1
FOLDER=./
ALL_FILE=1

while getopts "f:m:e:vh" flag
do
	case $flag in

	v)
		printf "${GREEN}%s : %s\n" "Version" ${VERSION}
		exit
		;;
	f)
		FOLDER=$OPTARG
		;;
	m)
		MESSAGE=$OPTARG
		;;
	e)
		ALL_FILE=0
		EXCLUDE=$OPTARG
		;;
	h)
		printf "%s -- :\n" "Help page"
		printf "\t-%s : %s\n" "h" "Open help page"
		printf "\t-%s : %s\n" "v" "Print current version"
		printf "\t-%s : %s\n" "f" "Choose git repo folder"
		printf "\t-%s : %s\n" "m" "Define commit message"
		printf "\t-%s : %s\n" "e" "File to exclude from commit (Separate by ',')"
		exit
		;;
	esac
done

function add_files {
	cd $FOLDER
	if [ "$ALL_FILE" == "0" ]
	then
		git add .
		OLDIFS=$IFS
		IFS=','
		read -ra array <<< "$EXCLUDE"
		for arg in "${array[@]}"; do
			echo $arg
		done
		IFS=$OLDIFS
	else
		echo "nop"
	fi
}

add_files

