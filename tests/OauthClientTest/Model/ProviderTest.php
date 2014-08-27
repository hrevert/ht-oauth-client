<?php
namespace Hrevert\OauthClientTest\Model;

use Hrevert\OauthClient\Model\Provider;
use Phine\Test\Property;

class ProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testSettersAndGetters()
    {
        $provider = new Provider();

        Property::set($provider, 'id', 105);
        $provider->setName('Twitter');

        $this->assertEquals(105, $provider->getId());
        $this->assertEquals('Twitter', $provider->getName());
    }
}
