#!/bin/bash

# Simple build script to archive all required Joomla package files into .zip file
#
# Usage: ./build.sh

CURRENT_DIR=$(pwd)
PACKAGE_DIR="${CURRENT_DIR}/packages"

if [ ! -d "${PACKAGE_DIR}" ]; then
  mkdir -p "${PACKAGE_DIR}"
fi

# Create component archive
cd component/com_markasread
zip -qq -r com_markasread .
mv com_markasread.zip "${PACKAGE_DIR}"
cd "${CURRENT_DIR}"

# Create plugin archive
cd plugins/content/markasread
zip -qq -r plg_content_markasread .
mv plg_content_markasread.zip "${PACKAGE_DIR}"
cd "${CURRENT_DIR}"

zip -qq -r pkg_markasread pkg_markasread.xml package.installer.php packages
