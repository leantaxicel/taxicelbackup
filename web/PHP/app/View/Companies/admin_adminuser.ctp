<?
	$config = Configure::read("TaxiCel"); // loading config
?>
<div class="creatTol">
	<h2><?php echo __('Company Admin users'); ?></h2>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Id</th>
			<th>Username</th>
			<th>first Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
	</tr>
	
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['f_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['l_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['mobile']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>

