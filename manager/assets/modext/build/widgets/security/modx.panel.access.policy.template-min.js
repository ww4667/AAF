MODx.panel.AccessPolicyTemplate=function(A){A=A||{};var B=A.record||{};Ext.applyIf(A,{url:MODx.config.connectors_url+"security/access/policy/template.php",baseParams:{action:"update",id:MODx.request.id},id:"modx-panel-access-policy-template",class_key:"modAccessPolicyTemplate",plugin:"",bodyStyle:"",defaults:{collapsible:false,autoHeight:true},items:[{html:"<h2>"+_("policy_template")+(A.record?": "+A.record.name:"")+"</h2>",border:false,cls:"modx-page-header",id:"modx-policy-template-header"},{xtype:"modx-tabs",defaults:{bodyStyle:"padding: 15px",autoHeight:true,border:true},forceLayout:true,deferredRender:false,items:[{title:_("policy_template"),layout:"form",items:[{html:"<p>"+_("policy_template.desc")+"</p>",border:false},{xtype:"hidden",name:"id"},{xtype:"textfield",fieldLabel:_("name"),name:"name",width:300,maxLength:255,enableKeyEvents:true,allowBlank:false,listeners:{keyup:{scope:this,fn:function(C,D){Ext.getCmp("modx-policy-template-header").getEl().update("<h2>"+_("policy")+": "+C.getValue()+"</h2>");}}}},{xtype:"textarea",fieldLabel:_("description"),name:"description",width:300,grow:true},{xtype:"textfield",fieldLabel:_("lexicon"),name:"lexicon",width:300,allowBlank:true,value:"permissions"},{html:"<hr /><p>"+_("permissions_desc")+"</p>",border:false},{xtype:"modx-grid-template-permissions",policy:MODx.request.id,autoHeight:true,preventRender:true}]}]}],listeners:{setup:{fn:this.setup,scope:this},success:{fn:this.success,scope:this},beforeSubmit:{fn:this.beforeSubmit,scope:this}}});MODx.panel.AccessPolicyTemplate.superclass.constructor.call(this,A);};Ext.extend(MODx.panel.AccessPolicyTemplate,MODx.FormPanel,{initialized:false,setup:function(){if(this.initialized){return ;}if(this.config.template===""||this.config.template===0){this.fireEvent("ready");return false;}var B=this.config.record;this.getForm().setValues(B);var A=Ext.getCmp("modx-grid-template-permissions");if(A){A.getStore().loadData(B.permissions);}this.fireEvent("ready");MODx.fireEvent("ready");this.initialized=true;},beforeSubmit:function(B){var A=Ext.getCmp("modx-grid-template-permissions");Ext.apply(B.form.baseParams,{permissions:A?A.encode():{}});},success:function(A){Ext.getCmp("modx-grid-template-permissions").getStore().commitChanges();}});Ext.reg("modx-panel-access-policy-template",MODx.panel.AccessPolicyTemplate);MODx.grid.TemplatePermissions=function(A){A=A||{};Ext.applyIf(A,{id:"modx-grid-template-permissions",fields:["name","description","description_trans","value","menu"],columns:[{header:_("name"),dataIndex:"name",width:150,editor:{xtype:"textfield",renderer:true}},{header:_("description"),dataIndex:"description_trans",width:250,editable:false}],data:[],width:"90%",height:300,maxHeight:300,autosave:false,autoExpandColumn:"name",tbar:[{text:_("permission_add_template"),scope:this,handler:this.createAttribute}]});MODx.grid.TemplatePermissions.superclass.constructor.call(this,A);this.propRecord=new Ext.data.Record.create(["name","description","value"]);};Ext.extend(MODx.grid.TemplatePermissions,MODx.grid.LocalGrid,{createAttribute:function(A,B){this.loadWindow(A,B,{xtype:"modx-window-template-permission-create",record:{},blankValues:true,listeners:{success:{fn:function(D){var C=this.getStore();D.description_trans=D.description;var E=new this.propRecord(D);C.add(E);Ext.getCmp("modx-panel-access-policy-template").fireEvent("fieldChange");},scope:this}}});return true;},remove:function(){var A=this.getSelectionModel().getSelected();if(this.fireEvent("beforeRemoveRow",A)){this.getStore().remove(A);this.fireEvent("afterRemoveRow",A);}},_showMenu:function(C,B,D){D.stopEvent();D.preventDefault();var A=this.menu;A.recordIndex=B;A.record=this.getStore().getAt(B).data;if(!this.getSelectionModel().isSelected(B)){this.getSelectionModel().selectRow(B);}A.removeAll();A.add({text:_("permission_remove"),scope:this,handler:this.remove});A.show(D.target);}});Ext.reg("modx-grid-template-permissions",MODx.grid.TemplatePermissions);MODx.window.NewTemplatePermission=function(A){A=A||{};this.ident=A.ident||"polpc"+Ext.id();Ext.applyIf(A,{title:_("permission_add_template"),height:150,width:475,url:MODx.config.connectors_url+"security/access/policy/index.php",action:"addProperty",saveBtnText:_("add"),fields:[{xtype:"modx-combo-permission",fieldLabel:_("name"),name:"name",hiddenName:"name",id:"modx-"+this.ident+"-name",anchor:"90%"},{xtype:"textarea",fieldLabel:_("description"),name:"description",id:"modx-"+this.ident+"-description",anchor:"90%",grow:true}]});MODx.window.NewTemplatePermission.superclass.constructor.call(this,A);};Ext.extend(MODx.window.NewTemplatePermission,MODx.Window,{submit:function(){var E=this.fp.getForm().getValues();var D=Ext.getCmp("modx-grid-template-permissions");var C=D.getStore();var B=C.findExact("name",E.name);if(B!=-1){MODx.msg.alert(_("error"),_("permission_err_ae"));return false;}var A=Ext.getCmp("modx-"+this.ident+"-name");C=A.getStore();var F=C.getAt(C.find("name",E.name));if(F){E.description=F.data.description;E.description_trans=F.data.description;}E.value=1;this.fireEvent("success",E);this.hide();return false;}});Ext.reg("modx-window-template-permission-create",MODx.window.NewTemplatePermission);MODx.combo.Permission=function(A){A=A||{};Ext.applyIf(A,{name:"permission",hiddenName:"permission",displayField:"name",valueField:"name",fields:["name","description"],editable:true,typeAhead:false,forceSelection:false,tpl:new Ext.XTemplate('<tpl for="."><div class="x-combo-list-item"><span style="font-weight: bold">{name}</span>','<p style="margin: 0; font-size: 11px; color: gray;">{description}</p></div></tpl>'),url:MODx.config.connectors_url+"security/access/permission.php"});MODx.combo.Permission.superclass.constructor.call(this,A);};Ext.extend(MODx.combo.Permission,MODx.combo.ComboBox);Ext.reg("modx-combo-permission",MODx.combo.Permission);