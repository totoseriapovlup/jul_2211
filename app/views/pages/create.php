<h1>New note</h1>
<form action="<?= \app\core\Route::url('admin', 'store')?>" method="post">
    <label for="note">Note:</label>
    <input type="text" name="note" id="note"/>
    <input type="submit" value="Create note"/>
</form>