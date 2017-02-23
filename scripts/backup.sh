#!/bin/bash

tar -czvf /home/ubuntu/KrooAdminBackup/backup-$(date +%Y-%m-%d).tar.gz /var/www/html/Kroo_Admin-Redesign_Demo/
rm -r /var/www/html/Kroo_Admin-Redesign_Demo/*

 

