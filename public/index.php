<? 
    include 'layouts/header.php';
?>
<body>
   <?
    $users = new UsersControllers();
    foreach($users->getUsers() as $user)
    {
        echo $user['name'];
    };         
   ?>
</body>
<?
    include 'layouts/footer.php'
?>