<h1>Lisa raamat nimekirja</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('Lisa/Nimekiri/'.$id); ?>

<label for="book_id">Raamat</label>
<?php echo form_dropdown('book_id', $books)?><br />


<input type="submit" name="submit" value="Lisa Raamat" />

</form>