#!/bin/bash
## 代码同步脚本
## NAME 项目名称
## GITPATH SSH下载地址
## WEBPATH  web根目录
NAME=$1;
GITPATH=$2;
WEBPATH=$3; 
GITBIN=$4;
RSYNCPASS=$5
EXCLUDEFROM=$6
IP=$7
if [ -z ${NAME} ];then
   echo '项目名称不能为空';
   exit 1;
fi;
PULLPATH=${WEBPATH}/${NAME};
if [ ! -d ${PULLPATH} ];then
   if [ ! -z $GITPATH  ];then
      cd $WEBPATH && ${GITBIN} clone $GITPATH && cd ${NAME};
   else
      echo '不存在的路径';
      exit 1;
   fi;
fi;

if [ $? -ne 0 ];then
   echo 'clone:' $GITPATH '失败';
   exit 1;
fi

cd ${PULLPATH} &&  BRANCHENAME=`${GITBIN} branch --no-color 2> /dev/null | sed -e '/^[^*]/d' -e 's/* \(.*\)/\1/'` ;

if [ $BRANCHENAME != 'master' ];then
   ${GITBIN} checkout master;
fi
${GITBIN} pull;
if [ $? -ne 0 ];then
   echo 'git pull '${NAME}'失败';
   exit 1;
fi
#${GITBIN} checkout 'dev.'${NAME} && ${GITBIN}  reset --hard && ${GITBIN} clean -df  && ${GITBIN} pull;
#if [ $? -ne 0 ];then
#   echo '测试分支切换失败';
#   exit 1;
#fi
MODULENAME=`echo ${NAME}  | sed -e 's/\./_/g'`;
/bin/chown -R httpd:httpd ${WEBPATH}/${NAME}/;
echo -vzrtopg  --password-file=${RSYNCPASS}  --exclude-from=${EXCLUDEFROM} ${WEBPATH}/${NAME}/ httpd@${IP}::${MODULENAME}
#rsync  -vzrtopg  --password-file=${RSYNCPASS}  --exclude-from=${EXCLUDEFROM} ${WEBPATH}/${NAME}/ httpd@${IP}::${MODULENAME}
#if [ $? -ne 0 ];then
#   echo '同步测试代码失败';
#   exit 1;
#fi
#${GITBIN} checkout master;
