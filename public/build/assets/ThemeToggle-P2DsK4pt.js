import{d,o as l,e as c,Q as w,ad as b,n as g,a,f as h,t as m,i as f,G as v,H as u,q as k,b as y,u as _}from"./app-BDusPxOz.js";import{s as x}from"./index-DUfUUQwL.js";const S=["src","alt"],Y={__name:"ApplicationMark",setup(n){const t=d("images/logo.png"),e=d("AskNVote");return(s,i)=>(l(),c("img",{src:t.value,alt:e.value,class:""},null,8,S))}},B={class:"max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8"},V={class:"flex items-center justify-between flex-wrap"},T={class:"w-0 flex-1 flex items-center min-w-0"},C={key:0,class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},L=a("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),z=[L],M={key:1,class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},j=a("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"},null,-1),O=[j],E={class:"ms-3 font-medium text-sm text-white truncate"},I={class:"shrink-0 sm:ms-3"},P=a("svg",{class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[a("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6 18L18 6M6 6l12 12"})],-1),$=[P],Z={__name:"Banner",setup(n){const t=w(),e=d(!0),s=d("success"),i=d("");return b(async()=>{var o,r;s.value=((o=t.props.jetstream.flash)==null?void 0:o.bannerStyle)||"success",i.value=((r=t.props.jetstream.flash)==null?void 0:r.banner)||"",e.value=!0}),(o,r)=>(l(),c("div",null,[e.value&&i.value?(l(),c("div",{key:0,class:g({"bg-indigo-500":s.value=="success","bg-red-700":s.value=="danger"})},[a("div",B,[a("div",V,[a("div",T,[a("span",{class:g(["flex p-2 rounded-lg",{"bg-indigo-600":s.value=="success","bg-red-600":s.value=="danger"}])},[s.value=="success"?(l(),c("svg",C,z)):h("",!0),s.value=="danger"?(l(),c("svg",M,O)):h("",!0)],2),a("p",E,m(i.value),1)]),a("div",I,[a("button",{type:"button",class:g(["-me-1 flex p-2 rounded-md focus:outline-none sm:-me-2 transition",{"hover:bg-indigo-600 focus:bg-indigo-600":s.value=="success","hover:bg-red-600 focus:bg-red-600":s.value=="danger"}]),"aria-label":"Dismiss",onClick:r[0]||(r[0]=f(R=>e.value=!1,["prevent"]))},$,2)])])])],2)):h("",!0)]))}};var F=function(t){var e=t.dt;return`
.p-toggleswitch {
    display: inline-block;
    width: `.concat(e("toggleswitch.width"),`;
    height: `).concat(e("toggleswitch.height"),`;
}

.p-toggleswitch-input {
    cursor: pointer;
    appearance: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding: 0;
    margin: 0;
    opacity: 0;
    z-index: 1;
    outline: 0 none;
    border-radius: `).concat(e("toggleswitch.border.radius"),`;
}

.p-toggleswitch-slider {
    display: inline-block;
    cursor: pointer;
    width: 100%;
    height: 100%;
    border-width: `).concat(e("toggleswitch.border.width"),`;
    border-style: solid;
    border-color: `).concat(e("toggleswitch.border.color"),`;
    background: `).concat(e("toggleswitch.background"),`;
    transition: background `).concat(e("toggleswitch.transition.duration"),", color ").concat(e("toggleswitch.transition.duration"),", border-color ").concat(e("toggleswitch.transition.duration"),", outline-color ").concat(e("toggleswitch.transition.duration"),", box-shadow ").concat(e("toggleswitch.transition.duration"),`;
    border-radius: `).concat(e("toggleswitch.border.radius"),`;
    outline-color: transparent;
    box-shadow: `).concat(e("toggleswitch.shadow"),`;
}

.p-toggleswitch-slider:before {
    position: absolute;
    content: "";
    top: 50%;
    background: `).concat(e("toggleswitch.handle.background"),`;
    width: `).concat(e("toggleswitch.handle.size"),`;
    height: `).concat(e("toggleswitch.handle.size"),`;
    left: `).concat(e("toggleswitch.gap"),`;
    margin-top: calc(-1 * calc(`).concat(e("toggleswitch.handle.size"),` / 2));
    border-radius: `).concat(e("toggleswitch.handle.border.radius"),`;
    transition: background `).concat(e("toggleswitch.transition.duration"),", left ").concat(e("toggleswitch.slide.duration"),`;
}

.p-toggleswitch.p-toggleswitch-checked .p-toggleswitch-slider {
    background: `).concat(e("toggleswitch.checked.background"),`;
    border-color: `).concat(e("toggleswitch.checked.border.color"),`;
}

.p-toggleswitch.p-toggleswitch-checked .p-toggleswitch-slider:before {
    background: `).concat(e("toggleswitch.handle.checked.background"),`;
    left: calc(`).concat(e("toggleswitch.width")," - calc(").concat(e("toggleswitch.handle.size")," + ").concat(e("toggleswitch.gap"),`));
}

.p-toggleswitch:not(.p-disabled):has(.p-toggleswitch-input:hover) .p-toggleswitch-slider {
    background: `).concat(e("toggleswitch.hover.background"),`;
    border-color: `).concat(e("toggleswitch.hover.border.color"),`;
}

.p-toggleswitch:not(.p-disabled):has(.p-toggleswitch-input:hover) .p-toggleswitch-slider:before {
    background: `).concat(e("toggleswitch.handle.hover.background"),`;
}

