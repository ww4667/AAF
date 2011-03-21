<?php
/**
 * Doodles Connector
 *
 * @package doodles
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/gir/index.php';

require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('aaf.core_path',null,$modx->getOption('core_path').'components/aaf/');
require_once $corePath.'model/aaf/aaf.class.php';
$modx->aaf = new Aaf($modx);

$modx->lexicon->load('aaf:default');

/* handle request */
$path = $modx->getOption('processorsPath',$modx->aaf->config,$corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));