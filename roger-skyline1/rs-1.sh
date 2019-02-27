#!/bin/bash

RED="\033[38;5;1m"
GREEN="\033[38;5;40m"
YELLOW="\033[38;5;226m"

HOST=localhost
PORT=22
PUBKEY=""
DEPLOY=0

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
        echo "\`$PUBKEY\` file not found."
        PUBKEY=""
    else
        if ! [ ${PUBKEY: -4} == ".pub" ]; then
            echo "\`$PUBKEY\` not a valid public key file. (Please use \`.pub\` extension."
            PUBKEY=""
        fi
    fi
    if [ "$PUBKEY" == "" ]; then
        if [ -f ~/.ssh/id_rsa.pub ]; then
            PUBKEY="~/.ssh/id_rsa.pub"
        else
            echo "Unable to find default public ssh key : ~/.ssh/id_rsa.pub. Please create new SSH Key using \`ssh-keygen\` before deployment."
            exit
        fi
    fi
    echo "Using \`$PUBKEY\` as public ssh key for deployment."
}

function print_infos {
    echo "Deployment settings : --"
    echo "\tHost: ${GREEN}$HOST"
}

function copy_files {
    echo "Copying files to "
    scp -P $PORT ./files root@$HOST:/root/rs1-files
}

print_infos

#check_pub_key
#if [ $DEPLOY == 1 ]; then
#    copy_files
#fi
