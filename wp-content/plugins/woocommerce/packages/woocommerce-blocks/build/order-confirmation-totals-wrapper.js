(()=>{"use strict";var e,o={4396:(e,o,t)=>{t.r(o);var r=t(9307);const n=window.wp.blocks,l=window.wp.blockEditor;var a=t(1984),i=t(444);const c=(0,r.createElement)(i.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",fill:"none"},(0,r.createElement)("path",{stroke:"currentColor",strokeWidth:"1.5",fill:"none",d:"M6 3.75h12c.69 0 1.25.56 1.25 1.25v14c0 .69-.56 1.25-1.25 1.25H6c-.69 0-1.25-.56-1.25-1.25V5c0-.69.56-1.25 1.25-1.25z"}),(0,r.createElement)("path",{fill:"currentColor",fillRule:"evenodd",d:"M6.9 7.5A1.1 1.1 0 018 6.4h8a1.1 1.1 0 011.1 1.1v2a1.1 1.1 0 01-1.1 1.1H8a1.1 1.1 0 01-1.1-1.1v-2zm1.2.1v1.8h7.8V7.6H8.1z",clipRule:"evenodd"}),(0,r.createElement)("path",{fill:"currentColor",d:"M8.5 12h1v1h-1v-1zM8.5 14h1v1h-1v-1zM8.5 16h1v1h-1v-1zM11.5 12h1v1h-1v-1zM11.5 14h1v1h-1v-1zM11.5 16h1v1h-1v-1zM14.5 12h1v1h-1v-1zM14.5 14h1v1h-1v-1zM14.5 16h1v1h-1v-1z"})),s=JSON.parse('{"name":"woocommerce/order-confirmation-totals-wrapper","version":"1.0.0","title":"Order Totals Section","description":"Display the order details section.","category":"woocommerce","keywords":["WooCommerce"],"attributes":{"heading":{"type":"string"}},"supports":{"multiple":false,"align":["wide","full"],"html":false,"spacing":{"padding":true,"margin":true,"__experimentalDefaultControls":{"margin":false,"padding":false}}},"textdomain":"woocommerce","apiVersion":2,"$schema":"https://schemas.wp.org/trunk/block.json"}'),p={heading:{type:"string",default:(0,t(5736).__)("Order details","woocommerce")}};(0,n.registerBlockType)(s,{icon:{src:(0,r.createElement)(a.Z,{icon:c,className:"wc-block-editor-components-block-icon"})},edit:({attributes:e,setAttributes:o})=>{const t=(0,l.useBlockProps)();return(0,r.createElement)("div",{...t},(0,r.createElement)(l.InnerBlocks,{allowedBlocks:["core/heading"],template:[["core/heading",{level:3,style:{typography:{fontSize:"24px"}},content:e.heading||"",onChangeContent:e=>o({heading:e})}],["woocommerce/order-confirmation-totals",{lock:{remove:!0}}]]}))},save:()=>(0,r.createElement)(l.InnerBlocks.Content,null),attributes:p})},9307:e=>{e.exports=window.wp.element},5736:e=>{e.exports=window.wp.i18n},444:e=>{e.exports=window.wp.primitives}},t={};function r(e){var n=t[e];if(void 0!==n)return n.exports;var l=t[e]={exports:{}};return o[e].call(l.exports,l,l.exports,r),l.exports}r.m=o,e=[],r.O=(o,t,n,l)=>{if(!t){var a=1/0;for(p=0;p<e.length;p++){for(var[t,n,l]=e[p],i=!0,c=0;c<t.length;c++)(!1&l||a>=l)&&Object.keys(r.O).every((e=>r.O[e](t[c])))?t.splice(c--,1):(i=!1,l<a&&(a=l));if(i){e.splice(p--,1);var s=n();void 0!==s&&(o=s)}}return o}l=l||0;for(var p=e.length;p>0&&e[p-1][2]>l;p--)e[p]=e[p-1];e[p]=[t,n,l]},r.n=e=>{var o=e&&e.__esModule?()=>e.default:()=>e;return r.d(o,{a:o}),o},r.d=(e,o)=>{for(var t in o)r.o(o,t)&&!r.o(e,t)&&Object.defineProperty(e,t,{enumerable:!0,get:o[t]})},r.o=(e,o)=>Object.prototype.hasOwnProperty.call(e,o),r.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.j=741,(()=>{var e={741:0};r.O.j=o=>0===e[o];var o=(o,t)=>{var n,l,[a,i,c]=t,s=0;if(a.some((o=>0!==e[o]))){for(n in i)r.o(i,n)&&(r.m[n]=i[n]);if(c)var p=c(r)}for(o&&o(t);s<a.length;s++)l=a[s],r.o(e,l)&&e[l]&&e[l][0](),e[l]=0;return r.O(p)},t=self.webpackChunkwebpackWcBlocksJsonp=self.webpackChunkwebpackWcBlocksJsonp||[];t.forEach(o.bind(null,0)),t.push=o.bind(null,t.push.bind(t))})();var n=r.O(void 0,[2869],(()=>r(4396)));n=r.O(n),((this.wc=this.wc||{}).blocks=this.wc.blocks||{})["order-confirmation-totals-wrapper"]=n})();