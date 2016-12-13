<div class="col-md-10">
    <form action="<?=$form_action; ?>" class="form-horizontal" method="post" accept-charset="utf-8">
        <div class="form-group">
            <label for="class_id" class="control-label col-sm-offset-1 col-sm-2">Klass</label>
            <div class="col-sm-3">
                <select name="class_id" id="class_id" class="btn btn-default">
                    <?=$classes; ?>
                </select>
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('class_id'); ?></div>
        </div>
        <div class="form-group">
            <label for="book_id" class="control-label col-sm-offset-1 col-sm-2">Raamat</label>
            <div class="col-sm-3">
                <select name="book_id" id="book_id" class="btn btn-default">
                    <?=$books; ?>
                </select>
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('book_id'); ?></div>
        </div>
        <div class="form-group">
            <div class="btn-group col-sm-offset-3 col-sm-10">
                <input type="submit" name="submit" value="Lisa nimekirja"  class="btn btn-primary btn-sm" />
                <a href="<?=$cancel_link; ?>" class="btn btn-warning btn-sm" role="button">Katkesta</a>
            </div>
        </div>
    </form>
</div>
</div>