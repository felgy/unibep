<h1>Darbinieku saraksts</h1>
<a href="/employee/add">Pievienot</a>

<ul>
    <?php foreach ($employees as $employee) : ?>
    <li><?php echo $employee['name']; ?>&nbsp<?php echo $employee['last_name']; ?></li><a href="/employee/update?id=<?php echo $employee['id']; ?>">Izmainīt</a><a href="/employee/delete?id=<?php echo $employee['id']; ?>">Dzēst</a>
    <?php endforeach; ?>
</ul>