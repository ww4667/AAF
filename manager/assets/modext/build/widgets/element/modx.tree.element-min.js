MODx.tree.Element=function(A){A=A||{};Ext.applyIf(A,{rootVisible:false,enableDD:!Ext.isEmpty(MODx.config.enable_dragdrop)?true:false,ddGroup:"modx-treedrop-dd",title:"",url:MODx.config.connectors_url+"element/index.php",useDefaultToolbar:true,tbar:[{icon:MODx.config.template_url+"images/restyle/icons/template.png",cls:"x-btn-icon",tooltip:{text:_("new")+" "+_("template")},handler:function(){this.redirect("index.php?a="+MODx.action["element/template/create"]);},scope:this,hidden:MODx.perm.new_template?false:true},{icon:MODx.config.template_url+"images/restyle/icons/tv.png",cls:"x-btn-icon",tooltip:{text:_("new")+" "+_("tv")},handler:function(){this.redirect("index.php?a="+MODx.action["element/tv/create"]);},scope:this,hidden:MODx.perm.new_tv?false:true},{icon:MODx.config.template_url+"images/restyle/icons/chunk.png",cls:"x-btn-icon",tooltip:{text:_("new")+" "+_("chunk")},handler:function(){this.redirect("index.php?a="+MODx.action["element/chunk/create"]);},scope:this,hidden:MODx.perm.new_chunk?false:true},{icon:MODx.config.template_url+"images/restyle/icons/snippet.png",cls:"x-btn-icon",tooltip:{text:_("new")+" "+_("snippet")},handler:function(){this.redirect("index.php?a="+MODx.action["element/snippet/create"]);},scope:this,hidden:MODx.perm.new_snippet?false:true},{icon:MODx.config.template_url+"images/restyle/icons/plugin.png",cls:"x-btn-icon",tooltip:{text:_("new")+" "+_("plugin")},handler:function(){this.redirect("index.php?a="+MODx.action["element/plugin/create"]);},scope:this,hidden:MODx.perm.new_plugin?false:true}]});MODx.tree.Element.superclass.constructor.call(this,A);this.on("afterSort",this.afterSort);};Ext.extend(MODx.tree.Element,MODx.tree.Tree,{forms:{},windows:{},stores:{},createCategory:function(C,B){var A={};if(this.cm.activeNode.attributes.data){A.parent=this.cm.activeNode.attributes.data.id;}if(!this.windows.createCategory){this.windows.createCategory=MODx.load({xtype:"modx-window-category-create",record:A,listeners:{success:{fn:function(){this.refreshNode(this.cm.activeNode.id,true);},scope:this}}});}this.windows.createCategory.setValues(A);this.windows.createCategory.show(B.target);},renameCategory:function(C,B){var A=this.cm.activeNode.attributes.data;if(!this.windows.renameCategory){this.windows.renameCategory=MODx.load({xtype:"modx-window-category-rename",record:A,listeners:{success:{fn:function(D){var F=D.a.result.object;var E=this.cm.activeNode;E.setText(F.category+" ("+F.id+")");Ext.get(E.getUI().getEl()).frame();E.attributes.data.id=F.id;E.attributes.data.category=F.category;},scope:this}}});}this.windows.renameCategory.setValues(A);this.windows.renameCategory.show(B.target);},removeCategory:function(C,A){var B=this.cm.activeNode.attributes.data.id;MODx.msg.confirm({title:_("warning"),text:_("category_confirm_delete"),url:MODx.config.connectors_url+"element/category.php",params:{action:"remove",id:B},listeners:{success:{fn:function(){this.cm.activeNode.remove();},scope:this}}});},duplicateElement:function(H,E,G,C){var D={id:G,type:C,name:_("duplicate_of",{name:this.cm.activeNode.attributes.name})};if(!this.windows.duplicateElement){this.windows.duplicateElement=MODx.load({xtype:"modx-window-element-duplicate",record:D,listeners:{success:{fn:function(){this.refreshNode(this.cm.activeNode.id);},scope:this}}});}else{var A=MODx.config.connectors_url+"element/"+C+".php";this.windows.duplicateElement.fp.getForm().url=A;var B=this.windows.duplicateElement.fp.getForm().findField("duplicateValues");if(B){if(C!="tv"){B.hide();var F=B.getEl().up(".x-form-item");if(F){F.setDisplayed(false);}}else{B.show();var F=B.getEl().up(".x-form-item");if(F){F.setDisplayed(true);}}}}this.windows.duplicateElement.setValues(D);this.windows.duplicateElement.show(E.target);},removeElement:function(D,A){var C=this.cm.activeNode.id.substr(2);var B=C.split("_");MODx.msg.confirm({title:_("warning"),text:_("remove_this_confirm",{type:B[0],name:this.cm.activeNode.attributes.name}),url:MODx.config.connectors_url+"element/"+B[0]+".php",params:{action:"remove",id:B[2]},listeners:{success:{fn:function(){this.cm.activeNode.remove();},scope:this}}});},quickCreate:function(E,D,B){var C={category:this.cm.activeNode.attributes.pk||""};var A=MODx.load({xtype:"modx-window-quick-create-"+B,record:C,listeners:{success:{fn:function(){this.refreshNode(this.cm.activeNode.id);},scope:this}}});A.setValues(C);A.show(D.target);A.on("hide",function(){delete A;},this);},quickUpdate:function(C,B,A){MODx.Ajax.request({url:MODx.config.connectors_url+"element/"+A+".php",params:{action:"get",id:this.cm.activeNode.attributes.pk},listeners:{success:{fn:function(E){var D=MODx.load({xtype:"modx-window-quick-update-"+A,record:E.object,listeners:{success:{fn:function(F){this.refreshNode(this.cm.activeNode.id);},scope:this}}});D.setValues(E.object);D.show(B.target);},scope:this}}});},_createElement:function(G,C,B){var F=this.cm.activeNode.id.substr(2);var E=F.split("_");var B=E[0]=="type"?E[1]:E[0];var D=E[0]=="type"?0:(E[1]=="category"?E[2]:E[3]);var A=MODx.action["element/"+B+"/create"];this.redirect("index.php?a="+A+"&category="+D);this.cm.hide();return false;},afterSort:function(C){var A=C.event.target.attributes;if(A.type=="category"){var B=C.event.dropNode.attributes;if(A.id!="n_category"&&B.type=="category"){C.event.target.expand();}else{this.refreshNode(C.event.target.attributes.id,true);this.refreshNode("n_type_"+C.event.dropNode.attributes.type,true);}}},_handleDrop:function(B){var A=B.target;if(B.point=="above"||B.point=="below"){return false;}if(B.target.attributes.type=="category"&&B.point=="append"){return true;}if(!this.isCorrectType(B.dropNode,A)){return false;}return B.target.getDepth()>0;},isCorrectType:function(A,C){var B=false;if(C.attributes.type==A.attributes.type){if(!(C.parentNode&&((A.attributes.cls=="folder"&&C.attributes.cls=="folder"&&A.parentNode.id==C.parentNode.id)||C.attributes.cls=="file"))){B=true;}}return B;},_showContextMenu:function(C,B){C.select();this.cm.activeNode=C;this.cm.removeAll();if(C.attributes.menu&&C.attributes.menu.items){this.addContextMenuItem(C.attributes.menu.items);this.cm.show(C.getUI().getEl(),"t?");}else{var A=[];switch(C.attributes.classKey){case"root":A=this._getRootMenu(C);break;case"modCategory":A=this._getCategoryMenu(C);break;default:A=this._getElementMenu(C);break;}this.addContextMenuItem(A);this.cm.showAt(B.xy);}B.stopEvent();},_getQuickCreateMenu:function(G,A){var E=G.getUI();var F=[];var D=["template","tv","chunk","snippet","plugin"];var C;for(var B=0;B<D.length;B++){C=D[B];if(E.hasClass("pnew_"+C)){F.push({text:_(C),scope:this,type:C,handler:function(I,H){this.quickCreate(I,H,I.type);}});}}A.push({text:_("quick_create"),handler:function(){return false;},menu:{items:F}});return A;},_getElementMenu:function(D){var B=D.attributes;var C=D.getUI();var A=[];A.push({text:"<b>"+B.text+"</b>",handler:function(){return false;},header:true});A.push("-");if(C.hasClass("pedit")){A.push({text:_("edit")+" "+B.elementType,type:B.type,pk:B.pk,handler:function(F,E){location.href="index.php?a="+MODx.action["element/"+F.type+"/update"]+"&id="+F.pk;}});A.push({text:_("quick_update_"+B.type),type:B.type,handler:function(F,E){this.quickUpdate(F,E,F.type);}});}if(C.hasClass("pnew")){A.push({text:_("duplicate")+" "+B.elementType,pk:B.pk,type:B.type,handler:function(F,E){this.duplicateElement(F,E,F.pk,F.type);}});}if(C.hasClass("pdelete")){A.push({text:_("remove")+" "+B.elementType,handler:this.removeElement});}A.push("-");if(C.hasClass("pnew")){A.push({text:_("add_to_category_this",{type:B.elementType}),handler:this._createElement});}if(C.hasClass("pnewcat")){A.push({text:_("new_category"),handler:this.createCategory});}return A;},_getCategoryMenu:function(D){var B=D.attributes;var C=D.getUI();var A=[];A.push({text:"<b>"+B.text+"</b>",handler:function(){return false;},header:true});A.push("-");if(C.hasClass("pnewcat")){A.push({text:_("category_create"),handler:this.createCategory});}if(C.hasClass("peditcat")){A.push({text:_("category_rename"),handler:this.renameCategory});}if(A.length>2){A.push("-");}if(B.elementType){A.push({text:_("add_to_category_this",{type:Ext.util.Format.capitalize(B.type)}),handler:this._createElement});}this._getQuickCreateMenu(D,A);if(C.hasClass("pdelcat")){A.push("-");A.push({text:_("category_remove"),handler:this.removeCategory});}return A;},_getRootMenu:function(D){var B=D.attributes;var C=D.getUI();var A=[];if(C.hasClass("pnew")){A.push({text:_("new_"+B.type),handler:this._createElement});A.push({text:_("quick_create_"+B.type),type:B.type,handler:function(F,E){this.quickCreate(F,E,F.type);}});}if(C.hasClass("pnewcat")){if(C.hasClass("pnew")){A.push("-");}A.push({text:_("new_category"),handler:this.createCategory});}return A;}});Ext.reg("modx-tree-element",MODx.tree.Element);MODx.window.DuplicateElement=function(A){A=A||{};this.ident=A.ident||"dupeel-"+Ext.id();var B=[{xtype:"hidden",name:"id",id:"modx-"+this.ident+"-id"},{xtype:"textfield",fieldLabel:_("element_name_new"),name:"name",id:"modx-"+this.ident+"-name",anchor:"90%"}];if(A.record.type=="tv"){B.push({xtype:"checkbox",fieldLabel:_("element_duplicate_values"),labelSeparator:"",name:"duplicateValues",id:"modx-"+this.ident+"-duplicate-values",anchor:"95%",inputValue:1,checked:false});}Ext.applyIf(A,{title:_("element_duplicate"),url:MODx.config.connectors_url+"element/"+A.record.type+".php",action:"duplicate",fields:B,labelWidth:150});MODx.window.DuplicateElement.superclass.constructor.call(this,A);};Ext.extend(MODx.window.DuplicateElement,MODx.Window);Ext.reg("modx-window-element-duplicate",MODx.window.DuplicateElement);MODx.window.RenameCategory=function(A){A=A||{};this.ident=A.ident||"rencat-"+Ext.id();Ext.applyIf(A,{title:_("category_rename"),height:150,width:350,url:MODx.config.connectors_url+"element/category.php",action:"update",fields:[{xtype:"hidden",name:"id",id:"modx-"+this.ident+"-id",value:A.record.id},{xtype:"textfield",fieldLabel:_("name"),name:"category",id:"modx-"+this.ident+"-category",width:150,value:A.record.category,anchor:"90%"}]});MODx.window.RenameCategory.superclass.constructor.call(this,A);};Ext.extend(MODx.window.RenameCategory,MODx.Window);Ext.reg("modx-window-category-rename",MODx.window.RenameCategory);