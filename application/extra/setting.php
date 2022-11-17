<?php

use think\Env;

return [
    'img_prefix' => Env::get('img_prefix'),
    'token_expire_in' => 7200
];