.p-toggleswitch:not(.p-disabled):has(.p-toggleswitch-input:hover).p-toggleswitch-checked .p-toggleswitch-slider {
    background: `).concat(e("toggleswitch.checked.hover.background"),`;
    border-color: `).concat(e("toggleswitch.checked.hover.border.color"),`;
}

.p-toggleswitch:not(.p-disabled):has(.p-toggleswitch-input:hover).p-toggleswitch-checked .p-toggleswitch-slider:before {
    background: `).concat(e("toggleswitch.handle.checked.hover.background"),`;
}

.p-toggleswitch:not(.p-disabled):has(.p-toggleswitch-input:focus-visible) .p-toggleswitch-slider {
    box-shadow: `).concat(e("toggleswitch.focus.ring.shadow"),`;
    outline: `).concat(e("toggleswitch.focus.ring.width")," ").concat(e("toggleswitch.focus.ring.style")," ").concat(e("toggleswitch.focus.ring.color"),`;
    outline-offset: `).concat(e("toggleswitch.focus.ring.offset"),`;
}

.p-toggleswitch.p-invalid > .p-toggleswitch-slider {
    border-color: `).concat(e("toggleswitch.invalid.border.color"),`;
}

.p-toggleswitch.p-disabled {
    opacity: 1;
}

.p-toggleswitch.p-disabled .p-toggleswitch-slider {
    background: `).concat(e("toggleswitch.disabled.background"),`;
}

.p-toggleswitch.p-disabled .p-toggleswitch-slider:before {
    background: `).concat(e("toggleswitch.handle.disabled.background"),`;
}
`)},N={root:{position:"relative"}},A={root:function(t){var e=t.instance,s=t.props;return["p-toggleswitch p-component",{"p-toggleswitch-checked":e.checked,"p-disabled":s.disabled,"p-invalid":s.invalid}]},input:"p-toggleswitch-input",slider:"p-toggleswitch-slider"},D=v.extend({name:"toggleswitch",theme:F,classes:A,inlineStyles:N}),H={name:"BaseToggleSwitch",extends:x,props:{modelValue:{type:null,default:!1},trueValue:{type:null,default:!0},falseValue:{type:null,default:!1},invalid:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},readonly:{type:Boolean,default:!1},tabindex:{type:Number,default:null},inputId:{type:String,default:null},inputClass:{type:[String,Object],default:null},inputStyle:{type:Object,default:null},ariaLabelledby:{type:String,default:null},ariaLabel:{type:String,default:null}},style:D,provide:function(){return{$pcToggleSwitch:this,$parentInstance:this}}},p={name:"ToggleSwitch",extends:H,inheritAttrs:!1,emits:["update:modelValue","change","focus","blur"],methods:{getPTOptions:function(t){var e=t==="root"?this.ptmi:this.ptm;return e(t,{context:{checked:this.checked,disabled:this.disabled}})},onChange:function(t){if(!this.disabled&&!this.readonly){var e=this.checked?this.falseValue:this.trueValue;this.$emit("update:modelValue",e),this.$emit("change",t)}},onFocus:function(t){this.$emit("focus",t)},onBlur:function(t){this.$emit("blur",t)}},computed:{checked:function(){return this.modelValue===this.trueValue}}},U=["data-p-checked","data-p-disabled"],q=["id","checked","tabindex","disabled","readonly","aria-checked","aria-labelledby","aria-label","aria-invalid"];function G(n,t,e,s,i,o){return l(),c("div",u({class:n.cx("root"),style:n.sx("root")},o.getPTOptions("root"),{"data-p-checked":o.checked,"data-p-disabled":n.disabled}),[a("input",u({id:n.inputId,type:"checkbox",role:"switch",class:[n.cx("input"),n.inputClass],style:n.inputStyle,checked:o.checked,tabindex:n.tabindex,disabled:n.disabled,readonly:n.readonly,"aria-checked":o.checked,"aria-labelledby":n.ariaLabelledby,"aria-label":n.ariaLabel,"aria-invalid":n.invalid||void 0,onFocus:t[0]||(t[0]=function(){return o.onFocus&&o.onFocus.apply(o,arguments)}),onBlur:t[1]||(t[1]=function(){return o.onBlur&&o.onBlur.apply(o,arguments)}),onChange:t[2]||(t[2]=function(){return o.onChange&&o.onChange.apply(o,arguments)})},o.getPTOptions("input")),null,16,q),a("span",u({class:n.cx("slider")},o.getPTOptions("slider")),null,16)],16,U)}p.render=G;const Q={class:"text-gray-900 dark:text-gray-100 text-sm"},J={key:0},K={key:1},ee={__name:"ThemeToggle",props:{reverse:Boolean},setup(n){const t=n,e=d(!1);function s(){document.documentElement.classList.contains("dark")?(document.documentElement.classList.remove("dark"),localStorage.setItem("theme","light")):(document.documentElement.classList.add("dark"),localStorage.setItem("theme","dark"))}return k(()=>{localStorage.getItem("theme")==="dark"&&(document.documentElement.classList.add("dark"),e.value=!0)}),(i,o)=>(l(),c("div",{class:g(["flex gap-x-4",{"flex-row-reverse":t.reverse}])},[a("div",Q,[e.value?(l(),c("p",J,"dark")):(l(),c("p",K,"light"))]),y(_(p),{modelValue:e.value,"onUpdate:modelValue":o[0]||(o[0]=r=>e.value=r),onClick:s},null,8,["modelValue"])],2))}};export{Z as _,Y as a,ee as b};
