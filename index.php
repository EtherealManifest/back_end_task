<?php
require('model/database.php');
require ('model/todolist_db.php');

$description = filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW);
$task_name = filter_input(INPUT_POST, 'task_name', FILTER_UNSAFE_RAW);
$task_num = filter_input(INPUT_POST, 'task', FILTER_UNSAFE_RAW);
#THis action here is what we use in the switch case. In our form, we add a hidden field
#that holds a value with this attribute, and we use that to determine what happens here.
$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
$message = filter_input(INPUT_GET, 'message', FILTER_UNSAFE_RAW);

if($message){
    echo $message;
}

if(!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if(!$action) {
        $action = 'list_tasks';
    }
}

#echo($action);
 switch($action) {
    case 'insert':
        add_task($task_name, $description);
        header("Location: .?action=list_tasks");
    case 'delete-task':
        delete_item($task_num);
        header("Location: .?action=list_tasks");
    default:
        $tasks = get_todo_list();
        include('view/task_list.php');

 }
?>