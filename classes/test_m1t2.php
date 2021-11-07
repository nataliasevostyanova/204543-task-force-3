<?php
/**
 * File
 * for testing if TaskStatusAction works right way
 */

require_once 'TaskStatusAction.php';


//настройки assert()
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_CALLBACK, function () {
    echo '<hr />';
    echo func_get_arg(3);
});

$strategy = new TaskStatusAction();

assert($strategy->getActualStatus(TaskStatusAction::ACTION_CANCEL) == TaskStatusAction::STATUS_UNDO, 'problem with cancel action');
assert($strategy->getActualStatus(TaskStatusAction::ACTION_RESPOND) == TaskStatusAction::STATUS_INWORK, 'problem with respond action');
assert($strategy->getActualStatus(TaskStatusAction::ACTION_FINISH) == TaskStatusAction::STATUS_FINISH, 'problem with finish action');
assert($strategy->getActualStatus(TaskStatusAction::ACTION_REFUSE) == TaskStatusAction::STATUS_REFUSAL, 'problem with refuse action');

assert(false, 'test TaskStatusAction::getActualStatus() complete');
