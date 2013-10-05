#!/bin/bash

mkdir -m777 -p ./assets
mkdir -m777 -p ./protected/runtime
mkdir -m777 -p ./protected/extensions/eauth/assets

chown ${USER}:www ./* -Rf
sudo chmod g+w ./protected/extensions/eauth/assets -Rf
sudo chmod g+w ./assets -Rf
sudo chmod g+w ./protected/runtime -Rf
sudo chmod g+w ./protected/views -Rf
sudo chmod g+w ./protected/models -Rf
sudo chmod g+w ./protected/modules -Rf
sudo chmod g+w ./protected/components -Rf
sudo chmod g+w ./protected/controllers -Rf
sudo chmod g+w ./protected/data -Rf
