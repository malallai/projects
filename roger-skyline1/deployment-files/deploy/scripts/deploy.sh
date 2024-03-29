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

files="."

function source_files {
    if [ -f /root/rs1-files/settings.yml ]; then
        eval $(parse_yaml /root/rs1-files/settings.yml)
    fi
}

RED="\033[38;5;1m"
GREEN="\033[38;5;40m"
YELLOW="\033[38;5;226m"

source "/root/rs1-files/scripts/fail2ban.sh"
source "/root/rs1-files/scripts/firewalls.sh"
source "/root/rs1-files/scripts/init.sh"
source "/root/rs1-files/scripts/scripts.sh"
source "/root/rs1-files/scripts/ssh.sh"

source_files

deploy_init >> /root/deployment.log
deploy_ssh >> /root/deployment.log
deploy_dos >> /root/deployment.log
deploy_firewalls >> /root/deployment.log
deploy_scripts >> /root/deployment.log
echo "Work" >> /root/deployment.log
