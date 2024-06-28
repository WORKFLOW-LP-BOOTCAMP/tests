# Mock ou doublure

Un Mock est une **doublure**, c'est un objet créé à partir d'une classe dont vous connaissez le fonctionnent.

Vous utiliserez cette technique pour tester l'algorithmique d'une classe qui consomme un autre objet que l'on ne teste pas soit parce qu'il n'est plus à tester, soit parce que vous tester le comportement d'une classe donnée. Les tests doivent être le plus possible Single Responsability. Vous devez uniquement tester le comportement d'une classe donnée, une classe possède des responsabilités limités et bien définies, principe SOLID, Single Responsability.

## Un peu de vocabulaire.

- Un **dummy** est un objet qui remplit un contrat sans autre précision.

```php
$mockStorage = $this->createMock(Storable::class);
```

- Un **stub** est un **dummy** auquel on a défini un comportement pour certaine(s) méthode(s) et indiquez ce que cette méthode doit retourner.

```php
$mockStorage = $this->createMock(Storable::class);
$mockStorage->method('getStorage')->willReturn(['apple' => round(10 * 1.5 * 1.2, 2)]);
```

Et **Stub** peut également retourner un dummy. Imaginons que la méthode getValue retourne un objet de type Product :

```php
$product = $this->createMock(Product::class);
$mockStorage->method('getValue')->willReturn($product);
```

- Un mock est une doublure qui définit ses comportements ou attentes en anglais. Ainsi chaque méthode du Mock possède un comportement spécifique ou définit :

```php
$mockStorage->expects($this->once())->method('setValue')->with($apple->getName(), abs(1.5 * 10 * 1.2));
```

- **Mock** définition :

**La pratique consistant à remplacer un objet avec une doublure de test qui vérifie des attentes, par exemple en faisant l’assertion qu’une méthode a été appelée, est appelée mock.**

## Utiliser une doublure dans les tests 

Vous pouvez par exemple tester que le Mock renvoi bien l'objet Mock lui-même de la manière suivante :

```php
// Créer un bouchon pour la classe de type Storable (interface).
$mockStorage = $this->createMock(Storable::class);

// Configurer le bouchon la méthode get retournera l'objet $mockStorage lui-même
$mockStorage->method('get')
        ->will($this->returnSelf());

$this->assertSame($mockStorage, $mockStorage->get());
```

Un Mock peut également lever une exception que l'on pourra par la suite tester.

```php
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testException(){
        // stub si on définit uniquement un comportement
        $stub = $this->createMock(Storable::class);

        $stub->method('getStorage')
             ->will($this->throwException(new \InvalidArgumentException));

        $stub->getStorage();
        $this->expectException(InvalidArgumentException::class);
    }
}
```

## Utilisation d'un Mock 

Le storage ci-dessous est un Mock au sens où l'on attent un comportement spécifique que l'on a définit dans le Mock et que l'on teste lors de l'appel d'une méthode buy dans la classe Cart qui consomme cet objet.

```php
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testCallResetWhenBuyMethodStorage()
    {
        $apple = new Product('apple', 1.5);
        $mockStorage = $this->createMock(Storable::class);
        $cart =  new Cart($mockStorage);
        $mockStorage
             ->expects($this->once())
             ->method('setValue')
             ->with($apple->getName(), abs(1.5 * 10 * 1.2));

        $cart->buy($apple, 10);
    }
}
```

