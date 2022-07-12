# Estudando PHP em MVC com PDO

![](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

**Construindo uma aplicação *PHP*, com a finalidade de estudo, com rotas controles e classes de modelos utilizando de *PDO* e estrutura *MVC* para o projeto.**

Há inúmeros frameworks fantásticos para PHP, no mercado. Porém, com a finalidade de estudo, acho muito interesante a ideia de se construir do 0 toda a aplicação.

Claro que a segurança e integridade que grandes frameworks chegam a ter, não conseguimos alcançar com este experimento. Mas nosso conhecimento chega a ter um BUM a mais.

## Começando com as Rotas

Criei um arquivo simples no diretório App, que recebe as Rotas de uma forma simples.

**GET, POST, PUT, DELETE**:

```php
use App\Http\Route;

Route::get('/', "HomeController@index");

Route::post('/users/create', "UserController@create");

Route::put('/users/[0-9]+/update/', "UsersController@update");

Route::get('/users/[0-9]+/delete/', "UsersController@delete");
```
Desta forma, de maneira bem simplicada se declara Rotas.

## Bind values:

Se preciso guardar informações, há uma classe pronta para isto.

```php
use App\Bind;

Bind::add($key, $value);
```

Passando uma chave e um valor, para ser coletado quando precissar chamando o metodo get da classe.

Para buscar somente passando o $key.

```php
$appName = Bind::get('app-name');
```

## Controllers

Controllers quando precisar de parâmetros deve se usar array.

```php
namespace App\Controllers;

class MeuController extends Controller {
    public function index(array $params) {
        echo $params;
    }
}
```

## Request

As requests estão bem simples no momento, passando somente por filtro padrão do php.

```php
namespace App\Controllers;

class MeuController extends Controller {
    public function index(Request $request) {
        echo $request->all();
    }
}
```

```php
namespace App\Controllers;

class MeuController extends Controller {
    public function index(Request $request) {
        echo $request->get("name");
    }
}
```

Por padrão está retornando objetos no all e o get

```php
namespace App\Controllers;

class MeuController extends Controller {
    public function index(Request $request) {
        echo $request->_(); // Aqui retorna sem nada de filtro e como array
    }
}
```

## Validate

A classe validation no momento só faz validação padrão do PHP, e tem que receber um array para filtrar os dados.

```php
namespace App\Controllers;

use App\Http\Validation;

class MeuController extends Controller {
    public function index(Request $request) {
        $value = $request->_();

        $value = Validation::validate($value);
    }
}
```

## Middlewares

Adcionando middlewares no projeto.

Primeiro passo é adicionar como 3° parâmetro na rota, um array com a string que deseja usar para o middleware. O mesmo que vamos cadastrar no mapeamento de classes.

```php
use App\Http\Route;

Route::get('/', "HomeController@index", ["middleware"]);

Route::post('/users/create', "UserController@create");

Route::put('/users/[0-9]+/update/', "UsersController@update");

Route::get('/users/[0-9]+/delete/', "UsersController@delete");
```
