<?php
namespace Hrevert\OauthClient\Model;

/**
 * Provider
 *
 * Represents a provider like facebook, twitter, google etc.
 */
class Provider implements ProviderInterface
{
    /**
     * Provider id
     *
     * @var int
     */
    protected $id;

    /**
     * Provider name
     *
     * @var string
     */
    protected $name;

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }
}
