<?php
namespace Hrevert\OauthClient\Model;

class UserProvider implements UserProviderInterface
{
    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var ProviderInterface
     */
    protected $provider;

    /**
     * @var string
     */
    protected $providerUid;

    /**
     * {@inheritDoc}
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * {@inheritDoc}
     */
    public function setProvider(ProviderInterface $provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * {@inheritDoc}
     */
    public function setProviderUid($providerUid)
    {
        $this->providerUid = $providerUid;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getProviderUid()
    {
        return $this->providerUid;
    }
}
