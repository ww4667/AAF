MODx.grid.ManagerLog=function(A){A=A||{};Ext.applyIf(A,{title:_("manager_log"),id:"modx-grid-manager-log",url:MODx.config.connectors_url+"system/log.php",fields:["id","user","username","occurred","action","classKey","item","name","menu"],autosave:false,paging:true,columns:[{header:_("occurred"),dataIndex:"occurred",width:125},{header:_("user"),dataIndex:"username",width:125,editable:false},{header:_("action"),dataIndex:"action",width:125},{header:"Object",dataIndex:"name",width:300}],tbar:[{xtype:"button",text:_("filter_clear"),scope:this,handler:function(){var B=Ext.getCmp(this.config.formpanel);if(B){B.getForm().reset();B.filter();}}},"->",{xtype:"button",text:_("mgrlog_clear"),scope:this,handler:function(){var B=Ext.getCmp(this.config.formpanel);if(B){B.clearLog();}}}]});MODx.grid.ManagerLog.superclass.constructor.call(this,A);};Ext.extend(MODx.grid.ManagerLog,MODx.grid.Grid);Ext.reg("modx-grid-manager-log",MODx.grid.ManagerLog);MODx.panel.ManagerLog=function(A){A=A||{};Ext.applyIf(A,{id:"modx-panel-manager-log",defaults:{collapsible:false,autoHeight:true},items:[{html:"<h2>"+_("mgrlog_view")+"</h2>",border:false,cls:"modx-page-header",id:"manager-log-header"},MODx.getPageStructure([{title:_("mgrlog_query"),layout:"form",bodyStyle:"padding: 15px;",defaults:{border:false,msgTarget:"side"},items:[{html:"<p>"+_("mgrlog_query_msg")+"</p>",border:false},{xtype:"modx-combo-user",fieldLabel:_("user"),name:"user",listeners:{select:{fn:this.filter,scope:this}}},{xtype:"textfield",fieldLabel:_("action"),name:"actionType",listeners:{change:{fn:this.filter,scope:this},render:{fn:this._addEnterKeyHandler}}},{xtype:"datefield",fieldLabel:_("date_start"),name:"dateStart",allowBlank:true,listeners:{select:{fn:this.filter,scope:this},render:{fn:this._addEnterKeyHandler}}},{xtype:"datefield",fieldLabel:_("date_end"),name:"dateEnd",allowBlank:true,listeners:{select:{fn:this.filter,scope:this},render:{fn:this._addEnterKeyHandler}}},MODx.PanelSpacer,{xtype:"modx-grid-manager-log",preventRender:true,formpanel:"modx-panel-manager-log"}]}])]});MODx.panel.ManagerLog.superclass.constructor.call(this,A);};Ext.extend(MODx.panel.ManagerLog,MODx.FormPanel,{filter:function(E,D,A){var C=this.getForm().getValues();var B=Ext.getCmp("modx-grid-manager-log");C.action="getList";B.getStore().baseParams=C;B.getStore().load({params:C,start:0,limit:20});B.getBottomToolbar().changePage(1);},_addEnterKeyHandler:function(){this.getEl().addKeyListener(Ext.EventObject.ENTER,function(){this.fireEvent("change");},this);},clearLog:function(A,B){MODx.msg.confirm({title:_("warning"),text:_("mgrlog_clear_confirm"),url:MODx.config.connectors_url+"system/log.php",params:{action:"truncate"},listeners:{success:{fn:function(){Ext.getCmp("modx-grid-manager-log").refresh();},scope:this}}});}});Ext.reg("modx-panel-manager-log",MODx.panel.ManagerLog);