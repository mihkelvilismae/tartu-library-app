<h1>Lisa uus Klass</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('Lisa/Klass'); ?>

<label for="name">Klassi nimi</label>
<input type="input" name="name"  /><br />

<label for="school_id">Kool</label>
<?php echo form_dropdown('school_id', $schools, $default_school)?><br />

<input type="submit" name="submit" value="Lisa klass" />

</form>