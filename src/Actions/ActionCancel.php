<?php

namespace TaskForce\Actions;

use TaskForce\Actions\Action;

class ActionCancel extends Action
{
    private string $actionName;

    public function __construct(int $userId, int $clientId, int $doerId, string $status)
    {
        parent::__construct($userId, $clientId, $doerId, $status);
        $this->actionName = 'cancel';
    }

    /**
     * @inheritDoc
     */
    function getClassName(): string
    {
        return get_class();
    }

    /**
     * @inheritDoc
     */
    public function getActionName(): string
    {
       return  $this->actionName;
    }

    /**
     * @inheritDoc
     */
    public function accessRightCheck(int $userId, int $clientId, int $doerId, string $status): bool
    {
        return ($userId == $clientId && $status == 'new');
    }
}
