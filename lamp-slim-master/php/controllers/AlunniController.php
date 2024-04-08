<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController
{
  /*-------------------------------------------------------------------------------------------------*/
  //Selezione di un alunno senza specifiche
  public function index(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    //Selezione di tutte le querry
    $result = $mysqli_connection->query("SELECT * FROM alunni");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
  /*-------------------------------------------------------------------------------------------------*/
  //Selezione di un alunno specificando l'id
  public function prenderePerId(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    //Selezione SOLO della querry specificata
    $result = $mysqli_connection->query("SELECT * FROM alunni WHERE alunni.id = '".$args['id']."'");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
  /*-------------------------------------------------------------------------------------------------*/
  //Aggiunta di un alunno
  public function aggiungiAlunno(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(), true);
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("INSERT INTO alunni (nome, cognome) VALUES ('" . $body['nome'] . "', '" . $body['cognome'] . "')");
    $response->getBody()->write(json_encode($result));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  } 
  /*-------------------------------------------------------------------------------------------------*/
  //Modifica di un alunno 
  public function modificaAlunno(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(), true);
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    //Modifica di un alunno
    $result = $mysqli_connection->query("UPDATE alunni SET nome = '" . $body['nome'] . "', cognome = '" . $body['cognome'] . "' WHERE id = '" . $args['id'] . "'");
    $response->getBody()->write(json_encode($result));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
  /*-------------------------------------------------------------------------------------------------*/
  //Eliminazione di un alunno
  public function eliminareAlunno(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    //Eliminazione della querry
    $deleteQuery = "DELETE FROM alunni WHERE id = '".$args['id']."'";
    $deleteResult = $mysqli_connection->query($deleteQuery);

    $response->getBody()->write(json_encode($toDelete));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
}
