Aaf.grid.Members = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'aaf-grid-members'
        ,url: Aaf.config.connector_url
        ,baseParams: { action: 'mgr/aaf/getList' }
        ,save_action: 'mgr/aaf/updateFromGrid'
        ,fields: ['id','name','description','menu']
        ,paging: true
        ,autosave: true
        ,remoteSort: true
        ,anchor: '97%'
        ,autoExpandColumn: 'name'
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,sortable: true
            ,width: 60
        },{
            header: _('aaf.name')
            ,dataIndex: 'name'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'textfield' }
        },{
            header: _('aaf.description')
            ,dataIndex: 'description'
            ,sortable: false
            ,width: 350
            ,editor: { xtype: 'textfield' }
        }]
        ,tbar: [{
            xtype: 'textfield'
            ,id: 'aaf-search-filter'
            ,emptyText: _('aaf.search...')
            ,listeners: {
                'change': {fn:this.search,scope:this}
                ,'render': {fn: function(cmp) {
                    new Ext.KeyMap(cmp.getEl(), {
                        key: Ext.EventObject.ENTER
                        ,fn: function() {
                            this.fireEvent('change',this.getValue());
                            this.blur();
                            return true; }
                        ,scope: cmp
                    });
                },scope:this}
            }
        },{
            text: _('aaf.aaf_create')
            ,handler: { xtype: 'aaf-window-member-create' ,blankValues: true }
        }]
    });
    Aaf.grid.Members.superclass.constructor.call(this,config)
};
Ext.extend(Aaf.grid.Members,MODx.grid.Grid,{
    search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
    ,updateMember: function(btn,e) {
        if (!this.updateMemberWindow) {
            this.updateMemberWindow = MODx.load({
                xtype: 'aaf-window-member-update'
                ,record: this.menu.record
                ,listeners: {
                    'success': {fn:this.refresh,scope:this}
                }
            });
        }
        this.updateMemberWindow.setValues(this.menu.record);
        this.updateMemberWindow.show(e.target);
    }

    ,removeAaf: function() {
        MODx.msg.confirm({
            title: _('aaf.member_remove')
            ,text: _('aaf.member_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/aaf/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:this.refresh,scope:this}
            }
        });
    }
});
Ext.reg('aaf-grid-members',Aaf.grid.Members);


Aaf.window.CreateMember = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('aaf.member_create')
        ,url: Aaf.config.connector_url
        ,baseParams: {
            action: 'mgr/aaf/create'
        }
        ,fields: [{
            xtype: 'textfield'
            ,fieldLabel: _('aaf.name')
            ,name: 'name'
            ,width: 300
        },{
            xtype: 'textarea'
            ,fieldLabel: _('aaf.description')
            ,name: 'description'
            ,width: 300
        }]
    });
    Aaf.window.CreateMember.superclass.constructor.call(this,config);
};
Ext.extend(Aaf.window.CreateMember,MODx.Window);
Ext.reg('aaf-window-member-create',Aaf.window.CreateMember);


Aaf.window.UpdateMember = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('aaf.member_update')
        ,url: Aaf.config.connector_url
        ,baseParams: {
            action: 'mgr/aaf/update'
        }
        ,fields: [{
            xtype: 'hidden'
            ,name: 'id'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('aaf.name')
            ,name: 'name'
            ,width: 300
        },{
            xtype: 'textarea'
            ,fieldLabel: _('aaf.description')
            ,name: 'description'
            ,width: 300
        }]
    });
    Aaf.window.UpdateMember.superclass.constructor.call(this,config);
};
Ext.extend(Aaf.window.UpdateMember,MODx.Window);
Ext.reg('aaf-window-member-update',Aaf.window.UpdateMember);