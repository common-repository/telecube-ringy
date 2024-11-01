var src_lib = "++ringy#telecube#eu+tcc_widget#js";
var lib = document.createElement("script"); var cf = false;
lib.src=src_lib.replace(/\,/g,":").replace(/\+/g,"/").replace(/\#/g,".")+"?instance="+tcc_uuid;
lib.language="javascript";
lib.type="text/javascript";
document.getElementsByTagName("head").item(0).appendChild(lib);
