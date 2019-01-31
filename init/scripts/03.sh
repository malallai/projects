#!/bin/bash

RED="\033[38;5;1m"
GREEN="\033[38;5;40m"
YELLOW="\033[38;5;226m"
VERSION=0.0.1
FOLDER=./
FILE=0
MESSAGE=0
FORCE=0
PULL=0

while getopts "f:F:m:e:i:vhbu" flag
do
	case $flag in

	v)
		printf "${GREEN}%s : %s\n" "Version" ${VERSION}
		exit
		;;
	b)
		FORCE=1
		;;
	u)
		PULL=1
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
	i)
		echo "alias gpush=\"$PWD/$0\"" >> $OPTARG
		. "$OPTARG"
		printf "${GREEN}GPush installed"
		exit
		;;
	h)
		printf "%s -- :\n" "Help page"
		printf "\t-%s : %s\n" "h" "Open help page"
		printf "\t-%s : %s\n" "v" "Print current version"
		printf "\t-%s : %s\n" "i" "Install GPush alias"
		printf "\t-%s : %s\n" "b" "Bypass update verification"
		printf "\t-%s : %s\n" "u" "Force git pull"
		printf "\t-%s : %s\n" "F" "Choose git repo folder"
		printf "\t-%s : %s\n" "f" "File to include from commit (Seperate by ',')"
		printf "\t-%s : %s\n" "e" "File to exclude from commit (Seperate by ',')"
		printf "\t-%s : %s\n" "m" "Define commit message"
		exit
		;;
	esac
done

function check_branch {
	git fetch >> /dev/null
	PULL_STATUS=`git status -uno | grep 'git pull'`
	PUSH_STATUS=`git status -u | grep 'git commit'`
	if [ "$PULL_STATUS" != "" ]
	then
		printf "${YELLOW}An update is available for this git repo. (Use 'git pull' or '-b' to bypass update verfication or '-u' to pull automaticcaly pull)\n"
		if [ "$PULL" == "1" ]; then
			git pull >> /dev/null
		else
			if [ "$FORCE" == "0" ]; then
				exit
			fi
		fi
	fi
	if [ "$PUSH_STATUS" == "" ]
	then
		printf "${YELLOW}Nothing to be commit.\n"
		exit
	fi
}

function add_files {
	cd $FOLDER
	if [ "$FILE" == "0" ]
	then
		git add . >> /dev/null
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
	git commit -m "$MESSAGE" >> /dev/null
}

function push_files {
	BRANCH=`git branch | cut -c3-`
	DIFF=`git diff --stat --cached origin/master | tail -1 | cut -d ' ' -f2`
	git push -q
	printf "${YELLOW}Pushed ${GREEN}%s ${YELLOW}files changed, for branch ${GREEN}%s\n" "$DIFF" "$BRANCH"
}

check_branch
add_files
commit_files
push_files
