<?php
namespace Hrevert\OauthClientTest\Model;

use Hrevert\OauthClient\Model\Provider;
use Phine\Test\Property;

class ProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $provider = new Provider;

        Property::set($provider, 'id', 105);
        Property::set($provider, 'name', 'Twitter');

        $this->assertEquals(105, $provider->getId());
        $this->assertEquals('Twitter', $provider->getName());
    }
}
