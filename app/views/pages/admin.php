<div id="all" class="content">
    <h1>Dashboard</h1>
    <button type="button" id="new-note">New note</button>
    <table id="note-list">
        <thead>
        <tr>
            <th>Note</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<div id="create" class="content">
    <h1>New note</h1>
    <form action="<?= \app\core\Route::url('api', 'store')?>"">
        <label for="note">Note:</label>
        <input type="text" name="note" id="note"/>
        <input type="submit" value="Create note"/>
    </form>
</div>
