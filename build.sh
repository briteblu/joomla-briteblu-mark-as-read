#!/bin/bash

# Simple build script to archive all required Joomla package files into .zip file
#
# Usage: ./build.sh

CURRENT_DIR=$(pwd)

cd plugins/content/markasread
zip -qq -r plg_content_markasread .
mv plg_content_markasread.zip "${CURRENT_DIR}/packages"

cd "${CURRENT_DIR}"
zip -qq -r pkg_markasread pkg_markasread.xml pkg_script.php packages
