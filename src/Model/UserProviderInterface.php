<?php
namespace Hrevert\OauthClient\Model;

/**
 *  Represents a link of a user and a provider
 */
interface UserProviderInterface
{
    /**
     * Sets user
     *
     * @param  UserInterface $user
     * @return self
     */
    public function setUser(UserInterface $user);

    /**
     * Gets user
     *
     * @return UserInterface
     */
    public function getUser();

    /**
     * Sets provider
     *
     * @param  ProviderInterface $provider
     * @return self
     */
    public function setProvider(ProviderInterface $provider);

    /**
     * Gets provider
     *
     * @return ProviderInterface
     */
    public function getProvider();

    /**
     * Sets provider user id
     *
     * @param  string $providerUid
     * @return self
     */
    public function setProviderUid($providerUid);

    /**
     * Gets providerUid
     *
     * @return string
     */
    public function getProviderUid();
}
