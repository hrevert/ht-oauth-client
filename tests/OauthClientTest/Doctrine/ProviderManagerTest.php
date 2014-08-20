<?php
namespace Hrevert\OauthClientTest\Doctrine;

use Hrevert\OauthClient\Doctrine\ProviderManager;

class ProviderManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testFindByName()
    {
        $provider = $this->getMock('Hrevert\OauthClient\Model\ProviderInterface'); 

        $repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $repository->expects($this->at(0))
            ->method('findOneBy')
            ->with(['name'  =>'twitter'])
            ->will($this->returnValue($provider));

        $providerManager = new ProviderManager($repository);

        $this->assertEquals($provider, $providerManager->findByName('twitter'));
        $this->assertEquals(null, $providerManager->findByName('aasdf'));
    }
}
