<div class="col-md-10">
    <form action="<?=$form_action; ?>" class="form-horizontal" method="post" accept-charset="utf-8">
        <div class="form-group">
            <label for="name" class="control-label col-sm-offset-1 col-sm-2">Nimi</label>
            <div class="col-sm-3">
                <input type="text" name="name" value="<?=$name; ?>"  class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('name'); ?></div>
        </div>
        <div class="form-group">
            <label for="phone" class="control-label col-sm-offset-1 col-sm-2">Telefon</label>
            <div class="col-sm-3">
                <input type="text" name="phone" value="<?=$phone; ?>"  class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('phone'); ?></div>
        </div>
        <div class="form-group">
            <label for="email" class="control-label col-sm-offset-1 col-sm-2">E-Mail</label>
            <div class="col-sm-3">
                <input type="text" name="email" value="<?=$email; ?>"  class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('email'); ?></div>
        </div>
        <div class="form-group">
            <div class="btn-group col-sm-offset-3 col-sm-10">
                <input type="submit" name="submit" value="Muuda kooli"  class="btn btn-primary btn-sm" />
                <a href="<?=base_url("Koolid"); ?>" class="btn btn-warning btn-sm" role="button">Katkesta</a>
            </div>
        </div>
    </form>
</div>
</div>