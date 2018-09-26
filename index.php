<?php
  require_once('db.php');
  require_once("inc/IT.php");

  // ligação à base de dados
  $db = dbconnect($hostname,$db_name,$db_user,$db_passwd);

  if($db){
      // criar query numa string
  	$query  = "SELECT users.name AS username, microposts.* FROM microposts, users WHERE microposts.user_id = users.id";

  	// executar a query
  	if(!($result = @ mysql_query($query,$db)))
  		showerror();

  	// Cria um novo objecto template
  	$template = new HTML_Template_IT('.');

  	// Carrega o template Filmes2_TemplateIT.html
  	$template->loadTemplatefile('index_template.html', true, true);

  	//MENU
  	$template->setCurrentBlock("MENU");

  	$template->setVariable('Menu_1', "Home");
  	$template->setVariable('Menu_2', "Register");
  	$template->setVariable('Menu_3', "Login");
  	$template->setVariable('Menu_4', "Welcome Dude!");

  	// Faz o parse do bloco MENU
  	$template->parseCurrentBlock();

    $nrows  = mysql_num_rows($result);

	for($i=0; $i < $nrows; $i++) {
		$tuple = mysql_fetch_array($result,MYSQL_ASSOC);

		// trabalha com o bloco POSTS do template
		$template->setCurrentBlock("POSTS");

		$template->setVariable('UPDATE', '<a href="./post/update/' . $tuple['id'] . '">update</a>');
		$template->setVariable('MICROPOST', $tuple['content']);
		$template->setVariable('user', $tuple['username']);
		$template->setVariable('CREATED', $tuple['created_at']);
		$template->setVariable('UPDATED', $tuple['updated_at']);

		// Faz o parse do bloco MICROPOSTS
		$template->parseCurrentBlock();

	} // end for

    $template->show();
  }
?>
