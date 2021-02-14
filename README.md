# Promotions
 
 Compuesto de módulos los cuales permiten realizar promociones automáticas para servidores de Azerothcore y FusionCMS.
 
##  Módulo de Azerothcore

* Otorga el nivel bajo el evento Onlogin.
* Configurable el oro, realm y nivel otorgado.

> Module-AC\Promotions\conf\Promotion.conf

```
[worldserver]

#
# Realm Id que reciba promociones
# default: 1
#

RealmId=1

#
# Oro regalado al inicio en monedas bronce
# default: 3000000
#

MoneyGiven=3000000

#
# Nivel por defecto otorgado
# default: 80
#

LevelMax=80
```

## Módulo de FusionCMS

* Configurable limitación por facción, posición, characters permitidos por ip, string de errores.

> Module-Fusion\promotion\config\promotion_config.php

```
/*
    MAX_CHARACTERS = Cantidad máxima de pj's por ip

    1 = Activado / 0 = Desactivado
    ALLY_PERMITED = Disponible promoción sólo para facción Alianza
    HORDE_PERMITED = Disponible promoción sólo para facción Horda

    SI AMBAS FACCIONES ESTÁN DESACTIVADAS ARROJARÁ ERROR DE PROMOCIÓN DESACTIVADA
*/
$config['cta_language'] = array(

    'MAX_CHARACTERS' => 1,
    'ALLY_PERMITED' => 1,
    'HORDE_PERMITED' => 1,

    'PROMOTION_DISABLED' => 'La promoción se encuentra desactivada en estos momentos.',
    'ALLY_ERROR' => 'La promoción en estos momentos está sólo disponible para la facción Horda.',
    'HORDE_ERROR' => 'La promoción en estos momentos está sólo disponible para la facción Alianza.',

    'TITLE'          => 'Promoción',
    'DESCRIPTION'      => 'Sólo serán visibles personajes de nivel bajo a 80.',
    'KEYWORDS'      => '',

    'REALM'          => 'Reino',
    'CHARACTER'      => 'Personajes',
    'PLS_SELECT'      => 'Seleccione un Personaje',
    'TRANSFER'      => 'Pedir Promoción',
    'SELECT_CHAR'      => 'Seleccione un Personaje.',
    'ERROR_REALM'      => 'El reino seleccionado es inválido o no existe.',
    'ERROR_CHARACTER' => 'El personaje seleccionado es inválido o no existe.',
    'ERROR_BELONGS'      => 'The selected character does not belong to your account.',
    'ERROR_ONLINE'      => 'El personaje está en linea, debe estar desconectado para continuar con el proceso.',
    'ERROR_PROMOTION' => 'Ya existe una promocion registrada en esta cuenta sin entregar aún.',
    'ERROR_MAX_ACC'   => 'Usted ya posee la cantidad máxima de personajes nivel 80 asociadas a su ip para la promoción.',
    'ERROR_WEB_FAIL'  => 'Error interno.',

    'SUCCESS_MSG'      => 'Su promoción ha sido registrada satisfactoriamente, ingrese con su personaje y reclame su premio, bienvenido a nuestro servidor, esperamos que lo disfrutes.',
    'BANNED_MSG'    => 'Tu cuenta está baneada'
);
```

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

## Inserción de la dependencia DataTables en la plantilla de admin de fusionCMS

> application\themes\admin\template.tpl

Despúes de la librería Jquery.

```
<script type="text/javascript"src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript"src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" type="text/css" />
```

## Creditos 

* [Xhaher](https://github.com/xhaher) (Autor del módulo)
* AzerothCore: [repository](https://github.com/azerothcore) - [website](http://azerothcore.org/) - [discord chat community](https://discord.gg/PaqQRkd)
