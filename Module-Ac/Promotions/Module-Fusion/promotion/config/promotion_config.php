<?php
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
    'ERROR_WEB_FAIL'  => 'Error.',

    'SUCCESS_MSG'      => 'Su promoción ha sido registrada satisfactoriamente, ingrese con su personaje y reclame su premio, bienvenido a nuestro servidor, esperamos que lo disfrutes.',
    'BANNED_MSG'    => 'Tu cuenta está baneada'
);













/*******************************************************************/
/******************* DO NOT CHANGE BELOW ***************************/
/*******************************************************************/
$config['force_code_editor'] = true;