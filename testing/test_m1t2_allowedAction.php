<?php
/**
  * testing class TaskStatusAction method getAllowedAction()
  */

require_once '../vendor/autoload.php';

use TaskForce\TaskStatusAction;
use TaskForce\Actions\Action;
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

$strategy = new TaskStatusAction(4, 4, 3,'new');
$action = new ActionCancel();
/*
echo '$strategy:  ';
var_dump($strategy->getAllowedAction(4, 4, 3,'working'));
echo '<br>';
echo '$action:  ';
var_dump($action->accessRightCheck(4, 4, 3));
echo '<br>';
var_dump($action->getActionName());
*/
assert($strategy->getAllowedAction(4, 4, 3,'new') == $action->getActionName(4, 4, 3), 'Problem of client with allowed actions for status NEW');

$strategy = new TaskStatusAction(3, 4, 3,'new');
$action = new ActionRespond();
assert($strategy->getAllowedAction(3, 4, 3,'new') == $action->getActionName(3, 4, 3), 'Problem of doer with allowed actions for status NEW');

$strategy = new TaskStatusAction(3, 4, 3,'working');
$action = new ActionFinish();
assert($strategy->getAllowedAction(4, 4, 3,'working') == $action->getActionName(4, 4, 3), 'Problem of client with allowed actions for status WORKING');

$strategy = new TaskStatusAction(3, 4, 3,'working');
$action = new ActionRefuse();
assert($strategy->getAllowedAction(3, 4, 3,'working') == $action->getActionName(3, 4, 3), 'Problem of doer with allowed actions for status WORKING');

$strategy = new TaskStatusAction(10, 4, 3,'working');
$action = new ActionRefuse();
//assert($strategy->getAllowedAction(10, 4, 3,'working') == $action->getActionName(10, 4, 3), 'User does not exist');

echo '<hr/>';
echo '<h3>test Allowed Actions completed. FIN</h3>';
echo '<hr/>';

