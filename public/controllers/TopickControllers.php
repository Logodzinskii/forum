<?
class TopickControllers{

    public function getTopic() : array {
        $database = Database::get_instance();

        $db = $database->getConnection();

        $query = 'SELECT user_id, topic_name, id, count(id) as count_topic FROM topics GROUP BY id';
            $stmt = $db->prepare($query);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_LAZY))
                {
                    $res[] = [
                        'topic_name'=>$row->topic_name,
                        'id'=>$row->id,
                    ];
                }     
            }else{
                
                $res[] = [
                    'noTopic'=>'Тем нет',
                ];
            }
        return $res;
    }
    
}
?>