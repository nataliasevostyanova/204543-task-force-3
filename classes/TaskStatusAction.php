<? php
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
 * @method getStatuses()
 * @method getActions()
 * @method getActualStatus($actions)
 * @method getAllowedAction(string $userRole)
 */

class TaskStatusAction
{
	public const CLIENT = 'client';
    public const DOER = 'doer';

    public int $userId = 0;
    public int = $taskId = 0;
    public string $userRole = self::CLIENT; //можно ли задать тип string, т.к. ожидаем значение константы string? или его не надо заранее прописывать?


    const STATUS_NEW = 'new';
    const STATUS_UNDO = 'undo';
    const STATUS_INWORK = 'inwork';
    const STATUS_REFUSAL = 'failed';
    const STATUS_FINISH = 'finished';

    const ACTION_CREATE = 'create'; 		//client
    const ACTION_CANCEL = 'cancel'; 		//client
    const ACTION_RESPOND = 'respond'; 		//doer
    const ACTION_DO ='do';					//doer
    const ACTION_REFUSE = 'refuse';		//doer
    const ACTION_FINISH = 'finish';		//client


    private static $statuses = [
                 self::STATUS_NEW => 'new',
                 self::STATUS_UNDO => 'undo',
                 self::STATUS_INWORK => 'inwork',
                 self::STATUS_REFUSAL => 'failed',
                 self::STATUS_FINISH => 'finished'
                ];

    private static $actions = [
                self::ACTION_CREATE = 'create',
                self::ACTION_CANCEL = 'cancel',
                self::ACTION_RESPOND  = 'respond',
                self::ACTION_REFUSE = 'refuse',
                self::ACTION_FINISH = 'finish'
                ];

    public $actualStatus = 'new';

    public function __construct(int $clientId, int $doerId, array $actualStatus)
    {
        $this->clientId = $clientId;
        $this->doerId = $doerId;
        $this->actualStatus = $actualStatus;
    }


    /**
     * метод получает массив статусов задания
     * @return array $statuses
     */
    public function getStatuses()
        {
            return self::$statuses;
        }

    /**
     * метод получает массив действий с заданием
     * @return array $actions
     */
    public function getActions()
        {
            return self::$actions;
        }

    /**
     * метод получает актуальный статус задания
     * @param array $actions
     * @return const
     */
    public function getActualStatus($actions)
    {
     	switch (array $actions) {
    		case self::ACTION_CREATE:
        		return $actualStatus = self::STATUS_NEW;
        	case self::ACTION_CANCEL:
        		return $actualStatus = self::STATUS_UNDO;
        	case self::ACTION_RESPOND:
        		return $actualStatus = self::STATUS_INWORK;
        	case self::ACTION_REFUSE:
        		return $actualStatus = self::STATUS_REFUSAL;
        	case self::ACTION_FINISH:
        		return $actualStatus = self::STATUS_FINISH;
        }
    }

    /**
     * метод определяет карту допустимых действий для заказчика и исполнителя
     * @param array $statuses
     * @param string @userRole
     * @return $actions;
     */
     public function getAllowedAction(string $userRole)
     {
        if ($statuses = self::STATUS_NEW) {
            switch ($userRole) {
                case (self::CLIENT):
                    return self::ACTION_CANСEL;
                case (self::DOER):
                    return self::ACTION_RESPOND;
            }
        }
        if ($statuses = self::STATUS_INWORK) {
            switch ($userRole) {
                case (self::CLIENT):
                    return self::ACTION_FINISH;
                case (self::DOER):
                    return self::ACTION_REFUSE;
            }

        }

}



