<li>
	<form method="POST" class="checkmark <?php e(!empty($task->done) ? ' checked' : '');?>">
		<input type="hidden" name="taskId" value="<?php e($task->id);?>">
		<button type="submit" name="a" value="toggle-done"></button>
	</form>
	<a href="/<?php e($navData['teamSlug'] . '/' . $navData['listSlug'] . '/' . $task->id);?>/">
		<h4>
			<?php e($task->title);?>
		</h4>
	</a>
	<?php if (!empty($showImportant)): ?>
		<form method="POST" class="important-toggle <?php e($task->important ? ' important' : '');?>">
			<input type="hidden" name="taskId" value="<?php e($task->id);?>">
			<button type="submit" name="a" value="toggle-important">
				☆
			</button>
		</form>
	<?php endif;?>
</li>