<?
class ValidatorController{
    
    /**
     * Проверка входящих значений
     * @param string $text значение для проверки
     * @return string
     */

    public function validateText(string $text): string
    {
        if(preg_match('/^[_0-9A-Za-zА-Яа-пр-яЁё]+$/', $text) === 1)
        {
            return $text;
        }else{
            
            throw new Exception('validateId - ' . $text);
        }
    }

    /**
     * Проверка входящих значений
     * @param string $text значение для проверки
     * @return string
     */

    public function validateEmail(string $string): string
    {
        if(preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $string) === 1)
        {
            return $string;
        }else{
            
            throw new Exception('validateId - ' . $string);
        }

    }

    /**
     * Проверка входящих значений
     * @param string $text значение для проверки
     * @return string
     */

    public static function validateId(string $id): int
    {
        if(preg_match('/^[0-9]*$/', intval($id)) === 1)
        {
           return $id;

        }else{

            throw new Exception('validateId - ' . $id);

        }
    }
}