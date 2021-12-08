<?php

namespace TaskForce\Actions;

use TaskForce\Task;
use TaskForce\Actions\Action;

class ActionCancel extends Action
{
    const ACTION_NAME = 'отменить';
    const INNER_NAME = 'cancel';

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
        return  self::INNER_NAME;
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
        return ($userId === $clientId && $userId !== $doerId && $status === Task::STATUS_NEW);
    }
}
