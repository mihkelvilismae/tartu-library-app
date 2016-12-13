<div class="col-md-10">
    <form action="<?=$form_action; ?>" class="form-horizontal" method="post" accept-charset="utf-8">
        <div class="form-group">
            <label for="title" class="control-label col-sm-offset-1 col-sm-2">Raamatu nimi</label>
            <div class="col-sm-3">
                <input type="text" name="title" value="<?=$book_title; ?>" class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('title'); ?></div>
        </div>
        <div class="form-group">
            <label for="lang" class="control-label col-sm-offset-1 col-sm-2">Keel</label>
            <div class="col-sm-3">
                <input type="text" name="lang" value="<?=$lang; ?>" class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('lang'); ?></div>
        </div>
        <div class="form-group">
            <label for="year" class="control-label col-sm-offset-1 col-sm-2">Aasta</label>
            <div class="col-sm-3">
                <input type="text" name="year" value="<?=$year; ?>" class="form-control" />
            </div>
            <div class="col-sm-6 text-danger"><?=form_error('year'); ?></div>
        </div>

        <div class="form-group">
            <label for="year" class="control-label col-sm-offset-1 col-sm-2">Autorid</label>
            <div class="col-sm-4">
                <ul class="list-group no-padding">
                    <?=$authors; ?>
                </ul>
            </div>
            <div class="col-sm-5"></div>
        </div>
        <div class="form-group">
            <label for="year" class="control-label col-sm-offset-1 col-sm-2">Märksõnad</label>
            <div class="col-sm-4">
                <ul class="list-group no-padding">
                    <?=$keywords; ?>
                </ul>
            </div>
            <div class="col-sm-5"></div>
        </div>
        <div class="form-group">
            <label for="year" class="control-label col-sm-offset-1 col-sm-2">Žanrid</label>
            <div class="col-sm-4">
                <ul class="list-group no-padding">
                    <?=$genres; ?>
                </ul>
            </div>
            <div class="col-sm-5"></div>
        </div>
        <div class="form-group">
            <div class="btn-group col-sm-offset-3 col-sm-10">
                <input type="submit" name="submit" value="Muuda raamatut" class="btn btn-primary btn-sm" />
                <a href="<?=base_url("Raamatud"); ?>" class="btn btn-warning btn-sm" role="button">Katkesta</a>
            </div>
        </div>
    </form>
</div>
</div>