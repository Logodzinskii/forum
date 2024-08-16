<? 
    include '../layouts/header.php';
    require_once '../autoload.php';
    require_once '../controllers/ValidatiorController.php';
?>
<main>
<?
    try{
    $message = new TopickControllers();
    $message = $message->createMessage($_POST);
    }catch(Exception $e)
    {
        $message = 'Ошибка валидации - ' . $e->getMessage();
    }
?>
<div class="message">
    <h2 class="error"><? echo $message ?></h2>
    <div class="big-button pages page"><a href="/">Назад</a></div>
</div>
</main>
<?
    include '../layouts/footer.php'
?>