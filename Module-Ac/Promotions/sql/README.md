## Creación de la nueva tabla character_promotion

```
CREATE TABLE `character_promotion` (
  `id` int(11) NOT NULL,
  `guid` int(10) NOT NULL,
  `account` int(10) NOT NULL,
  `entregado` tinyint(1) NOT NULL DEFAULT '0',
  `ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
```

**Boolean datatype in mysql:**
Use `TinyInt(1)` or `Boolean` (this is the same thing)

`bit(1)` can also work, but it may require a syntax like `b'(0)` and `b'(1)` when inserting (not sure).

If there are multiple booleans in the same table, bit(1) is better, otherwise it's the same result.


## Rules

- Use `InnoDB` as engine for dynamic tables (most likely in the `auth` and `characters` databases).
- Use `MyISAM` for **read-only** tables (in `world` database), but if you're not sure, just use innoDB.
- Use `utf8` as charset.


## Resources

https://www.w3schools.com/sql/sql_datatypes.asp
