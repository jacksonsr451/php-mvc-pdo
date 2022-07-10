# Estudando PHP em MVC com PDO

![](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

**Construindo uma aplicação *PHP*, com a finalidade de estudo, com rotas controles e classes de modelos utilizando de *PDO* e estrutura *MVC* para o projeto.**

Há inumeros frameworks fantásticos para PHP, no mercado. Porém, com a finalidade de estudo, acho muito interesante a ideia de se construir do 0 toda a aplicação.

Claro que a segurança e integridade que grandes frameworks chegam a ter, não conseguimos alcançar com este experimento. Mas nosso conhecimento chega a ter um BUM a mais.

## Começando com as Rotas

Criei um arquivo simples no diretorio App, que recebe as Rotas de uma forma simples.

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

Se preciso guardar infromações, há uma classe pronta para isto.

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

Controllers quando precisar de parametros deve se usar array.

```php
namespace App\Controllers;

class MeuController extends Controller {
    public function index(array $params) {
        echo $params;
    }
}
```
