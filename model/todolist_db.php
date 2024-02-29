<!--Create, Read, Update, Delete operations -->
<!--Because we arent ever "targeting" a specific task, Update will not be needed. Deleting and recreating
the Object will be enough for our purposes -->
<!-- Each of these will need to connect to the db variable, our php Data Object.-->
<?php
#get the full list of the items currently in the todo list
function get_todo_list(){
    global $db;
    #Our query will be run on the database, so in this case it needs everything from our task list.
    $query = 'SELECT * FROM `todoitem`';
    $statement = $db->prepare($query);
    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor();
    return $items;
}

#add a new item to the task list
function add_task($itemTitle, $itemDescription){
    global $db;
    #in the statements below, the :names are placeholders, they are filled in later. they could also 
    #be changed to ?, and assigned the same way, but naming them makes keeping track of the
    #assginment easier.
    if($itemTitle){
        if($itemDescription){
            $query = "INSERT INTO todoitem (Title, Description) 
            VALUES (:itemTitle, :itemDescription)";
        }
        else{
            $query = "INSERT INTO todoitem (Title, Description) 
            VALUES (:itemTitle, '')";
        }
    } else {
        return;
    }
    $statement = $db->prepare($query);
    $statement->bindValue(':itemTitle', $itemTitle);
    $statement->bindValue(':itemDescription', $itemDescription);
    $statement->execute();
    #there is no new data to display, so nothing needs to be returned
    $statement->closeCursor();
}
    
function delete_item($item_num){
    global $db;
    if($item_num){
        $query = "DELETE FROM `todoitem` WHERE ItemNum = :itemNum";
    } else {
        header("Location: index.php?message=Item Does Not Exist");
    }
    $statement = $db->prepare($query);
    $statement->bindValue(':itemNum', $item_num);
    $statement->execute();
    #there is no new data to display, so nothing needs to be returned
    $statement->closeCursor();
}
?>