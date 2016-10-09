<h1>Lisa uus Klass</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('Lisa/Raamat'); ?>

<label for="title">Raamatu nimi</label>
<input type="input" name="title"  /><br />

<label for="author">Autor</label>
<input type="input" name="author"  /><br />

<label for="year">Aasta</label>
<input type="input" name="year"  /><br />


<input type="submit" name="submit" value="Lisa Raamat" />

</form>