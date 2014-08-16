<?php
namespace Hrevert\OauthClient\Manager;

use Hrevert\OauthClient\Model\ProviderInterface;
use Hrevert\OauthClient\Model\UserInterface;
use Hrevert\OauthClient\Model\UserProviderInterface;

interface UserProviderManagerInterface
{
    /**
     * Finds by provider user id and provider
     *
     * @param string $providerUid
     * @param ProviderInterface $provider
     * @return UserProviderInterface
     */
    public function findByProviderUid($providerUid, ProviderInterface $provider);

    /**
     * Finds by user and provider
     *
     * @param UserInterface $user
     * @param ProviderInterface $provider
     * @return UserProviderInterface
     */
    public function findByUserAndProvider(UserInterface $user, ProviderInterface $provider);

    /**
     * Finds by user
     *
     * @param UserInterface $user
     * @param array|\Traversable
     */
    public function findByUser(UserInterface $user);

    /**
     * Insert record
     *
     * @param UserProviderInterface $userProvider
     */
    public function insert(UserProviderInterface $userProvider);
}
