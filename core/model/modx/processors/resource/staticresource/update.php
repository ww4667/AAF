<?php
/**
 * @package modx
 * @subpackage processors.resource
 */

/* specific data escaping */
$scriptProperties['pagetitle'] = trim($scriptProperties['pagetitle']);
$scriptProperties['variablesmodified'] = isset($scriptProperties['variablesmodified'])
    ? explode(',',$scriptProperties['variablesmodified'])
    : array();

/* default pagetitle */
if (empty($scriptProperties['pagetitle'])) $scriptProperties['pagetitle'] = $modx->lexicon('untitled_resource');

$scriptProperties['hidemenu'] = empty($scriptProperties['hidemenu']) ? 0 : 1;
$scriptProperties['isfolder'] = empty($scriptProperties['isfolder']) ? 0 : 1;
$scriptProperties['richtext'] = empty($scriptProperties['richtext']) ? 0 : 1;
$scriptProperties['donthit'] = empty($scriptProperties['donthit']) ? 0 : 1;
$scriptProperties['published'] = empty($scriptProperties['published']) ? 0 : 1;
$scriptProperties['cacheable'] = empty($scriptProperties['cacheable']) ? 0 : 1;
$scriptProperties['searchable'] = empty($scriptProperties['searchable']) ? 0 : 1;
$scriptProperties['syncsite'] = empty($scriptProperties['syncsite']) ? 0 : 1;
$scriptProperties['deleted'] = empty($scriptProperties['deleted']) ? 0 : 1;


/* friendly url alias checks */
if ($modx->getOption('friendly_alias_urls') && isset($scriptProperties['alias'])) {
    /* auto assign alias */
    $aliasPath = $resource->getAliasPath($scriptProperties['alias'],$scriptProperties);
    $duplicateId = $resource->isDuplicateAlias($aliasPath);
    if (!$modx->getOption('allow_duplicate_alias',null,false) && !empty($duplicateId)) {
        $err = $modx->lexicon('duplicate_alias_found',array(
            'id' => $duplicateId,
            'alias' => $aliasPath,
        ));
        $modx->error->addField('alias', $err);
    }
}

if ($modx->error->hasError()) return $modx->error->failure();


/* publish and unpublish dates */
$now = time();
if (isset($scriptProperties['pub_date'])) {
    if (empty($scriptProperties['pub_date'])) {
        $scriptProperties['pub_date'] = 0;
    } else {
        $scriptProperties['pub_date'] = strtotime($scriptProperties['pub_date']);
        if ($scriptProperties['pub_date'] < $now) $scriptProperties['published'] = 1;
        if ($scriptProperties['pub_date'] > $now) $scriptProperties['published'] = 0;
    }
}
if (isset($scriptProperties['unpub_date'])) {
    if (empty($scriptProperties['unpub_date'])) {
        $scriptProperties['unpub_date'] = 0;
    } else {
        $scriptProperties['unpub_date'] = strtotime($scriptProperties['unpub_date']);
        if ($scriptProperties['unpub_date'] < $now) {
            $scriptProperties['published'] = 0;
        }
    }
}

/* set publishedon date if publish change is different */
if (isset($scriptProperties['published']) && $scriptProperties['published'] != $resource->get('published')) {
    if (empty($scriptProperties['published'])) { /* if unpublishing */
        $scriptProperties['publishedon'] = 0;
        $scriptProperties['publishedby'] = 0;
    } else { /* if publishing */
        $scriptProperties['publishedon'] = !empty($scriptProperties['publishedon']) ? strtotime($scriptProperties['publishedon']) : time();
        $scriptProperties['publishedby'] = $modx->user->get('id');
    }
} else { /* if no change, unset publishedon/publishedby */
    if (empty($scriptProperties['published'])) { /* allow changing of publishedon date if resource is published */
        unset($scriptProperties['publishedon']);
    }
    unset($scriptProperties['publishedby']);
}

/* Deny publishing if not permitted */
if (!$modx->hasPermission('publish_document')) {
    $scriptProperties['published'] = $resource->get('published');
    $scriptProperties['publishedon'] = $resource->get('publishedon');
    $scriptProperties['publishedby'] = $resource->get('publishedby');
    $scriptProperties['pub_date'] = $resource->get('pub_date');
    $scriptProperties['unpub_date'] = $resource->get('unpub_date');
}
/* get parent */
$oldparent_id = $resource->get('parent');
if ($resource->get('id') == $modx->getOption('site_start')
&& (isset($scriptProperties['published']) && empty($scriptProperties['published']))) {
    return $modx->error->failure($modx->lexicon('resource_err_unpublish_sitestart'));
}
if ($resource->get('id') == $modx->getOption('site_start')
&& (!empty($scriptProperties['pub_date']) || !empty($scriptProperties['unpub_date']))) {
    return $modx->error->failure($modx->lexicon('resource_err_unpublish_sitestart_dates'));
}

