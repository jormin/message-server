(function(e){function t(t){for(var a,o,i=t[0],l=t[1],c=t[2],u=0,d=[];u<i.length;u++)o=i[u],r[o]&&d.push(r[o][0]),r[o]=0;for(a in l)Object.prototype.hasOwnProperty.call(l,a)&&(e[a]=l[a]);m&&m(t);while(d.length)d.shift()();return n.push.apply(n,c||[]),s()}function s(){for(var e,t=0;t<n.length;t++){for(var s=n[t],a=!0,i=1;i<s.length;i++){var l=s[i];0!==r[l]&&(a=!1)}a&&(n.splice(t--,1),e=o(o.s=s[0]))}return e}var a={},r={app:0},n=[];function o(t){if(a[t])return a[t].exports;var s=a[t]={i:t,l:!1,exports:{}};return e[t].call(s.exports,s,s.exports,o),s.l=!0,s.exports}o.m=e,o.c=a,o.d=function(e,t,s){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:s})},o.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var s=Object.create(null);if(o.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)o.d(s,a,function(t){return e[t]}.bind(null,a));return s},o.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="/";var i=window["webpackJsonp"]=window["webpackJsonp"]||[],l=i.push.bind(i);i.push=t,i=i.slice();for(var c=0;c<i.length;c++)t(i[c]);var m=l;n.push([0,"chunk-vendors"]),s()})({0:function(e,t,s){e.exports=s("56d7")},"034f":function(e,t,s){"use strict";var a=s("b538"),r=s.n(a);r.a},"03b3":function(e,t,s){"use strict";var a=s("4469"),r=s.n(a);r.a},"0453":function(e,t,s){"use strict";var a=s("e37a"),r=s.n(a);r.a},"0857":function(e,t,s){"use strict";var a=s("ae42"),r=s.n(a);r.a},1106:function(e,t,s){"use strict";var a=s("8d11"),r=s.n(a);r.a},1621:function(e,t,s){"use strict";var a=s("de22"),r=s.n(a);r.a},4469:function(e,t,s){},5552:function(e,t,s){},"56d7":function(e,t,s){"use strict";s.r(t);s("cadf"),s("551c"),s("097d");var a=s("2b0e"),r=s("5f2b"),n=s("cb4c"),o=s.n(n),i=s("f511"),l=s.n(i),c=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{attrs:{id:"app"}},[s("router-view")],1)},m=[],u=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("el-tabs",{attrs:{stretch:""},on:{"tab-click":e.handleClick},model:{value:e.activeTab,callback:function(t){e.activeTab=t},expression:"activeTab"}},[s("el-tab-pane",{attrs:{label:"公共留言",name:"common"}},[s("SendMessageButton"),s("MessageList",{directives:[{name:"show",rawName:"v-show",value:e.commonMessages.items.length>0,expression:"commonMessages.items.length > 0"}],ref:"commonMessages",attrs:{messages:e.commonMessages},on:{more:e.getMessages}})],1),s("el-tab-pane",{attrs:{label:"我发送的",name:"sender"}},[s("SendMessageButton"),s("MessageList",{directives:[{name:"show",rawName:"v-show",value:e.senderMessages.items.length>0,expression:"senderMessages.items.length > 0"}],ref:"senderMessages",attrs:{messages:e.senderMessages},on:{more:e.getMessages}})],1),s("el-tab-pane",{attrs:{label:"我接收的",name:"receiver"}},[s("SendMessageButton"),s("MessageList",{directives:[{name:"show",rawName:"v-show",value:e.receiverMessages.items.length>0,expression:"receiverMessages.items.length > 0"}],ref:"receiverMessages",attrs:{messages:e.receiverMessages},on:{more:e.getMessages}})],1),s("el-tab-pane",{attrs:{label:"个人中心",name:"ucenter"}},[s("UserInfo")],1)],1)},d=[],p=(s("7f7f"),function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",[s("el-row",{attrs:{id:"userInfoWrap"}},[s("el-col",{attrs:{span:18,offset:3}},[s("div",{staticClass:"grid-content bg-purple-dark"},[s("el-form",{ref:"userInfo",staticClass:"demo-ruleForm",attrs:{model:e.userInfo,"label-position":e.labelPosition,"label-width":"100px"}},[s("el-form-item",{attrs:{label:"姓名",prop:"name"}},[s("el-input",{attrs:{placeholder:"姓名",readonly:""},model:{value:e.userInfo.name,callback:function(t){e.$set(e.userInfo,"name",t)},expression:"userInfo.name"}})],1),s("el-form-item",{attrs:{label:"性别",prop:"gender"}},[s("el-select",{attrs:{placeholder:"请选择性别",disabled:""},model:{value:e.userInfo.gender,callback:function(t){e.$set(e.userInfo,"gender",t)},expression:"userInfo.gender"}},[s("el-option",{attrs:{label:"男",value:"1"}}),s("el-option",{attrs:{label:"女",value:"2"}})],1)],1),s("el-form-item",{attrs:{label:"手机号",prop:"phone"}},[s("el-input",{attrs:{placeholder:"请输入手机号",readonly:""},model:{value:e.userInfo.phone,callback:function(t){e.$set(e.userInfo,"phone",t)},expression:"userInfo.phone"}})],1),s("el-form-item",{attrs:{label:"邮箱",prop:"email"}},[s("el-input",{attrs:{placeholder:"请输入邮箱",readonly:""},model:{value:e.userInfo.email,callback:function(t){e.$set(e.userInfo,"email",t)},expression:"userInfo.email"}})],1),s("el-form-item",{attrs:{label:"邮箱验证",prop:"email"}},[s("el-input",{attrs:{placeholder:"请输入邮箱",readonly:""},model:{value:"1"===e.userInfo.email_verify?"已验证":"未验证",callback:function(t){e.$set(e.userInfo,"email_verify === '1' ? '已验证' : '未验证'",t)},expression:"userInfo.email_verify === '1' ? '已验证' : '未验证'"}},[s("el-button",{directives:[{name:"show",rawName:"v-show",value:"0"===e.userInfo.email_verify,expression:"userInfo.email_verify === '0'"}],attrs:{slot:"append",disabled:e.codeButton.disabled},on:{click:e.sendValidateEmail},slot:"append"},[e._v(e._s(e.codeButton.name))])],1)],1),s("el-form-item",{attrs:{label:"注册时间",prop:"created_at"}},[s("el-input",{attrs:{placeholder:"注册时间",readonly:""},model:{value:e.userInfo.created_at,callback:function(t){e.$set(e.userInfo,"created_at",t)},expression:"userInfo.created_at"}})],1),s("el-form-item",{attrs:{label:"注册IP",prop:"ip"}},[s("el-input",{attrs:{placeholder:"注册IP",readonly:""},model:{value:e.userInfo.ip,callback:function(t){e.$set(e.userInfo,"ip",t)},expression:"userInfo.ip"}})],1),s("el-form-item",{attrs:{label:"IP区域",prop:"ip_address"}},[s("el-input",{attrs:{placeholder:"IP区域",readonly:""},model:{value:e.userInfo.ip_address,callback:function(t){e.$set(e.userInfo,"ip_address",t)},expression:"userInfo.ip_address"}})],1)],1)],1)])],1),s("el-row",{attrs:{id:"logoutWrap"}},[s("el-button",{attrs:{type:"danger",id:"logoutBtn"},on:{click:e.logout}},[e._v("退出登录")])],1)],1)}),f=[],g={data:function(){return{labelPosition:"left",codeButton:{name:"重新发送",disabled:!1,time:180},userInfo:{name:"",gender:"1",phone:"",email:"",email_verify:"",created_at:"",ip:"",ip_address:""}}},methods:{logout:function(){var e=this;this.$get("/account/logout").then(function(t){localStorage.removeItem("token"),e.$message({message:t.message,type:"success"}),e.$router.push("/login")})},sendValidateEmail:function(){var e=this;this.$get("/account/send-validate-email").then(function(t){e.$message({message:t.message,type:"success"}),e.codeButton.disabled=!0;var s=e,a=window.setInterval(function(){s.codeButton.name="（"+s.codeButton.time+"秒）后重新发送",--s.codeButton.time,s.codeButton.time<0&&(s.codeButton.name="重新发送",s.codeButton.time=180,s.codeButton.disabled=!1,window.clearInterval(a))},1e3)})}},created:function(){var e=this;this.$get("/account/info").then(function(t){e.userInfo=t.user})}},v=g,h=(s("f517"),s("2877")),b=Object(h["a"])(v,p,f,!1,null,"6c58164e",null);b.options.__file="UserInfo.vue";var _=b.exports,w=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("el-row",[e._l(e.messages.items,function(e){return s("SimpleMessage",{key:e.id,attrs:{message:e}})}),s("div",{directives:[{name:"show",rawName:"v-show",value:e.messages.currentPage+1<=e.messages.totalPage,expression:"(messages.currentPage+1) <= messages.totalPage"}],staticClass:"more",on:{click:e.loadMore}},[s("span",[e._v(" -- 点击加载更多 --")])])],2)},$=[],y=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("el-card",{staticClass:"box-card message-card"},[s("div",{on:{click:e.messageDetail}},[s("span",{staticClass:"title"},[e._v(e._s(e.message.title))]),s("div",{staticClass:"bottom clearfix"},[s("div",{staticClass:"bottom clearfix"},[s("span",{staticClass:"sender"},[e._v(e._s(e.message.sender))]),s("span",{directives:[{name:"show",rawName:"v-show",value:null!=e.message.receiver,expression:"message.receiver != null"}],staticClass:"sender"},[s("i",{staticClass:"el-icon-d-arrow-right"})]),s("span",{staticClass:"receiver"},[e._v(e._s(e.message.receiver))]),s("time",{staticClass:"time",staticStyle:{float:"right"}},[e._v(e._s(e.message.created_at))])])])])])},x=[],C={props:["message"],methods:{messageDetail:function(e){this.$router.push("/message/"+this.message.id)}}},F=C,M=(s("0857"),Object(h["a"])(F,y,x,!1,null,"522e8171",null));M.options.__file="SimpleMessage.vue";var k=M.exports,I={components:{SimpleMessage:k},props:["messages"],methods:{loadMore:function(){this.$emit("more")}}},P=I,B=(s("1621"),Object(h["a"])(P,w,$,!1,null,"0fbaff7c",null));B.options.__file="MessageList.vue";var O=B.exports,j=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("el-button",{attrs:{type:"primary",icon:"el-icon-plus"},on:{click:function(t){e.sendMessage()}}},[e._v("发布留言")])},S=[],E={methods:{sendMessage:function(){this.$router.push("/sendMessage")}}},U=E,R=Object(h["a"])(U,j,S,!1,null,null,null);R.options.__file="SendMessageButton.vue";var N=R.exports,L={components:{UserInfo:_,MessageList:O,SendMessageButton:N},data:function(){return{activeTab:"common",commonMessages:{items:[],currentPage:0,totalPage:0,total:0},senderMessages:{items:[],currentPage:0,totalPage:0,total:0},receiverMessages:{items:[],currentPage:0,totalPage:0,total:0}}},methods:{handleClick:function(e){if("ucenter"!==e.name){var t=this.activeTab+"Messages";0==this[t].items.length&&this.getMessages()}},getMessages:function(){var e="/message/"+this.activeTab+"-messages",t=this.activeTab+"Messages",s=this;this.$get(e,{page:this[t].currentPage}).then(function(e){e.items.length>0&&(e.items.map(function(e,a){s[t].items.push(e)}),s[t].currentPage+=1)})}},mounted:function(){this.getMessages()}},T=L,q=Object(h["a"])(T,u,d,!1,null,null,null);q.options.__file="Index.vue";var W=q.exports,D={name:"app",components:{Index:W}},z=D,A=(s("034f"),Object(h["a"])(z,c,m,!1,null,null,null));A.options.__file="App.vue";var J=A.exports,V=s("8206"),Z=s.n(V),G=s("4328"),H=s.n(G),K=s("5c96"),Q=s.n(K);s("0fae");a["default"].use(Q.a);s("ac6a"),s("456d");a["default"].use(Q.a),a["default"].use(r["a"]),Z.a.defaults.timeout=5e3,Z.a.defaults.baseURL="http://api.message.local.com/api/frontend";var X=new r["a"];function Y(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return new Promise(function(s,a){Z.a.get(e,{params:t}).then(function(e){s(e.data)}).catch(function(e){a(e)})})}function ee(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},s=Object.keys(t).map(function(e){return encodeURIComponent(e)+"="+encodeURIComponent(t[e])}).join("&");return new Promise(function(t,a){Z.a.get(e+"?"+s).then(function(e){t(e.data)},function(e){a(e)})})}function te(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return new Promise(function(s,a){Z.a.post(e,t).then(function(e){s(e.data)},function(e){a(e)})})}function se(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return new Promise(function(s,a){Z.a.patch(e,t).then(function(e){s(e.data)},function(e){a(e)})})}function ae(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return new Promise(function(s,a){Z.a.put(e,t).then(function(e){s(e.data)},function(e){a(e)})})}Z.a.interceptors.request.use(function(e){e.headers={"Content-Type":"application/x-www-form-urlencoded"};var t=localStorage.getItem("token");return t&&void 0!==t&&(e.headers["User-Token"]=t),e.data=H.a.stringify(e.data),e},function(e){return Promise.reject(err)}),Z.a.interceptors.response.use(function(e){var t=e.data,s=t.code;switch(s){case 0:case-1:a["default"].prototype.$message({message:t.message,type:"error"});break;case-2:localStorage.removeItem("token"),X.push("/login"),location.reload();break;default:return e}},function(e){return Promise.reject(e)});var re=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("el-row",{attrs:{id:"loginWrap"}},[s("el-col",{attrs:{span:18,offset:3}},[s("div",{staticClass:"grid-content bg-purple-dark"},[s("el-form",{ref:"loginForm",staticClass:"demo-loginForm",attrs:{model:e.loginForm,rules:e.rules,"label-position":e.labelPosition,"label-width":"100px"}},[s("el-form-item",{attrs:{prop:"account"}},[s("el-input",{attrs:{placeholder:"请输入手机号或邮箱"},model:{value:e.loginForm.account,callback:function(t){e.$set(e.loginForm,"account",t)},expression:"loginForm.account"}})],1),s("el-form-item",{attrs:{prop:"password"}},[s("el-input",{attrs:{placeholder:"请输入密码",type:"password"},model:{value:e.loginForm.password,callback:function(t){e.$set(e.loginForm,"password",t)},expression:"loginForm.password"}})],1),s("el-form-item",[s("el-button",{attrs:{type:"primary"},on:{click:function(t){e.login("loginForm")}}},[e._v("登录")]),s("el-button",{attrs:{type:"default"},on:{click:function(t){e.register()}}},[e._v("注册")])],1)],1)],1)])],1)},ne=[],oe={data:function(){return{labelPosition:"top",loginForm:{account:"",password:""},rules:{account:[{required:!0,message:"请输入手机号或邮箱",trigger:"blur"}],password:[{required:!0,message:"请输入密码",trigger:"change"},{min:6,max:20,message:"请输入6-20位密码"}]}}},methods:{login:function(e){var t=this;this.$refs[e].validate(function(e){if(!e)return!1;t.$post("/auth/login",t.loginForm).then(function(e){localStorage.setItem("token",e.token);var s=t;t.$message({message:e.message,type:"success"}),s.$router.push("/")})})},register:function(){this.$router.push("/register")}}},ie=oe,le=(s("03b3"),Object(h["a"])(ie,re,ne,!1,null,"f8b262ea",null));le.options.__file="Login.vue";var ce=le.exports,me=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("el-row",{attrs:{id:"registerWrap"}},[s("el-col",{attrs:{span:18,offset:3}},[s("div",{staticClass:"grid-content bg-purple-dark"},[s("el-form",{ref:"registerForm",staticClass:"demo-ruleForm",attrs:{model:e.registerForm,rules:e.rules,"label-position":e.labelPosition,"label-width":"100px"}},[s("el-form-item",{attrs:{prop:"name"}},[s("el-input",{attrs:{placeholder:"姓名"},model:{value:e.registerForm.name,callback:function(t){e.$set(e.registerForm,"name",t)},expression:"registerForm.name"}})],1),s("el-form-item",{attrs:{prop:"gender"}},[s("el-select",{attrs:{placeholder:"请选择性别"},model:{value:e.registerForm.gender,callback:function(t){e.$set(e.registerForm,"gender",t)},expression:"registerForm.gender"}},[s("el-option",{attrs:{label:"男",value:"1"}}),s("el-option",{attrs:{label:"女",value:"2"}})],1)],1),s("el-form-item",{attrs:{prop:"phone"}},[s("el-input",{attrs:{placeholder:"请输入手机号"},model:{value:e.registerForm.phone,callback:function(t){e.$set(e.registerForm,"phone",t)},expression:"registerForm.phone"}})],1),s("el-form-item",{attrs:{prop:"code"}},[s("el-input",{attrs:{placeholder:"请输入验证码"},model:{value:e.registerForm.code,callback:function(t){e.$set(e.registerForm,"code",t)},expression:"registerForm.code"}},[s("el-button",{attrs:{slot:"append",disabled:e.codeButton.disabled},on:{click:e.sendCode},slot:"append"},[e._v(e._s(e.codeButton.name))])],1)],1),s("el-form-item",{attrs:{prop:"email"}},[s("el-input",{attrs:{placeholder:"请输入邮箱"},model:{value:e.registerForm.email,callback:function(t){e.$set(e.registerForm,"email",t)},expression:"registerForm.email"}})],1),s("el-form-item",{attrs:{prop:"password"}},[s("el-input",{attrs:{placeholder:"请输入密码",type:"password"},model:{value:e.registerForm.password,callback:function(t){e.$set(e.registerForm,"password",t)},expression:"registerForm.password"}})],1),s("el-form-item",{attrs:{prop:"confirmPassword"}},[s("el-input",{attrs:{placeholder:"请输入确认密码",type:"password"},model:{value:e.registerForm.confirmPassword,callback:function(t){e.$set(e.registerForm,"confirmPassword",t)},expression:"registerForm.confirmPassword"}})],1),s("el-form-item",[s("el-button",{attrs:{type:"primary"},on:{click:function(t){e.register("registerForm")}}},[e._v("注册")]),s("el-button",{attrs:{type:"default"},on:{click:function(t){e.login()}}},[e._v("已有账号？登录")])],1)],1)],1)])],1)},ue=[],de={data:function(){var e=this,t=function(e,t,s){var a=/^1[3456789]\d{9}$/;""===t?s(new Error("请输入手机号")):a.test(t)?s():s(new Error("请输入正确格式的手机号码"))},s=function(e,t,s){var a=/^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;""===t?s(new Error("请输入邮箱")):a.test(t)?s():s(new Error("请输入正确格式的邮箱"))},a=function(t,s,a){""===s?a(new Error("请输入密码")):(""!==e.registerForm.confirmPassword&&e.$refs.registerForm.validateField("confirmPassword"),a())},r=function(t,s,a){""===s?a(new Error("请输入确认密码")):s!==e.registerForm.password?a(new Error("两次输入密码不一致!")):a()};return{labelPosition:"top",codeButton:{name:"发送",disabled:!1,time:60},registerForm:{name:"",gender:"1",phone:"",code:"",email:"",password:"",confirmPassword:""},rules:{phone:[{required:!0,message:"请输入手机号",trigger:"blur"},{validator:t}],code:[{required:!0,message:"请输入验证码",trigger:"blur"}],email:[{required:!0,message:"请输入邮箱",trigger:"blur"},{validator:s}],password:[{required:!0,message:"请输入密码",trigger:"change"},{min:6,max:20,message:"请输入6-20位密码"},{validator:a}],confirmPassword:[{required:!0,message:"请输入密码",trigger:"change"},{min:6,max:20,message:"请输入6-20位密码"},{validator:r}]}}},methods:{sendCode:function(){var e=this;this.$refs.registerForm.validateField("phone",function(t){if(t)return!1;e.$post("/auth/register-code",{phone:e.registerForm.phone}).then(function(t){e.$message({message:t.message,type:"success"}),e.codeButton.disabled=!0;var s=e,a=window.setInterval(function(){s.codeButton.name="（"+s.codeButton.time+"秒）后重新发送",--s.codeButton.time,s.codeButton.time<0&&(s.codeButton.name="重新发送",s.codeButton.time=60,s.codeButton.disabled=!1,window.clearInterval(a))},1e3)})})},register:function(e){var t=this;this.$refs[e].validate(function(e){if(!e)return!1;t.$post("/auth/register",t.registerForm).then(function(e){if(1==e.code){localStorage.setItem("token",e.token);var s=t;t.$message({message:e.message,type:"success"}),s.$router.push("/")}else t.$message({message:e.message,type:"error"})})})},login:function(){this.$router.push("/login")}}},pe=de,fe=(s("e500"),Object(h["a"])(pe,me,ue,!1,null,"1d7e89c6",null));fe.options.__file="Register.vue";var ge=fe.exports,ve=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("el-row",{attrs:{id:"sendMessageWrap"}},[s("el-col",{attrs:{span:18,offset:3}},[s("div",{staticClass:"grid-content bg-purple-dark"},[s("el-form",{ref:"sendMessageForm",staticClass:"demo-ruleForm",attrs:{model:e.sendMessageForm,rules:e.rules,"label-position":e.labelPosition,"label-width":"100px"}},[s("el-form-item",{attrs:{prop:"title"}},[s("el-input",{attrs:{placeholder:"请输入标题"},model:{value:e.sendMessageForm.title,callback:function(t){e.$set(e.sendMessageForm,"title",t)},expression:"sendMessageForm.title"}})],1),s("el-form-item",{attrs:{prop:"content"}},[s("el-input",{attrs:{placeholder:"请输入留言内容",type:"textarea"},model:{value:e.sendMessageForm.content,callback:function(t){e.$set(e.sendMessageForm,"content",t)},expression:"sendMessageForm.content"}})],1),s("el-form-item",{attrs:{prop:"path"}},[s("Uploader",{ref:"uploader"})],1),s("el-form-item",{attrs:{prop:"receiver_id"}},[s("el-select",{attrs:{filterable:"",remote:"","reserve-keyword":"",placeholder:"请输入收信人姓名","remote-method":e.searchUser,loading:e.searchUserLoading},model:{value:e.sendMessageForm.receiverID,callback:function(t){e.$set(e.sendMessageForm,"receiverID",t)},expression:"sendMessageForm.receiverID"}},e._l(e.receiverOptions,function(e){return s("el-option",{key:e.id,attrs:{label:e.label,value:e.id}})}))],1),s("el-form-item",[s("el-button",{attrs:{type:"primary"},on:{click:function(t){e.sendMessage("sendMessageForm")}}},[e._v("留言")])],1)],1)],1)])],1)},he=[],be=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("el-upload",{directives:[{name:"loading",rawName:"v-loading",value:e.uploading,expression:"uploading"}],ref:"upload",staticClass:"attachment-uploader",attrs:{action:"//up-z2.qiniup.com/","show-file-list":!1,data:e.uploadParams,"on-success":e.handleSuccess,"on-change":e.handleChange,"auto-upload":!1,limit:1,"before-upload":e.beforeUpload}},[e.imgUrl?s("img",{staticClass:"attachment",attrs:{src:e.imgUrl}}):s("i",{staticClass:"el-icon-plus attachment-uploader-icon"})])},_e=[],we={data:function(){return{domain:"",uploadParams:{},uploading:!1,imgUrl:"",path:""}},methods:{handleSuccess:function(e,t){var s=e.key;this.path=s,this.imgUrl=this.domain+"/"+s,this.uploading=!1},beforeUpload:function(e){var t="image/jpeg"===e.type,s=e.size/1024/1024<20;return t||this.$message.error("上传头像图片只能是 JPG 格式!"),s||this.$message.error("上传头像图片大小不能超过 10MB!"),t&&s},handleChange:function(e,t){if(!1===this.uploading){var s=this;this.$get("/upload/token").then(function(e){s.domain=e.domain,s.uploadParams={token:e.token},s.uploading=!0,setTimeout(function(){s.$refs.upload.submit()},500)})}}}},$e=we,ye=(s("d045"),Object(h["a"])($e,be,_e,!1,null,null,null));ye.options.__file="Uploader.vue";var xe=ye.exports,Ce={components:{Uploader:xe},data:function(){return{labelPosition:"top",codeButton:{name:"发送",disabled:!1,time:60},sendMessageForm:{title:"",content:"",path:"",receiverID:""},searchUserLoading:!1,receiverOptions:[],rules:{title:[{required:!0,message:"请输入标题",trigger:"blur"},{min:1,max:80,message:"请输入1-80位字符"}],content:[{required:!0,message:"请输入内容",trigger:"blur"},{min:1,max:500,message:"请输入1-500位字符"}]}}},methods:{sendMessage:function(e){var t=this;this.$refs[e].validate(function(e){if(!e)return!1;var s=t.sendMessageForm;s.path=t.$refs.uploader.path,t.$post("/message/send",s).then(function(e){var s=t;t.$message({message:e.message,type:"success",onClose:function(){s.$router.push("/")}})})})},searchUser:function(e){var t=this;""!==e&&(this.searchUserLoading=!0,setTimeout(function(){t.searchUserLoading=!1;t.$get("/user/search",{keyword:e}).then(function(e){t.receiverOptions=e.users})},200))}}},Fe=Ce,Me=(s("aba5"),Object(h["a"])(Fe,ve,he,!1,null,"0467824b",null));Me.options.__file="SendMessage.vue";var ke=Me.exports,Ie=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"box-card message-card"},[s("div",{attrs:{id:"messageWrap"}},[s("div",{staticClass:"header clearfix",attrs:{slot:"header"},slot:"header"},[s("span",{staticClass:"title"},[e._v(e._s(e.message.title))]),s("div",{staticClass:"bottom clearfix"},[s("span",{staticClass:"sender"},[e._v(e._s(e.message.sender))]),s("span",{directives:[{name:"show",rawName:"v-show",value:null!=e.message.receiver,expression:"message.receiver != null"}],staticClass:"sender"},[s("i",{staticClass:"el-icon-d-arrow-right"})]),s("span",{staticClass:"receiver"},[e._v(e._s(e.message.receiver))]),s("time",{staticClass:"time",staticStyle:{float:"right"}},[e._v(e._s(e.message.created_at))])])]),s("div",{staticClass:"text item"},[s("img",{directives:[{name:"show",rawName:"v-show",value:null!==e.message.attachment,expression:"message.attachment !== null"}],staticClass:"image",attrs:{src:e.message.attachment}}),s("span",{staticClass:"content"},[e._v("\n            "+e._s(e.message.content)+"\n        ")])])]),s("div",{attrs:{id:"commentWrap"}},[s("div",{attrs:{id:"commentBtnWrap"}},[s("el-button",{attrs:{type:"primary",round:""},on:{click:e.sendComment}},[e._v("写评论")])],1),s("div",{attrs:{id:"commentListWrap"}},[s("CommentList",{directives:[{name:"show",rawName:"v-show",value:e.comments.items.length>0,expression:"comments.items.length > 0"}],ref:"comments",attrs:{comments:e.comments},on:{more:e.getComments}})],1)])])},Pe=[],Be=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("el-row",[e._l(e.comments.items,function(e){return s("Comment",{key:e.id,attrs:{comment:e}})}),s("div",{directives:[{name:"show",rawName:"v-show",value:e.comments.currentPage+1<=e.comments.totalPage,expression:"(comments.currentPage+1) <= comments.totalPage"}],staticClass:"more",on:{click:e.loadMore}},[s("span",[e._v(" -- 点击加载更多 --")])])],2)},Oe=[],je=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"box-card comment-card"},[s("div",{staticClass:"comment-header"},[s("span",{staticClass:"sender"},[e._v(e._s(e.comment.user))]),s("time",{staticClass:"time",staticStyle:{float:"right"}},[e._v(e._s(e.comment.created_at))])]),s("span",{staticClass:"content"},[e._v(e._s(e.comment.comment))])])},Se=[],Ee={props:["comment"]},Ue=Ee,Re=(s("7935"),Object(h["a"])(Ue,je,Se,!1,null,"1965dd46",null));Re.options.__file="Comment.vue";var Ne=Re.exports,Le={components:{Comment:Ne},props:["comments"],methods:{loadMore:function(){this.$emit("more")}}},Te=Le,qe=(s("1106"),Object(h["a"])(Te,Be,Oe,!1,null,"0f20856a",null));qe.options.__file="CommentList.vue";var We=qe.exports,De={components:{CommentList:We},data:function(){return{message:{},comments:{items:[],currentPage:0,totalPage:0,total:0}}},methods:{getComments:function(){var e=this;this.$get("/message/comments",{id:this.$route.params.id}).then(function(t){t.items.length>0&&(t.items.map(function(t,s){e.comments.items.push(t)}),e.comments.currentPage+=1)})},sendComment:function(){this.$router.push("/sendComment/"+this.$route.params.id)}},mounted:function(){var e=this;this.$get("/message/detail",{id:this.$route.params.id}).then(function(t){1==t.code&&(e.message=t.message)}),this.getComments()}},ze=De,Ae=(s("7009"),Object(h["a"])(ze,Ie,Pe,!1,null,"314c9322",null));Ae.options.__file="Message.vue";var Je=Ae.exports,Ve=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"box-card message-card"},[s("div",{attrs:{id:"messageWrap"}},[s("div",{staticClass:"header clearfix",attrs:{slot:"header"},slot:"header"},[s("span",{staticClass:"title"},[e._v(e._s(e.message.title))])]),s("div",{staticClass:"text item"},[s("el-form",{ref:"sendCommentForm",staticClass:"demo-ruleForm",attrs:{model:e.sendCommentForm,rules:e.rules}},[s("el-form-item",{attrs:{prop:"comment"}},[s("el-input",{attrs:{rows:6,placeholder:"请输入评论内容",type:"textarea"},model:{value:e.sendCommentForm.comment,callback:function(t){e.$set(e.sendCommentForm,"comment",t)},expression:"sendCommentForm.comment"}})],1),s("el-form-item",{staticStyle:{"text-align":"center"}},[s("el-button",{attrs:{type:"primary",id:"commentBtn"},on:{click:function(t){e.sendComment("sendCommentForm")}}},[e._v("评论")])],1)],1)],1)])])},Ze=[],Ge={data:function(){return{message:{},sendCommentForm:{comment:"",id:this.$route.params.id},receiverOptions:[],rules:{comment:[{required:!0,message:"请输入内容",trigger:"blur"},{min:1,max:500,message:"请输入1-140位字符"}]}}},methods:{sendComment:function(e){var t=this;this.$refs[e].validate(function(e){if(!e)return!1;var s=t.sendCommentForm;t.$post("/message/send-comment",s).then(function(e){var s=t;t.$message({message:e.message,type:"success"}),s.$router.push("/message/"+t.$route.params.id)})})}},mounted:function(){var e=this;this.$get("/message/detail",{id:this.$route.params.id}).then(function(t){1==t.code&&(e.message=t.message)})}},He=Ge,Ke=(s("c385"),Object(h["a"])(He,Ve,Ze,!1,null,"425f2246",null));Ke.options.__file="SendComment.vue";var Qe=Ke.exports,Xe=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"box-card message-card"},[s("div",{attrs:{id:"messageWrap"}},[s("div",{staticClass:"header clearfix",attrs:{slot:"header"},slot:"header"},[s("span",{directives:[{name:"show",rawName:"v-show",value:!0===e.verifyResult,expression:"verifyResult === true"}],staticClass:"title"},[e._v("您的邮箱激活成功!!")]),s("span",{directives:[{name:"show",rawName:"v-show",value:!1===e.verifyResult,expression:"verifyResult === false"}],staticClass:"title"},[e._v("您的邮箱激活失败!!")]),s("span",{directives:[{name:"show",rawName:"v-show",value:""===e.verifyResult,expression:"verifyResult === ''"}],staticClass:"title"},[e._v("您的邮箱正在验证中，请稍等～")])]),s("div",{staticClass:"text item"},[s("el-form",{staticClass:"demo-ruleForm"},[s("el-form-item",{staticStyle:{"text-align":"center"}},[s("el-button",{directives:[{name:"show",rawName:"v-show",value:!0===e.verifyResult,expression:"verifyResult === true"}],attrs:{type:"primary",id:"commentBtn"},on:{click:function(t){e.login()}}},[e._v("登录")]),s("el-button",{directives:[{name:"show",rawName:"v-show",value:""===e.verifyResult,expression:"verifyResult === ''"}],attrs:{type:"info",id:"commentBtn",disabled:"",loading:""}},[e._v("验证中")])],1)],1)],1)])])},Ye=[],et={data:function(){return{verifyResult:""}},methods:{login:function(){this.$router.push("/login")}},mounted:function(){var e=this;this.$post("/auth/validate-email",{emailCode:this.$route.params.code}).then(function(t){1==t.code?e.verifyResult=!0:e.verifyResult=!1})}},tt=et,st=(s("0453"),Object(h["a"])(tt,Xe,Ye,!1,null,"8bbfd45a",null));st.options.__file="VerifyEmail.vue";var at=st.exports,rt=[{path:"/",component:W},{path:"/login",component:ce},{path:"/register",component:ge},{path:"/sendMessage",component:ke},{path:"/message/:id",component:Je},{path:"/sendComment/:id",component:Qe},{path:"/verifyEmail/:code",component:at}],nt=new r["a"]({routes:rt});a["default"].use(r["a"]),a["default"].use(o.a),a["default"].use(l.a),a["default"].use(Z.a),a["default"].use(H.a),a["default"].prototype.$get=ee,a["default"].prototype.$post=te,a["default"].prototype.$fetch=Y,a["default"].prototype.$patch=se,a["default"].prototype.$put=ae,nt.beforeEach(function(e,t,s){var a=["/","/sendMessage","/message/:id"],r=localStorage.getItem("token");a.indexOf(e.path)>=0&&(void 0!=r&&r||s("/login")),"/login"===e.path&&r&&s.push("/"),s()}),new a["default"]({router:nt,render:function(e){return e(J)}}).$mount("#app")},6931:function(e,t,s){},7009:function(e,t,s){"use strict";var a=s("9da1"),r=s.n(a);r.a},7935:function(e,t,s){"use strict";var a=s("c1f5"),r=s.n(a);r.a},"83a2":function(e,t,s){},"8d11":function(e,t,s){},"92fb":function(e,t,s){},"9da1":function(e,t,s){},aba5:function(e,t,s){"use strict";var a=s("5552"),r=s.n(a);r.a},ae42:function(e,t,s){},b39d:function(e,t,s){},b538:function(e,t,s){},c1f5:function(e,t,s){},c385:function(e,t,s){"use strict";var a=s("92fb"),r=s.n(a);r.a},d045:function(e,t,s){"use strict";var a=s("b39d"),r=s.n(a);r.a},de22:function(e,t,s){},e37a:function(e,t,s){},e500:function(e,t,s){"use strict";var a=s("6931"),r=s.n(a);r.a},f517:function(e,t,s){"use strict";var a=s("83a2"),r=s.n(a);r.a}});
//# sourceMappingURL=app.c66d2a2f.js.map