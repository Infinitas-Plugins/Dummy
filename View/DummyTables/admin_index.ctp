<?php
	echo $this->Infinitas->adminIndexHead();
?>
<table class="listing">
	<?php
		echo $this->Infinitas->adminTableHeader(array(
			__d('dummy', 'Name'),
			__d('dummy', 'Amount') => array(
				'style' => 'width:100px'
			),
			__d('dummy', 'Actions') => array(
				'style' => 'width:100px'
			)
		));

		$inactive = false;
		foreach ($data as $one) {
			$table = $one['DummyTable'];
			if (!isset($table['active']) || (isset($table['active']) && $table['active']) ) { ?>
				<tr>
					<td>
						<?php echo $html->link(Inflector::underscore($table['name']), array('controller'=>'dummy_fields', 'action'=>'index', $table['id'])); ?>
					</td>
					<td>
						<?php
							if ($editable) {
								echo $form->create('DummyTable',array(
								'style' => 'width:100%;margin:0;',
								'url' => array('action'=>'number',$table['id'])));

								echo $form->text('DummyTable.number',array(
									'value' => $table['number'],
									'style'=>'width:100%',
									'onchange' => 'submit()'
								));
								echo $form->end();
							} else {
								echo $table['number'] ;
							} ?>
					</td>
					<td>
						<?php
								echo $html->link(__d('dummy', 'Generate'), array('action'=>'generate', $table['id']));
						if ($editable) {
							echo ' '.$html->link(__d('dummy', 'Deactivate'), array('action'=>'deactivate', $table['id']));
						}
						?>
					</td>
				</tr> <?php
			} else {
				$inactive = true;
			}
		};
	?>
</table>

<?php
	if ($inactive) { ?>
		<h4>Inactive tables</h4>
		<table class="listing">
			<?php
				echo $this->Infinitas->adminTableHeader(array(
					__d('dummy', 'Name'),
					__d('dummy', 'Actions') => array(
						'style' => 'width:100px'
					)
				));

				foreach ($data as $one ) {
					$table = $one['DummyTable'];

					if (!$table['active']) { ?>
						<tr>
							<td><?php echo $html->link(Inflector::underscore($table['name']), array('controller'=>'dummy_fields', 'action'=>'index', $table['name'])); ?></td>
							<td>
								<?php
									if ($editable) {
										echo $html->link(__d('dummy', 'Activate'), array('action'=>'activate', $table['id']));
									}
								?>&nbsp;
							</td>
						</tr><?php
					}
				}
			?>
		</table> <?php
	}