<?php

namespace TaskForce\Actions;

abstract class Action
{
    protected int $userId;
    protected int $clientId;
    protected int $doerId;
    protected string $status;
    protected string $nameAction;
    //protected string $userRole;

    public function __construct(int $userId, int $clientId, int $doerId, string $status)
    {
        $this->userId = $userId;
        $this->clientId = $clientId;
        $this->doerId = $doerId;
        $this->status = $status;

    }

    /**
     * получает имя класса
     * @return string
     */
    abstract protected function getClassName() :string;

    /**
     * получает название действия
     * @return string
     */
    abstract protected function getActionName() :string;

    /**
     * проверяет права пользователя на действие
     * @param int $userId
     * @param int $clientId
     * @param int $doerId
     * @param string $status
     * @return bool
     */
    abstract protected function accessRightCheck(int $userId, int $clientId, int $doerId, string $status) :bool;


}

