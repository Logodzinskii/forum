<?
    
    require_once '../autoload.php';

    $message = new TopickControllers();
    $message = $message->createMessage($_POST);

?>

<div class="message">
    <h2><? echo $message ?></h2>
    <a href="/">Назад</a>
</div>