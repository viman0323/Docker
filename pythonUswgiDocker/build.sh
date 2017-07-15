#!/bin/bash 
## Name:
## History:
## Data: 20170715

ImageName=$1

docker build -t ${ImageName} .
