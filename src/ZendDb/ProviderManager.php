<?php
namespace Hrevert\OauthClient\ZendDb;

use Hrevert\OauthClient\Manager\ProviderManagerInterface;
use ZfcBase\Mapper\AbstractDbMapper;
use Hrevert\OauthClient\Model\ProviderInterface;

class ProviderManager extends AbstractDbMapper implements ProviderManagerInterface
{
    /**
     * @var string
     */
    protected $tableName  = 'oauth_provider';

    /**
     * Finds provider by id
     *
     * @param int $id
     * @return null|ProviderInterface
     */
    public function findById($id)
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * {@inheritDoc}
     */
    public function findByName($name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    /**
     * Finds multiple providers by array provider id
     *
     * @param array $ids
     * @return array
     */
    public function findMultipleProviders(array $ids)
    {
        $select = $this->getSelect();
        $select->where->in('id', $ids);
        return $this->select($select);
    }

    /**
     * Sets table name
     *
     * @param string $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @param array $where
     * @return ProviderInterface|null
     */
    protected function findOneBy(array $where)
    {
        $select = $this->getSelect();
        $select->where($where)
            ->limit(1);
        return $this->select($select)->current();
    }
}
