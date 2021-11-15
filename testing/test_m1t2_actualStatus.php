<?php
/**
 * testing class TaskStatusAction method getActualStatus
 */

require_once '../vendor/autoload.php';

use TaskForce\TaskStatusAction;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_CALLBACK, function () {
    echo '<hr />';
    echo func_get_arg(3);
    echo '<hr />';
});

$strategy = new TaskStatusAction(5, 2, 'new');
assert($strategy->getActualStatus(TaskStatusAction::ACTION_CANCEL) == TaskStatusAction::STATUS_UNDO, 'Problem: expected after CANCEL status "UNDO"');
assert($strategy->getActualStatus(TaskStatusAction::ACTION_RESPOND) == TaskStatusAction::STATUS_WORKING, 'Problem: expected after RESPOND status "WORKING"');

$strategy = new TaskStatusAction(5, 2, 'working');
assert($strategy->getActualStatus(TaskStatusAction::ACTION_FINISH) == TaskStatusAction::STATUS_FINISH, 'Problem: expected after FINISH status "FINISH"');
assert($strategy->getActualStatus(TaskStatusAction::ACTION_REFUSE) == TaskStatusAction::STATUS_REFUSAL, 'Problem: expected after CANCEL status "REFUSAL"');

assert(false, 'test TaskStatusAction::getActualStatus() is complete THE END');

