<?php
/**
  * testing class TaskStatusAction method getAllowedAction()
  */

require_once '../classes/TaskStatusAction.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_CALLBACK, function() {
    echo '<hr />';
    echo func_get_arg(3);
    echo '<hr />';
});


$strategy = new TaskStatusAction(5, 2);

/**
 * проверка работы метода getClientAllowedAction()
 */
assert($strategy->getClientAllowedAction(TaskStatusAction::STATUS_NEW) == TaskStatusAction::ACTION_CANCEL, 'Problem with allowed action for CLIENT');
assert($strategy->getClientAllowedAction(TaskStatusAction::STATUS_WORKING) == TaskStatusAction::ACTION_FINISH, 'Problem with allowed action for CLIENT');

/**
 * проверка работы метода getDoerAllowedAction()
 */
$strategy = new TaskStatusAction(5, 2);

assert($strategy->getDoerAllowedAction(TaskStatusAction::STATUS_NEW) == TaskStatusAction::ACTION_RESPOND, 'Problem with allowed action for DOER');
assert($strategy->getDoerAllowedAction(TaskStatusAction::STATUS_WORKING) == TaskStatusAction::ACTION_REFUSE, 'Problem with allowed action for DOER');

assert(false, 'test Allowed Actions is complete FIN');

?>
