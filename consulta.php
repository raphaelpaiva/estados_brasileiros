<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Estados Brasileiros</title>
	</head>

	<body>
		<h1>Estados Brasileiros</h1>
		<?php
			require_once( "sparqllib.php" );
			$db = sparql_connect( "http://dbpedia.org/sparql/" );

			if ( !$db )
			{
				print "<p class=\"error\">" . sparql_errno() . ": " . sparql_error() . "</p>";
				exit;
			}
		?>
	</body>

</html>
