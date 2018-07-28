<h1>Darbinieka pievienošana sistēmai</h1>
<p class="<?php echo $display?>"><?php echo $message?></p>
<form class="form" action="/employee/add" method="POST">
    <input type="text" name="name" id="name" placeholder="Vārds (obligāti)">
    <input type="text" name="last_name" id="last_name" placeholder="Uzvārds">
    <input type="text" name="phone" id="phone" placeholder="Telefons">
    <input type="text" name="email" id="email" placeholder="Epasts">
    <input type="text" name="role" id="role" placeholder="Amats">
    <input type="text" name="rate" id="rate" placeholder="Algas likme">
    <button type="submit">Saglabāt</button>
</form>
<a href="<?php echo '/employee';?>">Atcelt</a>