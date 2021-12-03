<?php
/**
  * testing class TaskStatusAction method getAllowedAction()
  */

require_once '../vendor/autoload.php';

use TaskForce\Task;
use TaskForce\Actions\ActionCancel;
use TaskForce\Actions\ActionRespond;
use TaskForce\Actions\ActionFinish;
use TaskForce\Actions\ActionRefuse;


assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_CALLBACK, function() {
    echo '<hr />';
    echo func_get_arg(3);
    echo '<hr />';
});

$strategy = new Task(4, 4, 3,'новое');
$action = new ActionCancel();
/*
echo '$strategy:  ';
echo '<br>';
var_dump($strategy->getActions());
echo '<br>';
var_dump($strategy->getStatuses());
echo '<br>';
var_dump($strategy->getAllowedAction(4, 4, 3,'новое'));
echo '<br>';
echo '$action:  ';
var_dump($action->accessRightCheck(4, 4, 3, 'новое'));
echo '<br>';
var_dump($action->getActionName());
*/

assert($strategy->getAllowedAction(4, 4, 3,'новое') == $action->getActionName(4, 4, 3), 'Problem of client with allowed actions for status NEW');

$strategy = new Task(3, 4, 3,'новое');
$action = new ActionRespond();
assert($strategy->getAllowedAction(3, 4, 3,'новое') == $action->getActionName(3, 4, 3), 'Problem of doer with allowed actions for status NEW');

$strategy = new Task(3, 4, 3,'в работе');
$action = new ActionFinish();
assert($strategy->getAllowedAction(4, 4, 3,'в работе') == $action->getActionName(4, 4, 3), 'Problem of client with allowed actions for status WORKING');

$strategy = new Task(3, 4, 3,'в работе');
$action = new ActionRefuse();
assert($strategy->getAllowedAction(3, 4, 3,'в работе') == $action->getActionName(3, 4, 3), 'Problem of doer with allowed actions for status WORKING');

$strategy = new Task(10, 4, 3,'в работе');
$action = new ActionRefuse();

//assert($strategy->getAllowedAction(10, 4, 3,'working') == $action->getActionName(10, 4, 3), 'User does not exist');

echo '<hr/>';
echo '<h3 style="color: red">test Allowed Actions completed. FIN</h3>';
echo '<hr/>';

