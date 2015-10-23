<div class="appGalleries view">
<h2><?php  echo __('App Gallery'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($appGallery['AppGallery']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ios Image'); ?></dt>
		<dd>
			<?php echo h($appGallery['AppGallery']['ios_image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Android Image'); ?></dt>
		<dd>
			<?php echo h($appGallery['AppGallery']['android_image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gallery Text'); ?></dt>
		<dd>
			<?php echo h($appGallery['AppGallery']['gallery_text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Background Image'); ?></dt>
		<dd>
			<?php echo h($appGallery['AppGallery']['is_background_image']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit App Gallery'), array('action' => 'edit', $appGallery['AppGallery']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete App Gallery'), array('action' => 'delete', $appGallery['AppGallery']['id']), null, __('Are you sure you want to delete # %s?', $appGallery['AppGallery']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List App Galleries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New App Gallery'), array('action' => 'add')); ?> </li>
	</ul>
</div>
