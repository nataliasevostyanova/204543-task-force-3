<? php

class TaskStatusAction 
{
	//свойства класса
	 
	//информация о пользователях
	
	//роли
	public const CLIENT = 'client';
    public const DOER = 'doer';
    //id пользователей
    private $clientId = 0; 
    private $doerId = 0;

    //статусы задания
     const STATUS_NEW = 'new'; 			
     const STATUS_UNDO = 'undo';		
     const STATUS_INWORK = 'inwork';		
     const STATUS_REFUSAL = 'failed';	
     const STATUS_FINISH = 'finished';	
    
    
    //действия с заданием
     const ACTION_CREATE = 'create'; 		//client
     const ACTION_CANCEL = 'cancel'; 		//client
     const ACTION_RESPOND = 'respond'; 		//doer	
     const ACTION_DO ='do';					//doer
     const ACTION_PEFUSE = 'refuse';		//doer
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
                self::ACTION_CANSEL = 'cancel',
                self::ACTION_RESPOND  = 'respond',
                self::ACTION_PEFUSE = 'refuse',
                self::ACTION_FINISH = 'finish'
                ];

    public $actualStatus = 'new'; 

    // методы класса 
     
    //конструктор
    
     public function __construct($clientId, $doerId)
    {
        $this->clientId = $clientId;
        $this->doerId = $doerId;
    }

    // получает массив статусов задания
    
    public function getStatuses ()
        {  
            return self::$statuses;
        } 

    //получает массива действий
    
    public function getActions ()
        { 
            return self::$actions;
        }

    // возвращает статус задания после действий
    
     public function getActualStatus($actualStatus)
     {
     	switch ($actions[]) {
    		case 'create':
        		$actualStatus == 'new';
        		return $actualStatus;
        	break;
    		case 'cancel':
        		$actualStatus == 'undo';
        		return $actualStatus;
        	break;
    		case 'respond':
        		$actualStatus == 'inwork';
        		return $actualStatus;
        	break;

        	case 'refuse':
        		$actualStatus == 'failed';
        		return $actualStatus;
        	break;
        	case 'finish':
        		$actualStatus == 'finish';
        		return $actualStatus;
        	break;
		}
    }

    // тут у меня нет пока понимания как правильно: в switch/case нужно обращаться к имени константы или к её значению? второй вариант закомментила ниже
    
     /*
    public function getActualStatus($actualStatus)
     {
     	switch ($actions[]) {
    		case ACTION_CREATE:
        		$actualStatus == self::STATUS_NEW;
        		return $actualStatus;
        	break;
    		case self::ACTION_CANCEL:
        		$actualStatus == self::STATUS_UNDO;
        		return $actualStatus;
        	break;
    		case self::ACTION_RESPOND:
        		$actualStatus == self::STATUS_INWORK;
        		return $actualStatus;
        	break;
        	case self::ACTION_REFUSE:
        		$actualStatus == self::STATUS_REFUSAL;
        		return $actualStatus;
        	break;
        	case self::ACTION_FINISH:
        		$actualStatus == self::STATUS_FINISH;
        		return $actualStatus;
        	break;
		}
    }
     */

} 