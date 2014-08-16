<?php
namespace Hrevert\OauthClient\Model;

interface ProviderInterface
{
    /**
     * Gets provider id
     *
     * @return int
     */
    public function getId();

    /**
     * Gets provider name
     *
     * @return string
     */
    public function getName();
}
