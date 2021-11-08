<?php
/**
 * Класс описывает все состояния задания
 * и все возможные действия с ним
 * @property const CLIENT
 * @property const DOER
 * @property const STATUS_NEW
 * @property const STATUS_UNDO
 * @property const STATUS_INWORK
 * @property const STATUS_REFUSAL
 * @property const STATUS_FINISH
 * @property const ACTION_CREATE
 * @property const ACTION_CANCEL
 * @property const ACTION_RESPOND
 * @property const ACTION_DO
 * @property const ACTION_REFUSE
 * @property const ACTION_FINISH
 * @property int $userId
 * @property int $taskId
 * @property string $userRole
 * @property string $actualStatus
 * @property array $statuses
 * @property array $actions
 * @property string $status
 * @property string $action
 * @method getStatus()
 * @method getAction()
 * @method getActualStatus(string $action)
 * @method getAllowedAction(string $userRole)
 */

class TaskStatusAction
{
	public const CLIENT = 'client';
    public const DOER = 'doer';

    public int $userId = 0;
    public int $taskId = 0;
    public string $userRole = self::CLIENT; //можно ли задать тип string, т.к. ожидаем значение константы string? или его не надо заранее прописывать?
    public string $actualStatus = 'new';
    public string $status;
    public string $action;

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

    private static array $statuses = [
                 self::STATUS_NEW => 'new',
                 self::STATUS_UNDO => 'undo',
                 self::STATUS_WORKING => 'working',
                 self::STATUS_REFUSAL => 'failed',
                 self::STATUS_FINISH => 'finished',
                ];

    private static array $actions = [
                self::ACTION_CREATE => 'create',
                self::ACTION_CANCEL =>'cancel',
                self::ACTION_RESPOND => 'respond',
                self::ACTION_REFUSE => 'refuse',
                self::ACTION_FINISH => 'finish',
                ];

    public function __construct(int $userId, int $taskId, string $userRole, string $actualStatus)
    {
        $this->userId = $userId;
        $this->taskId = $taskId;
        $this->userRole = $userRole;
        $this->actualStatus = $actualStatus;
    }

    /**
     * @param array $statuses
     * @param
     * @return string $status
     */
    public function getStatus($key)
    {
        return $status = self::$statuses[$key];
    }

    /**
     * @param array $actions
     * @return string $actions
     */
    public function getAction($key)
    {
        return $action = self::$actions[$key];
    }

    /**
     * метод получает актуальный статус задания
     * @param string $action
     * @return string $actualStatus
     */
    public function getActualStatus(string $action)
    {
     	switch ($action) {
    		case self::ACTION_CREATE:
        		return $actualStatus = self::STATUS_NEW;
        	case self::ACTION_CANCEL:
        		return $actualStatus = self::STATUS_UNDO;
        	case self::ACTION_RESPOND:
        		return $actualStatus = self::STATUS_WORKING;
        	case self::ACTION_REFUSE:
        		return $actualStatus = self::STATUS_REFUSAL;
        	case self::ACTION_FINISH:
        		return $actualStatus = self::STATUS_FINISH;
        }
    }

    /**
     * метод определяет карту допустимых действий для заказчика и исполнителя
     * @param string $status
     * @param string @userRole
     * @return $action;
     */
     public function getAllowedAction(string $status, string $userRole)
     {
         if ($status = self::STATUS_NEW) {
             switch ($userRole) {
                 case (self::CLIENT):
                     return $action = self::ACTION_CANCEL;
                 case (self::DOER):
                     return $action = self::ACTION_RESPOND;
             }
         }
         if ($status = self::STATUS_WORKING) {
             switch ($userRole) {
                 case (self::CLIENT):
                     return $action = self::ACTION_FINISH;
                 case (self::DOER):
                     return $action= self::ACTION_REFUSE;
             }
         }
     }
}
