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

onoffcolor() {
    if [ $1 == 1 ] ; then
        echo "$2"
    else
        echo "$3"
    fi
}

RED="\033[38;5;1m"
GREEN="\033[38;5;40m"
YELLOW="\033[38;5;226m"
RESET="\033[0m"

deploy=0
files="."
host="localhost"
port="22"

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
    if ! [ -d $files ]; then
        mkdir -p $files
    fi
    cp -R -n /tmp/deployment/* $files/
    sed -i "s|host: localhost|host: $host|" $files/host.yml
    sed -i "s|port: 22|port: $port|" $files/host.yml
    sed -i "s|files: .|files: $files|" $files/host.yml
}

function source_files {
    if [ -f $files/host.yml ]; then
        eval $(parse_yaml $files/host.yml)
    fi
}

function print_details {
    source_files
    echo -e "Informations before deployment : --"
    echo -e "\tHost: ${GREEN}$host${RESET}"
    echo -e "\tPort: ${GREEN}$port${RESET}"
    echo -e "\tDeployment Files: ${GREEN}$files${RESET}"
    if ! [ -f $files/host.yml ]; then
        echo -e ""
        echo -e "(No \`host.yml\` file found, use \`-i\` option to initialize files, and get better configurations options.)"
    fi
}

function deploy {
    echo -e "Copying files to $host:$port.."
    scp -P $port $files/deploy root@$host:/root/rs1-files
    ssh root@$host -p $port '/root/rs1-files/files/deploy.sh'
    scp -P $port root@$host:/root/rs1-files/files/deployment.log ./.log && cat ./.log | grep "Work"
}

while getopts "H:p:f:hdiD" flag
do
    case $flag in
    H)
        if [ -f $files/host.yml ]; then
            echo -e "\`host.yml\` file found, update host file to use another host."
        else
            host=$OPTARG
        fi
        ;;
    p)
        if [ -f $files/host.yml ]; then
            echo -e "\`host.yml\` file found, update host file to use another port."
        else
            port=$OPTARG
        fi
        ;;
    f)
        files=$OPTARG
        ;;
    d)
        deploy=1
        ;;
    i)
        clone_files
        ;;
    D)
        print_details
        exit ;;
    h)
        echo -e "Help page -- :"
        echo -e "\t-h : Open help page"
        echo -e "\t-f : Define folder where to find all deployment files, can be used with -i"
        echo -e "\t-d : Launch deployment"
        echo -e "\t-i : Copy default files, can be used with -f"
        echo -e "\t-D : Print details about deployment"
        echo -e "\t-H : Manually define host for deployment, can be used with -i"
        echo -e "\t-p : Manually define port for deployment, can be used with -i"
        exit ;;
    esac
done
