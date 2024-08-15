<? 
    include '../layouts/header.php';
    require_once '../autoload.php';
    require_once '../controllers/ValidatiorController.php';
?>
<main>
<?

    $topic = new TopickControllers();
    try{
        $topic = $topic->createTopic($_POST);
        
    }catch(Exception $e)
    {
        $topic = 'Ошибка валидации - ' . $e->getMessage();
    }
    
?>
<div class="message">
    <h2 class="error"><? echo $topic ?></h2>
    <div class="big-button pages page"><a href="/">Назад</a></div>
</div>
</main>
<?
    include '../layouts/footer.php'
?>