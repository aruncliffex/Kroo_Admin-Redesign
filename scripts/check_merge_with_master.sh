#!/bin/bash

git checkout development
git format-patch master --stdout > temp.patch
var=`git apply --check temp.patch 2>&1`
var1=`echo $var| cut -d' ' -f1`

if [ "$var1" != "error:" ]
then
	echo "Success!"
	rm temp.patch
	exit 0
else
	printf "Error found: Merge with master having conflicts\n\n"
	echo `git apply --check temp.patch`
	rm temp.patch
	exit 50
fi
