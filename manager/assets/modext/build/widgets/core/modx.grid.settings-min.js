MODx.grid.SettingsGrid=function(A){A=A||{};this.exp=new Ext.grid.RowExpander({tpl:new Ext.Template('<p class="desc">{description_trans}</p>')});if(!A.tbar){A.tbar=[{text:_("setting_create"),scope:this,handler:{xtype:"modx-window-setting-create",url:A.url||MODx.config.connectors_url+"system/settings.php",blankValues:true}}];}A.tbar.push("->",{xtype:"modx-combo-area",name:"area",id:"modx-filter-area",emptyText:_("area_filter"),baseParams:{action:"getAreas",namespace:MODx.request.namespace?MODx.request.namespace:"core"},width:250,allowBlank:true,listeners:{select:{fn:this.filterByArea,scope:this}}},{xtype:"modx-combo-namespace",name:"namespace",id:"modx-filter-namespace",emptyText:_("namespace_filter"),value:MODx.request.namespace?MODx.request.namespace:"core",allowBlank:true,width:150,listeners:{select:{fn:this.filterByNamespace,scope:this}}},"-",{xtype:"textfield",name:"filter_key",id:"modx-filter-key",emptyText:_("search_by_key")+"...",listeners:{change:{fn:this.filterByKey,scope:this},render:{fn:function(B){new Ext.KeyMap(B.getEl(),{key:Ext.EventObject.ENTER,fn:function(){this.fireEvent("change",this.getValue());this.blur();return true;},scope:B});},scope:this}}},{xtype:"button",id:"modx-filter-clear",text:_("filter_clear"),listeners:{click:{fn:this.clearFilter,scope:this}}});this.cm=new Ext.grid.ColumnModel({columns:[this.exp,{header:_("name"),dataIndex:"name_trans",sortable:true,editable:false,width:150},{header:_("key"),dataIndex:"key",sortable:true,editable:false,width:125},{header:_("value"),dataIndex:"value",sortable:true,editable:true,renderer:this.renderDynField.createDelegate(this,[this],true),width:260},{header:_("last_modified"),dataIndex:"editedon",sortable:true,editable:false,width:125},{header:_("area"),dataIndex:"area_text",sortable:true,hidden:true,editable:false}],getCellEditor:function(B,F){var C=this.getDataIndex(B);if(C=="value"){var E=A.store.getAt(F);var D=MODx.load({xtype:E?(E.get("xtype")||"textfield"):"textfield"});return new Ext.grid.GridEditor(D);}return Ext.grid.ColumnModel.prototype.getCellEditor.call(this,B,F);}});Ext.applyIf(A,{cm:this.cm,fields:["key","name","value","description","xtype","namespace","area","area_text","editedon","oldkey","menu","name_trans","description_trans"],baseParams:{action:"getList",namespace:MODx.request.namespace?MODx.request.namespace:"core"},clicksToEdit:2,grouping:true,groupBy:"area_text",singleText:_("setting"),pluralText:_("settings"),plugins:this.exp,primaryKey:"key",autosave:true,pageSize:MODx.config.default_per_page>30?MODx.config.default_per_page:30,paging:true,collapseFirst:false,tools:[{id:"plus",qtip:_("expand_all"),handler:this.expandAll,scope:this},{id:"minus",hidden:true,qtip:_("collapse_all"),handler:this.collapseAll,scope:this}]});this.view=new Ext.grid.GroupingView({emptyText:A.emptyText||_("ext_emptymsg"),forceFit:true,autoFill:true,showPreview:true,enableRowBody:true,scrollOffset:0});MODx.grid.SettingsGrid.superclass.constructor.call(this,A);};Ext.extend(MODx.grid.SettingsGrid,MODx.grid.Grid,{_addEnterKeyHandler:function(){this.getEl().addKeyListener(Ext.EventObject.ENTER,function(){this.fireEvent("change");},this);},_showMenu:function(C,B,D){D.stopEvent();D.preventDefault();this.menu.record=this.getStore().getAt(B).data;if(!this.getSelectionModel().isSelected(B)){this.getSelectionModel().selectRow(B);}this.menu.removeAll();var A=[];if(this.menu.record.menu){A=this.menu.record.menu;}else{A.push({text:_("setting_update"),handler:{xtype:"modx-window-setting-update",record:{fk:Ext.isDefined(this.config.fk)?this.config.fk:0}}},"-",{text:_("setting_remove"),handler:this.remove.createDelegate(this,["setting_remove_confirm"])});}if(A.length>0){this.addContextMenuItem(A);this.menu.showAt(D.xy);}},clearFilter:function(){var A=MODx.request.namespace?MODx.request.namespace:"core";this.getStore().baseParams={action:"getList",namespace:A};Ext.getCmp("modx-filter-namespace").reset();var B=Ext.getCmp("modx-filter-area");if(B){B.store.baseParams.namespace=A;B.store.load();B.reset();}Ext.getCmp("modx-filter-key").reset();this.getBottomToolbar().changePage(1);this.refresh();},filterByKey:function(D,C,B){var A=C||D;this.getStore().baseParams.key=A;this.getStore().baseParams.namespace="";this.getBottomToolbar().changePage(1);this.refresh();return true;},filterByNamespace:function(A,E,B){this.getStore().baseParams.namespace=E.data.name;this.getStore().baseParams.area="";this.getBottomToolbar().changePage(1);this.refresh();var D=Ext.getCmp("modx-filter-area");if(D){var C=D.store;C.baseParams.namespace=E.data.name;C.removeAll();C.load();D.setValue("");}},filterByArea:function(A,C,B){this.getStore().baseParams.area=C.data.v;this.getBottomToolbar().changePage(1);this.refresh();},renderDynField:function(J,G,C,H,L,K,E){var A=K.getAt(H).data;J=Ext.util.Format.htmlEncode(J);var F;if(A.xtype=="combo-boolean"||A.xtype=="modx-combo-boolean"){F=MODx.grid.Grid.prototype.rendYesNo;return F(J,G,C,H,L,K,E);}else{if(A.xtype==="datefield"){F=Ext.util.Format.dateRenderer("Y-m-d");return F(J,G,C,H,L,K,E);}else{if(A.xtype.substr(0,5)=="combo"||A.xtype.substr(0,10)=="modx-combo"){var I=E.getColumnModel();var D=I.getCellEditor(L,H);if(!D){var B=Ext.ComponentMgr.create({xtype:A.xtype||"textfield"});D=new Ext.grid.GridEditor(B);I.setEditor(L,D);}F=MODx.combo.Renderer(D.field);return F(J,G,C,H,L,K,E);}}}return J;}});Ext.reg("modx-grid-settings",MODx.grid.SettingsGrid);MODx.combo.Area=function(A){A=A||{};Ext.applyIf(A,{name:"area",hiddenName:"area",displayField:"d",valueField:"v",fields:["d","v"],url:MODx.config.connectors_url+"system/settings.php",baseParams:{action:"getAreas"}});MODx.combo.Area.superclass.constructor.call(this,A);};Ext.extend(MODx.combo.Area,MODx.combo.ComboBox);Ext.reg("modx-combo-area",MODx.combo.Area);MODx.window.CreateSetting=function(A){A=A||{};Ext.applyIf(A,{title:_("setting_create"),width:500,url:A.url,action:"create",fields:[{xtype:"hidden",name:"fk",id:"modx-cs-fk",value:A.fk||0},{xtype:"textfield",fieldLabel:_("key"),name:"key",id:"modx-cs-key",maxLength:100,anchor:"90%"},{xtype:"textfield",fieldLabel:_("name"),name:"name",id:"modx-cs-name",anchor:"90%"},{xtype:"modx-combo-xtype-spec",fieldLabel:_("xtype"),description:_("xtype_desc"),id:"modx-cs-xtype",anchor:"90%"},{xtype:"modx-combo-namespace",fieldLabel:_("namespace"),name:"namespace",id:"modx-cs-namespace",value:"core",anchor:"90%"},{xtype:"textfield",fieldLabel:_("area_lexicon_string"),description:_("area_lexicon_string_msg"),name:"area",id:"modx-cs-area",anchor:"90%"},{xtype:"textfield",fieldLabel:_("value"),name:"value",id:"modx-cs-value",anchor:"90%"},{xtype:"textarea",fieldLabel:_("description"),name:"description",id:"modx-cs-description",allowBlank:true,anchor:"90%"}]});MODx.window.CreateSetting.superclass.constructor.call(this,A);this.on("show",function(){this.reset();},this);};Ext.extend(MODx.window.CreateSetting,MODx.Window);Ext.reg("modx-window-setting-create",MODx.window.CreateSetting);MODx.combo.xType=function(A){A=A||{};Ext.applyIf(A,{store:new Ext.data.SimpleStore({fields:["d","v"],data:[[_("textfield"),"textfield"],[_("textarea"),"textarea"],[_("yesno"),"combo-boolean"]]}),displayField:"d",valueField:"v",mode:"local",name:"xtype",hiddenName:"xtype",triggerAction:"all",editable:false,selectOnFocus:false,value:"textfield"});MODx.combo.xType.superclass.constructor.call(this,A);};Ext.extend(MODx.combo.xType,Ext.form.ComboBox);Ext.reg("modx-combo-xtype-spec",MODx.combo.xType);MODx.window.UpdateSetting=function(A){A=A||{};Ext.applyIf(A,{title:_("setting_update"),width:450,url:A.grid.config.url,action:"update",fields:[{xtype:"hidden",name:"fk",id:"modx-us-fk",value:A.fk||0},{xtype:"statictextfield",fieldLabel:_("key"),name:"key",id:"modx-us-key",submitValue:true},{xtype:"textfield",fieldLabel:_("name"),name:"name",id:"modx-us-name"},{xtype:"modx-combo-xtype-spec",name:"xtype",hiddenName:"xtype",id:"modx-us-xtype",fieldLabel:_("xtype"),description:_("xtype_desc")},{xtype:"modx-combo-namespace",fieldLabel:_("namespace"),name:"namespace",id:"modx-us-namespace",value:"core"},{xtype:"textfield",fieldLabel:_("area_lexicon_string"),description:_("area_lexicon_string_msg"),name:"area",id:"modx-us-area"},{xtype:"textfield",fieldLabel:_("value"),name:"value",id:"modx-us-value",width:250},{xtype:"textarea",fieldLabel:_("description"),name:"description",id:"modx-us-description",allowBlank:true,width:250}]});MODx.window.UpdateSetting.superclass.constructor.call(this,A);};Ext.extend(MODx.window.UpdateSetting,MODx.Window);Ext.reg("modx-window-setting-update",MODx.window.UpdateSetting);