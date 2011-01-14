/**
 * Loads the panel for managing lexicons.
 * 
 * @class MODx.panel.Lexicon
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype modx-panel-lexicon
 */
MODx.panel.Lexicon = function(config) {
    config = config || {};
    
    Ext.applyIf(config,{
        id: 'modx-panel-lexicon'
        ,itemId: 'panel-lexicon'
        ,bodyStyle: ''
        ,defaults: { autoHeight: true, collapsible: false }
        ,items: [{
            html: '<h2>'+_('lexicon_management')+'</h2>'
            ,border: false
            ,id: 'modx-lexicon-header'
            ,itemId: 'lexicon-header'
            ,cls: 'modx-page-header'
            
        },MODx.getPageStructure([{
            title: _('lexicon_management')
            ,layout: 'form'
            ,bodyStyle: 'padding: 15px;'
            ,items: [{
                html: '<p>'+_('lexicon_management_desc')+'</p>'
                ,border: false
            },{
                xtype: 'modx-grid-lexicon'
                ,itemId: 'grid-lexicon'
                ,title: ''
                ,preventRender: true
            }]
        }])]
    });
    MODx.panel.Lexicon.superclass.constructor.call(this,config);
};
Ext.extend(MODx.panel.Lexicon,MODx.FormPanel);
Ext.reg('modx-panel-lexicon',MODx.panel.Lexicon);
