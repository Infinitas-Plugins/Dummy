<?php
	echo $this->Infinitas->adminIndexHead();
?>
<table class="listing">
	<?php
		echo $this->Infinitas->adminTableHeader(array(
			__d('dummy', 'Name'),
			__d('dummy', 'Type'),
			__d('dummy', 'Allow Null'),
			__d('dummy', 'Default'),
			__d('dummy', 'Min'),
			__d('dummy', 'Max'),
			__d('dummy', 'Type'),
			__d('dummy', 'Actions')
		));

		foreach ($data['DummyField'] as $dummyField) {
			if ($dummyField['active']) { ?>
				<tr>
					<td><?php echo $dummyField['name']; ?>&nbsp;</td>
					<td style="text-align:left">
						<?php
						if ($editable && false !== strpos($dummyField['generator'], '->')) {
							echo $form->create('DummyField', array('url' => array('action'=>'change', $data['DummyTable']['id'])));

							echo $form->hidden('DummyField.id', array('value' => $dummyField['id']));
							echo $form->select('DummyField.generator', $types[$dummyField['type']], $dummyField['generator'], array('onchange' => 'submit()'), false);

							echo $form->end();
						}

						else {
							echo $dummyField['generator'];
						}
						?>&nbsp;
					</td>
					<td><?php echo $dummyField['allow_null'] == true ?  __d('dummy', 'YES') : __d('dummy', 'No'); ?>&nbsp;</td>
					<td><?php echo $dummyField['default']; ?>&nbsp;</td>
					<td><?php echo $dummyField['custom_min']; ?>&nbsp;</td>
					<td><?php echo $dummyField['custom_max']; ?>&nbsp;</td>
					<td><?php echo $dummyField['custom_variable']; ?>&nbsp;</td>
					<td class="actions">
						<?php
							if ($editable) {
								echo $html->link(__d('dummy', 'Deactivate'), array('action'=>'deactivate', $dummyField['id'], 'admin' => true)),
								' ',
								$html->link(__d('dummy', 'Edit'), array('action'=>'edit', $dummyField['id']));
							}
						?>&nbsp;
					</td>
				</tr> <?php
			}
		}
	?>
</table>

<?php echo $this->Html->tag('h4', __d('dummy', 'Inactive')); ?>
<table class="listing">
	<?php
		echo $this->Infinitas->adminTableHeader(array(
			__d('dummy', 'Name'),
			__d('dummy', 'Default'),
			__d('dummy', 'Actions')
		));

		foreach ($data['DummyField'] as $dummyField) {
			if (!$dummyField['active'] ) { ?>
				<tr>
					<td><?php echo $dummyField['name']; ?>&nbsp;</td>
					<td><?php echo $dummyField['default']; ?>&nbsp;</td>
					<td class="actions">
						<?php
							if ($editable) {
								echo $html->link(__d('dummy', 'Activate'), array('action'=>'activate', $dummyField['id'], 'admin' => true));
							}
						?>&nbsp;
					</td>
				</tr> <?php
			}
		}
	?>
</table>

<?php
	if (sizeof($contents)) {
		echo $this->Html->tag('h4', __d('dummy', 'Current Content Sample')); ?>
		<table class="listing">
			<?php
				$tds = array();
				foreach ($contents[0]['Model'] as $key => $value) {
					$tds[] = $key;
				}
				echo $this->Infinitas->adminTableHeader($tds);

				foreach ($contents as $one) {
					$row = $one['Model']; ?>
					<tr>
						<?php
							foreach ($row as $field) {
								echo '<td>', $this->Text->truncate(htmlspecialchars($field), 200), '</td>';
							}
						?>&nbsp;
					</tr> <?php
				};
			?>
		</table>
		<?php
	} else {
		echo $this->Html->tag('p', __d('dummy', 'No contents yet. Generate some.'));
	}
echo $form->end();