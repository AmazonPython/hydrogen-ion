<?php

namespace app\api\controller\v1;

use app\api\model\User as UserModel;
use app\api\model\UserAddress;
use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserAddressException;
use app\lib\exception\UserException;
use think\Controller;

class Address extends Controller
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createOrUpdateAddress,getUserAddress']
    ];

    protected function checkPrimaryScope()
    {
        $scope = TokenService::getCurrentTokenVar('scope');

        if ($scope) {
            if ($scope >= ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    public function getUserAddress()
    {
        $uid = TokenService::getCurrentUid();
        $userAddress = UserAddress::where('user_id', $uid)->find();

        if(!$userAddress){
            throw new UserAddressException();
        }

        return $userAddress;
    }

    public function createOrUpdateAddress()
    {
        $validate = new AddressNew();
        $validate->goCheck();
        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);

        if (!$user) {
            throw new UserException();
        }

        $data = $validate->getDataByRule(input('post.'));
        $userAddress = $user->address;

        if (!$userAddress) {
            $user->Address()->save($data);
        } else {
            $user->Address->save($data);
        }

        return json(new SuccessMessage(),201);
    }
}
