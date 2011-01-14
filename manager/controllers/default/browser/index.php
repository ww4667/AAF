<?php
/**
 * Loads the MODx.Browser page
 *
 * @package modx
 * @subpackage manager.browser
 */
if (!$modx->hasPermission('file_manager')) return $modx->error->failure($modx->lexicon('permission_denied'));

$modx->regClientStartupScript($modx->getOption('manager_url').'assets/modext/core/modx.view.js');
$modx->regClientStartupScript($modx->getOption('manager_url').'assets/modext/widgets/core/modx.rte.browser.js');

/* invoke OnRichTextBrowserInit */
$rtecallback = $modx->invokeEvent('OnRichTextBrowserInit');
if (is_array($rtecallback)) $rtecallback = trim(implode(',',$rtecallback),',');

$ctx = !empty($_REQUEST['ctx']) ? $_REQUEST['ctx'] : 'web';
$modx->smarty->assign('site_id',$modx->site_id);
$modx->smarty->assign('rtecallback',$rtecallback);
$modx->smarty->assign('_ctx',$ctx);
$modx->regClientStartupHTMLBlock('<script type="text/javascript">
MODx.siteId = "'.$modx->site_id.'";
MODx.ctx = "'.$ctx.'";
</script>');

$modx->response->registerCssJs(false);
return $modx->smarty->fetch('browser/index.tpl');