<?

class TopickControllers{

    public $db;
    public $limit, $curentPage;

    public function __construct()
    {
        $database = Database::get_instance();

        $this->db = $database->getConnection();
        $this->limit = 10;
        $this->curentPage = isset($_GET['page'])?$_GET['page'] : 1;
    }

    /**
     * Получим все темы форума
     * @return array
     */
    public function getTopic() : array {
        
        $countTopic = '';
        $topic = [];
        $link = '/';
        $pagination = new PaginatorControllers($this->curentPage, $this->limit, $link);
        
        
            $query = 'SELECT topics.id, topics.topic_name, topics.topic_descryption, topics.user_id, users.user_name, users.created_at, count(*) as count_message, 
                                              (SELECT user_id FROM messages WHERE topic_id = topics.id order by created_at DESC limit 1 ) as id_last_user,
                                              (SELECT created_at FROM messages WHERE topic_id = topics.id order by created_at DESC limit 1 ) as messages_created_at,
                                              (SELECT user_name FROM users WHERE id = id_last_user ) as last_user_name,
                                              (SELECT COUNT(*) FROM topics) as count_topic
                                               FROM topics
                                               LEFT JOIN users ON users.id = topics.user_id 
                                               LEFT JOIN messages ON messages.topic_id = topics.id                                             
                                               GROUP BY topics.id
                                               LIMIT '.$this->limit.'
                                               OFFSET '.$pagination->getOffset().'';
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_LAZY))
                {
                    $topic[] = [
                        'topic_id'=>$row->id,
                        'topic_name'=>$row->topic_name,
                        'topic_descryption'=>$row->topic_descryption,
                        'user_name'=>$row->user_name,
                        'last_user_name'=>$row->last_user_name,
                        'messages_created_at'=>$row->messages_created_at,
                        'count_message'=>$row->count_message,
                    ];
                    $countTopic = $row->count_topic;
                }

                $pagination->setCount($countTopic);

            }else{
                
                $topic[] = [
                    'noTopic'=>'Тем нет',
                ];

                $pagination->setCount($countTopic);
            }

        $pagination = $pagination->pagination();
        return ['topic'=>$topic, 'pages'=>$pagination];
    }

    /**
     * Получим все сообщения по id темы
     * @param integer $id
     * @return array
     */

    public function getTopicMessage($id) : array {    
    $topic = [];

    $countTopic = 0;
    $topic = [];
    
    $link = 'topic='.$id;
        
    $pagination = new PaginatorControllers($this->curentPage, $this->limit, $link);

        $query = 'SELECT messages.id,
         messages.user_message,
          messages.user_id,
           messages.created_at as created_at,
            topics.topic_name as topic_name,
             topics.topic_descryption,
              topics.id as topic_id,
               users.user_name as user_name, 
                           (SELECT COUNT(*) FROM messages WHERE topic_id = "'.$id.'") as count_topic
                           FROM messages
                           LEFT JOIN users ON users.id = messages.user_id
                           LEFT JOIN topics ON topics.id = messages.topic_id
                           WHERE topic_id = "'.$id.'"
                           GROUP BY messages.id
                           LIMIT '.$this->limit.'
                           OFFSET '.$pagination->getOffset().'';
            
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            while ($row = $stmt->fetch(PDO::FETCH_LAZY))
            {
                $topic[] = [
                    'topic_id'=>$row->topic_id,
                    'topic_name'=>$row->topic_name,
                    'topic_descryption'=>$row->topic_descryption,
                    'message_name'=>$row->user_message,
                    'user_name'=>$row->user_name,
                    'messages_created_at'=>$row->created_at,
                ];
                
                $countTopic = $row->count_topic;
                
            }  
            
            $pagination->setCount($countTopic); 
            
        }else{

            $query = 'SELECT id, topic_name  FROM topics 
                           WHERE id = "'.$id.'"';
                           
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $pagination->setCount($countTopic);
        if($stmt->rowCount() > 0)
        while ($row = $stmt->fetch(PDO::FETCH_LAZY))
            {
                $topic[] = [
                    'topic_id'=>$row->id,
                    'topic_name'=>$row->topic_name,
                    'noTopic'=>'Сообщений нет<br/>',
                ];
            }
        }           
  
        $pagination = $pagination->pagination();
        return ['topic'=>$topic, 'pages'=>$pagination];
    }

    /**
     * создание темы
     * @param $post
     * @return string
     */

    public function createTopic($post) : string {

        $validator = new ValidatorController();
        $userName = $validator->validateText($post['user_name']);
        $userEmail = $validator->validateEmail($post['user_email']);
        $userStatus = 'user';
        /**
         * Добавим пользователя в базу данных Users и получим его id
         */
        $idUser = new UsersControllers;
        $idUser = $idUser->addUser($userName, $userEmail, $userStatus);        

        $topicName = $post['topic_name'];
        $topicDescryption = $post['topic_descryption'];

        $createdAt = new \DateTime('now');
        $createdAt = $createdAt->format('Y-m-d:h:i:s');
        
        try{
            
            /**
            * Создадим тему и присвоим id пользователя, которого создали только что
            */
            $sth = $this->db->prepare("INSERT INTO `topics` SET
            `user_id`           = :user_id, 
            `topic_name`        = :topic_name, 
            `topic_descryption` = :topic_descryption,
            `created_at`        = :created_at,
            `updated_at`        = :updated_at");
            
            $sth->execute([
                'user_id'           => $idUser,
                'topic_name'        => $topicName,
                'topic_descryption' => $topicDescryption,
                'created_at'        => $createdAt,
                'updated_at'        => $createdAt,
            ]);

            return 'Тема успешно создана';    

        }catch(PDOException $e){

            $this->db->rollback();

            return $e->getMessage();
        }

    }

    /**
     * создание сообщения
     * @param $post
     * @return array
     */

    public function createMessage($post) : string {

        $validator = new ValidatorController();

        $userName = $validator->validateText($post['user_name']);
        $userEmail = $validator->validateEmail($post['user_email']);
        $userStatus = 'user';
        $idUser = new UsersControllers;
        $idUser = $idUser->addUser($userName, $userEmail, $userStatus);
        $topicId = $validator->validateId($post['topic_id']);
        $userMessage = $post['user_message'];

        $createdAt = new \DateTime('now');
        $createdAt = $createdAt->format('Y-m-d:h:i:s');
        
        try{

            $this->db->beginTransaction();
            
            /**
            * Создадим сообщение в теме и присвоим id темы и id пользователя, которого создали только что
            */
            $sth = $this->db->prepare("INSERT INTO `messages` SET
            `user_id`           = :user_id, 
            `topic_id`          = :topic_id, 
            `user_message`      = :user_message,
            `created_at`        = :created_at,
            `updated_at`        = :updated_at");
            
            $sth->execute([
                'user_id'           => $idUser,
                'topic_id'          => $topicId,
                'user_message'      => $userMessage,
                'created_at'        => $createdAt,
                'updated_at'        => $createdAt,
            ]);

            $this->db->commit();

            return 'Сообщение успешно создано';    

        }catch(PDOException $e){

            $this->db->rollback();

            return $e->getMessage();
        }

    }

}
?>