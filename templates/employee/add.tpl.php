<h1>Darbinieka pievienošana sistēmai</h1>
<form class="form" action="/employee/insert" method="POST">
    <input type="text" name="name" id="name" placeholder="Vārds">
    <input type="text" name="last_name" id="last_name" placeholder="Uzvārds">
    <input type="text" name="phone" id="phone" placeholder="Telefons">
    <input type="text" name="email" id="email" placeholder="Epasts">
    <input type="text" name="role" id="role" placeholder="Amats">
    <input type="text" name="rate" id="rate" placeholder="Algas likme">
    <button type="submit">Saglabāt</button>
</form>
<a href="<?php echo $_SERVER['HTTP_REFERER'];?>">Atcelt</a> 