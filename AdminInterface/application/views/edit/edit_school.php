<h1>Muuda kooli</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('Muuda/Kool/'.$id); ?>

<label for="name">Nimi</label>
<input type="input" name="name" value="<?=$current_value?>" /><br />

<input type="submit" name="submit" value="Muuda kooli" />

</form>