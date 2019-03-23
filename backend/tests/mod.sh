#! /bin/bash
#
# mod.sh
# Copyright (C) 2018 xub <xub@xub-X553MA>
#
# Distributed under terms of the MIT license.
#

#echo "disable | enable test ? type d\e"
#read mod 
#files=`find available/ -name "*Test.php"`
# ln -s ../available/ProductControllerTest.php enabled/ProductControllerTest.php
goroot() {
  cd "$(dirname "$0")"
}
rootdir=$(dirname "$0")
echo $rootdir

enable_all() {
  for filepath in ./available/*Test.php; do
    name="${filepath##*/}"
    if [ ! -e "./enabled/$name" ] ; then
      ln -sv "."$filepath "./enabled/"$name
    fi
  done
}

disable_from_input() {
  echo "Disable from input: $input_files"
  if [ ! -e "./enabled/$input_files" ] ; then
    echo "$input_files does not exists"
    process_files
  else
    rm -v "./enabled/$input_files"
  fi
}

disable_all() {
  rm -v ./enabled/*Test.php
}

enable_from_input() {
  echo "Enable from input: $input_files"
  if [ ! -e "./available/$input_files" ] ; then
    echo "$input_files does not exists"
    process_files
  else
    if [ ! -e "./enabled/$input_files" ] ; then
      ln -sv "../available/$input_files" "./enabled/$input_files"
    fi
  fi
}
check_q(){
  if [ $action = "q" ]; then
    echo "bye!"
    exit;
  fi
}

process_action() {
  echo "type action: e\d e by default. q for Exit"
  read action
  check_q
  if [ $action = "e" ] ; then
    all_files=`find ./available/  -name "*Test.php" -printf "%f "`
    echo $all_files
    process_files
  elif [ $action = "d" ]; then
    all_files=`find ./enabled/  -name "*Test.php" -printf "%f "`
    echo $all_files
    process_files
  else 
    echo "invalid action"
    process_action
  fi
}

process_files(){
  echo 'type all or some file name. q for Exit'
  read input_files
  check_q
  if [ $action = "d" ]; then
    if [ $input_files = "all" ]; then
      disable_all
    else
      disable_from_input 
    fi
  elif [ $action = "e" ]; then
    if [ $input_files = "all" ]; then
      enable_all
    else
      enable_from_input
    fi
  fi
}  

goroot

echo "all files:"
process_action
