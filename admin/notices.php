<?php
require_once "admin_guard.php";
require_once "../db.php";

$result = mysqli_query($conn,"SELECT * FROM notices ORDER BY id DESC");
?>


<table border="1" cellpadding="8">
<tr>
<th>Title</th>
<th>Action</th>
</tr>
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?= $row['title'] ?></td>
<td>
<a href="toggle_notice.php?id=<?= $row['id'] ?>">Toggle</a>
</td>
</tr>
<?php } ?>
</table>