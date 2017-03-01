#!/bin/bash

cd /var/www/html/Kroo_Admin-Redesign_Demo
echo `pwd`
git checkout master
var=`git merge development`
error_code=$?
echo $error_code
if [ "$error_code" == 0 ]
then
	echo "Merged with master branch successfull !"
	git remote set-url origin  git+ssh://git@github.com/aruncliffex/Kroo_Admin-Redesign.git
	git add .
	git commit -m"Commited merge from Master+Development branch"
	git push origin master
	exit 0
else
	printf "Error found: Merge with master unsuccessfull !  \n\n"
	printf "$var \n\n"
	git merge --abort
	exit 50
fi
