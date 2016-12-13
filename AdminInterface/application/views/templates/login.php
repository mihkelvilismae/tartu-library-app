<?php echo form_open($form_action, array('class' => 'form-horizontal')); ?>
    <div class="form-group">
        <label class="control-label col-sm-offset-3 col-sm-2" for="email">E-mail:</label>
        <div class="col-sm-3<?php if ($email_error !== '') echo ' has-error'?>">
            <input type="input" class="form-control" name="email" id="email" placeholder="Sisestage e-mail">
        </div>
        <div class="col-sm-4 text-danger"><?=$email_error; ?></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-offset-3 col-sm-2" for="password">Parool:</label>
        <div class="col-sm-3<?php if ($password_error !== '') echo ' has-error'?>">
            <input type="password" class="form-control" name="password" id="password" placeholder="Sisestage parool">
        </div>
        <div class="col-sm-4 text-danger"><?=$password_error; ?></div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-10">
            <button type="submit" class="btn btn-default text-center">Logi sisse</button>
        </div>
    </div>
</form>