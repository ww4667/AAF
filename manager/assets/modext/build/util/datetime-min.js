Ext.ns("Ext.ux.form");Ext.ux.form.DateTime=Ext.extend(Ext.form.Field,{dateValidator:null,defaultAutoCreate:{tag:"input",type:"hidden"},dtSeparator:" ",hiddenFormat:"Y-m-d H:i:s",otherToNow:true,timePosition:"right",timeValidator:null,timeWidth:100,dateFormat:"m/d/y",timeFormat:"g:i A",initComponent:function(){Ext.ux.form.DateTime.superclass.initComponent.call(this);var B=Ext.apply({},{id:this.id+"-date",format:this.dateFormat||Ext.form.DateField.prototype.format,width:this.timeWidth,selectOnFocus:this.selectOnFocus,validator:this.dateValidator,listeners:{blur:{scope:this,fn:this.onBlur},focus:{scope:this,fn:this.onFocus}}},this.dateConfig);this.df=new Ext.form.DateField(B);this.df.ownerCt=this;delete (this.dateFormat);var A=Ext.apply({},{id:this.id+"-time",format:this.timeFormat||Ext.form.TimeField.prototype.format,width:this.timeWidth,selectOnFocus:this.selectOnFocus,validator:this.timeValidator,listeners:{blur:{scope:this,fn:this.onBlur},focus:{scope:this,fn:this.onFocus}}},this.timeConfig);this.tf=new Ext.form.TimeField(A);this.tf.ownerCt=this;delete (this.timeFormat);this.relayEvents(this.df,["focus","specialkey","invalid","valid"]);this.relayEvents(this.tf,["focus","specialkey","invalid","valid"]);this.on("specialkey",this.onSpecialKey,this);},onRender:function(C,A){if(this.isRendered){return ;}Ext.ux.form.DateTime.superclass.onRender.call(this,C,A);var B;if("below"===this.timePosition||"bellow"===this.timePosition){B=Ext.DomHelper.append(C,{tag:"table",style:"border-collapse:collapse",children:[{tag:"tr",children:[{tag:"td",style:"padding-bottom:1px",cls:"ux-datetime-date"}]},{tag:"tr",children:[{tag:"td",cls:"ux-datetime-time"}]}]},true);}else{B=Ext.DomHelper.append(C,{tag:"table",style:"border-collapse:collapse",children:[{tag:"tr",children:[{tag:"td",style:"padding-right:4px",cls:"ux-datetime-date"},{tag:"td",cls:"ux-datetime-time"}]}]},true);}this.tableEl=B;this.wrap=B.wrap({cls:"x-form-field-wrap x-datetime-wrap"});this.wrap.on("mousedown",this.onMouseDown,this,{delay:10});this.df.render(B.child("td.ux-datetime-date"));this.tf.render(B.child("td.ux-datetime-time"));this.df.el.swallowEvent(["keydown","keypress"]);this.tf.el.swallowEvent(["keydown","keypress"]);if("side"===this.msgTarget){var D=this.el.findParent(".x-form-element",10,true);if(D){this.errorIcon=D.createChild({cls:"x-form-invalid-icon"});}var E={errorIcon:this.errorIcon,msgTarget:"side",alignErrorIcon:this.alignErrorIcon.createDelegate(this)};Ext.apply(this.df,E);Ext.apply(this.tf,E);}this.el.dom.name=this.hiddenName||this.name||this.id;this.df.el.dom.removeAttribute("name");this.tf.el.dom.removeAttribute("name");this.isRendered=true;this.updateHidden();},adjustSize:Ext.BoxComponent.prototype.adjustSize,alignErrorIcon:function(){this.errorIcon.alignTo(this.tableEl,"tl-tr",[2,0]);},initDateValue:function(){this.dateValue=this.otherToNow?new Date():new Date(1970,0,1,0,0,0);},clearInvalid:function(){this.df.clearInvalid();this.tf.clearInvalid();},markInvalid:function(A){this.df.markInvalid(A);this.tf.markInvalid(A);},beforeDestroy:function(){if(this.isRendered){this.wrap.removeAllListeners();this.wrap.remove();this.tableEl.remove();this.df.destroy();this.tf.destroy();}},disable:function(){if(this.isRendered){this.df.disabled=this.disabled;this.df.onDisable();this.tf.onDisable();}this.disabled=true;this.df.disabled=true;this.tf.disabled=true;this.fireEvent("disable",this);return this;},enable:function(){if(this.rendered){this.df.onEnable();this.tf.onEnable();}this.disabled=false;this.df.disabled=false;this.tf.disabled=false;this.fireEvent("enable",this);return this;},focus:function(){this.df.focus();},getPositionEl:function(){return this.wrap;},getResizeEl:function(){return this.wrap;},getValue:function(){return this.dateValue?new Date(this.dateValue):"";},isValid:function(){return this.df.isValid()&&this.tf.isValid();},isVisible:function(){return this.df.rendered&&this.df.getActionEl().isVisible();},onBlur:function(A){if(this.wrapClick){A.focus();this.wrapClick=false;}if(A===this.df){this.updateDate();}else{this.updateTime();}this.updateHidden();this.validate();(function(){if(!this.df.hasFocus&&!this.tf.hasFocus){var B=this.getValue();if(String(B)!==String(this.startValue)){this.fireEvent("change",this,B,this.startValue);}this.hasFocus=false;this.fireEvent("blur",this);}}).defer(100,this);},onFocus:function(){if(!this.hasFocus){this.hasFocus=true;this.startValue=this.getValue();this.fireEvent("focus",this);}},onMouseDown:function(A){if(!this.disabled){this.wrapClick="td"===A.target.nodeName.toLowerCase();}},onSpecialKey:function(B,C){var A=C.getKey();if(A===C.TAB){if(B===this.df&&!C.shiftKey){C.stopEvent();this.tf.focus();}if(B===this.tf&&C.shiftKey){C.stopEvent();this.df.focus();}this.updateValue();}if(A===C.ENTER){this.updateValue();}},reset:function(){this.df.setValue(this.originalValue);this.tf.setValue(this.originalValue);},setDate:function(A){this.df.setValue(A);},setTime:function(A){this.tf.setValue(A);},setSize:function(A,B){if(!A){return ;}if("below"===this.timePosition){this.df.setSize(A,B);this.tf.setSize(A,B);if(Ext.isIE){this.df.el.up("td").setWidth(A);this.tf.el.up("td").setWidth(A);}}else{this.df.setSize(A-this.timeWidth-4,B);this.tf.setSize(this.timeWidth,B);if(Ext.isIE){this.df.el.up("td").setWidth(A-this.timeWidth-4);this.tf.el.up("td").setWidth(this.timeWidth);}}},setValue:function(B){if(!B&&true===this.emptyToNow){this.setValue(new Date());return ;}else{if(!B){this.setDate("");this.setTime("");this.updateValue();return ;}}if("number"===typeof B){B=new Date(B);}else{if("string"===typeof B&&this.hiddenFormat){B=Date.parseDate(B,this.hiddenFormat);}}B=B?B:new Date(1970,0,1,0,0,0);var A;if(B instanceof Date){this.setDate(B);this.setTime(B);this.dateValue=new Date(Ext.isIE?B.getTime():B);}else{A=B.split(this.dtSeparator);this.setDate(A[0]);if(A[1]){if(A[2]){A[1]+=A[2];}this.setTime(A[1]);}}this.updateValue();},setVisible:function(A){if(A){this.df.show();this.tf.show();}else{this.df.hide();this.tf.hide();}return this;},show:function(){return this.setVisible(true);},hide:function(){return this.setVisible(false);},updateDate:function(){var A=this.df.getValue();if(A){if(!(this.dateValue instanceof Date)){this.initDateValue();if(!this.tf.getValue()){this.setTime(this.dateValue);}}this.dateValue.setMonth(0);this.dateValue.setFullYear(A.getFullYear());this.dateValue.setMonth(A.getMonth(),A.getDate());}else{this.dateValue="";this.setTime("");}},updateTime:function(){var A=this.tf.getValue();if(A&&!(A instanceof Date)){A=Date.parseDate(A,this.tf.format);}if(A&&!this.df.getValue()){this.initDateValue();this.setDate(this.dateValue);}if(this.dateValue instanceof Date){if(A){this.dateValue.setHours(A.getHours());this.dateValue.setMinutes(A.getMinutes());this.dateValue.setSeconds(A.getSeconds());}else{this.dateValue.setHours(0);this.dateValue.setMinutes(0);this.dateValue.setSeconds(0);}}},updateHidden:function(){if(this.isRendered){var A=this.dateValue instanceof Date?this.dateValue.format(this.hiddenFormat):"";this.el.dom.value=A;}},updateValue:function(){this.updateDate();this.updateTime();this.updateHidden();return ;},validate:function(){return this.df.validate()&&this.tf.validate();},renderer:function(C){var B=C.editor.dateFormat||Ext.ux.form.DateTime.prototype.dateFormat;B+=" "+(C.editor.timeFormat||Ext.ux.form.DateTime.prototype.timeFormat);var A=function(E){var D=Ext.util.Format.date(E,B);return D;};return A;}});Ext.reg("xdatetime",Ext.ux.form.DateTime);