<?php
/**
 * Класс описывает все состояния задания
 * и все возможные действия с ним
 */

namespace TaskForce;

use Taskforce\Actions\Action;
use TaskForce\Actions\ActionCancel;
use TaskForce\Actions\ActionRespond;
use TaskForce\Actions\ActionFinish;
use TaskForce\Actions\ActionRefuse;
use TaskForce\Exceptions\WrongStatusException;
use TaskForce\Exceptions\WrongActionException;

class Task
{
    private int $userId;
    private int $clientId;
    private int $doerId;
    private string $status;
    private string $action;


    const CLIENT = 'client';
    const DOER = 'doer';

    const STATUS_NEW = 'new';
    const STATUS_UNDO = 'undo';
    const STATUS_WORKING = 'working';
    const STATUS_REFUSAL = 'failed';
    const STATUS_FINISH = 'finished';

    const ACTION_CREATE = 'create';
    const ACTION_CANCEL = 'cancel';
    const ACTION_RESPOND = 'respond';
    const ACTION_REFUSE = 'refuse';
    const ACTION_FINISH = 'finish';

    private array $statuses = [
                 self::STATUS_NEW => 'новое',
                 self::STATUS_UNDO => 'отменено',
                 self::STATUS_WORKING => 'в работе',
                 self::STATUS_REFUSAL => 'провалено',
                 self::STATUS_FINISH => 'завершено',
                ];

    private array $actions = [
                self::ACTION_CREATE => 'создать',
                self::ACTION_CANCEL =>'отменить',
                self::ACTION_RESPOND => 'откликнуться',
                self::ACTION_REFUSE => 'отказаться',
                self::ACTION_FINISH => 'завершить',
                ];


    public function __construct(int $userId, int $clientId, int $doerId, string $status)
    {
        $this->userId = $userId;
        $this->clientId = $clientId;
        $this->doerId = $doerId;
        $this->status = $status;
    }

    /**
     * @return array $status
     */
    public function getStatuses() : array
    {
        return $this->statuses;
    }

    private function validateStatus (string $status) : void
    {
        if (!in_array($status, $this->getStatuses())) {
            throw new WrongStatusException("Неправильное значение статуса задания");
        }
    }

    /**
     * @return array $actions
     */
    public function getActions() : array
    {
        return $this->actions;
    }

    private function validateAction (string $action) : void
    {
        if (!in_array($action, $this->getActions())) {
            throw new WrongActionException("Нет такого действия с заданием");
        }
    }

    /**
     * метод получает состояние задания после выполнения определенного действия
     * @param string $action
     * @return string|null
     * @throws WrongActionException
     */
    public function getActualStatus(string $action) :? string
    {

        $this->validateAction($action);
        $this->action = $action;

        switch ($action) {
    		case (self::ACTION_CREATE):
        		return self::STATUS_NEW;
        	case (self::ACTION_CANCEL):
        		return self::STATUS_UNDO;
        	case (self::ACTION_RESPOND):
        		return self::STATUS_WORKING;
        	case (self::ACTION_REFUSE):
        		return self::STATUS_REFUSAL;
        	case (self::ACTION_FINISH):
        		return self::STATUS_FINISH;
        }
        return null;
    }

    /**
     * метод определяет карту допустимых действий для пользователя в каждом из состояний задания
     * @param int $userId
     * @param int $clientId
     * @param int $doerId
     * @param string $status
     * @throws WrongStatusException
     * @return string|array
     */
    public function getAllowedAction(int $userId, int $clientId, int $doerId, string $status) : string|array
    {
        $this->validateStatus($status);
        $this->status = $status;

        $actions = [new ActionCancel(), new ActionRespond(), new ActionFinish(), new ActionRefuse];

        $allowedAction = [];

        foreach ($actions as $action)
        {
            if ($action->accessRightCheck($userId, $clientId, $doerId, $status)){
                $allowedAction = $action->getActionName();
            }
        }
        return $allowedAction;
    }
}

