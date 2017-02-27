#!/bin/bash

git format-patch master --stdout > crazy.patch
var=`git apply --check crazy.patch 2>&1`
var1=`echo $var| cut -d' ' -f1`

if [ "$var1" == "error:" ]
then
	printf "Error found: Merge with master having conflicts\n\n"
	echo `git apply --check crazy.patch`
	exit 50
else
	echo "Success!"
	exit 0
fi
