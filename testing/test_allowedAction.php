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

$task = new Task(4, 4, 3,'new');
$al_action = array_shift($task->getAllowedAction(4, 4, 3,'new'));
$action = new ActionCancel();

echo '$task:  ';
/*echo '<pre>';
var_dump($task->getAction());
echo '</pre>';
echo '<pre>';
var_dump($task->getStatus());
echo '</pre>';
*/
var_dump($task->getAllowedAction(4, 4, 3,'new'));
echo '<br>';
var_dump($al_action);
echo '<br>';
echo '$action:  ';
var_dump($action->accessRightCheck(4, 4, 3, 'new'));
echo '<br>';
var_dump($action->getInnerName());

assert($al_action == $action->getInnerName(4, 4, 3), 'Problem of client with allowed actions for status NEW');

$task = new Task(3, 4, 3,'new');
$al_action = array_shift($task->getAllowedAction(3, 4, 3,'new'));
$action = new ActionRespond();
assert($al_action == $action->getInnerName(3, 4, 3), 'Problem of doer with allowed actions for status NEW');


$task = new Task(4, 4, 3,'working');
$al_action = array_shift($task->getAllowedAction(4, 4, 3,'working'));
$action = new ActionFinish();
assert($al_action== $action->getInnerName(4, 4, 3), 'Problem of client with allowed actions for status WORKING');


$task = new Task(3, 4, 3,'working');
$al_action = array_shift($task->getAllowedAction(3, 4, 3,'working'));
$action = new ActionRefuse();

assert($al_action == $action->getInnerName(3, 4, 3), 'Problem of doer with allowed actions for status WORKING');

$task = new Task(10, 4, 3,'working');
$al_action = array_shift($task->getAllowedAction(10, 4, 3,'working'));
$action = new ActionRefuse();

//assert($al_action == $action->getInnerName(10, 4, 3), 'User does not exist');

echo '<hr/>';
echo '<h3 style="color: red">test Allowed Actions completed. FIN</h3>';
echo '<hr/>';

