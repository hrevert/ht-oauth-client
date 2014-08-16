<?php
namespace Hrevert\OauthClient\Manager;

use Hrevert\OauthClient\Model\ProviderInterface;

interface ProviderManagerInterface
{
    /**
     * Finds provider by name
     *
     * @return null|ProviderInterface
     */
    public function findByName($name);
}
