<div class="col-md-10">
    <form action="http://localhost/Lisa/Kool" class="form-horizontal" method="post" accept-charset="utf-8">
        <div class="form-group">
            <label for="name" class="control-label col-sm-offset-1 col-sm-2">Nimi</label>
            <div class="col-sm-3">
                <input type="text" name="name" value="<?=$this->input->post('name'); ?>"  class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('name'); ?></div>
        </div>
        <div class="form-group">
            <label for="phone" class="control-label col-sm-offset-1 col-sm-2">Telefon</label>
            <div class="col-sm-3">
                <input type="text" name="phone" value="<?=$this->input->post('phone'); ?>"  class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('phone'); ?></div>
        </div>
        <div class="form-group">
            <label for="email" class="control-label col-sm-offset-1 col-sm-2">E-Mail</label>
            <div class="col-sm-3">
                <input type="text" name="email" value="<?=$this->input->post('email'); ?>"  class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('email'); ?></div>
        </div>
        <div class="form-group">
            <div class="btn-group col-sm-offset-3 col-sm-10">
                <input type="submit" name="submit" value="Lisa kool"  class="btn btn-primary btn-sm" />
                <a href="http://localhost/Koolid" class="btn btn-warning btn-sm" role="button">Katkesta</a>
            </div>
        </div>
    </form>
</div>
</div>