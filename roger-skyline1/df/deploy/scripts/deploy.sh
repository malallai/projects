#!/bin/bash

RED="\033[38;5;1m"
GREEN="\033[38;5;40m"
YELLOW="\033[38;5;226m"

function test {
    echo "Work" >> /root/deployment.log
}

test
