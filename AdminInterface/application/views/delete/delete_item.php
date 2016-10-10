<h1><?=$title ?></h1>
<?php echo validation_errors(); ?>
<?php echo form_open($form_action); ?>

<label for="item_id"><?=$item_type ?></label>
<?php echo form_dropdown('item_id', $items)?><br />

<input type="submit" name="submit" value="<?=$button_text?>" />

</form>