import{d as p,x as N,o as t,e as a,a as l,r as Q,b as s,w as o,g as r,t as b,s as B,n as w,m as Y,Q as z,T as D,k as I,y as U,c as y,f as u,u as $,F as G,h as O,z as R}from"./app-BDusPxOz.js";import{b as W,a as j}from"./DialogModal-CBQ4lXQi.js";import{_ as L,a as M}from"./TextInput-BRvXvSCL.js";import{_ as V}from"./PrimaryButton-HNLlPaTj.js";import{_ as C}from"./SecondaryButton-DvnNSiyY.js";import{_ as J}from"./DangerButton-Fh8Dr4hp.js";import{_ as X}from"./InputLabel-IF_FcJU9.js";import"./SectionTitle-CClscXmR.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const Z={class:"mt-4"},h={__name:"ConfirmsPassword",props:{title:{type:String,default:"Confirm Password"},content:{type:String,default:"For your security, please confirm your password to continue."},button:{type:String,default:"Confirm"}},emits:["confirmed"],setup(g,{emit:T}){const x=T,c=p(!1),e=N({password:"",error:"",processing:!1}),i=p(null),_=()=>{axios.get(route("password.confirmation")).then(n=>{n.data.confirmed?x("confirmed"):(c.value=!0,setTimeout(()=>i.value.focus(),250))})},v=()=>{e.processing=!0,axios.post(route("password.confirm"),{password:e.password}).then(()=>{e.processing=!1,d(),Y().then(()=>x("confirmed"))}).catch(n=>{e.processing=!1,e.error=n.response.data.errors.password[0],i.value.focus()})},d=()=>{c.value=!1,e.password="",e.error=""};return(n,m)=>(t(),a("span",null,[l("span",{onClick:_},[Q(n.$slots,"default")]),s(W,{show:c.value,onClose:d},{title:o(()=>[r(b(g.title),1)]),content:o(()=>[r(b(g.content)+" ",1),l("div",Z,[s(L,{ref_key:"passwordInput",ref:i,modelValue:e.password,"onUpdate:modelValue":m[0]||(m[0]=S=>e.password=S),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",autocomplete:"current-password",onKeyup:B(v,["enter"])},null,8,["modelValue"]),s(M,{message:e.error,class:"mt-2"},null,8,["message"])])]),footer:o(()=>[s(C,{onClick:d},{default:o(()=>[r(" Cancel ")]),_:1}),s(V,{class:w(["ms-3",{"opacity-25":e.processing}]),disabled:e.processing,onClick:v},{default:o(()=>[r(b(g.button),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}},ee={key:0,class:"text-lg font-medium text-gray-900 dark:text-gray-100"},te={key:1,class:"text-lg font-medium text-gray-900 dark:text-gray-100"},oe={key:2,class:"text-lg font-medium text-gray-900 dark:text-gray-100"},ae=l("div",{class:"mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-400"},[l("p",null," When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application. ")],-1),se={key:3},re={key:0},ne={class:"mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400"},le={key:0,class:"font-semibold"},ce={key:1},ie=["innerHTML"],ue={key:0,class:"mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400"},de={class:"font-semibold"},me=["innerHTML"],fe={key:1,class:"mt-4"},pe={key:1},ve=l("div",{class:"mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400"},[l("p",{class:"font-semibold"}," Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost. ")],-1),_e={class:"grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 dark:bg-gray-900 dark:text-gray-100 rounded-lg"},ye={class:"mt-5"},he={key:0},ge={key:1},Ve={__name:"TwoFactorAuthenticationForm",props:{requiresConfirmation:Boolean},setup(g){const T=g,x=z(),c=p(!1),e=p(!1),i=p(!1),_=p(null),v=p(null),d=p([]),n=D({code:""}),m=I(()=>{var f;return!c.value&&((f=x.props.auth.user)==null?void 0:f.two_factor_enabled)});U(m,()=>{m.value||(n.reset(),n.clearErrors())});const S=()=>{c.value=!0,R.post(route("two-factor.enable"),{},{preserveScroll:!0,onSuccess:()=>Promise.all([q(),E(),F()]),onFinish:()=>{c.value=!1,e.value=T.requiresConfirmation}})},q=()=>axios.get(route("two-factor.qr-code")).then(f=>{_.value=f.data.svg}),E=()=>axios.get(route("two-factor.secret-key")).then(f=>{v.value=f.data.secretKey}),F=()=>axios.get(route("two-factor.recovery-codes")).then(f=>{d.value=f.data}),A=()=>{n.post(route("two-factor.confirm"),{errorBag:"confirmTwoFactorAuthentication",preserveScroll:!0,preserveState:!0,onSuccess:()=>{e.value=!1,_.value=null,v.value=null}})},H=()=>{axios.post(route("two-factor.recovery-codes")).then(()=>F())},P=()=>{i.value=!0,R.delete(route("two-factor.disable"),{preserveScroll:!0,onSuccess:()=>{i.value=!1,e.value=!1}})};return(f,K)=>(t(),y(j,null,{title:o(()=>[r(" Two Factor Authentication ")]),description:o(()=>[r(" Add additional security to your account using two factor authentication. ")]),content:o(()=>[m.value&&!e.value?(t(),a("h3",ee," You have enabled two factor authentication. ")):m.value&&e.value?(t(),a("h3",te," Finish enabling two factor authentication. ")):(t(),a("h3",oe," You have not enabled two factor authentication. ")),ae,m.value?(t(),a("div",se,[_.value?(t(),a("div",re,[l("div",ne,[e.value?(t(),a("p",le," To finish enabling two factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP code. ")):(t(),a("p",ce," Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application or enter the setup key. "))]),l("div",{class:"mt-4 p-2 inline-block bg-white",innerHTML:_.value},null,8,ie),v.value?(t(),a("div",ue,[l("p",de,[r(" Setup Key: "),l("span",{innerHTML:v.value},null,8,me)])])):u("",!0),e.value?(t(),a("div",fe,[s(X,{for:"code",value:"Code"}),s(L,{id:"code",modelValue:$(n).code,"onUpdate:modelValue":K[0]||(K[0]=k=>$(n).code=k),type:"text",name:"code",class:"block mt-1 w-1/2",inputmode:"numeric",autofocus:"",autocomplete:"one-time-code",onKeyup:B(A,["enter"])},null,8,["modelValue"]),s(M,{message:$(n).errors.code,class:"mt-2"},null,8,["message"])])):u("",!0)])):u("",!0),d.value.length>0&&!e.value?(t(),a("div",pe,[ve,l("div",_e,[(t(!0),a(G,null,O(d.value,k=>(t(),a("div",{key:k},b(k),1))),128))])])):u("",!0)])):u("",!0),l("div",ye,[m.value?(t(),a("div",ge,[s(h,{onConfirmed:A},{default:o(()=>[e.value?(t(),y(V,{key:0,type:"button",class:w(["me-3",{"opacity-25":c.value}]),disabled:c.value},{default:o(()=>[r(" Confirm ")]),_:1},8,["class","disabled"])):u("",!0)]),_:1}),s(h,{onConfirmed:H},{default:o(()=>[d.value.length>0&&!e.value?(t(),y(C,{key:0,class:"me-3"},{default:o(()=>[r(" Regenerate Recovery Codes ")]),_:1})):u("",!0)]),_:1}),s(h,{onConfirmed:F},{default:o(()=>[d.value.length===0&&!e.value?(t(),y(C,{key:0,class:"me-3"},{default:o(()=>[r(" Show Recovery Codes ")]),_:1})):u("",!0)]),_:1}),s(h,{onConfirmed:P},{default:o(()=>[e.value?(t(),y(C,{key:0,class:w({"opacity-25":i.value}),disabled:i.value},{default:o(()=>[r(" Cancel ")]),_:1},8,["class","disabled"])):u("",!0)]),_:1}),s(h,{onConfirmed:P},{default:o(()=>[e.value?u("",!0):(t(),y(J,{key:0,class:w({"opacity-25":i.value}),disabled:i.value},{default:o(()=>[r(" Disable ")]),_:1},8,["class","disabled"]))]),_:1})])):(t(),a("div",he,[s(h,{onConfirmed:S},{default:o(()=>[s(V,{type:"button",class:w({"opacity-25":c.value}),disabled:c.value},{default:o(()=>[r(" Enable ")]),_:1},8,["class","disabled"])]),_:1})]))])]),_:1}))}};export{Ve as default};
