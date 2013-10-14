#!/bin/bash

mkdir -m777 -p ./assets
mkdir -m777 -p ./protected/runtime
mkdir -m777 -p ./protected/extensions/eauth/assets

chown ${USER}:www ./* -Rf
 chmod g+w ./protected/extensions/eauth/assets -Rf
 chmod g+w ./assets -Rf
 chmod g+w ./protected/runtime -Rf
 chmod g+w ./protected/views -Rf
 chmod g+w ./protected/models -Rf
 chmod g+w ./protected/modules -Rf
 chmod g+w ./protected/components -Rf
 chmod g+w ./protected/controllers -Rf
 chmod g+w ./protected/data -Rf
