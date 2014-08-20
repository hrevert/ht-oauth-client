<?php
namespace Hrevert\OauthClient\Doctrine;

use Hrevert\OauthClient\Manager\UserProviderManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Hrevert\OauthClient\Model\ProviderInterface;
use Hrevert\OauthClient\Model\UserInterface;
use Hrevert\OauthClient\Model\UserProviderInterface;

class UserProviderManager implements UserProviderManagerInterface
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var ObjectRepository
     */
    protected $repository;

    /**
     * Constructor
     *
     * @param ObjectManager $objectManager
     * @param string        $class
     */
    public function __construct(ObjectManager $objectManager, $class)
    {
        $this->objectManager = $objectManager;
        $this->repository = $objectManager->getRepository($class);
    }

    /**
     * {@inheritDoc}
     */
    public function findByProviderUid($providerUid, ProviderInterface $provider)
    {
        return $this->repository->findOneBy(['providerUid' => $providerUid, 'provider' => $provider]);
    }

    /**
     * {@inheritDoc}
     */
    public function findByUserAndProvider(UserInterface $user, ProviderInterface $provider)
    {
        return $this->repository->findOneBy(['user' => $user, 'provider' => $provider]);
    }

    /**
     * {@inheritDoc}
     */
    public function findByUser(UserInterface $user)
    {
        return $this->repository->findBy(['user' => $user]);
    }

    /**
     * {@inheritDoc}
     */
    public function insert(UserProviderInterface $userProvider)
    {
        $this->objectManager->persist($userProvider);
        $this->objectManager->flush();
    }
}
