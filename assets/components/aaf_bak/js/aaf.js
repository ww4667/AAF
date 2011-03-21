var Aaf = function(config) {
    config = config || {};
    Aaf.superclass.constructor.call(this,config);
};
Ext.extend(Aaf,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {}
});
Ext.reg('aaf',Aaf);

var Aaf = new Aaf();