<?php

namespace TaskForce\Actions;

use TaskForce\TaskStatusAction;
use TaskForce\Actions\Action;

class ActionFinish extends Action
{
    /**
     * получает имя действия
     * @return string
     */
    public function getActionName(): string
    {
        return  'завершить';
    }

    /**
     * получает внутреннее имя действия
     * @return string
     */
    public function getInnerName(): string
    {
        return  TaskStatusAction::ACTION_FINISH;
    }

    /**
     * проверяет права пользователя
     * @param int $userId
     * @param int $clientId
     * @param int $doerId
     * @return bool
     */
    public function accessRightCheck(int $userId, int $clientId, int $doerId): bool
    {
        return ($userId == $clientId && $userId !== $doerId);
    }
}
