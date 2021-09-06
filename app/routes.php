<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\Product\ListProductsAction;
use App\Application\Actions\Product\ViewProductAction;
use App\Application\Actions\Product\ProductAction;
use App\Domain\Product\Product;
use App\Domain\Product\ProductRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response, $args): Response {
        $response->getBody()->write('Hello world! View products at /products');
        $response->getBody()->write('<form method="POST">
        <label for="Prodid">ProductId:</label><br>
        <input type="number" id="Prodid" name="Prodid"><br>
        <label for="ProductName">ProductName:</label><br>
        <input type="text" id="ProductName" name="ProductName"><br>
        <label for="CreatedDate">CreatedDate:</label><br>
        <input type="text" id="CreatedDate" name="CreatedDate"><br>
        <label for="SaleQuota">SaleQuota:</label><br>
        <input type="number" id="SaleQuota" name="SaleQuota"><br>
        <label for="MinPrice">MinPrice:</label><br>
        <input type="Number" step="0.1" id="MinPrice" name="MinPrice"><br>
        <label for="MaxPrice">MaxPrice:</label><br>
        <input type="Number" step="0.1" id="MaxPrice" name="MaxPrice"><br>
        <input type="submit" onclick="">test</button>
        </form>');
                
        return $response;
    });

    $app->post('/', function (Request $request, Response $response, $args): Response {
        $data = $request->getParsedBody();
        $html = var_export($data, true);
        $response->getBody()->write($html);
        $Prodid = $request->getAttribute('Prodid');
        $ProductName = $request->getAttribute('ProductName');
        $CreatedDate = $request->getAttribute('CreatedDate');
        $SaleQuota = $request->getAttribute('SaleQuota');
        $MinPrice = floatval($request->getAttribute('MinPrice'));
        $MaxPrice = floatval($request->getAttribute('MaxPrice'));
        Product::newProduct(intval($Prodid),strval($ProductName),strval($CreatedDate),intval($SaleQuota),$MinPrice,$MaxPrice);
        return $response; 
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/products', function (Group $group) {
        $group->get('', ListProductsAction::class);
        $group->get('/{id}', ViewProductAction::class);
    });
};
