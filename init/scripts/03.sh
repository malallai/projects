#!/bin/bash

RED="\033[38;5;1m"
GREEN="\033[38;5;40m"
YELLOW="\033[38;5;226m"
VERSION=0.0.1
FOLDER=./
FILE=0
MESSAGE=0

while getopts "f:F:m:e:vh" flag
do
	case $flag in

	v)
		printf "${GREEN}%s : %s\n" "Version" ${VERSION}
		exit
		;;
	F)
		FOLDER=$OPTARG
		;;
	f)
		FILE=1
		INCLUDE=$OPTARG
		;;
	m)
		MESSAGE=$OPTARG
		;;
	e)
		FILE=2
		EXCLUDE=$OPTARG
		;;
	h)
		printf "%s -- :\n" "Help page"
		printf "\t-%s : %s\n" "h" "Open help page"
		printf "\t-%s : %s\n" "v" "Print current version"
		printf "\t-%s : %s\n" "F" "Choose git repo folder"
		printf "\t-%s : %s\n" "f" "File to include from commit (Seperate by ',')"
		printf "\t-%s : %s\n" "e" "File to exclude from commit (Seperate by ',')"
		printf "\t-%s : %s\n" "m" "Define commit message"
		exit
		;;
	esac
done

function add_files {
	cd $FOLDER
	if [ "$FILE" == "0" ]
	then
		git add .
	else
		OLDIFS=$IFS
		IFS=','
		if [ "$FILE" == "1" ]
		then
			read -ra array <<< "$INCLUDE"
			for arg in "${array[@]}"; do
				git add $arg >> /dev/null
			done
		else
			read -ra array <<< "$EXCLUDE"
			for arg in "${array[@]}"; do
				git reset -- $arg >> /dev/null
			done
		fi
		IFS=$OLDIFS
	fi
}

function commit_files {
	if [ "$MESSAGE" == "0" ]
	then
		MESSAGE=`git diff --stat --cached origin/master | tail -1`
	fi
	git commit -m "$MESSAGE"
}

function push_files {
	BRANCH=`git branch | cut -c3-`
	DIFF=`git diff --stat --cached origin/master | tail -1 | cut -d ' ' -f2`
	git push
	echo $DIFF
	printf "${YELLOW}Pushed ${GREEN}%s ${YELLOW}files for branch ${GREEN}%s\n" "$DIFF" "$BRANCH"
}

add_files
commit_files
push_files
