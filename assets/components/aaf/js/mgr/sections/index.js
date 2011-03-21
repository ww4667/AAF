Ext.onReady(function() {
    MODx.load({ xtype: 'aaf-page-home'});
});

Aaf.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'aaf-panel-home'
            ,renderTo: 'aaf-panel-home-div'
        }]
    });
    Aaf.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(Aaf.page.Home,MODx.Component);
Ext.reg('aaf-page-home',Aaf.page.Home);