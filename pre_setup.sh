#!/bin/sh

# Run this with doas

echo "http://mirror.bahnhof.net/pub/alpinelinux/edge/main" > /etc/apk/repositories
echo "http://mirror.bahnhof.net/pub/alpinelinux/edge/community" >> /etc/apk/repositories
echo "http://mirror.bahnhof.net/pub/alpinelinux/edge/testing" >> /etc/apk/repositories

apk update
apk upgrade

apk add ansible sshpass

echo "Please reboot your machine now."

