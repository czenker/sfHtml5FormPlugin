<?php
$tainted = $form->getTaintedValues();
$cleared = $form->getValues();
?>
<table>
	<thead>
		<tr>
			<th>name</th>
			<th>tainted value</th>
			<th>cleared value</th>
		</tr>
	</thead>	
	<tbody>
		<?php foreach($cleared as $name=>$value): ?>
		<tr>
			<th><?php echo $name?></th>
			<td><?php var_dump($tainted[$name])?></td>
			<td><?php var_dump($value)?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>