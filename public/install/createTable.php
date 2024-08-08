<?

require_once '../autoload.php';

class createTable {

    /**
     * Создание таблицы пользователей
     * @return void
     */
    public function createUsers() : void {

        $table = 'users';
        $sql ="CREATE TABLE IF NOT EXISTS $table(
            ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
            user_name VARCHAR( 250 ) NOT NULL,
            user_email VARCHAR( 250 ) NOT NULL UNIQUE,
            user_status VARCHAR( 150 ) NOT NULL,
            created_at TIMESTAMP NOT NULL,
            updated_at TIMESTAMP NOT NULL
           );";

        echo $this->createTable($table, $sql);
               
    }

    /**
     * Создание таблицы тем форума
     * @return void
     */
    public function create_Topic() : void {
        
        $table = 'topics';
        $sql ="CREATE TABLE IF NOT EXISTS $table(
            ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            INDEX par_ind (user_id),
                FOREIGN KEY (user_id)
                REFERENCES users(id)
                ON DELETE CASCADE,
            topic_name VARCHAR( 250 ) NOT NULL,
            topic_descryption VARCHAR( 250 ) NOT NULL,
            created_at TIMESTAMP NOT NULL,
            updated_at TIMESTAMP NOT NULL
            );";
        
        echo $this->createTable($table, $sql);
    }

    /**
     * Создание таблицы сообщений форума
     * @return void
     */
    public function create_Messages() : void {
        
        $table = 'messages';
        $sql ="CREATE TABLE IF NOT EXISTS $table(
            ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
            user_id INT( 250 ) NOT NULL,
            INDEX use_ind (user_id),
                FOREIGN KEY (user_id)
                REFERENCES users(id)
                ON DELETE CASCADE,
            topic_id INT( 250 ) NOT NULL,
            INDEX top_ind (topic_id),
                FOREIGN KEY (topic_id)
                REFERENCES topics(id)
                ON DELETE CASCADE,
            user_message TEXT NOT NULL,
            created_at TIMESTAMP NOT NULL,
            updated_at TIMESTAMP NOT NULL);";
        
        echo $this->createTable($table, $sql);
    }

    private function createTable($table, $sql) : string {
        
        $result = '';
        
        try{
            
            $database = Database::get_instance();
            $db = $database->getConnection();
    
            $db->exec($sql);

            $result = "Таблица ". $table ." создана успешно";

        }               
        catch(PDOException $e)  {

            $result = "Ошибка при создании таблицы: " . $e->getMessage();

        } 

        return $result; 
    }
        
}

$table = new createTable();
$table->createUsers();
$table->create_Topic();
$table->create_Messages();

?>