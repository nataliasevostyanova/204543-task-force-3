<?php
/**
 * асбтрактный класс для действий с заданием
 */

namespace TaskForce\Actions;

abstract class Action
{
    /**
     * получает название действия
     * @return string
     */
    abstract protected function getActionName() :string;

    /**
     * получает имя класса
     * @return string
     */
    abstract protected function getInnerName() :string;

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

