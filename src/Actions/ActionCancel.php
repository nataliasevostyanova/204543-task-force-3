<?php

namespace TaskForce\Actions;

use TaskForce\TaskStatusAction;
use TaskForce\Actions\Action;

class ActionCancel extends Action
{
    /**
     * получает имя действия
     * @return string
     */
    public function getActionName(): string
    {
        return 'отменить' ;
    }

    /**
     * получает внутреннее имя действия
     * @return string
     */
    public function getInnerName(): string
    {
        return  TaskStatusAction::ACTION_CANCEL;
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
        return ($userId == $clientId && $userId !== $doerId && $status == 'new');
    }
}
