<?
class TopickControllers{

    public function getTopic() : array {

        $database = Database::get_instance();

        $db = $database->getConnection();
        
        $topic = [];

            $query = 'SELECT topics.id, topics.topic_name, topics.user_id, users.user_name, users.created_at, count(*) as count_message, 
                                              (SELECT user_id FROM messages WHERE topic_id = topics.id order by created_at DESC limit 1 ) as id_last_user,
                                              (SELECT created_at FROM messages WHERE topic_id = topics.id order by created_at DESC limit 1 ) as messages_created_at,
                                              (SELECT user_name FROM users WHERE id = id_last_user ) as last_user_name
                                               FROM topics
                                               LEFT JOIN users ON users.id = topics.user_id 
                                               LEFT JOIN messages ON messages.topic_id = topics.id                                             
                                               GROUP BY topics.id';
            $stmt = $db->prepare($query);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_LAZY))
                {
                    $topic[] = [
                        'topic_id'=>$row->id,
                        'topic_name'=>$row->topic_name,
                        'user_name'=>$row->user_name,
                        'last_user_name'=>$row->last_user_name,
                        'messages_created_at'=>$row->messages_created_at,
                        'count_message'=>$row->count_message,
                    ];
                }     
            }else{
                
                $topic[] = [
                    'noTopic'=>'Тем нет',
                ];
            }           
      
        return $topic;
    }

    public function getTopicMessage($id) : array {
        echo $id;
    $database = Database::get_instance();

    $db = $database->getConnection();
    
    $topic = [];

        $query = 'SELECT messages.user_message, messages.user_id, messages.created_at as created_at, users.user_name as user_name FROM messages 
                           LEFT JOIN users ON users.id = messages.user_id
                           WHERE topic_id = "'.$id.'"
                           ';
        $stmt = $db->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            while ($row = $stmt->fetch(PDO::FETCH_LAZY))
            {
                $topic[] = [
                    'topic_id'=>$row->id,
                    'topic_name'=>$row->user_message,
                    'user_name'=>$row->user_name,
                    'messages_created_at'=>$row->created_at,
                ];
            }     
        }else{
            
            $topic[] = [
                'noTopic'=>'Тем нет',
            ];
        }           
  
    return $topic;
}

}
?>