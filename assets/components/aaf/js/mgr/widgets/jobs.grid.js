Aaf.grid.Jobs = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'aaf-grid-jobs'
        ,url: Aaf.config.connector_url
        ,baseParams: { action: 'mgr/aaf/getJobList' }
        ,save_action: 'mgr/aaf/updateJobFromGrid'
        ,fields: ['id','company','job_title','description','name','post_job_until','email','phone_number','approved','menu']
        ,paging: true
        ,autosave: true
        ,remoteSort: true
        ,anchor: '97%'
        ,autoExpandColumn: 'description'
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,sortable: true
            ,width: 60
        },{
            header: _('aaf.job_company')
            ,dataIndex: 'company'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'textfield' }
        },{
            header: _('aaf.job_title')
            ,dataIndex: 'job_title'
            ,sortable: true
            ,width: 100
            ,editor: { xtype: 'textfield' }
        },{
            header: _('aaf.job_description')
            ,dataIndex: 'description'
            ,sortable: false
            ,width: 350
            ,editor: { xtype: 'textarea' }
        },{
            header: _('aaf.job_approved')
            ,dataIndex: 'approved'
            ,sortable: true
            ,width: 80
            ,editor: { xtype: 'combo-boolean', renderer: 'boolean' }
        }]
        ,tbar: [{
            xtype: 'textfield'
            ,id: 'aaf-jobs-search-filter'
            ,emptyText: _('aaf.search...')
            ,listeners: {
                'change': {fn:this.search,scope:this},
				
                'render': {
                    fn: function(cmp){
                        cmp.getEl().addKeyListener(Ext.EventObject.ENTER, function(){
                            this.search(cmp);
                        }, this);
                    },
                    scope: this
                }
            }
        },{
            text: _('aaf.job_create')
            ,handler: { xtype: 'aaf-window-job-create' ,blankValues: true }
        }]
    });
    Aaf.grid.Jobs.superclass.constructor.call(this,config)
};
Ext.extend(Aaf.grid.Jobs,MODx.grid.Grid,{
    search: function(C, A, B){
        this.getStore().baseParams = {
            action: "mgr/aaf/getJobList",
            query: C.getValue()
        };
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
    ,updateJob: function(btn,e) {
        if (!this.updateJobWindow) {
            this.updateJobWindow = MODx.load({
                xtype: 'aaf-window-job-update'
                ,record: this.menu.record
                ,listeners: {
                    'success': {fn:this.refresh,scope:this}
                }
            });
        }
        this.updateJobWindow.setValues(this.menu.record);
        this.updateJobWindow.show(e.target);
    }

    ,removeJob: function() {
        MODx.msg.confirm({
            title: _('aaf.job_remove')
            ,text: _('aaf.job_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/aaf/removeJob'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:this.refresh,scope:this}
            }
        });
    }
});
Ext.reg('aaf-grid-jobs',Aaf.grid.Jobs);

Aaf.window.CreateJob = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('aaf.job_create')
        ,url: Aaf.config.connector_url
        ,baseParams: {
            action: 'mgr/aaf/createJob'
        }
        ,fields: [{
            xtype: 'textfield'
            ,fieldLabel: _('aaf.job_company')
            ,name: 'company'
            ,width: 300
        },{
            xtype: 'textfield'
            ,fieldLabel: _('aaf.job_title')
            ,name: 'job_title'
            ,width: 300
        },{
            xtype: 'textarea'
            ,fieldLabel: _('aaf.job_description')
            ,name: 'description'
            ,width: 300
        },{
            xtype: 'textfield'
            ,fieldLabel: _('aaf.job_name')
            ,name: 'name'
            ,width: 300
        },{
            xtype: 'textfield'
            ,fieldLabel: _('aaf.job_email')
            ,name: 'email'
            ,vtype: 'email'
            ,width: 300
        },{
            xtype: 'textfield'
            ,fieldLabel: _('aaf.job_phone')
            ,name: 'phone_number'
            ,width: 300
        },{
            xtype: 'datefield'
            ,fieldLabel: _('aaf.job_post_until')
            ,name: 'post_job_until'
            ,altFormats: 'Y-m-d H:i:s'
            ,width: 100
        },{
            xtype: 'combo-boolean'
            ,fieldLabel: _('aaf.job_approved')
            ,name: 'approved'
            ,width: 100
            ,renderer: 'boolean'
        }]
    });
    Aaf.window.CreateJob.superclass.constructor.call(this,config);
};
Ext.extend(Aaf.window.CreateJob,MODx.Window);
Ext.reg('aaf-window-job-create',Aaf.window.CreateJob);


Aaf.window.UpdateJob = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('aaf.job_update')
        ,url: Aaf.config.connector_url
        ,baseParams: {
            action: 'mgr/aaf/updateJob'
        }
        ,fields: [{
            xtype: 'hidden'
            ,name: 'id'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('aaf.job_company')
            ,name: 'company'
            ,width: 300
        },{
            xtype: 'textfield'
            ,fieldLabel: _('aaf.job_title')
            ,name: 'job_title'
            ,width: 300
        },{
            xtype: 'textarea'
            ,fieldLabel: _('aaf.job_description')
            ,name: 'description'
            ,width: 300
        },{
            xtype: 'textfield'
            ,fieldLabel: _('aaf.job_name')
            ,name: 'name'
            ,width: 300
        },{
            xtype: 'textfield'
            ,fieldLabel: _('aaf.job_email')
            ,name: 'email'
            ,vtype: 'email'
            ,width: 300
        },{
            xtype: 'textfield'
            ,fieldLabel: _('aaf.job_phone')
            ,name: 'phone_number'
            ,width: 300
        },{
            xtype: 'datefield'
            ,fieldLabel: _('aaf.job_post_until')
            ,name: 'post_job_until'
            ,altFormats: 'Y-m-d H:i:s'
            ,width: 100
        },{
            xtype: 'combo-boolean'
            ,fieldLabel: _('aaf.job_approved')
            ,name: 'approved'
            ,width: 100
            ,renderer: 'boolean'
        }]
    });
    Aaf.window.UpdateJob.superclass.constructor.call(this,config);
};
Ext.extend(Aaf.window.UpdateJob,MODx.Window);
Ext.reg('aaf-window-job-update',Aaf.window.UpdateJob);