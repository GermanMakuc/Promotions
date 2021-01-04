# Promotions
 
 Compuesto de módulos los cuales permiten realizar promociones automáticas para servidores de Azerothcore y FusionCMS
 
##  Módulo de Azerothcore

* Otorga el nivel bajo el evento Onlogin
* Configurable el oro y nivel otorgado

## Módulo de Fusion

* Configurable limitación por facción, posición, characters permitidos por ip, string de errores

## Requisitos

* v2.0.0+ [Azerothcore](https://github.com/azerothcore/azerothcore-wotlk) 
* 6.1.7+ [FusionCMS](https://github.com/poszer/FusionCMS)
* [DataTables](https://datatables.net/) 

## Instalación 

```
1) Usar el comando `git clone` o descargarlo manualmente.
2) Importar el SQL manualmente en la base de datos Characters.
3) Mover el contenido en la carpeta Module-Ac a la carpeta raíz de AzerothCore en /modules.
4) Repetir el paso 3 con la carpeta Module-Fusion a la carpeta raíz de FusionCMS en /modules.
5) Re-run cmake y compilar AzerothCore limpio.
```

Inserción de la dependencia DataTables en la plantilla de admin de fusionCMS:

> application\themes\admin\template.tpl

Despúes de la librería Jquery

```
<script type="text/javascript"src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript"src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" type="text/css" />
```

## Creditos 

* [Xhaher](https://github.com/xhaher) (Autor del módulo)
* AzerothCore: [repository](https://github.com/azerothcore) - [website](http://azerothcore.org/) - [discord chat community](https://discord.gg/PaqQRkd)
