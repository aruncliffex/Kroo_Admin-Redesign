#!/bin/bash

rm -rf Kroo_Admin-Redesign
git clone https://github.com/aruncliffex/Kroo_Admin-Redesign.git
cd Kroo_Admin-Redesign 
git checkout development
git format-patch master --stdout > temp.patch
var=`git apply --check temp.patch 2>&1`
var1=`echo $var| cut -d' ' -f1`

if [ "$var1" != "error:" ]
then
	echo "Success!"
	cd ..
	rm -rf Kroo_Admin-Redesign 
	exit 0
else
	printf "Error found: Merge with master having conflicts\n\n"
	echo `git apply --check temp.patch`
	cd ..
	rm -rf Kroo_Admin-Redesign 
	exit 50
fi
