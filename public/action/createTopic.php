<?
    
    require_once '../autoload.php';

    $topic = new TopickControllers();
    $topic = $topic->createTopic($_POST);

?>

<div class="message">
    <h2><? echo $topic ?></h2>
    <a href="/">Назад</a>
</div>