<?

class UsersControllers {

    public $db;

    public function __construct()
    {
        $database = Database::get_instance();

        $this->db = $database->getConnection();
    }
    /**
     * Получим список пользователей, возвращает массив
     * @return array
     */

    public function getUsers() : array {

        try{
            $query = 'SELECT * FROM users';
            $stmt = $this->db->prepare($query);
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
        }catch(PDOException $e){
            $log = new FileLogWriter();
            $processor = new LoggerController($log, $e->getMessage());
            $processor->write();
        }
             
    }
    /**
     * Перед добавлением пользователя функция проверяет по email есть ли он в базе.
     * Если есть в базе то возвращает id, если нет то создает нового пользователя и возвращает id
     * @param string $userName, $userEmail, $userStatus
     * @return string @idUser
     */

    public function addUser($userName, $userEmail, $userStatus):string{
        
        $createdAt = new \DateTime('now');
        $createdAt = $createdAt->format('Y-m-d:h:i:s');
        $userStatus = $userStatus;
        /**
        * Проверим есть ли пользователь в базе данных по email
        */
        try{
            $param = [
                'user_email'=> $userEmail  ,
            ];
            $query = 'SELECT id FROM users WHERE user_email=:user_email';
            $stmt = $this->db->prepare($query);
            $stmt->execute($param);
            if($stmt->rowCount() > 0)
            {
                while ($row = $stmt->fetch(PDO::FETCH_LAZY))
                    {
    
                        $idUser = $row->id;
                                
                    }
            }else{
                $sth = $this->db->prepare("INSERT INTO `users` SET 
                    `user_name`     = :user_name, 
                    `user_email`    = :user_email,
                    `user_status`   = :user_status,
                    `created_at`    = :created_at,
                    `updated_at`    = :updated_at
                    ");
                $sth->execute([
                    'user_name'     => $userName,
                    'user_email'    => $userEmail,
                    'user_status'   => $userStatus,
                    'created_at'    => $createdAt,
                    'updated_at'    => $createdAt,
                ]);  
    
                $idUser =  $this->db->lastInsertId();
            }
    
            return $idUser;
        }catch(Exception $e){
            $log = new FileLogWriter();
            $processor = new LoggerController($log, $e->getMessage());
            $processor->write();
        }
        
    }

}