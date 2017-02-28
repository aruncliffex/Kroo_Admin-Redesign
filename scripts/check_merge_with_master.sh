#!/bin/bash

git clone https://github.com/aruncliffex/Kroo_Admin-Redesign.git
cd Kroo_Admin-Redesign
git checkout development
git checkout master
var=`git merge --no-commit development  2>&1`
var1=`echo $var| cut -d' ' -f1-4`
var2=`echo $var| cut -d' ' -f1-2`
var3=`echo $var| cut -d' ' -f1-8`
var4=`echo $var| cut -d' ' -f1`
if [[ "$var1" == "Automatic merge went well;" ]] || 
   [[ "$var2" == "Already up-to-date." ]] || 
   [[ "$var3" == "merge: development - not something we can merge" ]] ||
   [[ "$var4" == "Updating" ]]
then
        echo "Success!"
	cd ..
	rm -rf Kroo_Admin-Redesign
        exit 0
else
        printf "Error found: Merge with master having conflicts\n\n"
        printf "$var"
        git merge --abort
	cd ..
	rm -rf Kroo_Admin-Redesign
        exit 1
fi
