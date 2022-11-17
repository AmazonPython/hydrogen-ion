<?php

namespace app\api\controller\v1;

use app\api\model\User as UserModel;
use app\api\validate\AddressNew;
use app\api\service\token as TokenService;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;

class Address
{
    public function createOrUpdateAddress()
    {
        (new AddressNew())->goCheck();

        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);

        if (!$user) {
            throw new UserException();
        }

        $dataArray = getDatas();
        $userAddress = $user->address;

        if (!$userAddress) {
            $user->Address()->save($dataArray);
        } else {
            $user->Address->save($dataArray);
        }

        return new SuccessMessage();
    }
}
