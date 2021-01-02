# Promotions
 
 Compuesto de módulos los cuales permiten realizar promociones automáticas para servidores de Azerothcore y FusionCMS
 
##  Módulo de Azerothcore

* Otorga el nivel bajo el evento Onlogin
* Configurable el oro y nivel otorgado

## Módulo de Fusion

* Configurable limitación por facción, posición, characters permitidos por ip, string de errores

## Requisitos

* [Azerothcore] (https://github.com/azerothcore/azerothcore-wotlk) 
* 6.1.7 Mínimo [FusionCMS] (https://github.com/poszer/FusionCMS)
* [DataTables](https://datatables.net/) 

Inserción de dependencias en la plantilla de admin:

> application\themes\admin\template.tpl

Despúes de la librería Jquery

'''
<script type="text/javascript"src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript"src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" type="text/css" />
'''