<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Container\ContainerInterface;


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserController
{
    protected $container;
    protected $db;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->db = new \PDO('mysql:host='. $container->get('config')['db']['host'] . ';dbname=' . 
                                            $container->get('config')['db']['dbname'], 
                                            $container->get('config')['db']['username'], 
                                            $container->get('config')['db']['password']);
    }

    public function getAllUsers(Request $request, Response $response, $args)
    {
        $stmt = $this->db->query('SELECT * FROM users');
        $users = $stmt->fetchAll();
        return $response->withJson(['data' => $users]);
    }

    public function getUser(Request $request, Response $response, $args)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $args['id']]);
        $user = $stmt->fetch();
        return $response->withJson(['data' => $user]);
    }
    public function verify($token, Request $request, Response $response)
    {
        $secret = $this->container->get('config')['jwt']['secret'];

        try {
            $decoded = JWT::decode($token, new Key($secret, 'HS256'));
            return $response->withJson(['data' => (array) $decoded]);
        } catch (\Exception $e) {
            return $response->withStatus(401)->withJson(['error' => $e->getMessage()]);
        }
    }
}
?>