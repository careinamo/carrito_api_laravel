# Instalacion:

Entorno de desarrollo: [laragon](https://laragon.org/download/) (debe clonar eL repositorio dentro del directorio www de laragon) y noo es necesario ninguna confuguracion adicional a laragon.

Version de laravel: 7


 luego de clonar ejecutar. debera ejecuat dentro de la terminal de laragon:

 ```composer install```

convertir el archivo, ```.env.example``` en ```.env```

Ejecutar: 

 ```php artisan key:generate```

```php artisan migrate:refresh --seed```

 ```php artisan serve```

# Uso de API:

[Coleccion documentada](https://documenter.getpostman.com/view/2274977/TzRRE9QL)

## Orden en el que funcionan las llamadas al api:

GET 'host/catalogue' -> Genera el catalogo según las condiciones

POST api/shopping-cart/store -> se usa para agregar un producto a un carrito (token). 
como no se implemento nada especial para generar un token que identifique a cada carrito, se puede escribir un numero al azar y a partir de allí ese será el identificador del carrito. agrega productos
de uno en uno, por lo tanto se puede repetir el producto para aumentar la cantidad del mismo, mientras exista suficiente inventario.

DEL api/shopping-cart -> se le envia un json similar a cuando se agregan productos al carrito 
pero ahora los descuenta la cantidad hasta remover el producto.

POST api/checkout/show -> permite visualizar toda la información del carrito, sirve para totalizar.

POST api/checkout/confirm -> si bien no se implemento lógica para crear una tabla de 
ordenes creadas, este endpoint es el que concreta la compra y descuenta del stock.