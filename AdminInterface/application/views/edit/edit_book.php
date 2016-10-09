<h1>Muuda raamatut</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('Muuda/Raamat/'.$id); ?>

<label for="title">Raamatu nimi</label>
<input type="input" name="title" value="<?=$current_title?>" /><br />
<label for="author">Autor</label>
<input type="input" name="author" value="<?=$current_author?>" /><br />
<label for="year">Aasta</label>
<input type="input" name="year" value="<?=$current_year?>" /><br />

<input type="submit" name="submit" value="Muuda raamatut" />

</form>