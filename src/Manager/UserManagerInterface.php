<?php
namespace Hrevert\OauthClient\Manager;

use Hrevert\OauthClient\Model\UserInterface;

interface UserManagerInterface
{
    /**
     * Finds user by id
     *
     * @param mixed $id
     * @return null|UserInterface
     */
    public function findById($id);
} 