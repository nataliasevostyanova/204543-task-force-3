<?php
/**
 *
 * testing class TaskStatusAction method getActualStatus
 */

require_once '../classes/TaskStatusAction.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_CALLBACK, function () {
    echo '<hr />';
    echo func_get_arg(3);
    echo '<hr />';
});


$strategy = new TaskStatusAction(5, 2);

assert($strategy->getActualStatus(TaskStatusAction::ACTION_CANCEL) == TaskStatusAction::STATUS_UNDO, 'Problem with cancel action: expected status "UNDO"');
assert($strategy->getActualStatus(TaskStatusAction::ACTION_RESPOND) == TaskStatusAction::STATUS_WORKING, 'Problem with respond action: expected status "WORKING"');
assert($strategy->getActualStatus(TaskStatusAction::ACTION_FINISH) == TaskStatusAction::STATUS_FINISH, 'Problem with finish action: expected status "FINISH"');
assert($strategy->getActualStatus(TaskStatusAction::ACTION_REFUSE) == TaskStatusAction::STATUS_REFUSAL, 'Problem with refuse action; expected status "REFUSAL"');

assert(false, 'test TaskStatusAction::getActualStatus() is complete THE END');

