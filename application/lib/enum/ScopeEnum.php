<?php

namespace app\lib\enum;

// 接口访问权限枚举
Class ScopeEnum
{
    // scope = user 代表普通用户，RootUser 代表管理员
    const User = 16;
    const SuperUser = 32;
}
