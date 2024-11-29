<h1>Dashboard</h1>
<a href="<?= \app\core\Route::url('admin', 'create')?>">New note</a>
<table>
    <thead>
        <tr>
            <th>Note</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php if(count($notes) > 0):?>
        <?php foreach ($notes as $note):?>
        <tr>
            <td><?= $note['name']?></td>
            <td>
                <form action="<?= \app\core\Route::url('admin', 'destroy')?>" method="post">
                    <input type="hidden" name="id" value="<?= $note['id']?>"/>
                    <input type="submit" value="Delete"/>
                </form>
            </td>
        </tr>
        <?php endforeach;?>
    <?php endif;?>
</table>