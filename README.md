# Propel2 — Thelia fork

Fork of [propelorm/Propel2](https://github.com/propelorm/Propel2) maintained by the [Thelia](https://github.com/thelia) organization. It is the ORM used by [Thelia](https://thelia.net), an open-source e-commerce solution. The upstream project being inactive, this fork is maintained independently.

## Branches

| Branch | Used by |
|--------|---------|
| `thelia3.0` | Thelia 3 |
| `thelia-2.5` | Thelia 2.5 |

## Changes compared to upstream

- Symfony event dispatching on the ActiveRecord lifecycle: a generated `Event` class per table, with `PRE_SAVE`, `POST_SAVE`, `PRE_INSERT`, `POST_INSERT`, `PRE_UPDATE`, `POST_UPDATE`, `PRE_DELETE` and `POST_DELETE` events dispatched through the connection's `EventDispatcher`
- Native PHP types on generated model properties, getters and setters
- PHP 8.x and Symfony 6/7 compatibility fixes
- Backward-compatibility helpers kept for Thelia 2

## Installation

```bash
composer require thelia/propel:dev-thelia3.0
```

Thelia projects pull this package automatically through `thelia/core`.

## Documentation

The general Propel documentation at [propelorm.org](http://propelorm.org/) still applies. For the Thelia integration (events, generated models, schema conventions), see the [Thelia documentation](https://docs.thelia.net).

## Contribute

Fork the repository and create a pull request against the relevant branch. Please include unit tests with your changes.

## License

MIT. See the `LICENSE` file for details.
