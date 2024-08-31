import{G as m,o as r,e as p,r as b,H as h,T as _,a as l,i as x,b as s,w as d,u as e,t as v,f as y}from"./app-BDusPxOz.js";import{s as f}from"./index-Csazy4ZU.js";import{s as $}from"./index-C4H-QJQX.js";import{s as g}from"./index-DUfUUQwL.js";var w=function(t){var a=t.dt;return`
.p-floatlabel {
    display: block;
    position: relative;
}

.p-floatlabel label {
    position: absolute;
    pointer-events: none;
    top: 50%;
    margin-top: -.5rem;
    transition-property: all;
    transition-timing-function: ease;
    line-height: 1;
    left: 0.75rem;
    color: `.concat(a("floatlabel.color"),`;
    transition-duration: `).concat(a("floatlabel.transition.duration"),`;
}

.p-floatlabel:has(textarea) label {
    top: 1rem;
}

.p-floatlabel:has(input:focus) label,
.p-floatlabel:has(input.p-filled) label,
.p-floatlabel:has(input:-webkit-autofill) label,
.p-floatlabel:has(textarea:focus) label,
.p-floatlabel:has(textarea.p-filled) label,
.p-floatlabel:has(.p-inputwrapper-focus) label,
.p-floatlabel:has(.p-inputwrapper-filled) label {
    top: -.75rem;
    font-size: 12px;
    color: `).concat(a("floatlabel.focus.color"),`;
}

.p-floatlabel .p-placeholder,
.p-floatlabel input::placeholder,
.p-floatlabel .p-inputtext::placeholder {
    opacity: 0;
    transition-property: all;
    transition-timing-function: ease;
}

.p-floatlabel .p-focus .p-placeholder,
.p-floatlabel input:focus::placeholder,
.p-floatlabel .p-inputtext:focus::placeholder {
    opacity: 1;
    transition-property: all;
    transition-timing-function: ease;
}

.p-floatlabel > .p-invalid + label {
    color: `).concat(a("floatlabel.invalid.color"),`;
}
`)},V={root:"p-floatlabel"},S=m.extend({name:"floatlabel",theme:w,classes:V}),k={name:"BaseFloatLabel",extends:g,props:{},style:S,provide:function(){return{$pcFloatLabel:this,$parentInstance:this}}},c={name:"FloatLabel",extends:k,inheritAttrs:!1};function B(n,t,a,u,o,i){return r(),p("span",h({class:n.cx("root")},n.ptmi("root")),[b(n.$slots,"default")],16)}c.render=B;const L={class:"flex items-center justify-center min-h-screen"},F={class:"mx-auto lg:w-1/4 px-12"},N=l("h2",{class:"mb-12 font-black text-3xl text-center"},"Enter Q&A Session",-1),j={class:"mb-8"},A=l("label",{for:"username"},"Name",-1),C={class:"mb-8"},E=l("label",{for:"username"},"Session code",-1),U={class:"text-sm px-2 pt-2"},z={key:0,class:"text-red-500"},D={class:"flex justify-center"},P={__name:"Start",setup(n){const t=_({name:"",session_code:""});function a(){t.post("/start")}return(u,o)=>(r(),p("div",L,[l("div",F,[N,l("form",{onSubmit:x(a,["prevent"])},[l("div",j,[s(e(c),null,{default:d(()=>[s(e(f),{id:"name",modelValue:e(t).name,"onUpdate:modelValue":o[0]||(o[0]=i=>e(t).name=i),class:"w-full"},null,8,["modelValue"]),A]),_:1})]),l("div",C,[s(e(c),null,{default:d(()=>[s(e(f),{id:"session_code",modelValue:e(t).session_code,"onUpdate:modelValue":o[1]||(o[1]=i=>e(t).session_code=i),class:"w-full"},null,8,["modelValue"]),E]),_:1}),l("div",U,[e(t).errors.session_code?(r(),p("span",z,v(e(t).errors.session_code),1)):y("",!0)])]),l("div",D,[s(e($),{class:"px-48",label:"Let's go!",type:"submit",disabled:e(t).processing},null,8,["disabled"])])],32)])]))}};export{P as default};
