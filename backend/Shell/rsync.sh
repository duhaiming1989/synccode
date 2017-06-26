#!/usr/bin/env bash
WEBPATH=$1
GITBIN=$2
COMMIT=$3
GITROOT=$4
RSYNCPASS=$5

cd ${GITROOT};

${GITBIN} reset --hard ${COMMIT};

#/bin/chown -R httpd:httpd ${WEBPATH}/${NAME}/;

rsync -vzrtopg  --password-file=${RSYNCPASS}  --exclude-from=${EXCLUDEFROM} ${WEBPATH}/${NAME}/ httpd@${IP}::${MODULENAME}