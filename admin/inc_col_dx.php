</div>
<div id="bigbox_right">
<div id="bluebox">
<div class="title">Crea Nuovo</div>
<table width="99%"><tr>
<td><form action="user_new.php" method="post">
<input type="submit" value="UTENTE" style="width:100%" />
</form></td><td>
<form action="sondaggio.php" method="post">
<input type="submit" value="SONDAGGIO" style="width:100%" />
</form></td><td>
<form action="crm_new.php" method="post">
<input type="submit" value="TICKET" style="width:100%" />
</form></td>
</tr></table>
</div>

<div id="bluebox">
<div class="title">Cerca Iscritto</div>
<form method="get" action="user_search.php">
<table border="0" align="center"><tr>
<td><label>ID<input type="radio" value="user_id" name="searchfor" /></label></td>
<td><label>Nome/Cognome<input type="radio" name="searchfor" value="second_name" /></label></td>
<td><label>Email<input type="radio" name="searchfor" value="email" /></label></td>
<td><label>Testo<input type="radio" checked="checked" name="searchfor" value="text" style="width:100%" /></label></td></tr>
<tr>
<td><select name="limit">
<option value="10">10</option>
<option value="50">50</option>
<option value="100" selected="selected">100</option>
<option value="500">500</option>
<option value="1000">tutti</option>
</select></td>
<td><input type="text" name="searchtxt" /></td>
<td><input type="submit" value="CERCA" class="mini" /></td>
</tr></table>
</form>
</div>
<div id="bluebox">
<div class="title">Cerca Ticket</div>
<form method="get" action="crm_search.php">
<table border="0" align="center"><tr>
<td><label>Ticket ID<input type="radio" value="user_id" name="searchfor" /></label></td>
<td><label>User ID<input type="radio" name="searchfor" value="user_id" /></label></td>
<td><label>Email<input type="radio" name="searchfor" value="email" /></label></td>
<td><label>Testo Libero<input type="radio" checked="checked" name="searchfor" value="text" style="width:100%" /></label></td></tr>
<tr>
<td>&nbsp;</td>
<td><input type="text" name="searchtxt" /></td>
<td><input type="submit" value="CERCA" class="mini" /></td>
</tr></table>
</form>
</div>
<div id="bluebox">
<div class="title">Cerca Sondaggio</div>
<form method="get" action="search_sondaggio.php">
<table border="0" align="center"><tr>
<td><label>ID<input type="radio" value="id_sond" name="searchfor" /></label></td>
<td><label>Domanda<input type="radio" name="searchfor" value="domanda" checked="checked" /></label></td>
<td><label>Punti<input type="radio" name="searchfor" value="punti" /></label></td>
</tr><tr>
<td>&nbsp;</td>
<td><input type="text" name="searchtxt" /></td>
<td><input type="submit" value="CERCA" class="mini" style="width:100%" /></td>
</tr></table>
</form>
</div>