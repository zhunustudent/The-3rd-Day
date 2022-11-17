<?php
    $id = $_GET['id'];
    $notes = $news->showNews($id);

    if($id)
    {
        if(!$news->showNews($id))
        {
            $errMsg = "Произошла ошибка при просмотре новостей";
        } 
        else 
        {
            foreach ($notes as $note)
            {
                echo "<h3>{$note['title']} </h3>
                <p>' {$note['description']} ' </p>
                <p><a href='{$note['source']}'> {$note['source']} </a></p>";
            }
        }
    }
?>