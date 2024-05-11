#!/bin/sh

doas echo "http://mirror.bahnhof.net/pub/alpinelinux/edge/main" > /etc/apk/repositories
doas echo "http://mirror.bahnhof.net/pub/alpinelinux/edge/community" >> /etc/apk/repositories
doas echo "http://mirror.bahnhof.net/pub/alpinelinux/edge/testing" >> /etc/apk/repositories

doas apk update
doas apk upgrade

doas apk add ansible

echo "Please reboot your machine now."