$count_children = $modx->getCount('modResource',array('parent' => $resource->get('id')));
$scriptProperties['isfolder'] = $count_children > 0;

/* Keep original publish state, if change is not permitted */
if (!$modx->hasPermission('publish_document')) {
    $scriptProperties['publishedon'] = $resource->get('publishedon');
    $scriptProperties['pub_date'] = $resource->get('pub_date');
    $scriptProperties['unpub_date'] = $resource->get('unpub_date');
}

/* set deleted status and fire events */
if ($scriptProperties['deleted'] != $resource->get('deleted')) {
    if ($resource->get('deleted')) { /* undelete */
        if (!$modx->hasPermission('undelete_document')) {
            $scriptProperties['deleted'] = $resource->get('deleted');
        } else {
            $resource->set('deleted',false);
            $resourceUndeleted = true;
        }
    } else { /* delete */
        if (!$modx->hasPermission('delete_document')) {
            $scriptProperties['deleted'] = $resource->get('deleted');
        } else {
            $resource->set('deleted',true);
            $resourceDeleted = true;
        }
    }
}

/* Now save data */
unset($scriptProperties['variablesmodified']);
$resource->fromArray($scriptProperties);
$resource->set('editedby', $modx->user->get('id'));
$resource->set('editedon', time(), 'integer');

/* invoke OnBeforeDocFormSave event, and allow non-empty responses to prevent save */
$OnBeforeDocFormSave = $modx->invokeEvent('OnBeforeDocFormSave',array(
    'mode' => modSystemEvent::MODE_UPD,
    'id' => $resource->get('id'),
    'resource' => &$resource,
));
if (is_array($OnBeforeDocFormSave)) {
    $canSave = false;
    foreach ($OnBeforeDocFormSave as $msg) {
        if (!empty($msg)) {
            $canSave .= $msg."\n";
        }
    }
} else {
    $canSave = $OnBeforeDocFormSave;
}
if (!empty($canSave)) {
    return $modx->error->failure($canSave);
}

/* save resource */
if ($resource->save() == false) {
    return $modx->error->failure($modx->lexicon('document_err_save'));
}

