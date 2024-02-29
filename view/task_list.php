<?php include('view/header.php')?>

<section id='list' class="list">
    <header class="list_row list_header">
        <h1>Tasks that need doing</h1>
            <?php foreach ($tasks as $task) : ?>
                <div class="Task_list_item">
                    <div class = "task_title">
                        <p><?=$task['Title']?></p>
                    </div>
                    <div class = "task_description">
                        <p><?=$task['Description']?></p>
                    </div>
                    <form class = 'delete_button_form' action="." method="POST">
                        <input type="hidden" name="action" value="delete-task">
                        <input type="hidden" name="task" value=<?=$task['ItemNum']?>>
                        <button class="delete_task_button">-X-</button>
                    </form>
                </div>
            <?php endforeach; ?>
    </header>
</section>
<section>
    <h2>Insert Task / Create Task</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="hidden" name="action" value="insert">
        <label for="newCity">Task Name: </label>
        <input type="text" id="newName" name="task_name" required>
        <label for="countryCode">Descripton:</label>
        <input type="text" id="description" name="description" required>
        <button type="submit">Submit</button>
    </form>
</section>


<?php include('view/footer.php')?>
