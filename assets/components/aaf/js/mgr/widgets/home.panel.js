Aaf.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,items: [{
            html: '<h2>'+_('aaf.management')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,bodyStyle: 'padding: 10px'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,stateful: true
            ,stateId: 'aaf-home-tabpanel'
            ,stateEvents: ['tabchange']
            ,getState:function() {
                return {activeTab:this.items.indexOf(this.getActiveTab())};
            }
            ,items: [{
                title: 'Members'
                ,defaults: { autoHeight: true }
                ,items: [{
                    html: '<p>'+_('aaf.management_desc')+'</p><br />'
                    ,border: false
                },{
                    xtype: 'aaf-grid-members'
                    ,preventRender: true
                }]
            },{
                title: 'Jobs'
                ,defaults: { autoHeight: true }
                ,items: [{
                    html: '<p>'+_('aaf.management_desc')+'</p><br />'
                    ,border: false
                },{
                    xtype: 'aaf-grid-jobs'
                    ,preventRender: true
                }]
            }]
        }]
    });
    Aaf.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(Aaf.panel.Home,MODx.Panel);
Ext.reg('aaf-panel-home',Aaf.panel.Home);
