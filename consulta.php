<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css"  href="css/style.css" />
		<title>Estados Brasileiros</title>
	</head>

	<body>
        <h1>Estados Brasileiros</h1>
        <h3>Dados trazidos de <a href="http://dbpedia.org/">dbpedia.org</a></h3>
		<?php
			require_once( "sparqllib.php" );
			$db = sparql_connect( "http://dbpedia.org/sparql/" );

			if ( !$db )
			{
				print "<p class=\"error\">" . sparql_errno() . ": " . sparql_error() . "</p>";
				exit;
            }

            sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );

            $sparql = "select distinct ?Estado ?Populacao where {
                ?estados <http://dbpedia.org/ontology/type> <http://dbpedia.org/resource/States_of_Brazil>. 
                ?estados <http://dbpedia.org/property/name> ?Estado. 
                ?estados <http://dbpedia.org/property/populationTotal> ?Populacao.
                } ORDER BY DESC(?Populacao)";

            $result = sparql_query( $sparql );
            
            if( !$result )
            {
                print "<p class=\"error\">" . sparql_errno() . ": " . sparql_error(). "</p>";
                exit;
            }
 
            $fields = sparql_field_array( $result );
            
            print "<table>";
            print "<caption>População dos Estados brasileiros</caption>";
                
            print "<tr>";
            foreach( $fields as $field )
            {
                print "<th scope=\"col\">$field</th>";
            }
            
            while( $row = sparql_fetch_array( $result ) )
            {
                print "<tr>";
                foreach( $fields as $field )
                {
                    $uf = str_ireplace("State", "", "$row[$field]");
                    $uf = str_ireplace(" of", "", "$uf");
                    $uf = str_ireplace("Brazilian Federal District", "Distrito Federal", "$uf");
                    print "<td>$uf</td>";
                }

                print "</tr>";
            }

            print "</tr>";
            print "</table>";

        ?>
	</body>

</html>
