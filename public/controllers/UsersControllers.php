<?

class UsersControllers {

    public function getUsers() : array {
        
        $database = Database::get_instance();

        $db = $database->getConnection();

        $query = 'SELECT * FROM topic';
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