<?php

namespace TaskForce\Actions;

use TaskForce\Task;
use TaskForce\Actions\Action;

class ActionRefuse extends Action
{
    const ACTION_NAME = 'отказаться';
    const INNER_NAME = 'refuse';
    /**
     * получает имя действия
     * @return string
     */
    public function getActionName(): string
    {
        return self::ACTION_NAME;
    }

    /**
     * получает внутреннее имя действия
     * @return string
     */
    public function getInnerName(): string
    {
        return  self::INNER_NAME;;
    }

    /**
     * проверяет права пользователя
     * @param int $userId
     * @param int $clientId
     * @param int $doerId
     * @param string $status
     * @return bool
     */
    public function accessRightCheck(int $userId, int $clientId, int $doerId, string $status): bool
    {
        return ($userId === $doerId && $userId !== $clientId && $status === Task::STATUS_WORKING);
    }
}
