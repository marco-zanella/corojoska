<form method="POST" action="users">
    <input type="text" name="username" placeholder="Username">
    <input type="text" name="name">
    <input type="text" name="surname">
    <button>Add</button>
</form>


Users:
<?php foreach ($users as $user): ?>
<div style="border: 1px solid #CCC; margin: 1em">
    Name: <?= $user->name ?> <?= $user->surname ?><br>
    Username: <?= $user->username ?><br>
    Id: <?= $user->id ?><br>
    Actions:
    <form method="POST" action="users/<?= $user->id ?>">
        <input type="hidden" name="_method" value="DELETE">
        <button>deete</button>
    </form>
    <form method="POST" action="users/<?= $user->id ?>">
        <input type="hidden" name="_method" value="PUT">
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="name">
        <input type="text" name="surname">
        <button>Update</button>
    </form>

</div>
<?php endforeach; ?>
