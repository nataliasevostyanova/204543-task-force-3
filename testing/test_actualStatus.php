<?php
/**
 * testing class TaskStatusAction method getActualStatus
 */

require_once '../vendor/autoload.php';

use TaskForce\Task;
use TaskForce\Actions\ActionCancel;
use TaskForce\Actions\ActionRespond;
use TaskForce\Actions\ActionFinish;
use TaskForce\Actions\ActionRefuse;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_CALLBACK, function () {
    echo '<hr />';
    echo func_get_arg(3);
    echo '<hr />';
});

$strategy = new Task(2, 2, 5, 'новое');
$action = new ActionCancel(2, 2, 5, 'новое');
/*
echo '$strategy:  ';
echo '<br>';
var_dump($strategy->getActualStatus('cancel'));
echo '<br>';
echo '$action:  ';
var_dump($action->accessRightCheck(2, 2, 5, 'новое'));
echo '<br>';
var_dump($action->getInnerName());
*/
assert($strategy->getActualStatus($action->getInnerName()) == Task::STATUS_UNDO, 'Problem: status "UNDO" expected after CANCEL action');

$strategy = new Task(5, 2, 5, 'новое');
$action = new ActionRespond(5, 2, 5, 'новое');
assert($strategy->getActualStatus($action->getInnerName()) == Task::STATUS_WORKING, 'Problem: status "WORKING" expected after RESPOND action ');

$strategy = new Task(2, 2, 5, 'в работе');
$action = new ActionFinish(2, 2, 5, 'в работе');
assert($strategy->getActualStatus($action->getInnerName()) == Task::STATUS_FINISH, 'Problem: status "FINISH" expected after FINISH action');

$strategy = new Task(5, 2, 5, 'в работе');
$action = new ActionRefuse(5, 2, 5, 'в работе');
assert($strategy->getActualStatus($action->getInnerName()) == Task::STATUS_REFUSAL, 'Problem: status "REFUSAL" expected after REFUSE action');


echo '<hr/>';
echo '<h3 style="color: blue">test Actual Status completed. END</h3>';
echo '<hr/>';
