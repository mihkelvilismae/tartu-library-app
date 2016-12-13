<div class="col-md-10">
    <form action="<?=$form_action; ?>" class="form-horizontal" method="post" accept-charset="utf-8">
        <div class="form-group">
            <label for="class_id" class="control-label col-sm-offset-1 col-sm-2">Klass</label>
            <div class="col-sm-3">
                <select name="class_id" class="btn btn-default">
                    <?=$class_options; ?>
                </select>
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('class_id'); ?></div>
        </div>

        <div class="form-group">
            <label for="year" class="control-label col-sm-offset-1 col-sm-2">Raamatud</label>
            <div class="col-sm-4">
                <ul class="list-group no-padding">
                    <?=$books; ?>
                </ul>
            </div>
            <div class="col-sm-5"></div>
        </div>
        <div class="form-group">

            <div class="btn-group col-sm-offset-3 col-sm-10">
                <input type="submit" name="submit" value="Muuda nimekirja" class="btn btn-primary btn-sm" />
                <a href="http://localhost/Nimekiri" class="btn btn-warning btn-sm" role="button">Katkesta</a>
            </div>
        </div>
    </form>
</div>
</div>