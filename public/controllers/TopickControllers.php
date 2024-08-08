<?
class TopickControllers{

    public function getTopic() : array {

        $database = Database::get_instance();

        $db = $database->getConnection();
        
        $topic = [];
        
        
        $db->beginTransaction();

            $query = 'SELECT topic_name, id FROM topics';
            $stmt = $db->prepare($query);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_LAZY))
                {
                    $topic[] = [
                        'topic_name'=>$row->topic_name,
                        'id'=>$row->id,
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