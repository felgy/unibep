<p>Apstiprini darbinieka<span
            class="drop-name"><?php echo $employee[0]['name']; ?><?php echo $employee[0]['lastname']; ?></span> dzēšanu!
</p>
<form action="/employee/drop?id=<?php echo $employee[0]['id']; ?>" method="post">
    <label for="answer">Ieraksti darbinieka vārdu:</label>
    <input type="text" id="answer" name="name">
    <button type="submit">Dzēst</button>
</form>
<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Atcelt</a>