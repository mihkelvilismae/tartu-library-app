    <div class="col-md-10">
        <form action="http://localhost/Lisa/Klass" class="form-horizontal" method="post" accept-charset="utf-8">
            <div class="form-group">
                <label for="school_id" class="control-label col-sm-offset-1 col-sm-2">Kool</label>
                <div class="col-sm-3">
                    <select name="school_id" class="btn btn-default">
                        <?=$school_options; ?>
                    </select>
                </div>
                <div class="col-sm-6 text-danger"><?=form_error('school_id'); ?></div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-sm-offset-1 col-sm-2">Klassi nimi</label>
                <div class="col-sm-3">
                    <input type="text" name="name" value="<?=$this->input->post('name'); ?>"  class="form-control" />
                </div>
                <div class="col-sm-6 text-danger"><?=form_error('name'); ?></div>
            </div>
            <div class="form-group">
                <div class="btn-group col-sm-offset-3 col-sm-10">
                    <input type="submit" name="submit" value="Lisa klass"  class="btn btn-primary btn-sm" />
                    <a href="http://localhost/Klassid" class="btn btn-warning btn-sm" role="button">Katkesta</a>
                </div>
            </div>
        </form>
    </div>
</div>