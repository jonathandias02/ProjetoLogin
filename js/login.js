/* global login */

function ativarcampo(div){
	div.style.backgroundColor="#D3D3D3";
	//div.style.border="thin dotted #000000";
        div.style.width="450px";
        div.style.height="35px";
	var id_span=div.id+"_span";
	var obj_span=document.getElementById(id_span);
	obj_span.style.display="block";
	var id_field=div.id+"_field";
	var obj_field=document.getElementById(id_field);
	obj_field.style.backgroundColor="#FFFFCC";
}
 
function liberarcampo(div){
	div.style.backgroundColor="";
	div.style.border="";
	var id_span=div.id+"_span";
	var obj_span=document.getElementById(id_span);
	obj_span.style.display="none";
	var id_field=div.id+"_field";
	var obj_field=document.getElementById(id_field);
	obj_field.style.backgroundColor="#C0C0C0";
}

function ativarsub(div){
	var id_span=div.id+"_span";
	var obj_span=document.getElementById(id_span);
	obj_span.style.display="block";
	var id_field=div.id+"_field";
	var obj_field=document.getElementById(id_field);
	obj_field.style.backgroundColor="#FFFFCC";
}

function liberarsub(div){
	var id_span=div.id+"_span";
	var obj_span=document.getElementById(id_span);
	obj_span.style.display="none";
	var id_field=div.id+"_field";
	var obj_field=document.getElementById(id_field);
	obj_field.style.backgroundColor="#C0C0C0";
}

function valida() {

    if (login['usu'].value === "") {
        alert("O Campo USUARIO é Obrigatorio!");
        login['usu'].focus();
        return false;
    }

    if (login['senha'].value === "") {
        alert("O Campo SENHA é Obrigatorio!");
        login['senha'].focus();
        return false;
    }
}