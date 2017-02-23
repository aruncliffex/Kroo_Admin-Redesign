#!/bin/bash

tar -czvf /home/ubuntu/KrooAdminBackup/backup-$(date +%Y-%m-%d_%H:%M:%S).tar.gz /var/www/html/Kroo_Admin-Redesign_Demo/
rm -r /var/www/html/Kroo_Admin-Redesign_Demo/*

 

