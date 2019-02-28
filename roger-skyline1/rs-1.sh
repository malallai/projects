#!/bin/bash

parse_yaml() {
   local prefix=$2
   local s='[[:space:]]*' w='[a-zA-Z0-9_]*' fs=$(echo @|tr @ '\034')
   sed -ne "s|^\($s\)\($w\)$s:$s\"\(.*\)\"$s\$|\1$fs\2$fs\3|p" \
        -e "s|^\($s\)\($w\)$s:$s\(.*\)$s\$|\1$fs\2$fs\3|p"  $1 |
   awk -F$fs '{
      indent = length($1)/2;
      vname[indent] = $2;
      for (i in vname) {if (i > indent) {delete vname[i]}}
      if (length($3) > 0) {
         vn=""; for (i=0; i<indent; i++) {vn=(vn)(vname[i])("_")}
         printf("%s%s%s=\"%s\"\n", "'$prefix'",vn, $2, $3);
      }
   }'
}

eval $(parse_yaml host.yml)

RED="\033[38;5;1m"
GREEN="\033[38;5;40m"
YELLOW="\033[38;5;226m"
RESET="\033[0m"

deploy=0

while getopts "f:hdi" flag
do
    case $flag in
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

function clone_files {
    rm -rf /tmp/deployment
    git clone -q https://malallai@gitlab.com/malallai.42/deployment-files.git /tmp/deployment/ && rm -rf /tmp/deployment/.git
    if [ -d ./deploy ]; then
        for entry in `find /tmp/deployment/* -type f`
        do
            f=`echo "$entry" | cut -c17-`
            folder=`echo $f | cut -d/ -f1`
            file=`echo $f | cut -d/ -f2`
            if [ $folder == $file ]; then
                folder=""
            fi
            if ! [ -f ./deploy/$f ]; then
                echo "Copying \`$f\`.."
                mkdir -p ./deploy/$folder
                cp -R $entry ./deploy/$folder/$file
            fi
        done
    else
        mkdir ./deploy
        cp -R /tmp/deployment/* ./deploy/
    fi
}

function print_details {
    echo -e "Informations before deployment : --"
    echo -e "\tHost: ${GREEN}$host${RESET}"
    echo -e "\tPort: ${GREEN}$port${RESET}"
}

function copy_files {
    echo -e "Copying files to "
    scp -P $port ./files root@$host:/root/rs1-files
}

onoffcolor() {
    if [ $1 == 1 ] ; then
        echo "$2"
    else
        echo "$3"
    fi
}

clone_files
print_details