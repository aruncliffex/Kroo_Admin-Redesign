#!/bin/bash


var=`git merge --no-commit development  2>&1`
var1=`echo $var| cut -d' ' -f1-4`
echo $var1
if [ "$var1" == "Automatic merge went well;" ]
then
	echo "Success!"
	exit 0
else
	printf "Error found: Merge with master having conflicts\n\n"
	exit 50
fi
