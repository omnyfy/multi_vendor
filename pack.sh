#!/bin/bash
DATE=`date +"%Y_%m_%d"`
cd src
tar -czf ../release/omnyfy_vendor_$DATE.tar.gz .
cd ..
