# Classe à tester : Cart

La classe `Cart` représente un panier qui permet d'ajouter des produits et de gérer les quantités.

```php
// Cart.php

class Cart {
    private $storage;

    public function __construct(Storable $storage) {
        $this->storage = $storage;
    }

    public function buy(Product $product, $quantity) {
        $total = $product->getPrice() * $quantity * 1.2; // Calcul du prix total avec une taxe de 20%
        $this->storage->setValue($product->getName(), $total);
        // D'autres logiques peuvent suivre comme mise à jour du panier, etc.
    }
}
```

## Interface Storable

L'interface `Storable` définit les méthodes que notre mock doit implémenter.

```php
// Storable.php

interface Storable {
    public function setValue($key, $value);
}
```

## Classe Product

Une classe simple pour représenter un produit avec un nom et un prix.

```php
// Product.php

class Product {
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }
}
```

## Test avec PHPUnit et Mock

Maintenant, écrivons un test utilisant PHPUnit pour vérifier que lorsque nous ajoutons un produit au panier, la méthode `setValue` de `Storable` est appelée avec les bons arguments.

```php
// CartTest.php

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase {
    public function testBuyMethodCallsSetValueOnStorage() {
        // Création du mock pour l'interface Storable
        $mockStorage = $this->createMock(Storable::class);

        // Création d'un produit pour tester
        $apple = new Product('apple', 1.5);

        // Configuration des attentes sur le mock
        $mockStorage->expects($this->once())
                    ->method('setValue')
                    ->with($apple->getName(), abs(1.5 * 10 * 1.2)); // Vérifie que setValue est appelé avec ces paramètres

        // Création de l'instance de Cart avec le mock de Storable
        $cart = new Cart($mockStorage);

        // Appel de la méthode à tester
        $cart->buy($apple, 10);
    }
}
```

- **Création du mock** : Nous utilisons `$this->createMock(Storable::class)` pour créer un objet simulé qui implémente l'interface `Storable`. Ce mock remplace le véritable objet de stockage pour isoler la classe `Cart` lors du test.

- **Configuration des attentes** : Avec `$mockStorage->expects(...)`, nous définissons ce que nous attendons du mock. Ici, nous nous assurons que la méthode `setValue` est appelée exactement une fois avec les paramètres attendus.

- **Test de la méthode `buy`** : Nous créons une instance de `Cart` avec notre mock `Storable`. En appelant `$cart->buy($apple, 10)`, nous testons que l'ajout d'un produit dans le panier déclenche bien l'appel attendu à `setValue` sur notre mock.