/* Save resource groups */
if (isset($scriptProperties['resource_groups'])) {
    $resourceGroups = $modx->fromJSON($scriptProperties['resource_groups']);
    if (is_array($resourceGroups)) {
        foreach ($resourceGroups as $id => $resourceGroupAccess) {
            /* prevent adding records for non-existing groups */
            $resourceGroup = $modx->getObject('modResourceGroup',$resourceGroupAccess['id']);
            if (empty($resourceGroup)) continue;
            
            if ($resourceGroupAccess['access']) {
                $resourceGroupResource = $modx->getObject('modResourceGroupResource',array(
                    'document_group' => $resourceGroupAccess['id'],
                    'document' => $resource->get('id'),
                ));
                if (empty($resourceGroupResource)) {
                    $resourceGroupResource = $modx->newObject('modResourceGroupResource');
                }
                $resourceGroupResource->set('document_group',$resourceGroupAccess['id']);
                $resourceGroupResource->set('document',$resource->get('id'));
                $resourceGroupResource->save();
            } else {
                $resourceGroupResource = $modx->getObject('modResourceGroupResource',array(
                    'document_group' => $resourceGroupAccess['id'],
                    'document' => $resource->get('id'),
                ));
                if ($resourceGroupResource && $resourceGroupResource instanceof modResourceGroupResource) {
                    $resourceGroupResource->remove();
                }
            }
        }
    }
}
/* save TVs */
if (!empty($scriptProperties['tvs'])) {
    $tmplvars = array ();
    $c = $modx->newQuery('modTemplateVar');
    $c->setClassAlias('tv');
    $c->innerJoin('modTemplateVarTemplate', 'tvtpl', array(
        'tvtpl.tmplvarid = tv.id',
        'tvtpl.templateid' => $resource->get('template'),
    ));
    $c->leftJoin('modTemplateVarResource', 'tvc', array(
        'tvc.tmplvarid = tv.id',
        'tvc.contentid' => $resource->get('id'),
    ));
    $c->select(array(
        'DISTINCT tv.*',
        "IF(tvc.value != '',tvc.value,tv.default_text) AS value"
    ));
    $c->sortby('tv.rank');

    $tvs = $modx->getCollection('modTemplateVar',$c);
    foreach ($tvs as $tv) {
        /* set value of TV */
        $value = isset($scriptProperties['tv'.$tv->get('id')]) ? $scriptProperties['tv'.$tv->get('id')] : $tv->get('default_text');

        /* validation for different types */
        switch ($tv->get('type')) {
            case 'url':
                if ($scriptProperties['tv'.$tv->get('id').'_prefix'] != '--') {
                    $value = str_replace(array('ftp://','http://'),'', $value);
                    $value = $scriptProperties['tv'.$tv->get('id').'_prefix'].$value;
                }
                break;
            case 'date':
                $value = empty($value) ? '' : strftime('%Y-%m-%d %H:%M:%S',strtotime($value));
                break;
            /* ensure tag types trim whitespace from tags */
            case 'tag':
            case 'autotag':
                $tags = explode(',',$value);
                $newTags = array();
                foreach ($tags as $tag) {
                    $newTags[] = trim($tag);
                }
                $value = implode(',',$newTags);
                break;
            default:
                /* handles checkboxes & multiple selects elements */
                if (is_array($value)) {
                    $featureInsert = array();
                    while (list($featureValue, $featureItem) = each($value)) {
                        $featureInsert[count($featureInsert)] = $featureItem;
                    }
                    $value = implode('||',$featureInsert);
                }
                break;
        }

        /* if different than default and set, set TVR record */
        $default = $tv->processBindings($tv->get('default_text'),$resource->get('id'));
        if (strcmp($value,$default) != 0) {

            /* update the existing record */
            $tvc = $modx->getObject('modTemplateVarResource',array(
                'tmplvarid' => $tv->get('id'),
                'contentid' => $resource->get('id'),
            ));
            if ($tvc == null) {
                /* add a new record */
                $tvc = $modx->newObject('modTemplateVarResource');
                $tvc->set('tmplvarid',$tv->get('id'));
                $tvc->set('contentid',$resource->get('id'));
            }
            $tvc->set('value',$value);
            $tvc->save();

        /* if equal to default value, erase TVR record */
        } else {
            $tvc = $modx->getObject('modTemplateVarResource',array(
                'tmplvarid' => $tv->get('id'),
                'contentid' => $resource->get('id'),
            ));
            if ($tvc != null) $tvc->remove();
        }
    }
}
/* end save TVs */

/* fire delete/undelete events */
if (isset($resourceUndeleted) && !empty($resourceUndeleted)) {
    $modx->invokeEvent('OnResourceUndelete',array(
        'id' => $resource->get('id'),
        'resource' => &$resource,
    ));
}
if (isset($resourceDeleted) && !empty($resourceDeleted)) {
    $modx->invokeEvent('OnResourceDelete',array(
        'id' => $resource->get('id'),
        'resource' => &$resource,
    ));
}


/* invoke OnDocFormSave event */
$modx->invokeEvent('OnDocFormSave',array(
    'mode' => modSystemEvent::MODE_UPD,
    'id' => $resource->get('id'),
    'resource' => & $resource
));

/* log manager action */
$modx->logManagerAction('save_resource','modResource',$resource->get('id'));

if (!empty($scriptProperties['syncsite']) || !empty($scriptProperties['clearCache'])) {
    /* empty cache */
    $cacheManager= $modx->getCacheManager();
    $cacheManager->clearCache(array (
            "{$resource->context_key}/resources/",
            "{$resource->context_key}/context.cache.php",
        ),
        array(
            'objects' => array('modResource', 'modContext', 'modTemplateVarResource'),
            'publishing' => true
        )
    );
}

$resource->removeLock();

$returnArray = $resource->get(array_diff(array_keys($resource->_fields), array('content','ta','introtext','description','link_attributes','pagetitle','longtitle','menutitle')));
foreach ($returnArray as $k => $v) {
    if (strpos($k,'tv') === 0) {
        unset($returnArray[$k]);
    }
}
$returnArray['class_key'] = $resource->get('class_key');
$returnArray['preview_url'] = $modx->makeUrl($resource->get('id'));
return $modx->error->success('',$returnArray);