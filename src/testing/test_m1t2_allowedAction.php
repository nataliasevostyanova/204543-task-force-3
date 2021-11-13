<?php
/**
  * testing class TaskStatusAction method getAllowedAction()
  */

require_once '../../vendor/autoload.php';

use TaskForce\classes\TaskStatusAction;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_CALLBACK, function() {
    echo '<hr />';
    echo func_get_arg(3);
    echo '<hr />';
});

$strategy = new TaskStatusAction(5, 2, 'new');
assert($strategy->getAllowedAction(TaskStatusAction::STATUS_NEW) == [TaskStatusAction::ACTION_CANCEL, TaskStatusAction::ACTION_RESPOND], 'Problem with allowed actions for status NEW');

$strategy = new TaskStatusAction(5, 2, 'working');
assert($strategy->getAllowedAction(TaskStatusAction::STATUS_WORKING) == [TaskStatusAction::ACTION_FINISH, TaskStatusAction::ACTION_REFUSE], 'Problem with allowed actions for status WORKING');

assert(false, 'test Allowed Actions is complete FIN');


