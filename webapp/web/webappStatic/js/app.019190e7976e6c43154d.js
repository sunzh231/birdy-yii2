webpackJsonp([1],[,,,,,,,,,,function(t,e,n){"use strict";var i=n(86),a=n.n(i),s=n(18),o=n.n(s),r=n(19),l=n.n(r),c=n(91),u=n.n(c),d=n(90),p=n.n(d),v=n(63),h=function(t){function e(t){o()(this,e);var n=u()(this,(e.__proto__||a()(e)).call(this,t));return n.vm=t,n}return p()(e,t),l()(e,[{key:"login",value:function(t){arguments.length>1&&void 0!==arguments[1]&&arguments[1];return this.vm.$resource(t).save(this.vm.target).then(function(t){return t.data})}}]),e}(v.a);e.a=h},,,,,,,,,,,,,,,,,,,,,,,,function(t,e,n){var i=n(0)(n(66),n(146),null,null);t.exports=i.exports},function(t,e,n){n(139);var i=n(0)(n(72),n(157),null,null);t.exports=i.exports},function(t,e,n){n(132);var i=n(0)(n(79),n(150),null,null);t.exports=i.exports},,,,,,,,,,,,,,,,,,,,function(t,e,n){n(140);var i=n(0)(n(74),n(158),null,null);t.exports=i.exports},function(t,e,n){n(136);var i=n(0)(n(75),n(154),"data-v-7881b14d",null);t.exports=i.exports},function(t,e,n){n(131);var i=n(0)(n(76),n(149),"data-v-2191a5df",null);t.exports=i.exports},function(t,e,n){n(133);var i=n(0)(n(77),n(151),null,null);t.exports=i.exports},function(t,e,n){n(137);var i=n(0)(n(78),n(155),"data-v-793fc5e2",null);t.exports=i.exports},,,function(t,e,n){"use strict";var i=n(18),a=n.n(i),s=n(19),o=n.n(s),r=function(){function t(e){a()(this,t),this.vm=e}return o()(t,[{key:"create",value:function(t){arguments.length>1&&void 0!==arguments[1]&&arguments[1];return this.vm.$resource(t).save(this.vm.target).then(function(t){return t.data})}},{key:"update",value:function(t){arguments.length>1&&void 0!==arguments[1]&&arguments[1];return this.vm.$resource(t).update(this.vm.target).then(function(t){return t.data})}},{key:"get",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;return this.vm.$resource(t).get(e).then(function(t){return t.data})}},{key:"remove",value:function(t){arguments.length>1&&void 0!==arguments[1]&&arguments[1];return this.vm.$resource(t).delete().then(function(t){return t.data})}}]),t}();e.a=r},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(55),a=n(51),s=n.n(a),o=n(53),r=n(52),l=n(54),c=n.n(l),u=n(50),d=n(56),p=n.n(d),v=n(57),h=n.n(v),f=n(58),_=n.n(f),g=n(60),m=n.n(g),w=n(36),x=(n.n(w),n(59)),b=n.n(x);i.a.use(o.a),i.a.use(r.a),i.a.use(c.a),i.a.use(u.a);var C=[{path:"/",component:h.a},{path:"/confirm/:id",component:_.a},{path:"/list",component:m.a},{path:"/loanend",component:b.a}],y=new o.a({routes:C});s.a.attach(document.body),i.a.config.productionTip=!1,new i.a({router:y,render:function(t){return t(p.a)}}).$mount("#app-box")},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(169),a=n.n(i);e.default={components:{XDialog:a.a},created:function(){void 0!==this.value&&(this.showValue=this.value)},props:{value:Boolean,title:String,content:String,buttonText:String,maskTransition:{type:String,default:"vux-mask"},dialogTransition:{type:String,default:"vux-dialog"}},data:function(){return{showValue:!1}},methods:{_onHide:function(){this.showValue=!1}},watch:{value:function(t){this.showValue=t},showValue:function(t){this.$emit("input",t)}}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:{gap:String}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(14);e.default={props:{isLink:Boolean,link:[String,Object],borderIntent:{type:Boolean,default:!0}},methods:{onClick:function(){this.link&&n.i(i.a)(this.link,this.$router)}}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(166),a=n.n(i),s=n(14),o=n(80);e.default={components:{InlineDesc:a.a},props:n.i(o.a)(),beforeMount:function(){this.hasTitleSlot=!!this.$slots.title},computed:{valueClass:function(){return{"vux-cell-primary":"content"===this.primary||"left"===this.valueAlign,"vux-cell-align-left":"left"===this.valueAlign,"vux-cell-arrow-transition":!!this.arrowDirection,"vux-cell-arrow-up":"up"===this.arrowDirection,"vux-cell-arrow-down":"down"===this.arrowDirection}}},methods:{getLabelStyles:function(){return{width:this.$parent.labelWidth||this.$parent.$parent.labelWidth,textAlign:this.$parent.labelAlign||this.$parent.$parent.labelAlign,marginRight:this.$parent.labelMarginRight||this.$parent.$parent.labelMarginRight}},onClick:function(){!this.disabled&&n.i(s.a)(this.link,this.$router)}},data:function(){return{hasTitleSlot:!1}}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:{title:String,titleColor:String,labelWidth:String,labelAlign:String,labelMarginRight:String,gutter:[String,Number]}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(83),a=n.n(i),s=n(81),o=n(14);e.default={created:function(){this.index=this.value||0,this.index&&(this.current=this.index)},mounted:function(){var t=this;this.hasTwoLoopItem(),this.$nextTick(function(){t.list&&0===t.list.length||t.render(t.index),t.xheight=t.getHeight()})},methods:{hasTwoLoopItem:function(){2===this.list.length&&this.loop&&(this.listTwoLoopItem=this.list)},clickListItem:function(t){n.i(o.a)(t.url,this.$router),this.$emit("on-click-list-item",JSON.parse(a()(t)))},buildBackgroundUrl:function(t){return"url("+t+")"},render:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0;this.swiper&&this.swiper.destroy(),this.swiper=new s.a({container:this.$el,direction:this.direction,auto:this.auto,loop:this.loop,interval:this.interval,threshold:this.threshold,duration:this.duration,height:this.height||this._height,minMovingDistance:this.minMovingDistance,imgList:this.imgList}).on("swiped",function(e,n){t.current=n%t.length,t.index=n%t.length}),e>0&&this.swiper.go(e)},rerender:function(){var t=this;this.$el&&!this.hasRender&&(this.hasRender=!0,this.hasTwoLoopItem(),this.$nextTick(function(){t.index=t.value||0,t.current=t.value||0,t.length=t.list.length||t.$children.length,t.destroy(),t.render(t.value)}))},destroy:function(){this.swiper&&this.swiper.destroy()},getHeight:function(){var t=parseInt(this.height,10);return t?this.height:t?void 0:this.aspectRatio?this.$el.offsetWidth*this.aspectRatio+"px":"180px"}},props:{list:{type:Array,default:function(){return[]}},direction:{type:String,default:"horizontal"},showDots:{type:Boolean,default:!0},showDescMask:{type:Boolean,default:!0},dotsPosition:{type:String,default:"right"},dotsClass:String,auto:{type:Boolean,default:!1},loop:Boolean,interval:{type:Number,default:3e3},threshold:{type:Number,default:50},duration:{type:Number,default:300},height:{type:String,default:"auto"},aspectRatio:Number,minMovingDistance:{type:Number,default:0},value:{type:Number,default:0}},data:function(){return{hasRender:!1,current:this.index||0,xheight:"auto",length:this.list.length,index:0,listTwoLoopItem:[]}},watch:{list:function(t){this.rerender()},current:function(t){this.index=t,this.$emit("on-index-change",t)},index:function(t){var e=this;t!==this.current&&this.$nextTick(function(){e.swiper&&e.swiper.go(t)}),this.$emit("input",t)},value:function(t){this.index=t}},beforeDestroy:function(){this.destroy()}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(82);e.default={mixins:[i.a],props:{value:Boolean,time:{type:Number,default:2e3},type:{type:String,default:"success"},transition:String,width:{type:String,default:"7.6em"},isShowMask:{type:Boolean,default:!1},text:String,position:String},data:function(){return{show:!1}},created:function(){this.value&&(this.show=!0)},computed:{currentTransition:function(){return this.transition?this.transition:"top"===this.position?"vux-slide-from-top":"bottom"===this.position?"vux-slide-from-bottom":"vux-fade"},toastClass:function(){return{"weui-toast_forbidden":"warn"===this.type,"weui-toast_cancel":"cancel"===this.type,"weui-toast_success":"success"===this.type,"weui-toast_text":"text"===this.type,"vux-toast-top":"top"===this.position,"vux-toast-bottom":"bottom"===this.position,"vux-toast-middle":"middle"===this.position}},style:function(){if("text"===this.type&&"auto"===this.width)return{padding:"10px"}}},watch:{show:function(t){var e=this;t&&(this.$emit("input",!0),this.$emit("on-show"),this.fixSafariOverflowScrolling("auto"),clearTimeout(this.timeout),this.timeout=setTimeout(function(){e.show=!1,e.$emit("input",!1),e.$emit("on-hide"),e.fixSafariOverflowScrolling("touch")},this.time))},value:function(t){this.show=t}}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(14);e.default={props:{type:{default:"default"},disabled:Boolean,mini:Boolean,plain:Boolean,text:String,actionType:String,showLoading:Boolean,link:String},methods:{onClick:function(){!this.disabled&&n.i(i.a)(this.link,this.$router)}},computed:{classes:function(){return[{"weui-btn_disabled":this.disabled,"weui-btn_mini":this.mini},"weui-btn_"+this.type,this.plain?"weui-btn_plain-"+this.type:"",this.showLoading?"weui-btn_loading":""]}}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:{value:{type:Boolean,default:!1},maskTransition:{type:String,default:"vux-mask"},dialogTransition:{type:String,default:"vux-dialog"},dialogClass:{type:String,default:"weui-dialog"},hideOnBlur:Boolean,dialogStyle:Object,scroll:{type:Boolean,default:!0}},watch:{value:{handler:function(t){this.currentValue=t},immediate:!0},currentValue:function(t){this.$emit(t?"on-show":"on-hide"),this.$emit("input",t)}},data:function(){return{currentValue:!1}},methods:{onTouchMove:function(t){!this.scroll&&t.preventDefault()}}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(10);e.default={name:"app",data:function(){return{birdyService:new i.a(this),config:{}}},created:function(){this.pageInit()},methods:{pageInit:function(){}}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(10),a=n(162),s=n.n(a),o=n(168),r=n.n(o),l=n(167),c=n.n(l),u=n(35),d=n.n(u),p=n(34),v=n.n(p),h=n(36),f=n.n(h);e.default={components:{Alert:s.a,Toast:r.a,Swiper:c.a,XButton:d.a,Box:v.a,Upload:f.a},data:function(){return{birdyService:new i.a(this),position:"default",showTip:!1,show:!1,result:"贷款申请提交结果",errorTip:"请完善表单内容",content:{},target:{loan_amount:0,income:0,id_card_front:"",bank_pic:""},demo06_index:0,demo06_list:[]}},created:function(){var t=this;this.pageInit();var e=location.href.split("#")[0];this.birdyService.get("/api/wechat/config?url="+e).then(function(e){t.config=e,t.$wechat.config({debug:!0,appId:e.appId,timestamp:e.timestamp,nonceStr:e.nonceStr,signature:e.signature,jsApiList:["onMenuShareAppMessage"]}),t.$wechat.onMenuShareAppMessage({title:"微信在线贷款申请",desc:"微信1~20万元，无抵押信用贷款，最快30分钟审批",link:"http://www.xindaifuwu.com/webapp",imgUrl:"http://www.xindaifuwu.com/upload/base/loan_logo.png",type:"",dataUrl:"",success:function(){},cancel:function(){}})}).catch(function(t){console.log(t)}).finally(function(){})},methods:{demo06_onIndexChange:function(t){this.demo06_index=t},pageInit:function(){var t=this;this.birdyService.get("/api/content/1?access-token=abc123_").then(function(e){t.content=e.content,t.demo06_list=e.banners.map(function(t,e){return{url:"",img:t.url,title:""}})}).catch(function(t){console.log(t)}).finally(function(){})},apply:function(){var t=this;return this.target.name?this.target.tel?/^1[34578]\d{9}$/.test(this.target.tel)?0==this.target.loan_amount?(this.showTip=!0,this.errorTip="请选择贷款金额",!1):this.target.occupation?0==this.target.income?(this.showTip=!0,this.errorTip="请选择您的家庭年收入",!1):this.target.id_card_front?this.target.bank_pic?void this.birdyService.create("/api/loan/create?access-token=abc123_").then(function(e){t.show=!0,t.target={loan_amount:0,income:0,id_card_front:"",bank_pic:""}}).catch(function(t){alert(t),console.log(t)}).finally(function(){}):(this.showTip=!0,this.errorTip="请上传银行卡照片",!1):(this.showTip=!0,this.errorTip="请上传身份证正面照片",!1):(this.showTip=!0,this.errorTip="请填写您的职业",!1):(this.showTip=!0,this.errorTip="请输入正确手机号码",!1):(this.showTip=!0,this.errorTip="请填写您的手机号码",!1):(this.showTip=!0,this.errorTip="请填写您的真实姓名",!1)}}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(10),a=n(35),s=n.n(a),o=n(34),r=n.n(o),l=n(37),c=n.n(l);e.default={data:function(){return{birdyService:new i.a(this),content:{},target:{}}},created:function(){var t=this;this.getData(),this.pageInit();var e=location.href.split("#")[0];this.birdyService.get("/api/wechat/config?url="+e).then(function(e){t.config=e,t.$wechat.config({debug:!0,appId:e.appId,timestamp:e.timestamp,nonceStr:e.nonceStr,signature:e.signature,jsApiList:["onMenuShareAppMessage"]}),t.$wechat.onMenuShareAppMessage({title:t.target.name+"微信贷款信息核对确认书",desc:" ",link:"",imgUrl:"http://www.xindaifuwu.com/upload/base/loan_logo.png",type:"",dataUrl:"",success:function(){},cancel:function(){}})}).catch(function(t){console.log(t)}).finally(function(){})},computed:{formatDate:function(){return c()(new Date(1e3*this.target.created_at),"YYYY-MM-DD")}},methods:{pageInit:function(){var t=this;this.birdyService.get("/api/content/1?access-token=abc123_").then(function(e){t.content=e.content}).catch(function(t){console.log(t)}).finally(function(){})},getData:function(){var t=this;this.birdyService.get("/api/loan/view/"+this.$route.params.id+"?access-token=abc123_").then(function(e){t.target=e}).catch(function(t){}).finally(function(){})},confirm:function(){var t=this;this.target.loan_status=2,this.birdyService.update("/api/loan/update/"+this.$route.params.id+"?access-token=abc123_").then(function(e){window.location.href=t.content.link}).catch(function(t){}).finally(function(){})}},components:{XButton:s.a,Box:r.a}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(37),a=n.n(i),s=n(10);e.default={data:function(){return{birdyService:new s.a(this),now:a()(new Date,"YYYY-MM-DD"),issues:[],banners:[]}},created:function(){this.init()},methods:{init:function(){var t=this;this.birdyService.get("/api/endpage/view/1?access-token=abc123_").then(function(e){t.title=e.content.title,t.desc=e.content.description,t.pic=e.content.pic,t.banners=e.pics,t.issues=e.issues}).catch(function(t){console.log(t)}).finally(function(){})}}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(10),a=n(165),s=n.n(a),o=n(164),r=n.n(o),l=n(163),c=n.n(l),u=n(35),d=n.n(u),p=n(34),v=n.n(p);e.default={data:function(){return{birdyService:new i.a(this),loans:[],page:1,pageCount:1}},created:function(){this.init()},methods:{init:function(){this.getData(this.page)},detail:function(t,e){e.preventDefault(),this.$router.push({path:"/confirm/"+t})},getData:function(t){var e=this;this.birdyService.get("/api/loan/index?page="+t+"&access-token=abc123_").then(function(t){e.loans=t.items,e.pageCount=t._meta.pageCount}).catch(function(t){}).finally(function(){})},pageChange:function(t){-1==t&&this.page>1&&(this.page=this.page+t),1==t&&this.page<this.pageCount&&(this.page=this.page+t),this.getData(this.page)}},components:{Group:s.a,Cell:r.a,CellBox:c.a,XButton:d.a,Box:v.a}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=n(143),a=n.n(i);e.default={props:{fpath:{type:String}},data:function(){return{images:[]}},methods:{addPic:function(){this.fileUpload()},onFileChange:function(t){var e=this,n=t.target.files||t.dataTransfer.files;n.length&&a()(n[0]).then(function(t){e.createImage(n),console.log(t),t.formData.append("fileLen",t.fileLen),e.fileUpload(t)}).then(function(t){return console.log(t),t}).catch(function(t){alert(t)}).always(function(){})},createImage:function(t){this.images=[];for(var e=this,n=null,i=t.length,a=0;a<i;a++)n=new window.FileReader,n.readAsDataURL(t[a]),n.onload=function(t){e.images.push(t.target.result)}},removeImage:function(t){this.images=[],this.$emit("update:fpath","")},fileUpload:function(t){this.$http.post("/api/upload/picture",t.formData).then(function(t){var e=t.data.data;this.$emit("update:fpath",e)},function(t){console.log(t)})}}}},,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},function(t,e){},,,function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[t.title?n("div",{staticClass:"weui-cells__title",style:{color:t.titleColor},domProps:{innerHTML:t._s(t.title)}}):t._e(),t._v(" "),n("div",{staticClass:"weui-cells",class:{"vux-no-group-title":!t.title},style:{marginTop:"number"==typeof t.gutter?t.gutter+"px":t.gutter}},[t._t("after-title"),t._v(" "),t._t("default")],2)])},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement;return(t._self._c||e)("div",{style:{margin:t.gap}},[t._t("default")],2)},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"vux-cell-box weui-cell",class:{"vux-tap-active":t.isLink||!!t.link,"weui-cell_access":t.isLink||!!t.link,"vux-cell-no-border-intent":!t.borderIntent},on:{click:t.onClick}},[n("div",[t._t("default")],2)])},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"vux-toast"},[n("div",{directives:[{name:"show",rawName:"v-show",value:t.isShowMask&&t.show,expression:"isShowMask && show"}],staticClass:"weui-mask_transparent"}),t._v(" "),n("transition",{attrs:{name:t.currentTransition}},[n("div",{directives:[{name:"show",rawName:"v-show",value:t.show,expression:"show"}],staticClass:"weui-toast",class:t.toastClass,style:{width:t.width}},[n("i",{directives:[{name:"show",rawName:"v-show",value:"text"!==t.type,expression:"type !== 'text'"}],staticClass:"weui-icon-success-no-circle weui-icon_toast"}),t._v(" "),t.text?n("p",{staticClass:"weui-toast__content",style:t.style,domProps:{innerHTML:t._s(t.text)}}):n("p",{staticClass:"weui-toast__content"},[t._t("default")],2)])])],1)},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"loan_confirm"}},[n("div",{staticClass:"page-wrap"},[n("div",{staticClass:"page-header"},[n("div",{staticClass:"title"},[t._v("\n        "+t._s(t.target.name)+"微信贷款信息核对确认书\n      ")]),t._v(" "),n("div",{staticClass:"datetime"},[t._v("\n        "+t._s(t.formatDate)+"\n      ")])]),t._v(" "),n("div",{staticClass:"page-content"},[n("div",{staticClass:"content-group"},[t._m(0),t._v(" "),n("span",{staticClass:"text-control"},[t._v(t._s(t.target.name))])]),t._v(" "),n("div",{staticClass:"content-group"},[t._m(1),t._v(" "),n("span",{staticClass:"text-control"},[t._v(t._s(parseInt(t.target.loan_amount))+"万元")])]),t._v(" "),n("div",{staticClass:"content-group"},[t._m(2),t._v(" "),n("span",{staticClass:"text-control"},[t._v(t._s(150*t.target.loan_amount)+"元/月 月付")])]),t._v(" "),n("div",{staticClass:"content-group"},[t._m(3),t._v(" "),n("span",{staticClass:"text-control"},[t._v("每月"+t._s(new Date(t.target.created_at).getDate())+"日还上月利息，最后一个月支付本金")])]),t._v(" "),t._m(4),t._v(" "),t._m(5),t._v(" "),n("div",{staticClass:"content-group"},[t._m(6),t._v(" "),n("span",{staticClass:"text-control"},[n("img",{attrs:{width:"100%",src:t.target.id_card_front}})])]),t._v(" "),n("div",{staticClass:"content-group"},[t._m(7),t._v(" "),n("span",{staticClass:"text-control"},[n("img",{attrs:{width:"100%",src:t.target.bank_pic}})])]),t._v(" "),n("div",{staticClass:"content-group"},[t._m(8),t._v(" "),n("span",{staticClass:"text-control"},[t._v(t._s(parseInt(t.target.loan_amount))+"万元整")])]),t._v(" "),t._m(9),t._v(" "),t._m(10),t._v(" "),t._m(11)]),t._v(" "),n("box",{attrs:{gap:"10px 10px"}},[n("div",{on:{click:t.confirm}},[n("x-button",{staticClass:"confirm-btn",attrs:{type:"primary"}},[t._v("点击确定贷款")])],1)])],1)])},staticRenderFns:[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("label",[t._v("贷款申请人"),n("span",[t._v(":")])])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("label",[t._v("贷款总金额"),n("span",[t._v(":")])])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("label",[t._v("利息"),n("span",[t._v(":")])])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("label",[t._v("还款时间"),n("span",[t._v(":")])])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"content-group"},[n("label",[t._v("贷款时间"),n("span",[t._v(":")])]),t._v(" "),n("span",{staticClass:"text-control"},[t._v("12个月")])])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"content-group"},[n("label",[t._v("还款方式"),n("span",[t._v(":")])]),t._v(" "),n("span",{staticClass:"text-control"},[t._v("将每月利息于指定时间前存入下方绑定的银行卡即可")])])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("label",[t._v("身份证"),n("span",[t._v(":")])])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("label",[t._v("收款银行"),n("span",[t._v(":")])])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("label",[t._v("放款金额"),n("span",[t._v(":")])])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"content-group"},[n("label",[t._v("到账时间"),n("span",[t._v(":")])]),t._v(" "),n("span",{staticClass:"text-control"},[t._v("2小时以内")])])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"content-group"},[n("label",[t._v("手续费"),n("span",[t._v(":")])]),t._v(" "),n("span",{staticClass:"text-control"},[t._v("800元人民币/一次性")])])},function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"content-group help-tip"},[n("label",[t._v("办理截止时间"),n("span",[t._v(":")])]),t._v(" "),n("span",[t._v("18：00前，逾期系统将取消该贷款订单，请尽快点击办理")])])}]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"vue-upload-img-multiple"},[n("div",[n("input",{staticClass:"upload-btn",attrs:{type:"file",value:"12"},on:{change:t.onFileChange}})]),t._v(" "),t.images.length>0?n("div",[n("ul",t._l(t.images,function(t){return n("li",[n("img",{attrs:{width:"100%",src:t}})])})),t._v(" "),n("button",{on:{click:t.removeImage}},[t._v("移除")])]):t._e()])},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"loan_end"}},[n("div",{staticClass:"page-wrap"},[n("div",{staticClass:"page-header"},[n("div",{staticClass:"title"},[t._v("\n        "+t._s(t.title)+"\n      ")]),t._v(" "),n("div",{staticClass:"datetime"},[t._v("\n        "+t._s(t.now)+"\n      ")]),t._v(" "),n("div",{staticClass:"pictures"},[n("div",{staticClass:"pic"},t._l(t.banners,function(e){return n("div",{staticClass:"pic-item"},["qr"==e.name?n("div",{staticClass:"qr-text"},[t._v("\n              "+t._s(t.pic)+"\n            ")]):t._e(),t._v(" "),n("img",{attrs:{src:e.url}})])}))]),t._v(" "),n("div",{staticClass:"issues"},[n("div",{staticClass:"title-text"},[n("div",{staticClass:"title-tip"},[t._v("\n            常见问题\n          ")]),t._v("\n          "+t._s(t.desc)+"\n        ")]),t._v(" "),n("ul",t._l(t.issues,function(e,i){return n("li",[n("div",{staticClass:"question"},[n("span",{staticClass:"issue-no"},[t._v(t._s(i+1))]),t._v(" "),n("span",{staticClass:"issue-title"},[t._v(t._s(e.question))])]),t._v(" "),n("div",{staticClass:"answer"},[t._v("\n              "+t._s(e.answer)+"\n            ")])])}))])])])])},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"vux-slider"},[n("div",{staticClass:"vux-swiper",style:{height:t.xheight}},[t._t("default"),t._v(" "),t._l(t.list,function(e,i){return n("div",{staticClass:"vux-swiper-item",attrs:{"data-index":i},on:{click:function(n){t.clickListItem(e)}}},[n("a",{attrs:{href:"javascript:"}},[n("div",{staticClass:"vux-img",style:{backgroundImage:t.buildBackgroundUrl(e.img)}}),t._v(" "),t.showDescMask?n("p",{staticClass:"vux-swiper-desc"},[t._v(t._s(e.title))]):t._e()])])}),t._v(" "),t._l(t.listTwoLoopItem,function(e,i){return t.listTwoLoopItem.length>0?n("div",{staticClass:"vux-swiper-item vux-swiper-item-clone",attrs:{"data-index":i},on:{click:function(n){t.clickListItem(e)}}},[n("a",{attrs:{href:"javascript:"}},[n("div",{staticClass:"vux-img",style:{backgroundImage:t.buildBackgroundUrl(e.img)}}),t._v(" "),t.showDescMask?n("p",{staticClass:"vux-swiper-desc"},[t._v(t._s(e.title))]):t._e()])]):t._e()})],2),t._v(" "),n("div",{directives:[{name:"show",rawName:"v-show",value:t.showDots,expression:"showDots"}],class:[t.dotsClass,"vux-indicator","vux-indicator-"+t.dotsPosition]},t._l(t.length,function(e){return n("a",{attrs:{href:"javascript:"}},[n("i",{staticClass:"vux-icon-dot",class:{active:e-1===t.current}})])}))])},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement;return(t._self._c||e)("span",{staticClass:"vux-label-desc"},[t._t("default")],2)},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"loan_apply"}},[n("swiper",{attrs:{loop:"",auto:"",list:t.demo06_list,index:t.demo06_index},on:{"on-index-change":t.demo06_onIndexChange}}),t._v(" "),n("div",{staticClass:"divider-block"},[t._v("\n    微信贷款申请官方平台说明\n  ")]),t._v(" "),n("div",{staticClass:"description"},[t._v("\n    "+t._s(t.content.description)+"\n  ")]),t._v(" "),n("div",{staticClass:"divider-block"},[t._v("\n    请认真填写表单\n  ")]),t._v(" "),n("div",{staticClass:"form-wrap"},[n("div",{staticClass:"form-group"},[n("label",{staticClass:"label-control"},[t._v("姓名")]),t._v(" "),n("div",{staticClass:"content-control"},[n("input",{directives:[{name:"model",rawName:"v-model",value:t.target.name,expression:"target.name"}],attrs:{type:"text",placeholder:"请填写您的真实姓名"},domProps:{value:t.target.name},on:{input:function(e){e.target.composing||(t.target.name=e.target.value)}}})])]),t._v(" "),n("div",{staticClass:"form-group"},[n("label",{staticClass:"label-control"},[t._v("手机号码")]),t._v(" "),n("div",{staticClass:"content-control"},[n("input",{directives:[{name:"model",rawName:"v-model",value:t.target.tel,expression:"target.tel"}],attrs:{type:"text",placeholder:"请填写您的手机号码"},domProps:{value:t.target.tel},on:{input:function(e){e.target.composing||(t.target.tel=e.target.value)}}})])]),t._v(" "),n("div",{staticClass:"form-group"},[n("label",{staticClass:"label-control"},[t._v("贷款金额")]),t._v(" "),n("div",{staticClass:"content-control"},[n("select",{directives:[{name:"model",rawName:"v-model",value:t.target.loan_amount,expression:"target.loan_amount"}],on:{change:function(e){var n=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.target.loan_amount=e.target.multiple?n:n[0]}}},[n("option",{domProps:{value:0}},[t._v("请选择您的贷款金额")]),t._v(" "),n("option",{domProps:{value:1}},[t._v("1万")]),t._v(" "),n("option",{domProps:{value:2}},[t._v("2万")]),t._v(" "),n("option",{domProps:{value:3}},[t._v("3万")]),t._v(" "),n("option",{domProps:{value:4}},[t._v("4万")]),t._v(" "),n("option",{domProps:{value:5}},[t._v("5万")]),t._v(" "),n("option",{domProps:{value:6}},[t._v("6万")]),t._v(" "),n("option",{domProps:{value:7}},[t._v("7万")]),t._v(" "),n("option",{domProps:{value:8}},[t._v("8万")]),t._v(" "),n("option",{domProps:{value:9}},[t._v("9万")]),t._v(" "),n("option",{domProps:{value:10}},[t._v("10万")]),t._v(" "),n("option",{domProps:{value:15}},[t._v("15万")]),t._v(" "),n("option",{domProps:{value:20}},[t._v("20万")])])])]),t._v(" "),n("div",{staticClass:"form-group"},[n("label",{staticClass:"label-control"},[t._v("职业")]),t._v(" "),n("div",{staticClass:"content-control"},[n("input",{directives:[{name:"model",rawName:"v-model",value:t.target.occupation,expression:"target.occupation"}],attrs:{type:"text",placeholder:"请填写您的职业"},domProps:{value:t.target.occupation},on:{input:function(e){e.target.composing||(t.target.occupation=e.target.value)}}})])]),t._v(" "),n("div",{staticClass:"form-group"},[n("label",{staticClass:"label-control"},[t._v("家庭年收入")]),t._v(" "),n("div",{staticClass:"content-control"},[n("select",{directives:[{name:"model",rawName:"v-model",value:t.target.income,expression:"target.income"}],on:{change:function(e){var n=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.target.income=e.target.multiple?n:n[0]}}},[n("option",{domProps:{value:0}},[t._v("请选择您的家庭年收入")]),t._v(" "),n("option",{domProps:{value:5}},[t._v("5万")]),t._v(" "),n("option",{domProps:{value:10}},[t._v("10万")]),t._v(" "),n("option",{domProps:{value:15}},[t._v("15万")]),t._v(" "),n("option",{domProps:{value:20}},[t._v("20万")]),t._v(" "),n("option",{domProps:{value:30}},[t._v("30万以上")])])])]),t._v(" "),n("div",{staticClass:"form-group"},[n("label",{staticClass:"label-control"},[t._v("上传身份证正面照片")]),t._v(" "),n("div",{staticClass:"content-control"},[n("upload",{attrs:{fpath:t.target.id_card_front},on:{"update:fpath":[function(e){t.target.id_card_front=e},function(e){return t.target.id_card_front=e}]}})],1)]),t._v(" "),n("div",{staticClass:"form-group"},[n("label",{staticClass:"label-control"},[t._v("上传银行卡照片")]),t._v(" "),n("div",{staticClass:"content-control"},[n("upload",{attrs:{fpath:t.target.bank_pic},on:{"update:fpath":[function(e){t.target.bank_pic=e},function(e){return t.target.bank_pic=e}]}})],1)])]),t._v(" "),n("box",{attrs:{gap:"10px 10px"}},[n("div",{on:{click:t.apply}},[n("x-button",{staticClass:"apply-btn",attrs:{type:"primary"}},[t._v("提交微信贷款申请官方平台")])],1)]),t._v(" "),n("alert",{attrs:{title:t.result},model:{value:t.show,callback:function(e){t.show=e},expression:"show"}},[t._v(" 恭喜您的贷款申请已成功提交 ")]),t._v(" "),n("toast",{attrs:{type:"text",time:1600,"is-show-mask":"",text:t.errorTip,position:t.position},model:{value:t.showTip,callback:function(e){t.showTip=e},expression:"showTip"}})],1)},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"loan_list"}},[n("group",t._l(t.loans,function(e){return n("div",{on:{click:function(n){t.detail(e.id,n)}}},[n("cell-box",{attrs:{"is-link":""}},[n("span",[t._v(t._s(e.name))]),t._v("微信贷款信息核对确认书\n      ")])],1)})),t._v(" "),n("div",{staticClass:"btn-wrap"},[n("box",{staticClass:"btn-group",attrs:{gap:"10px 10px"}},[n("span",{on:{click:function(e){t.pageChange(-1)}}},[n("x-button",{staticClass:"apply-btn",attrs:{type:"default",mini:""}},[t._v("上一页")])],1),t._v(" "),n("span",{staticClass:"page-info"},[t._v("\n        "+t._s(t.page)+"/"+t._s(t.pageCount)+"\n      ")]),t._v(" "),n("span",{on:{click:function(e){t.pageChange(1)}}},[n("x-button",{staticClass:"apply-btn",attrs:{type:"default",mini:""}},[t._v("下一页")])],1)])],1)],1)},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"vux-x-dialog",on:{touchmove:t.onTouchMove}},[n("transition",{attrs:{name:t.maskTransition}},[n("div",{directives:[{name:"show",rawName:"v-show",value:t.currentValue,expression:"currentValue"}],staticClass:"weui-mask",on:{click:function(e){t.hideOnBlur&&(t.currentValue=!1)}}})]),t._v(" "),n("transition",{attrs:{name:t.dialogTransition}},[n("div",{directives:[{name:"show",rawName:"v-show",value:t.currentValue,expression:"currentValue"}],class:t.dialogClass,style:t.dialogStyle},[t._t("default")],2)])],1)},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("button",{staticClass:"weui-btn",class:t.classes,attrs:{disabled:t.disabled,type:t.actionType},on:{click:t.onClick}},[t.showLoading?n("i",{staticClass:"weui-loading"}):t._e(),t._v(" "),t._t("default",[t._v(t._s(t.text))])],2)},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"app"}},[n("router-view")],1)},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"weui-cell",class:{"vux-tap-active":t.isLink||!!t.link,"weui-cell_access":t.isLink||!!t.link,"vux-cell-no-border-intent":!t.borderIntent,"vux-cell-disabled":t.disabled},on:{click:t.onClick}},[n("div",{staticClass:"weui-cell__hd"},[t._t("icon")],2),t._v(" "),n("div",{staticClass:"vux-cell-bd",class:{"vux-cell-primary":"title"===t.primary&&"left"!==t.valueAlign}},[n("p",[t.title||t.hasTitleSlot?n("label",{staticClass:"vux-label",style:t.getLabelStyles()},[t._t("title",[t._v(t._s(t.title))])],2):t._e(),t._v(" "),t._t("after-title")],2),t._v(" "),n("inline-desc",[t._t("inline-desc",[t._v(t._s(t.inlineDesc))])],2)],1),t._v(" "),n("div",{staticClass:"weui-cell__ft",class:t.valueClass},[t._t("value"),t._v(" "),t._t("default",[t._v(t._s(t.value))]),t._v(" "),t.isLoading?n("i",{staticClass:"weui-loading"}):t._e()],2),t._v(" "),t._t("child")],2)},staticRenderFns:[]}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"vux-alert"},[n("x-dialog",{attrs:{"mask-transition":t.maskTransition,"dialog-transition":t.dialogTransition},on:{"on-hide":function(e){t.$emit("on-hide")},"on-show":function(e){t.$emit("on-show")}},model:{value:t.showValue,callback:function(e){t.showValue=e},expression:"showValue"}},[n("div",{staticClass:"weui-dialog__hd"},[n("strong",{staticClass:"weui-dialog__title"},[t._v(t._s(t.title))])]),t._v(" "),n("div",{staticClass:"weui-dialog__bd"},[t._t("default",[n("div",{domProps:{innerHTML:t._s(t.content)}})])],2),t._v(" "),n("div",{staticClass:"weui-dialog__ft"},[n("a",{staticClass:"weui-dialog__btn weui-dialog__btn_primary",attrs:{href:"javascript:;"},on:{click:t._onHide}},[t._v(t._s(t.buttonText||"确定"))])])])],1)},staticRenderFns:[]}},,function(t,e,n){n(142);var i=n(0)(n(65),n(160),null,null);t.exports=i.exports},function(t,e,n){n(129);var i=n(0)(n(67),n(147),null,null);t.exports=i.exports},function(t,e,n){n(141);var i=n(0)(n(68),n(159),null,null);t.exports=i.exports},function(t,e,n){n(128);var i=n(0)(n(69),n(145),null,null);t.exports=i.exports},function(t,e,n){n(135);var i=n(0)(null,n(153),null,null);t.exports=i.exports},function(t,e,n){n(134);var i=n(0)(n(70),n(152),null,null);t.exports=i.exports},function(t,e,n){n(130);var i=n(0)(n(71),n(148),null,null);t.exports=i.exports},function(t,e,n){n(138);var i=n(0)(n(73),n(156),null,null);t.exports=i.exports},,,function(t,e){}],[64]);
//# sourceMappingURL=app.019190e7976e6c43154d.js.map