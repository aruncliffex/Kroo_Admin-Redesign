#!/bin/bash

git checkout master
var=`git merge --no-commit development  2>&1`
var1=`echo $var| cut -d' ' -f1-4`
var2=`echo $var| cut -d' ' -f1-2`

echo $var1
echo $var2
if [ "$var1" == "Automatic merge went well;" || "$var2" == "Already up-to-date."]
then
	echo "Success!"
	exit 0
else
	printf "Error found: Merge with master having conflicts\n\n"
	printf "$var
	git merge --abort
	exit 50
fi
