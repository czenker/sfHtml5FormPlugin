<?php if($sf_user->hasFlash('ok')):?>
<p class="msg_ok"><?php echo $sf_user->getFlash('ok') ?></p>
<?php endif;?>

<?php if($sf_user->hasFlash('error')):?>
<p class="msg_error"><?php echo $sf_user->getFlash('error') ?></p>
<?php endif;?>

<?php if($form->isBound()):?>
	<?php include_partial('inspect_values' , array('form' => $form));?>
<?php endif;?>
<form action="" method="post">
<table>
	<tfoot>
		<tr>
			<td colspan="2"><input type="submit" value="Try it!" /></td>
		</tr>
	</tfoot>
	<tbody>
		<?php echo $form->render();?>
	</tbody>
</table>
</form>