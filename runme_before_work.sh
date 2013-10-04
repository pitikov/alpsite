#!/bin/bash

mkdir -m774 -p ./assets
mkdir -m774 -p ./protected/runtime
mkdir -m774 -p ./protected/extensions/eauth/assets

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
