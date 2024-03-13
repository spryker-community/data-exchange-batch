# Data Exchange Batch

## How to install locally?

1. Check out a local instance of Spryker, e.g. (B2C Shop)[https://github.com/spryker-shop/b2c-demo-shop.git], and set it up completly

2. inside there create a new directory `spryker-community`

3. clone this repository into the new directory:
```
git clone https://github.com/spryker-community/data-exchange-batch.git
```

4. move the `composer.json` and `composer.lock` from the `spryker-community/data-exchange-batch/_local` to the root folder of the shop

5. run composer install again to install the package with symlink

6. have fun!
