MODx.panel.AccessPolicies=function(A){A=A||{};Ext.applyIf(A,{id:"modx-panel-access-policies",bodyStyle:"",defaults:{collapsible:false,autoHeight:true},items:[{html:"<h2>"+_("policies")+"</h2>",border:false,id:"modx-policies-header",cls:"modx-page-header"},{layout:"form",bodyStyle:"padding: 15px",items:[{html:"<p>"+_("policy_management_msg")+"</p>",border:false},{xtype:"modx-grid-access-policy",preventRender:true}]}]});MODx.panel.AccessPolicies.superclass.constructor.call(this,A);};Ext.extend(MODx.panel.AccessPolicies,MODx.FormPanel);Ext.reg("modx-panel-access-policies",MODx.panel.AccessPolicies);MODx.grid.AccessPolicy=function(A){A=A||{};this.sm=new Ext.grid.CheckboxSelectionModel();Ext.applyIf(A,{id:"modx-grid-access-policy",url:MODx.config.connectors_url+"security/access/policy.php",fields:["id","name","description","class","data","parent","template","template_name","active_permissions","total_permissions","active_of","cls"],paging:true,autosave:true,remoteSort:true,sm:this.sm,columns:[this.sm,{header:_("policy_name"),dataIndex:"name",width:200,editor:{xtype:"textfield",allowBlank:false},sortable:true},{header:_("description"),dataIndex:"description",width:375,editor:{xtype:"textfield"}},{header:_("policy_template"),dataIndex:"template_name",width:375},{header:_("active_permissions"),dataIndex:"active_of",width:100,editable:false}],tbar:[{text:_("policy_create"),scope:this,handler:this.createPolicy},"-",{text:_("bulk_actions"),menu:[{text:_("policy_remove_multiple"),handler:this.removeSelected,scope:this}]}]});MODx.grid.AccessPolicy.superclass.constructor.call(this,A);};Ext.extend(MODx.grid.AccessPolicy,MODx.grid.Grid,{editPolicy:function(B,A){location.href="?a="+MODx.action["security/access/policy/update"]+"&id="+this.menu.record.id;},createPolicy:function(A,C){var B=this.menu.record;if(!this.windows.apc){this.windows.apc=MODx.load({xtype:"modx-window-access-policy-create",record:B,plugin:this.config.plugin,listeners:{success:{fn:function(D){this.refresh();},scope:this}}});}this.windows.apc.reset();this.windows.apc.show(C.target);},getMenu:function(){var B=this.getSelectionModel().getSelected();var C=B.data.cls;var A=[];if(this.getSelectionModel().getCount()>1){A.push({text:_("policy_remove_multiple"),handler:this.removeSelected});}else{if(C.indexOf("pedit")!=-1){A.push({text:_("policy_update"),handler:this.editPolicy});A.push({text:_("policy_duplicate"),handler:this.confirm.createDelegate(this,["duplicate","policy_duplicate_confirm"])});}if(C.indexOf("premove")!=-1){if(A.length>0){A.push("-");}A.push({text:_("policy_remove"),handler:this.confirm.createDelegate(this,["remove","policy_remove_confirm"])});}}if(A.length>0){this.addContextMenuItem(A);}},removeSelected:function(){var A=this.getSelectedAsList();if(A===false){return false;}MODx.msg.confirm({title:_("policy_remove_multiple"),text:_("policy_remove_multiple_confirm"),url:this.config.url,params:{action:"removeMultiple",policies:A},listeners:{success:{fn:function(B){this.getSelectionModel().clearSelections(true);this.refresh();},scope:this}}});return true;}});Ext.reg("modx-grid-access-policy",MODx.grid.AccessPolicy);MODx.window.CreateAccessPolicy=function(A){A=A||{};Ext.applyIf(A,{width:400,title:_("policy_create"),url:MODx.config.connectors_url+"security/access/policy.php",action:"create",fields:[{fieldLabel:_("name"),name:"name",id:"modx-cap-name",xtype:"textfield",anchor:"90%"},{fieldLabel:_("policy_template"),name:"template",hiddenName:"template",id:"modx-cap-template",xtype:"modx-combo-access-policy-template",anchor:"90%"},{fieldLabel:_("description"),name:"description",id:"modx-cap-description",xtype:"textarea",anchor:"90%",height:50},{name:"class",id:"modx-cap-class",xtype:"hidden"},{name:"id",id:"modx-cap-id",xtype:"hidden"}]});MODx.window.CreateAccessPolicy.superclass.constructor.call(this,A);};Ext.extend(MODx.window.CreateAccessPolicy,MODx.Window);Ext.reg("modx-window-access-policy-create",MODx.window.CreateAccessPolicy);MODx.combo.AccessPolicyTemplate=function(A){A=A||{};Ext.applyIf(A,{name:"template",hiddenName:"template",fields:["id","name","description"],forceSelection:true,typeAhead:false,editable:false,allowBlank:false,listWidth:300,url:MODx.config.connectors_url+"security/access/policy/template.php",tpl:new Ext.XTemplate('<tpl for="."><div class="x-combo-list-item"><span style="font-weight: bold">{name}</span>','<p style="margin: 0; font-size: 11px; color: gray;">{description}</p></div></tpl>')});MODx.combo.AccessPolicyTemplate.superclass.constructor.call(this,A);};Ext.extend(MODx.combo.AccessPolicyTemplate,MODx.combo.ComboBox);Ext.reg("modx-combo-access-policy-template",MODx.combo.AccessPolicyTemplate);