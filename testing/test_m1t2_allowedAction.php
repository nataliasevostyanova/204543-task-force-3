<?php
/**
  * testing class TaskStatusAction method getAllowedAction()
  */

require_once '../vendor/autoload.php';

use TaskForce\TaskStatusAction;
use TaskForce\Actions\Action;
use TaskForce\Actions\ActionCancel;
use TaskForce\Actions\ActionRefuse;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);
assert_options(ASSERT_CALLBACK, function() {
    echo '<hr />';
    echo func_get_arg(3);
    echo '<hr />';
});

$strategy = new TaskStatusAction(4, 4, 3,'new');
//var_dump($strategy->getUserAllowedAction(4, 4, 3,'new'));

assert($strategy->getUserAllowedAction(4, 4, 3,'new') == 'cancel', 'Problem of client with allowed actions for status NEW');
assert($strategy->getUserAllowedAction(3, 4, 3,'new') == 'respond', 'Problem of doer with allowed actions for status NEW');

assert($strategy->getUserAllowedAction(4, 4, 3,'working') == 'finish', 'Problem of client with allowed actions for status WORKING');
assert($strategy->getUserAllowedAction(3, 4, 3,'working') == 'refuse', 'Problem of client with allowed actions for status WORKING');

//assert($strategy->getUserAllowedAction(10, 4, 3,'working') == 'refuse', 'User does not exist');

echo '<hr/>';
echo '<h3>test Allowed Actions is complete. FIN</h3>';
echo '<hr/>';

