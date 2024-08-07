<?
class TopickControllers{

    public function getTopic() : array {
        $database = Database::get_instance();

        $db = $database->getConnection();

        $query = 'SELECT * FROM topics';
            $stmt = $db->prepare($query);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_LAZY))
                {
                    $res[] = [
                        'topic_name'=>$row->name,
                        'id'=>$row->id,
                    ];
                }                    
            }else{
                http_response_code(404);
                return false;
            }
        return $res;
    }
}
?>