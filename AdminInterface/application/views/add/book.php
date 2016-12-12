    <div class="col-md-10">
        <form action="http://localhost/Lisa/Raamat" class="form-horizontal" method="post" accept-charset="utf-8">
            <div class="form-group">
                <label for="title" class="control-label col-sm-offset-1 col-sm-2">Raamatu nimi</label>
                <div class="col-sm-3">
                    <input type="text" name="title" value="<?=$this->input->post('title'); ?>" class="form-control" />
                </div>
                <div class="col-sm-6 text-danger"><?=form_error('title'); ?></div>
            </div>
            <div class="form-group">
                <label for="lang" class="control-label col-sm-offset-1 col-sm-2">Keel</label>
                <div class="col-sm-3">
                    <input type="text" name="lang" value="<?=$this->input->post('lang'); ?>" class="form-control" />
                </div>
                <div class="col-sm-6 text-danger"><?=form_error('lang'); ?></div>
            </div>
            <div class="form-group">
                <label for="year" class="control-label col-sm-offset-1 col-sm-2">Aasta</label>
                <div class="col-sm-3">
                    <input type="text" name="year" value="<?=$this->input->post('year'); ?>" class="form-control" />
                </div>
                <div class="col-sm-6 text-danger"><?=form_error('year'); ?></div>
            </div>
            <div class="form-group">
                <div class="btn-group col-sm-offset-3 col-sm-10">
                    <input type="submit" name="submit" value="Lisa raamat" class="btn btn-primary btn-sm" />

                    <a href="http://localhost/Raamatud" class="btn btn-warning btn-sm" role="button">Katkesta</a>
                </div>
            </div>
        </form>
    </div>
</div>