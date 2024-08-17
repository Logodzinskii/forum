<?

class AnaliticControllers{

    public $db;

    public function __construct()
    {
        $database = Database::get_instance();

        $this->db = $database->getConnection();
        
    }

    public function countTopic(): int
    {
        $countTopic = 0;
        $query = 'SELECT count(*) as count_topic FROM topics';
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_LAZY))
                {
                    $countTopic = $row->count_topic;
                }

            }
        return $countTopic;
    }

    public function countMesseg(): int
    {
        $countMessage = 0;
        $query = 'SELECT count(*) as count_message FROM messages';
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_LAZY))
                {
                    $countMessage = $row->count_message;
                }

            }
        return $countMessage;
    }

    public function countUser(): int
    {
        $countUser = 0;
        $query = 'SELECT count(*) as count_user FROM users';
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_LAZY))
                {
                    $countUser = $row->count_user;
                }

            }
        return $countUser;
    }

}