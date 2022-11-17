<?php 
    $notes = $news->getNews();

    if ($notes == false) 
    {
        $errMsg = "Произошла ошибка при выводе новостной ленты";
    }
    else
    {
        echo "<p>Всего новостей: " . count($notes) . " записей.</p>";
        echo "<h3> НОВОСТИ: </h3>";
        foreach ($notes as $note)
        {
            echo "<p'><a href='news.php?id={$note['id']}'> {$note['title']} | {$note['category']} </a></p>";
        }
    }
?>