<div class="col-md-10">
    <form action="http://localhost/Lisa/Kasutaja" class="form-horizontal" method="post" accept-charset="utf-8">
        <div class="form-group">
            <label for="firstname" class="control-label col-sm-offset-1 col-sm-2">Eesnimi</label>
            <div class="col-sm-3">
                <input type="text" name="firstname" value="<?=$this->input->post('firstname'); ?>" class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('firstname'); ?></div>
        </div>
        <div class="form-group">
            <label for="lastname" class="control-label col-sm-offset-1 col-sm-2">Perenimi</label>
            <div class="col-sm-3">
                <input type="text" name="lastname" value="<?=$this->input->post('lastname'); ?>" class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('lastname'); ?></div>
        </div>
        <div class="form-group">
            <label for="email" class="control-label col-sm-offset-1 col-sm-2">E-Mail</label>
            <div class="col-sm-3">
                <input type="text" name="email" value="<?=$this->input->post('email'); ?>"  class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('email'); ?></div>
        </div>
        <div class="form-group">
            <label for="password" class="control-label col-sm-offset-1 col-sm-2">Parool</label>
            <div class="col-sm-3">
                <input type="password" name="password" class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('password'); ?></div>
        </div>
        <div class="form-group">
            <label for="phone" class="control-label col-sm-offset-1 col-sm-2">Telefon</label>
            <div class="col-sm-3">
                <input type="text" name="phone" value="<?=$this->input->post('phone'); ?>"  class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('phone'); ?></div>
        </div>
        <div class="form-group">
            <label for="is_admin" class="control-label col-sm-offset-1 col-sm-2">Admin</label>
            <div class="col-sm-3">
                <div class="form-control no-border no-padding">
                <input type="checkbox" name="is_admin"<?=$this->input->post('is_admin') ? ' checked' : ''; ?> />
                </div>
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('is_admin'); ?></div>
        </div>
        <div class="form-group">
            <div class="btn-group col-sm-offset-3 col-sm-10">
                <input type="submit" name="submit" value="Lisa kasutaja" class="btn btn-primary btn-sm" />
                <a href="http://localhost/Kasutajad" class="btn btn-warning btn-sm" role="button">Katkesta</a>
            </div>
        </div>
    </form>
</div>
</div>