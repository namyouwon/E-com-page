var SLDS="object"==typeof SLDS?SLDS:{};SLDS["__internal/chunked/showcase/./ui/components/global-header/base/example.jsx.js"]=function(e){function t(t){for(var n,i,s=t[0],l=t[1],c=t[2],d=0,f=[];d<s.length;d++)i=s[d],Object.prototype.hasOwnProperty.call(a,i)&&a[i]&&f.push(a[i][0]),a[i]=0;for(n in l)Object.prototype.hasOwnProperty.call(l,n)&&(e[n]=l[n]);for(u&&u(t);f.length;)f.shift()();return r.push.apply(r,c||[]),o()}function o(){for(var e,t=0;t<r.length;t++){for(var o=r[t],n=!0,s=1;s<o.length;s++){var l=o[s];0!==a[l]&&(n=!1)}n&&(r.splice(t--,1),e=i(i.s=o[0]))}return e}var n={},a={90:0,6:0,13:0,14:0,22:0,24:0,26:0,36:0,37:0,56:0,72:0,73:0,79:0,93:0,94:0,96:0,97:0,98:0,103:0,104:0,112:0,117:0,119:0,123:0,125:0,128:0,132:0,134:0,136:0,137:0,138:0,141:0,143:0,146:0,147:0,148:0,151:0,155:0,158:0},r=[];function i(t){if(n[t])return n[t].exports;var o=n[t]={i:t,l:!1,exports:{}};return e[t].call(o.exports,o,o.exports,i),o.l=!0,o.exports}i.m=e,i.c=n,i.d=function(e,t,o){i.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},i.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,t){if(1&t&&(e=i(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(i.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)i.d(o,n,function(t){return e[t]}.bind(null,n));return o},i.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(t,"a",t),t},i.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},i.p="/assets/scripts/bundle/";var s=this.webpackJsonpSLDS___internal_chunked_showcase=this.webpackJsonpSLDS___internal_chunked_showcase||[],l=s.push.bind(s);s.push=t,s=s.slice();for(var c=0;c<s.length;c++)t(s[c]);var u=l;return r.push([701,0]),o()}({0:function(e,t){e.exports=React},16:function(e,t){e.exports=ReactDOM},701:function(e,t,o){"use strict";o.r(t),o.d(t,"Context",(function(){return ve})),o.d(t,"states",(function(){return _e}));var n=o(0),a=o.n(n),r=o(2),i=o.n(r),s=o(1),l=o.n(s),c=o(4),u=o(55),d=o(35),f={item1:{username:"Val Handerly",avatar:"/assets/images/avatar2.jpg",title:"mentioned you",message:"@jrogers Could I please have a review on my presentation deck",timestamp:"10 hours ago",unread:!0},item2:{username:"Jon Rogers",avatar:"/assets/images/avatar3.jpg",title:"commented on your post",message:"I totally agree with your sentiment",timestamp:"13 hours ago",unread:!0},item3:{username:"Rebecca Stone",avatar:"/assets/images/avatar2.jpg",title:"mentioned you",message:"@jrogers Here's the conversation I mentioned to you",timestamp:"1 day ago",unread:!1}};function p(e){return(p="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function m(e,t){for(var o=0;o<t.length;o++){var n=t[o];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}function b(e,t){return(b=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}function y(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var o,n=_(e);if(t){var a=_(this).constructor;o=Reflect.construct(n,arguments,a)}else o=n.apply(this,arguments);return h(this,o)}}function h(e,t){if(t&&("object"===p(t)||"function"==typeof t))return t;if(void 0!==t)throw new TypeError("Derived constructors may only return object or undefined");return v(e)}function v(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}function _(e){return(_=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}var g=function(e){return a.a.createElement("li",{className:i()("slds-global-header__notification",e.unread&&"slds-global-header__notification_unread",e.className),key:e.index},a.a.createElement("div",{className:"slds-media slds-has-flexi-truncate slds-p-around_x-small"},a.a.createElement("div",{className:"slds-media__figure"},a.a.createElement(u.Avatar,{className:"slds-avatar_small"},a.a.createElement("img",{alt:e.username,src:e.avatar,title:"".concat(e.username," avatar")}))),a.a.createElement("div",{className:"slds-media__body"},a.a.createElement("div",{className:"slds-grid slds-grid_align-spread"},a.a.createElement("a",{href:"#",onClick:function(e){return e.preventDefault()},className:"slds-text-link_reset slds-has-flexi-truncate"},a.a.createElement("h3",{className:"slds-truncate",title:"".concat(e.username," ").concat(e.title)},a.a.createElement("strong",null,"".concat(e.username," ").concat(e.title))),a.a.createElement("p",{className:"slds-truncate",title:e.message},e.message),a.a.createElement("p",{className:"slds-m-top_x-small slds-text-color_weak"},e.timestamp,e.unread&&a.a.createElement("abbr",{className:"slds-text-link slds-m-horizontal_xxx-small",title:"unread"},"●")))))))},w=function(e){!function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),Object.defineProperty(e,"prototype",{writable:!1}),t&&b(e,t)}(i,e);var t,o,n,r=y(i);function i(){var e;return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,i),(e=r.call(this)).renderNotificationItems=e.renderNotificationItems.bind(v(e)),e}return t=i,(o=[{key:"renderNotificationItems",value:function(e){var t=f[e];return a.a.createElement(g,{key:e,index:e,avatar:t.avatar,username:t.username,title:t.title,message:t.message,timestamp:t.timestamp,unread:t.unread})}},{key:"render",value:function(){return a.a.createElement(d.Popover,{className:"slds-popover_large slds-nubbin_top-right",bodyClassName:"slds-p-around_none",headerTitle:"Notifications",closeButton:!0,style:{position:"absolute",top:"calc(100% + 12px)",right:"-12px"}},a.a.createElement("ul",null,Object.keys(f).map(this.renderNotificationItems)))}}])&&m(t.prototype,o),n&&m(t,n),Object.defineProperty(t,"prototype",{writable:!1}),i}(n.Component),x=o(244);function E(e){return(E="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function N(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function S(e,t){for(var o=0;o<t.length;o++){var n=t[o];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}function P(e,t){return(P=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}function O(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var o,n=C(e);if(t){var a=C(this).constructor;o=Reflect.construct(n,arguments,a)}else o=n.apply(this,arguments);return j(this,o)}}function j(e,t){if(t&&("object"===E(t)||"function"==typeof t))return t;if(void 0!==t)throw new TypeError("Derived constructors may only return object or undefined");return function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e)}function C(e){return(C=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}var I=function(e){!function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),Object.defineProperty(e,"prototype",{writable:!1}),t&&P(e,t)}(i,e);var t,o,n,r=O(i);function i(){return N(this,i),r.apply(this,arguments)}return t=i,(o=[{key:"render",value:function(){return a.a.createElement(d.Popover,{className:"slds-nubbin_top slds-dynamic-menu",bodyClassName:"slds-p-horizontal_none",title:"My Favorites",footer:a.a.createElement(x.Footer,null),style:{position:"absolute",left:"-8rem",top:"36px"}},a.a.createElement(x.ListboxList,{length:this.props.numberOfFavorites}))}}])&&S(t.prototype,o),n&&S(t,n),Object.defineProperty(t,"prototype",{writable:!1}),i}(n.Component),T=o(14),k=o(25);function R(e){return(R="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function F(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function D(e,t){for(var o=0;o<t.length;o++){var n=t[o];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}function M(e,t){return(M=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}function L(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var o,n=q(e);if(t){var a=q(this).constructor;o=Reflect.construct(n,arguments,a)}else o=n.apply(this,arguments);return A(this,o)}}function A(e,t){if(t&&("object"===R(t)||"function"==typeof t))return t;if(void 0!==t)throw new TypeError("Derived constructors may only return object or undefined");return function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e)}function q(e){return(q=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}var B=function(e){!function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),Object.defineProperty(e,"prototype",{writable:!1}),t&&M(e,t)}(i,e);var t,o,n,r=L(i);function i(){return F(this,i),r.apply(this,arguments)}return t=i,(o=[{key:"render",value:function(){return a.a.createElement(T.Menu,{className:"slds-dropdown_right slds-nubbin_top-right",style:{right:"-1rem"}},a.a.createElement(T.MenuList,null,a.a.createElement(T.MenuItem,{iconLeft:a.a.createElement(k.StandardIcon,{containerClassName:"slds-m-right_x-small",className:"slds-icon_small",symbol:"event"}),tabIndex:"0"},"New Event"),a.a.createElement(T.MenuItem,{iconLeft:a.a.createElement(k.StandardIcon,{containerClassName:"slds-m-right_x-small",className:"slds-icon_small",symbol:"note"}),tabIndex:"0"},"New Note"),a.a.createElement(T.MenuItem,{iconLeft:a.a.createElement(k.StandardIcon,{containerClassName:"slds-m-right_x-small",className:"slds-icon_small",symbol:"email"}),tabIndex:"0"},"New Email")))}}])&&D(t.prototype,o),n&&D(t,n),Object.defineProperty(t,"prototype",{writable:!1}),i}(n.Component);function U(e){return(U="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function H(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function V(e,t){for(var o=0;o<t.length;o++){var n=t[o];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}function G(e,t){return(G=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}function J(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var o,n=Y(e);if(t){var a=Y(this).constructor;o=Reflect.construct(n,arguments,a)}else o=n.apply(this,arguments);return z(this,o)}}function z(e,t){if(t&&("object"===U(t)||"function"==typeof t))return t;if(void 0!==t)throw new TypeError("Derived constructors may only return object or undefined");return function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e)}function Y(e){return(Y=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}var K=function(e){return a.a.createElement("div",{className:"slds-global-actions__favorites slds-dropdown-trigger slds-dropdown-trigger_click"},a.a.createElement("div",{className:"slds-button-group"},a.a.createElement(c.b,{className:i()("slds-global-actions__favorites-action slds-button_icon slds-button_icon-border slds-button_icon-small",{"slds-is-disabled":e.favoritesDisabled,"slds-is-selected":e.favoritesClicked}),disabled:e.favoritesDisabled,"aria-pressed":e.favoritesClicked?"true":"false",symbol:"favorite",title:"Toggle Favorites",assistiveText:"Toggle Favorite",onClick:function(){return e.toggleFavorite()}}),a.a.createElement(c.b,{className:i()("slds-global-actions__favorites-more slds-button_icon slds-button_icon-border slds-button_icon-small"),iconClassName:"slds-button__icon_small",symbol:"down",title:"View Favorites",assistiveText:"View Favorites"})),e.showFavoritesPopup&&a.a.createElement(I,{numberOfFavorites:2}))};K.propTypes={favoritesDisabled:l.a.bool,favoritesClicked:l.a.bool,showFavoritesPopup:l.a.bool};var Q=function(e){return a.a.createElement("div",{className:i()("slds-dropdown-trigger slds-dropdown-trigger_click",e.showTaskMenu&&"slds-is-open")},a.a.createElement(c.b,{className:"slds-button_icon slds-button_icon-container slds-button_icon-small slds-global-actions__task slds-global-actions__item-action","aria-haspopup":"true",symbol:"add",title:"Global Actions",assistiveText:"Global Actions"}),e.showTaskMenu&&a.a.createElement(B,null))};Q.propTypes={showTaskMenu:l.a.bool};var $=function(){return a.a.createElement("div",{className:"slds-dropdown-trigger slds-dropdown-trigger_click"},a.a.createElement(c.b,{className:"slds-button_icon slds-button_icon-container slds-button_icon-small slds-global-actions__help slds-global-actions__item-action",iconClassName:"slds-global-header__icon","aria-haspopup":"true",symbol:"question",title:"Help and Training",assistiveText:"Help and Training"}))},W=function(){return a.a.createElement("div",{className:"slds-dropdown-trigger slds-dropdown-trigger_click"},a.a.createElement(c.b,{className:"slds-button_icon slds-button_icon-container slds-button_icon-small slds-global-actions__setup slds-global-actions__item-action",iconClassName:"slds-global-header__icon","aria-haspopup":"true",symbol:"setup",title:"Setup",assistiveText:"Setup"}))},X=function(e){var t=e.notificationCount?"".concat(e.notificationCount," new notifications"):"no new notifications";return a.a.createElement("div",{className:i()("slds-dropdown-trigger slds-dropdown-trigger_click",e.showNotificationPopup&&"slds-is-open")},a.a.createElement(c.b,{className:i()("slds-button_icon slds-button_icon-container slds-button_icon-small slds-global-actions__notifications slds-global-actions__item-action",{"slds-incoming-notification":e.showNotification&&e.notificationCount}),iconClassName:"slds-global-header__icon",symbol:"notification",title:t,assistiveText:t,"aria-live":"assertive","aria-atomic":"true"}),a.a.createElement("span",{"aria-hidden":"true",className:i()("slds-notification-badge",e.notificationCount&&"slds-incoming-notification",e.showNotification&&"slds-show-notification")},e.notificationCount),e.showNotificationPopup&&a.a.createElement(w,null))};X.propTypes={notificationCount:l.a.oneOfType([l.a.string,l.a.number]),showNotificationPopup:l.a.bool};var Z=function(){return a.a.createElement("div",{className:"slds-dropdown-trigger slds-dropdown-trigger_click"},a.a.createElement("button",{className:"slds-button slds-global-actions__avatar slds-global-actions__item-action",title:"person name","aria-haspopup":"true"},a.a.createElement("span",{className:"slds-avatar slds-avatar_circle slds-avatar_medium"},a.a.createElement("img",{alt:"Person name",src:"/assets/images/avatar2.jpg",title:"User avatar"}))))},ee=function(e){!function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),Object.defineProperty(e,"prototype",{writable:!1}),t&&G(e,t)}(i,e);var t,o,n,r=J(i);function i(){return H(this,i),r.apply(this,arguments)}return t=i,(o=[{key:"render",value:function(){var e=this.props,t=e.toggleFavorite,o=e.favoritesClicked,n=e.favoritesDisabled,r=e.showFavoritesPopup,i=e.showNotification,s=e.notificationCount,l=e.showNotificationPopup,c=e.showTaskMenu;return a.a.createElement("ul",{className:"slds-global-actions"},a.a.createElement("li",{className:"slds-global-actions__item"},a.a.createElement(K,{toggleFavorite:t,favoritesClicked:o,favoritesDisabled:n,showFavoritesPopup:r})),a.a.createElement("li",{className:"slds-global-actions__item"},a.a.createElement(Q,{showTaskMenu:c})),a.a.createElement("li",{className:"slds-global-actions__item"},a.a.createElement($,null)),a.a.createElement("li",{className:"slds-global-actions__item"},a.a.createElement(W,null)),a.a.createElement("li",{className:"slds-global-actions__item"},a.a.createElement(X,{showNotification:i,notificationCount:s,showNotificationPopup:l})),a.a.createElement("li",{className:"slds-global-actions__item"},a.a.createElement(Z,null)))}}])&&V(t.prototype,o),n&&V(t,n),Object.defineProperty(t,"prototype",{writable:!1}),i}(a.a.Component);ee.propTypes={favoritesClicked:l.a.bool,favoritesDisabled:l.a.bool,showFavoritesPopup:l.a.bool,showNotification:l.a.bool,notificationCount:l.a.oneOfType([l.a.string,l.a.number]),showNotificationPopup:l.a.bool,showTaskMenu:l.a.bool};var te=ee;function oe(e){return(oe="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function ne(e,t){for(var o=0;o<t.length;o++){var n=t[o];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}function ae(e,t){return(ae=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}function re(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var o,n=le(e);if(t){var a=le(this).constructor;o=Reflect.construct(n,arguments,a)}else o=n.apply(this,arguments);return ie(this,o)}}function ie(e,t){if(t&&("object"===oe(t)||"function"==typeof t))return t;if(void 0!==t)throw new TypeError("Derived constructors may only return object or undefined");return se(e)}function se(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}function le(e){return(le=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}var ce=function(){return a.a.createElement(a.a.Fragment,null,a.a.createElement("a",{href:"#",className:"slds-assistive-text slds-assistive-text_focus",onClick:function(e){return e.preventDefault()}},"Skip to Navigation"),a.a.createElement("a",{href:"#",className:"slds-assistive-text slds-assistive-text_focus",onClick:function(e){return e.preventDefault()}},"Skip to Main Content"))},ue=function(){return a.a.createElement("div",{className:"slds-global-header__logo"},a.a.createElement("span",{className:"slds-assistive-text"},"Salesforce"))},de=function(e){!function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),Object.defineProperty(e,"prototype",{writable:!1}),t&&ae(e,t)}(s,e);var t,o,n,r=re(s);function s(){var e;return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,s),(e=r.call(this)).toggleFavorite=e.toggleFavorite.bind(se(e)),e.showNotification=e.showNotification.bind(se(e)),e.showIncomingNotification=e.showIncomingNotification.bind(se(e)),e.state={favoritesClicked:!1,showNotification:!1,notificationCount:0},e}return t=s,(o=[{key:"toggleFavorite",value:function(){this.setState({favoritesClicked:!this.state.favoritesClicked})}},{key:"showNotification",value:function(){this.setState({showNotification:!this.state.showNotification,notificationCount:1})}},{key:"showIncomingNotification",value:function(){this.setState({notificationCount:++this.state.notificationCount})}},{key:"render",value:function(){var e=this;return a.a.createElement("header",{className:i()("slds-global-header_container",this.props.className)},a.a.createElement(ce,null),a.a.createElement("div",{className:"slds-global-header slds-grid slds-grid_align-spread"},a.a.createElement("div",{className:"slds-global-header__item"},a.a.createElement(ue,null)),!this.props.playground&&a.a.createElement("div",{className:"slds-global-header__item slds-global-header__item_search"},this.props.globalSearch),a.a.createElement("div",{className:"slds-global-header__item"},a.a.createElement(te,{toggleFavorite:this.toggleFavorite,favoritesClicked:this.state.favoritesClicked,favoritesDisabled:this.props.favoritesDisabled,showFavoritesPopup:this.props.showFavoritesPopup,showNotification:this.state.showNotification,notificationCount:this.state.notificationCount,showNotificationPopup:this.props.showNotificationPopup,showTaskMenu:this.props.showTaskMenu}))),this.props.playground&&a.a.createElement("div",{className:"slds-button-group slds-m-around_medium"},a.a.createElement("button",{className:"slds-button slds-button_neutral",onClick:function(){return e.showNotification()}},"Toggle Notification"),a.a.createElement("button",{className:"slds-button slds-button_neutral",onClick:function(){return e.showIncomingNotification()}},"Increase count")))}}])&&ne(t.prototype,o),n&&ne(t,n),Object.defineProperty(t,"prototype",{writable:!1}),s}(n.Component),fe=o(18),pe=o(52),me=o(20),be=o(8),ye={option0:{name:"Recent Items",label:!0},option1:{name:"Salesforce - 1,000 Licenses",entityMeta:!0,entityType:"Opportunity",entityField:"Propecting"},option2:{name:"Art Vandelay",entityMeta:!0,entityType:"Contact",entityField:"avandelay@vandelay.com"},option3:{name:"Vandelay Industries",entityMeta:!0,entityType:"Account",entityField:"San Francisco"},option4:{name:"Salesforce UK 2016 Events",entityMeta:!0,entityType:"Event",entityField:"$20,000"},option5:{name:"H.E. Pennypacker",entityMeta:!0,entityType:"Lead",entityField:"Nursing"}},he=o(6),ve=function(e){return a.a.createElement("div",{className:"demo-only",style:{height:"340px"}},e.children)},_e=(t.default=[{id:"default",label:"Default",element:a.a.createElement(de,{globalSearch:a.a.createElement(fe.a,{id:he.d.uniqueId("combobox-id-"),"aria-controls":"search-listbox-id-1",comboboxID:"primary-search-combobox-id-1",autocomplete:!0,inputContainerClassName:"slds-global-search__form-element",label:"Search Salesforce",hideLabel:!0,placeholder:"Search Salesforce",results:a.a.createElement(me.e,{id:"search-listbox-id-1","aria-label":"Recent Items",snapshot:ye,type:"entity",count:6}),resultsType:"listbox",addon:a.a.createElement(pe.b,{id:he.d.uniqueId("objectswitcher-combobox-id-"),value:"Accounts",addonPosition:"start",hasInteractions:!0,comboboxAriaControls:"primary-search-combobox-id-1",listboxId:he.d.uniqueId("objectswitcher-listbox-id-")}),addonPosition:"start",comboboxPosition:"end",inputIconPosition:"left",leftInputIcon:a.a.createElement(be.UtilityIcon,{symbol:"search",className:"slds-icon slds-icon_xx-small slds-icon-text-default",containerClassName:"slds-input__icon slds-input__icon_left",title:!1,assistiveText:!1}),hasInteractions:!0})})}],[{id:"search-focused-expanded",label:"Global Search - Focused and Exanded",element:a.a.createElement(de,{globalSearch:a.a.createElement(fe.a,{id:he.d.uniqueId("combobox-id-"),"aria-controls":"search-listbox-id-2",comboboxID:"primary-search-combobox-id-2",autocomplete:!0,inputContainerClassName:"slds-global-search__form-element",label:"Search Salesforce",hideLabel:!0,placeholder:"Search Salesforce",results:a.a.createElement(me.e,{id:"search-listbox-id-2","aria-label":"Recent Items",snapshot:ye,type:"entity",count:6}),resultsType:"listbox",addon:a.a.createElement(pe.b,{id:he.d.uniqueId("objectswitcher-combobox-id-"),value:"Accounts",addonPosition:"start",comboboxAriaControls:"primary-search-combobox-id-2",listboxId:he.d.uniqueId("objectswitcher-listbox-id-")}),addonPosition:"start",comboboxPosition:"end",inputIconPosition:"left",leftInputIcon:a.a.createElement(be.UtilityIcon,{symbol:"search",className:"slds-icon slds-icon_xx-small slds-icon-text-default",containerClassName:"slds-input__icon slds-input__icon_left",title:!1,assistiveText:!1})})})},{id:"search-active-typing",label:"Global Search - Active and typing",element:a.a.createElement(de,{globalSearch:a.a.createElement(fe.a,{id:he.d.uniqueId("combobox-id-"),"aria-controls":"search-listbox-id-4",comboboxID:"primary-search-combobox-id-4",autocomplete:!0,inputContainerClassName:"slds-global-search__form-element",label:"Search Salesforce",hideLabel:!0,placeholder:"Search Salesforce",value:"salesforce",results:a.a.createElement(me.e,{id:"search-listbox-id-4",term:"salesforce",snapshot:{option1:{term:"Salesforce",beforeTerm:"",afterTerm:".com",entityMeta:!0,entityType:"Account",entityLocation:"San Francisco, CA"},option2:{term:"Salesforce",beforeTerm:"",afterTerm:".org",entityMeta:!0,entityType:"Account",entityLocation:"New York, NY"},option3:{term:"Salesforce",beforeTerm:"",afterTerm:"HQ",entityMeta:!0,entityType:"Account",entityLocation:"San Francisco, CA"}},type:"entity",count:6}),resultsType:"listbox","aria-activedescendant":"option0",addon:a.a.createElement(pe.b,{id:he.d.uniqueId("objectswitcher-combobox-id-"),value:"Accounts",addonPosition:"start",comboboxAriaControls:"primary-search-combobox-id-4",listboxId:he.d.uniqueId("objectswitcher-listbox-id-")}),addonPosition:"start",comboboxPosition:"end",inputIconPosition:"left",leftInputIcon:a.a.createElement(be.UtilityIcon,{symbol:"search",className:"slds-icon slds-icon_xx-small slds-icon-text-default",containerClassName:"slds-input__icon slds-input__icon_left",title:!1,assistiveText:!1}),hasFocus:!0,isOpen:!0})})},{id:"favorites-disabled",label:"Favorites - Disabled",element:a.a.createElement(de,{favoritesDisabled:!0,globalSearch:a.a.createElement(fe.a,{id:he.d.uniqueId("combobox-id-"),"aria-controls":"search-listbox-id-1",comboboxID:"primary-search-combobox-id-1",autocomplete:!0,inputContainerClassName:"slds-global-search__form-element",label:"Search Salesforce",hideLabel:!0,placeholder:"Search Salesforce",results:a.a.createElement(me.e,{id:"search-listbox-id-1","aria-label":"Recent Items",snapshot:ye,type:"entity",count:2}),resultsType:"listbox",addon:a.a.createElement(pe.b,{id:he.d.uniqueId("objectswitcher-combobox-id-"),value:"Accounts",addonPosition:"start",hasInteractions:!0,comboboxAriaControls:"primary-search-combobox-id-1",listboxId:he.d.uniqueId("objectswitcher-listbox-id-")}),addonPosition:"start",comboboxPosition:"end",inputIconPosition:"left",leftInputIcon:a.a.createElement(be.UtilityIcon,{symbol:"search",className:"slds-icon slds-icon_xx-small slds-icon-text-default",containerClassName:"slds-input__icon slds-input__icon_left",title:!1,assistiveText:!1}),hasInteractions:!0})})},{id:"notification-count-1",label:"Notification - Count +1",element:a.a.createElement(de,{playground:!0,globalSearch:a.a.createElement(fe.a,{id:he.d.uniqueId("combobox-id-"),"aria-controls":"search-listbox-id-1",comboboxID:"primary-search-combobox-id-1",autocomplete:!0,inputContainerClassName:"slds-global-search__form-element",label:"Search Salesforce",hideLabel:!0,placeholder:"Search Salesforce",results:a.a.createElement(me.e,{id:"search-listbox-id-1","aria-label":"Recent Items",snapshot:ye,type:"entity",count:2}),resultsType:"listbox",addon:a.a.createElement(pe.b,{id:he.d.uniqueId("objectswitcher-combobox-id-"),value:"Accounts",addonPosition:"start",hasInteractions:!0,comboboxAriaControls:"primary-search-combobox-id-1",listboxId:he.d.uniqueId("objectswitcher-listbox-id-")}),addonPosition:"start",comboboxPosition:"end",inputIconPosition:"left",leftInputIcon:a.a.createElement(be.UtilityIcon,{symbol:"search",className:"slds-icon slds-icon_xx-small slds-icon-text-default",containerClassName:"slds-input__icon slds-input__icon_left",title:!1,assistiveText:!1}),hasInteractions:!0})})}])}});