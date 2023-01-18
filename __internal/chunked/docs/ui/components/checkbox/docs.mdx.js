var SLDS="object"==typeof SLDS?SLDS:{};SLDS["__internal/chunked/docs/./ui/components/checkbox/docs.mdx.js"]=function(e){function t(t){for(var a,c,n=t[0],o=t[1],s=t[2],u=0,b=[];u<n.length;u++)c=n[u],Object.prototype.hasOwnProperty.call(r,c)&&r[c]&&b.push(r[c][0]),r[c]=0;for(a in o)Object.prototype.hasOwnProperty.call(o,a)&&(e[a]=o[a]);for(d&&d(t);b.length;)b.shift()();return i.push.apply(i,s||[]),l()}function l(){for(var e,t=0;t<i.length;t++){for(var l=i[t],a=!0,n=1;n<l.length;n++){var o=l[n];0!==r[o]&&(a=!1)}a&&(i.splice(t--,1),e=c(c.s=l[0]))}return e}var a={},r={20:0},i=[];function c(t){if(a[t])return a[t].exports;var l=a[t]={i:t,l:!1,exports:{}};return e[t].call(l.exports,l,l.exports,c),l.l=!0,l.exports}c.m=e,c.c=a,c.d=function(e,t,l){c.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:l})},c.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},c.t=function(e,t){if(1&t&&(e=c(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var l=Object.create(null);if(c.r(l),Object.defineProperty(l,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)c.d(l,a,function(t){return e[t]}.bind(null,a));return l},c.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return c.d(t,"a",t),t},c.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},c.p="/assets/scripts/bundle/";var n=this.webpackJsonpSLDS___internal_chunked_docs=this.webpackJsonpSLDS___internal_chunked_docs||[],o=n.push.bind(n);n.push=t,n=n.slice();for(var s=0;s<n.length;s++)t(n[s]);var d=o;return i.push([793,0]),l()}({0:function(e,t){e.exports=React},20:function(e,t){e.exports=ReactDOM},21:function(e,t){e.exports=JSBeautify},793:function(e,t,l){"use strict";l.r(t),l.d(t,"getElement",(function(){return v})),l.d(t,"getContents",(function(){return w}));var a=l(0),r=l.n(a),i=l(4),c=l(2),n=(l(26),l(14),l(39)),o=l(30),s=l(80),d=l(8),u=l(11),b=r.a.createElement(s.a,null),h=[{id:"checked",label:"Checked",element:r.a.createElement(s.a,{isChecked:!0})},{id:"disabled",label:"Disabled",element:r.a.createElement(s.a,{isDisabled:!0})},{id:"checked-disabled",label:"Checked and Disabled",element:r.a.createElement(s.a,{isChecked:!0,isDisabled:!0})},{id:"error",label:"Error",element:r.a.createElement(s.a,{isRequired:!0,hasError:!0,inlineMessage:"This field is required"})},{id:"required",label:"Required",element:r.a.createElement(s.a,{isRequired:!0})},{id:"view-mode-unchecked",label:"View mode - Unchecked",element:r.a.createElement(d.b,{labelContent:"Form Element Label",isViewMode:!0},r.a.createElement(u.a,{symbol:"steps",size:"x-small",useCurrentColor:!0,assistiveText:"False",title:"False"}))},{id:"view-mode-checked",label:"View mode - Checked",element:r.a.createElement(d.b,{labelContent:"Form Element Label",isViewMode:!0},r.a.createElement(u.a,{symbol:"check",size:"x-small",useCurrentColor:!0,assistiveText:"True",title:"True"}))}],m=[{id:"help-text-icon",label:"Help text icon",element:r.a.createElement(s.a,{hasTooltip:!0})},{id:"required-help-text-icon",label:"Required with Help text icon",element:r.a.createElement(s.a,{isRequired:!0,hasTooltip:!0})},{id:"required-help-text-icon-tooltip",label:"Required with Help text icon, showing tooltip",element:r.a.createElement("div",{style:{paddingTop:"3rem"}},r.a.createElement(s.a,{isRequired:!0,hasTooltip:!0,showTooltip:!0}))}],p=l(1),f=l(37),O=i.c.a,x=i.c.code,k=i.c.h2,j=i.c.h3,E=i.c.h4,y=i.c.h5,g=i.c.p,v=function(){return Object(a.createElement)(i.b,{},Object(a.createElement)("div",{className:"doc lead"},"A checkable input that communicates if an option is true, false or indeterminate"),Object(a.createElement)(c.a,{exampleOnly:!0},Object(p.f)(o.b)),k({id:"About-Checkbox"},"About Checkbox"),g({},"The ability to style checkboxes with CSS varies across browsers. To ensure that checkboxes look the same everywhere, we use a custom DOM. Pay close attention to the markup, because all elements must exist for the styles to work."),j({id:"Accessibility"},"Accessibility"),g({},"Groups of checkboxes should be marked up using the fieldset and legend element. This helps someone using assistive technology to understand the question they're answering with the group of checkboxes. The fieldset is placed around the whole group and the legend contains the question."),g({},"Custom checkboxes are created by applying the ",x({},".slds-checkbox")," class to a ",x({},"<label>")," element. To remain accessible to all user agents, place ",x({},"<input>")," with ",x({},'type="checkbox"')," inside the ",x({},"<label>")," element. The ",x({},"<input>")," is then visually hidden, and the styling is placed on a span with the ",x({},".slds-checkbox_faux")," class. The styling of the span changes based on whether the checkbox is selected or focused by using a pseudo-element. A second span with ",x({},".slds-form-element__label")," contains the label text."),g({},"When a single checkbox is required, ",x({},'<div class="slds-checkbox">')," should get ",x({},'<abbr class="required" title="required">*</abbr>')," added to the DOM, directly before the ",x({},'<input type="checkbox" />')," for visual indication that the checkbox is required."),g({},"When a checkbox group is required, the ",x({},"<fieldset>")," should receive the class ",x({},".slds-is-required"),". The ",x({},"<legend>")," should then get ",x({},'<abbr class="required" title="required">*</abbr>')," added to the DOM for visual indication that the checkbox group is required."),g({},"As SLDS checkboxes rely on the ",x({},":checked")," pseudo selector, and the indeterminate state is only accessible via JavaScript, the use of a CSS class on the input will be necessary to implement this in SLDS. Use JavaScript to add the class when the indeterminate property is set to true on the input."),j({id:"Mobile"},"Mobile"),Object(a.createElement)(f.a,{patternSpecificText:"checkboxes will have an increased size to accommodate tapping with a finger instead of the more precise mouse cursor, as well as having larger label text"}),Object(a.createElement)(c.a,{frameOnly:!0,frameTitle:"Example mobile styles for checkboxes"},Object(p.f)(o.b)),k({id:"Base"},"Base"),g({},"The base variant of a checkbox is a single boolean value. The base checkbox is consumed by both a grouped checkbox and a checkbox within a form element."),g({},"The ",O({href:"#Form-Element"},"form element variant")," accommodates a top level label and additional functionality such as like help text and read only mode. Help text is not supported on a single checkbox."),Object(a.createElement)(c.a,null,Object(p.f)(o.b)),j({id:"States"},"States"),E({id:"Required"},"Required"),Object(a.createElement)(c.a,null,Object(p.f)(o.d,"required")),Object(a.createElement)(c.a,{frameOnly:!0,frameTitle:"Required checkbox example"},Object(p.f)(o.d,"required")),E({id:"Error"},"Error"),Object(a.createElement)(c.a,null,Object(p.f)(o.d,"error")),Object(a.createElement)(c.a,{frameOnly:!0,frameTitle:"Checkbox in error state example"},Object(p.f)(o.d,"error")),E({id:"Disabled"},"Disabled"),Object(a.createElement)(c.a,null,Object(p.f)(o.d,"disabled")),y({id:"Checked-and-Disabled"},"Checked and Disabled"),Object(a.createElement)(c.a,null,Object(p.f)(o.d,"checked-and-disabled")),j({id:"Examples"},"Examples"),E({id:"Group"},"Group"),Object(a.createElement)(c.a,null,Object(p.f)(o.c,"group")),Object(a.createElement)(c.a,{frameOnly:!0,frameTitle:"Group checkbox example"},Object(p.f)(o.c,"group")),y({id:"Required-2"},"Required"),Object(a.createElement)(c.a,null,Object(p.f)(o.c,"group-required")),Object(a.createElement)(c.a,{frameOnly:!0,frameTitle:"Required group checkbox example"},Object(p.f)(o.c,"group-required")),y({id:"Error-2"},"Error"),Object(a.createElement)(c.a,null,Object(p.f)(o.c,"group-error")),Object(a.createElement)(c.a,{frameOnly:!0,frameTitle:"Group error checkbox example"},Object(p.f)(o.c,"group-error")),y({id:"Disabled-2"},"Disabled"),Object(a.createElement)(c.a,null,Object(p.f)(o.c,"group-disabled")),E({id:"RTL-(right-to-left-direction)"},"RTL (right to left direction)"),Object(a.createElement)(c.a,null,Object(p.f)(o.c,"rtl")),k({id:"Form-Element"},"Form Element"),Object(a.createElement)(c.a,null,Object(p.f)(b)),j({id:"States-2"},"States"),E({id:"Checked"},"Checked"),Object(a.createElement)(c.a,null,Object(p.f)(h,"checked")),E({id:"Disabled-3"},"Disabled"),Object(a.createElement)(c.a,null,Object(p.f)(h,"disabled")),E({id:"Checked-and-Disabled-2"},"Checked and Disabled"),Object(a.createElement)(c.a,null,Object(p.f)(h,"checked-disabled")),E({id:"Error-3"},"Error"),Object(a.createElement)(c.a,null,Object(p.f)(h,"error")),E({id:"Required-3"},"Required"),Object(a.createElement)(c.a,null,Object(p.f)(h,"required")),j({id:"View-mode"},"View mode"),g({},"View mode is the read only state of a checkbox form element."),E({id:"Unchecked"},"Unchecked"),Object(a.createElement)(c.a,null,Object(p.f)(h,"view-mode-unchecked")),E({id:"Checked-2"},"Checked"),Object(a.createElement)(c.a,null,Object(p.f)(h,"view-mode-checked")),j({id:"Examples-2"},"Examples"),E({id:"With-help-text"},"With help text"),Object(a.createElement)(c.a,null,Object(p.f)(m,"help-text-icon")),E({id:"Required-with-help-text"},"Required with help text"),Object(a.createElement)(c.a,null,Object(p.f)(m,"required-help-text-icon")),E({id:"Required-with-help-text-with-tooltip"},"Required with help text with tooltip"),Object(a.createElement)(c.a,null,Object(p.f)(m,"required-help-text-icon-tooltip")),k({id:"Styling-Hooks-Overview"},"Styling Hooks Overview"),Object(a.createElement)(n.a,{name:"checkbox",type:"component"}))},w=function(){return Object(i.a)(v())}}});