<?php
    require_once('INewsDB.class.php');

    class NewsDB implements INewsDB
    {
        const DB_NAME = 'C:\OSPanel\domains\localhost\news\news.db';
        private $_db;

        function __construct()
        {
            if (!file_exists(self::DB_NAME))
            {
                $this->_db = new SQLite3(self::DB_NAME);
                //echo "Database created successfully";
                $sql = array(
                    "CREATE TABLE msgs(
                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                        title TEXT,
                        category INTEGER,
                        description TEXT,
                        source TEXT,
                        datetime INTEGER)",

                    "CREATE TABLE category(
                        id INTEGER,
                        name TEXT)",
                        
                    "INSERT INTO category(id, name)
                     SELECT 1 as id, 'Политика' as name
                     UNION SELECT 2 as id, 'Культура' as name
                     UNION SELECT 3 as id, 'Спорт' as name");
              
                foreach ($sql as $item) 
                {
                  $this->_db->exec($item);
                }
            }
            $this->_db = $this->_db instanceof SQLite3 ? $this->_db : new SQLite3(self::DB_NAME);
        }
      
        function __destruct()
        {
            unset($this->_db);
        }
        
        function saveNews($title, $category, $description, $source)
        {
            $dt = time();
            $sql = 'INSERT INTO msgs(title,category,description,source,datetime) 
            	    VALUES(:title,:category,:description,:source,$dt)';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':title',$title);
            $stmt->bindParam(':category',$category);
            $stmt->bindParam(':description',$description);
            $stmt->bindParam(':source',$source);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
       
        function getNews()
        {
            $sql = "SELECT msgs.id as id, title, category.name as category, description, source, datetime 
                    FROM msgs, category
                    WHERE category.id = msgs.category
                    ORDER BY msgs.id DESC";
            $result = $this->_db->query($sql);
            $arr = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) 
            {
                $arr[] = $row;
            }
            return $arr;
        }
       
        function showNews($id)
        {
            $sql = "SELECT * FROM msgs WHERE id = $id";
            $result = $this->_db->query($sql);
            $arr = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) 
            {
                $arr[] = $row;
            }
            return $arr;
        }
    }
    //$news = new NewsDB();
?>