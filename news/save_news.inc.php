<?php
    if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['source']) && !empty($_POST['category']))
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $source = $_POST['source'];
        $category = $_POST['category'];
        $result = $news->saveNews($title,$category,$description,$source);
        
        if($result)
        {
            header('Location: news.php');
        } 
        else 
        {
            $errMsg = 'Произошла ошибка при добавлении новости';
        }
    } 
    else 
    {
        $font = 'bold';
        $color = 'red';
        $errMsg = "<p style = 'font-weight: {$font}; color: {$color}'> Заполните все поля формы!</p>";
    }
?>