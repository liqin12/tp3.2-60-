<?php
return array(
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'tp5', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => '', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集


    'TMPL_PARSE_STRING'  =>array(
        '__PUBLIC__' => '/public', // 更改默认的/Public 替换规则
         '__JS__'     => '/Public/JS/', // 增加新的JS类库路径替换规则
         '__UPLOAD__' => '/Uploads', // 增加新的上传路径替换规则
    ),
);