<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Danh sách điểm danh</title>
	<style>
		body { font-family: Arial, sans-serif; padding: 20px; }
		table { border-collapse: collapse; width: 100%; max-width: 1000px; }
		th, td { border: 1px solid #ccccccff; padding: 6px 8px; text-align: left; }
		th { background:#f2f2f2; }
	</style>
</head>
<body>
	<h1>Danh sách điểm danh</h1>
    <?php
    require_once __DIR__ . '/data.php';

    $students = get_students();
    $sample = $students; // show all records
    ?>
	<?php if (empty($sample)): ?>
		<p>Không tìm thấy dữ liệu.</p>
	<?php else: ?>
		<table>
			<thead>
				<tr>
					<?php foreach (array_keys($sample[0]) as $col): ?>
						<th><?php echo htmlspecialchars($col); ?></th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($sample as $row): ?>
					<tr>
						<?php foreach ($row as $cell): ?>
							<td><?php echo htmlspecialchars($cell); ?></td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>

</body>
</html>

