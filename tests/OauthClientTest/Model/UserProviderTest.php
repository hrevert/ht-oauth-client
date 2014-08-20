<?php
namespace Hrevert\OauthClientTest\Model;

use Hrevert\OauthClient\Model\UserProvider;

class UserProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testSetUser()
    {
        $user = $this->getMock('Hrevert\OauthClient\Model\UserInterface');
        $userProvider = new UserProvider();
        $userProvider->setUser($user);
        $this->assertEquals($user, $userProvider->getUser());
    }

    public function testSetProvider()
    {
        $provider = $this->getMock('Hrevert\OauthClient\Model\ProviderInterface');
        $userProvider = new UserProvider();
        $userProvider->setProvider($provider);
        $this->assertEquals($provider, $userProvider->getProvider());
    }

    public function testSetProviderUid()
    {
        $providerUid = 'asdf32434sad235';
        $userProvider = new UserProvider();
        $userProvider->setProviderUid($providerUid);
        $this->assertEquals($providerUid, $userProvider->getProviderUid());
    }
}
