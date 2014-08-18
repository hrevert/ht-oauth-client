<?php
namespace Hrevert\OauthClient\Doctrine;

use Hrevert\OauthClient\Manager\ProviderManagerInterface;
use Doctrine\Common\Persistence\ObjectRepository;

class ProviderManager implements ProviderManagerInterface
{
    /**
     * @var ObjectRepository
     */
    protected $repository; 
    
    /**
     * Constructor
     *
     * @param ObjectRepository $repository
     */
    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritDoc}
     */    
    public function findByName($name)
    {
        return $this->repository->findOneBy(['name' => $name]);
    }    
}
