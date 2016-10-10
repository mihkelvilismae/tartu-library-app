<h1>Muuda klassi</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('Muuda/Klass/'.$id); ?>

<label for="name">Klassi nimi</label>
<input type="input" name="name" value="<?=$current_name?>" /><br />

<label for="school_id">Kool</label>
<?php echo form_dropdown('school_id', $schools, $current_school)?><br />

<input type="submit" name="submit" value="Muuda klassi" />

</form>