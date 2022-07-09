<table>
    <thead>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
    </thead>
    <tbody>
        <?php foreach ($response["users"] as $user): ?>
            <td><?= $user->ID ?></td>
            <td><?= $user->name ?></td>
            <td><?= $user->email ?></td>
        <?php endforeach ?>
    </tbody>
</table>