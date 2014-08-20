<?php
namespace Hrevert\OauthClientTest\Doctrine;

use Hrevert\OauthClient\Doctrine\UserProviderManager;
use Hrevert\OauthClient\Model\UserProviderInterface;
use Hrevert\OauthClient\Model\UserProvider;

class UserProviderManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testFindByProviderUid()
    {
        $objectManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $class = 'Hrevert\OauthClient\Model\UserProvider';
        $repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $objectManager->expects($this->once())
            ->method('getRepository')
            ->with($class)
            ->will($this->returnValue($repository));

        $userProviderManager = new UserProviderManager($objectManager, $class);

        $provider = $this->getMock('Hrevert\OauthClient\Model\ProviderInterface');
        $userProvider = $this->getMock('Hrevert\OauthClient\Model\UserProviderInterface');
        $providerUid = '6784sadf23454';

        $repository->expects($this->once())
            ->method('findOneBy')
            ->with(['providerUid' => $providerUid, 'provider' => $provider])
            ->will($this->returnValue($userProvider));

        $this->assertEquals($userProvider, $userProviderManager->findByProviderUid($providerUid, $provider));
    }

    public function testFindByUserAndProvider()
    {
        $objectManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $class = 'Hrevert\OauthClient\Model\UserProvider';
        $repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $objectManager->expects($this->once())
            ->method('getRepository')
            ->with($class)
            ->will($this->returnValue($repository));

        $userProviderManager = new UserProviderManager($objectManager, $class);

        $provider = $this->getMock('Hrevert\OauthClient\Model\ProviderInterface');
        $userProvider = $this->getMock('Hrevert\OauthClient\Model\UserProviderInterface');
        $user = $this->getMock('Hrevert\OauthClient\Model\UserInterface');

        $repository->expects($this->once())
            ->method('findOneBy')
            ->with(['user' => $user, 'provider' => $provider])
            ->will($this->returnValue($userProvider));

        $this->assertEquals($userProvider, $userProviderManager->findByUserAndProvider($user, $provider));
                
    }

    public function testFindByUser()
    {
        $objectManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $class = 'Hrevert\OauthClient\Model\UserProvider';
        $repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $objectManager->expects($this->once())
            ->method('getRepository')
            ->with($class)
            ->will($this->returnValue($repository));

        $userProviderManager = new UserProviderManager($objectManager, $class);

        $userProvider = $this->getMock('Hrevert\OauthClient\Model\UserProvider');
        $userProviders = [new UserProvider, $userProvider];
        $user = $this->getMock('Hrevert\OauthClient\Model\UserInterface');

        $repository->expects($this->once())
            ->method('findBy')
            ->with(['user' => $user])
            ->will($this->returnValue($userProviders));

        $this->assertEquals($userProviders, $userProviderManager->findByUser($user));
                
    }

    public function testInsert()
    {
        $objectManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $class = 'Hrevert\OauthClient\Model\UserProvider';  
        
        $userProviderManager = new UserProviderManager($objectManager, $class);
        
        $userProvider = $this->getMock('Hrevert\OauthClient\Model\UserProvider'); 

        $objectManager->expects($this->once())
            ->method('persist')
            ->with($userProvider); 
            
        $objectManager->expects($this->once())
            ->method('flush');
            
        $userProviderManager->insert($userProvider);                     
    }
}
