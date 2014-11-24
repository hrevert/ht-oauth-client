<?php
namespace Hrevert\OauthClient\ZendDb;

use Hrevert\OauthClient\Manager\UserManagerInterface;
use Hrevert\OauthClient\Manager\UserProviderManagerInterface;
use Hrevert\OauthClient\Model\ProviderInterface;
use Hrevert\OauthClient\Model\UserInterface;
use Hrevert\OauthClient\Model\UserProvider;
use Hrevert\OauthClient\Model\UserProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use ZfcBase\Mapper\AbstractDbMapper;

class UserProviderManager extends AbstractDbMapper implements UserProviderManagerInterface
{
    /**
     * @var ProviderManager
     */
    protected $providerManager;

    /**
     * @var UserManagerInterface
     */
    protected $userManager;

    /**
     * Constructor
     *
     * @param ProviderManager $providerManager
     * @param UserManagerInterface $userManager
     */
    public function __construct(ProviderManager $providerManager, UserManagerInterface $userManager)
    {
        $this->providerManager  = $providerManager;
        $this->userManager      = $userManager;
    }

    /**
     * {@inheritDoc}
     */
    public function findByProviderUid($providerUid, ProviderInterface $provider)
    {
        $row = $this->findOneBy(['provider_uid' => $providerUid, 'provider_id' => $provider->getId()]);
        if ($row === null) {
            return null;
        }
        return $this->createUserProvider($this->userManager->findById($row->user_id), $provider, $providerUid);
    }

    /**
     * {@inheritDoc}
     */
    public function findByUserAndProvider(UserInterface $user, ProviderInterface $provider)
    {
        $row = $this->findOneBy(['user_id' => $user->getId(), 'provider_id' => $provider->getId()]);
        if ($row === null) {
            return null;
        }
        return $this->createUserProvider($user, $provider, $row->provider_uid);
    }

    /**
     * {@inheritDoc}
     */
    public function findByUser(UserInterface $user)
    {
        $this->initialize();
        $select = $this->getSelect();
        $select->where(['user_id' => $user->getId()]);
        $result = $this->getSlaveSql()->prepareStatementForSqlObject($select)->execute();
        if (!count($result)) {
            return [];
        }
        $resultSet = new ResultSet;
        $resultSet->initialize($result);
        $providerIds = [];
        foreach ($resultSet as $row) {
            $providerIds[] = $row->provider_id;
        }
        $providersResultSet = $this->providerManager->findMultipleProviders($providerIds);
        $providers = [];
        foreach ($providersResultSet as $provider) {
            $providers[$provider->getId()] = $provider;
        }
        $userProviders = [];
        foreach ($resultSet as $row) {
            $userProviders[] = $this->createUserProvider($user, $providers[$row->provider_id], $row->provider_uid);
        }

        return $userProviders;
    }

    /**
     * {@inheritDoc}
     */
    public function insert(UserProviderInterface $userProvider)
    {
        $sql = $this->getSql()->setTable($this->tableName);
        $insert = $sql->insert();
        $insert->values([
            'user_id' => $userProvider->getUser()->getId(),
            'provider_id' => $userProvider->getProvider()->getId(),
            'provider_uid' => $userProvider->getProviderUid(),
        ]);

        return $sql->prepareStatementForSqlObject($insert)->execute();
    }

    /**
     * @param UserInterface $user
     * @param ProviderInterface $provider
     * @param int $providerUid
     * @return UserProvider
     */
    protected function createUserProvider(UserInterface $user, ProviderInterface $provider, $providerUid)
    {
        $userProvider = new UserProvider;
        $userProvider->setUser($user);
        $userProvider->setProvider($provider);
        $userProvider->setProviderUid($providerUid);
        return $userProvider;
    }

    /**
     * @param array $where
     * @return object|null
     */
    protected function findOneBy(array $where)
    {
        $select = $this->getSelect();
        $select->where($where)
            ->limit(1);
        $result = $this->getSlaveSql()->prepareStatementForSqlObject($select)->execute();
        if (!count($result)) {
            return null;
        }
        $resultSet = new ResultSet;
        $resultSet->initialize($result);
        return $resultSet->current();
    }
}
