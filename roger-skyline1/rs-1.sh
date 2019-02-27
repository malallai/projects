#!/bin/bash

RED="\033[38;5;1m"
GREEN="\033[38;5;40m"
YELLOW="\033[38;5;226m"
RESET="\033[0m"

HOST=localhost
PORT=22
PUBKEY=""
DEPLOY=0
DSSH=0
DFIREWALL=0
DCRONDIFF=0
DUPDATE=0

while getopts "H:p:k:hd" flag
do
    case $flag in
    p)
        PORT=$OPTARG
        ;;
    H)
        HOST=$OPTARG
        ;;
    d)
        DEPLOY=1
        ;;
    k)
        PUBKEY=$OPTARG
        ;;
    h)
        echo -e "Help page -- :"
        echo -e "\t-h : Open help page"
        exit ;;
    esac
done

function check_pub_key {
    if ! [ -f $PUBKEY ]; then
        echo -e "\`$PUBKEY\` file not found."
        PUBKEY=""
    else
        if ! [ ${PUBKEY: -4} == ".pub" ]; then
            echo -e "\`$PUBKEY\` not a valid public key file. (Please use \`.pub\` extension."
            PUBKEY=""
        fi
    fi
    if [ "$PUBKEY" == "" ]; then
        if [ -f ~/.ssh/id_rsa.pub ]; then
            PUBKEY="~/.ssh/id_rsa.pub"
        else
            echo -e "Unable to find default public ssh key : ~/.ssh/id_rsa.pub. Please create new SSH Key using \`ssh-keygen\` before deployment."
            exit
        fi
    fi
    echo -e "Using \`$PUBKEY\` as public ssh key for deployment."
}

function print_infos {
    echo -e "Deployment settings : --"
    echo -e "\tHost: ${GREEN}$HOST${RESET}"
    echo -e "\tPort: ${GREEN}$PORT${RESET}"
    echo -e "\tPublic Key: ${GREEN}$PUBKEY${RESET}"
    echo -e "WTD: --"
    echo -e "\tSSH: $(onoffcolor "$DSSH" "${GREEN}true" "${RED}false")${RESET}"
    echo -e "\tFirewall: $(onoffcolor "$DFIREWALL" "${GREEN}true" "${RED}false")${RESET}"
    echo -e "\tCrondiff Script: $(onoffcolor "$DCRONDIFF" "${GREEN}true" "${RED}false")${RESET}"
    echo -e "\tUpdate Script: $(onoffcolor "$DUPDATE" "${GREEN}true" "${RED}false")${RESET}"
}

function copy_files {
    echo -e "Copying files to "
    scp -P $PORT ./files root@$HOST:/root/rs1-files
}

onoffcolor() {
    if [ $1 == 1 ] ; then
        echo "$2"
    else
        echo "$3"
    fi
}

print_infos

#check_pub_key
#if [ $DEPLOY == 1 ]; then
#    copy_files
#fi
