(window.webpackJsonp=window.webpackJsonp||[]).push([["chunk-0aae"],{"3usR":function(e,t,a){"use strict";var l=a("gKI7");a.n(l).a},"5z5A":function(e,t,a){"use strict";var l=a("Pp9f");a.n(l).a},Pp9f:function(e,t,a){},gKI7:function(e,t,a){},iCiZ:function(e,t,a){"use strict";a.r(t);var l=a("P2sY"),n=a.n(l),r={name:"MdInput",props:{icon:String,name:String,type:{type:String,default:"text"},value:[String,Number],placeholder:String,readonly:Boolean,disabled:Boolean,min:String,max:String,step:String,minlength:Number,maxlength:Number,required:{type:Boolean,default:!0},autoComplete:{type:String,default:"off"},validateEvent:{type:Boolean,default:!0}},data:function(){return{currentValue:this.value,focus:!1,fillPlaceHolder:null}},computed:{computedClasses:function(){return{"material--active":this.focus,"material--disabled":this.disabled,"material--raised":Boolean(this.focus||this.currentValue)}}},watch:{value:function(e){this.currentValue=e}},methods:{handleModelInput:function(e){var t=e.target.value;this.$emit("input",t),"ElFormItem"===this.$parent.$options.componentName&&this.validateEvent&&this.$parent.$emit("el.form.change",[t]),this.$emit("change",t)},handleMdFocus:function(e){this.focus=!0,this.$emit("focus",e),this.placeholder&&""!==this.placeholder&&(this.fillPlaceHolder=this.placeholder)},handleMdBlur:function(e){this.focus=!1,this.$emit("blur",e),this.fillPlaceHolder=null,"ElFormItem"===this.$parent.$options.componentName&&this.validateEvent&&this.$parent.$emit("el.form.blur",[this.currentValue])}}},s=(a("5z5A"),a("KHd+")),o=Object(s.a)(r,function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"material-input__component",class:e.computedClasses},[a("div",{class:{iconClass:e.icon}},[e.icon?a("i",{staticClass:"el-input__icon material-input__icon",class:["el-icon-"+e.icon]}):e._e(),e._v(" "),"email"===e.type?a("input",{directives:[{name:"model",rawName:"v-model",value:e.currentValue,expression:"currentValue"}],staticClass:"material-input",attrs:{name:e.name,placeholder:e.fillPlaceHolder,readonly:e.readonly,disabled:e.disabled,autoComplete:e.autoComplete,required:e.required,type:"email"},domProps:{value:e.currentValue},on:{focus:e.handleMdFocus,blur:e.handleMdBlur,input:[function(t){t.target.composing||(e.currentValue=t.target.value)},e.handleModelInput]}}):e._e(),e._v(" "),"url"===e.type?a("input",{directives:[{name:"model",rawName:"v-model",value:e.currentValue,expression:"currentValue"}],staticClass:"material-input",attrs:{name:e.name,placeholder:e.fillPlaceHolder,readonly:e.readonly,disabled:e.disabled,autoComplete:e.autoComplete,required:e.required,type:"url"},domProps:{value:e.currentValue},on:{focus:e.handleMdFocus,blur:e.handleMdBlur,input:[function(t){t.target.composing||(e.currentValue=t.target.value)},e.handleModelInput]}}):e._e(),e._v(" "),"number"===e.type?a("input",{directives:[{name:"model",rawName:"v-model",value:e.currentValue,expression:"currentValue"}],staticClass:"material-input",attrs:{name:e.name,placeholder:e.fillPlaceHolder,step:e.step,readonly:e.readonly,disabled:e.disabled,autoComplete:e.autoComplete,max:e.max,min:e.min,minlength:e.minlength,maxlength:e.maxlength,required:e.required,type:"number"},domProps:{value:e.currentValue},on:{focus:e.handleMdFocus,blur:e.handleMdBlur,input:[function(t){t.target.composing||(e.currentValue=t.target.value)},e.handleModelInput]}}):e._e(),e._v(" "),"password"===e.type?a("input",{directives:[{name:"model",rawName:"v-model",value:e.currentValue,expression:"currentValue"}],staticClass:"material-input",attrs:{name:e.name,placeholder:e.fillPlaceHolder,readonly:e.readonly,disabled:e.disabled,autoComplete:e.autoComplete,max:e.max,min:e.min,required:e.required,type:"password"},domProps:{value:e.currentValue},on:{focus:e.handleMdFocus,blur:e.handleMdBlur,input:[function(t){t.target.composing||(e.currentValue=t.target.value)},e.handleModelInput]}}):e._e(),e._v(" "),"tel"===e.type?a("input",{directives:[{name:"model",rawName:"v-model",value:e.currentValue,expression:"currentValue"}],staticClass:"material-input",attrs:{name:e.name,placeholder:e.fillPlaceHolder,readonly:e.readonly,disabled:e.disabled,autoComplete:e.autoComplete,required:e.required,type:"tel"},domProps:{value:e.currentValue},on:{focus:e.handleMdFocus,blur:e.handleMdBlur,input:[function(t){t.target.composing||(e.currentValue=t.target.value)},e.handleModelInput]}}):e._e(),e._v(" "),"text"===e.type?a("input",{directives:[{name:"model",rawName:"v-model",value:e.currentValue,expression:"currentValue"}],staticClass:"material-input",attrs:{name:e.name,placeholder:e.fillPlaceHolder,readonly:e.readonly,disabled:e.disabled,autoComplete:e.autoComplete,minlength:e.minlength,maxlength:e.maxlength,required:e.required,type:"text"},domProps:{value:e.currentValue},on:{focus:e.handleMdFocus,blur:e.handleMdBlur,input:[function(t){t.target.composing||(e.currentValue=t.target.value)},e.handleModelInput]}}):e._e(),e._v(" "),a("span",{staticClass:"material-input-bar"}),e._v(" "),a("label",{staticClass:"material-label"},[e._t("default")],2)])])},[],!1,null,"f03f6b9c",null);o.options.__file="index.vue";var i=o.exports,u=a("xEMq"),c={props:{value:{type:Boolean,default:!1}},computed:{comment_disabled:{get:function(){return this.value},set:function(e){this.$emit("input",e)}}}},d=Object(s.a)(c,function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("el-dropdown",{attrs:{"show-timeout":100,trigger:"click"}},[a("el-button",{attrs:{plain:""}},[e._v(e._s(e.comment_disabled?"评论已关闭":"评论已打开")+"\n    "),a("i",{staticClass:"el-icon-caret-bottom el-icon--right"})]),e._v(" "),a("el-dropdown-menu",{staticClass:"no-padding",attrs:{slot:"dropdown"},slot:"dropdown"},[a("el-dropdown-item",[a("el-radio-group",{staticStyle:{padding:"10px"},model:{value:e.comment_disabled,callback:function(t){e.comment_disabled=t},expression:"comment_disabled"}},[a("el-radio",{attrs:{label:!0}},[e._v("关闭评论")]),e._v(" "),a("el-radio",{attrs:{label:!1}},[e._v("打开评论")])],1)],1)],1)],1)},[],!1,null,null,null);d.options.__file="Comment.vue";d.exports;var m={props:{value:{required:!0,default:function(){return[]},type:Array}},data:function(){return{platformsOptions:[{key:"a-platform",name:"a-platform"},{key:"b-platform",name:"b-platform"},{key:"c-platform",name:"c-platform"}]}},computed:{platforms:{get:function(){return this.value},set:function(e){this.$emit("input",e)}}}},p=Object(s.a)(m,function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("el-dropdown",{attrs:{"hide-on-click":!1,"show-timeout":100,trigger:"click"}},[a("el-button",{attrs:{plain:""}},[e._v("\n    平台("+e._s(e.platforms.length)+")\n    "),a("i",{staticClass:"el-icon-caret-bottom el-icon--right"})]),e._v(" "),a("el-dropdown-menu",{staticClass:"no-border",attrs:{slot:"dropdown"},slot:"dropdown"},[a("el-checkbox-group",{staticStyle:{padding:"5px 15px"},model:{value:e.platforms,callback:function(t){e.platforms=t},expression:"platforms"}},e._l(e.platformsOptions,function(t){return a("el-checkbox",{key:t.key,attrs:{label:t.key}},[e._v("\n        "+e._s(t.name)+"\n      ")])}))],1)],1)},[],!1,null,null,null);p.options.__file="Platform.vue";var f=p.exports,h={props:{value:{type:String,default:""}},computed:{source_uri:{get:function(){return this.value},set:function(e){this.$emit("input",e)}}}},g=Object(s.a)(h,function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("el-dropdown",{attrs:{"show-timeout":100,trigger:"click"}},[a("el-button",{attrs:{plain:""}},[e._v("\n    外链\n    "),a("i",{staticClass:"el-icon-caret-bottom el-icon--right"})]),e._v(" "),a("el-dropdown-menu",{staticClass:"no-padding no-border",staticStyle:{width:"400px"},attrs:{slot:"dropdown"},slot:"dropdown"},[a("el-form-item",{staticStyle:{"margin-bottom":"0px"},attrs:{"label-width":"0px",prop:"source_uri"}},[a("el-input",{attrs:{placeholder:"请输入内容"},model:{value:e.source_uri,callback:function(t){e.source_uri=t},expression:"source_uri"}},[a("template",{slot:"prepend"},[e._v("填写url")])],2)],1)],1)],1)},[],!1,null,null,null);g.options.__file="SourceUrl.vue";var v={status:"draft",id:void 0,title:"",sender:"",receiver:"",attachment:"",content:"",ip:"",ip_address:"",created_at:"",platforms:["a-platform"],comment_disabled:!1,importance:0},b={labelPosition:"left",name:"messageDetail",components:{MDinput:i,PlatformDropdown:f,SourceUrlDropdown:g.exports},props:{isEdit:{type:Boolean,default:!1}},data:function(){return{message:n()({},v),loading:!1,userListOptions:[]}},computed:{contentShortLength:function(){return this.message.content_short.length},lang:function(){return this.$store.getters.language}},created:function(){if(this.isEdit){var e=this.$route.params&&this.$route.params.id;this.fetchData(e)}else this.message=n()({},v)},methods:{fetchData:function(e){var t=this;Object(u.c)(e).then(function(e){t.message=e.data.message,t.setTagsViewTitle()}).catch(function(e){console.log(e)})},setTagsViewTitle:function(){var e=n()({},this.$route,{title:"查看留言-"+this.message.id});this.$store.dispatch("updateVisitedView",e)}}},_=(a("3usR"),Object(s.a)(b,function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"createPost-container"},[a("el-form",{ref:"message",staticClass:"form-container",attrs:{model:e.message}},[a("div",{staticClass:"createPost-main-container"},[a("el-row",[a("el-col",{attrs:{span:24}},[a("el-form-item",{staticStyle:{"margin-bottom":"40px"},attrs:{label:"标题:",prop:"title"}},[a("MDinput",{attrs:{maxlength:80,name:"name",required:"",readonly:""},model:{value:e.message.title,callback:function(t){e.$set(e.message,"title",t)},expression:"message.title"}})],1)],1)],1),e._v(" "),a("el-row",[a("el-col",{attrs:{span:6}},[a("el-form-item",{staticStyle:{"margin-bottom":"40px"},attrs:{"label-width":"60px",label:"留言者:"}},[a("el-input",{attrs:{rows:1,readonly:""},model:{value:e.message.sender,callback:function(t){e.$set(e.message,"sender",t)},expression:"message.sender"}})],1)],1),e._v(" "),a("el-col",{attrs:{span:6,offset:2}},[a("el-form-item",{staticStyle:{"margin-bottom":"40px"},attrs:{"label-width":"60px",label:"接收者:"}},[a("el-input",{attrs:{rows:1,readonly:""},model:{value:e.message.receiver,callback:function(t){e.$set(e.message,"receiver",t)},expression:"message.receiver"}})],1)],1)],1),e._v(" "),a("el-row",[a("el-col",{attrs:{span:6}},[a("el-form-item",{staticStyle:{"margin-bottom":"40px"},attrs:{"label-width":"60px",label:"IP:"}},[a("el-input",{attrs:{rows:1,readonly:""},model:{value:e.message.ip,callback:function(t){e.$set(e.message,"ip",t)},expression:"message.ip"}})],1)],1),e._v(" "),a("el-col",{attrs:{span:6,offset:2}},[a("el-form-item",{staticStyle:{"margin-bottom":"40px"},attrs:{"label-width":"60px",label:"IP区域:"}},[a("el-input",{attrs:{rows:1,readonly:""},model:{value:e.message.ip_address,callback:function(t){e.$set(e.message,"ip_address",t)},expression:"message.ip_address"}})],1)],1),e._v(" "),a("el-col",{attrs:{span:6,offset:2}},[a("el-form-item",{staticStyle:{"margin-bottom":"40px"},attrs:{"label-width":"80px",label:"留言时间:"}},[a("el-input",{attrs:{rows:1,readonly:""},model:{value:e.message.created_at,callback:function(t){e.$set(e.message,"created_at",t)},expression:"message.created_at"}})],1)],1)],1),e._v(" "),a("el-row",{directives:[{name:"show",rawName:"v-show",value:e.message.attachment,expression:"message.attachment"}]},[a("el-col",{attrs:{span:24}},[a("el-form-item",{staticStyle:{"margin-bottom":"40px"},attrs:{label:"图片:",prop:"title"}},[a("img",{staticClass:"image",staticStyle:{"max-width":"300px"},attrs:{src:e.message.attachment}})])],1)],1),e._v(" "),a("el-row",[a("el-col",{attrs:{span:24}},[a("el-form-item",{staticStyle:{"margin-bottom":"40px"},attrs:{label:"留言内容:",prop:"title"}},[a("el-input",{attrs:{rows:5,type:"textarea",readonly:""},model:{value:e.message.content,callback:function(t){e.$set(e.message,"content",t)},expression:"message.content"}})],1)],1)],1)],1)])],1)},[],!1,null,"7269b25a",null));_.options.__file="MessageDetail.vue";var x={name:"EditForm",components:{MessageDetail:_.exports}},y=Object(s.a)(x,function(){var e=this.$createElement;return(this._self._c||e)("Message-detail",{attrs:{"is-edit":!0}})},[],!1,null,null,null);y.options.__file="detail.vue";t.default=y.exports},xEMq:function(e,t,a){"use strict";a.d(t,"b",function(){return n}),a.d(t,"c",function(){return r}),a.d(t,"a",function(){return s});var l=a("t3Un");function n(e){return Object(l.a)({url:"/message/index",method:"get",params:e})}function r(e){return Object(l.a)({url:"/message/detail",method:"get",params:{id:e}})}function s(e){return Object(l.a)({url:"/message/delete",method:"get",params:{id:e}})}}}]);