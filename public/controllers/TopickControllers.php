<?
class TopickControllers{

    public function getTopic() : array {
        $database = Database::get_instance();

        $db = $database->getConnection();

        $query = 'SELECT * FROM users';
            $stmt = $db->prepare($query);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_LAZY))
                {
                    $res[] = [
                        'name'=>$row->name,
                        'status'=>$row->status,
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