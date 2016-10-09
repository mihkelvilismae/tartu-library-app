<h1>Lisa uus kool</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('Lisa/Kool'); ?>

<label for="name">Nimi</label>
<input type="input" name="name" /><br />
<label for="phone">Telefon</label>
<input type="input" name="phone" /><br />
<label for="email">E-Mail</label>
<input type="input" name="email" /><br />

<input type="submit" name="submit" value="Lisa kool" />

</form>