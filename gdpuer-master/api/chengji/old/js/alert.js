

var strHtml;
function ShowMessage(m,color){
        messageBox.style.filter="alpha(opacity=100)";
        messageBox.style.visibility="visible";

        message.style.visibility="visible";
        //¼������
        strHtml="<div style='background:"+color+"; padding:3px 10px; height:45px; text-align:center;height:30px;line-height:30px;color:#FFFFFF; font-size:30px;'>"+m+"</div>";
        message.innerHTML=strHtml; 
        setTimeout("Close()",3500);//���ùرյ�ʱ��
}
var i=100;
function Close(){
    if(i<=0){
        message.style.visibility="hidden";
        strHtml="";
        
        //��ԭ���ԺͲ���
        i=100;
        messageBox.style.filter="alpha(opacity=100)";
        messageBox.style.visibility="visible";
        clearTimeout();
        return;
    }
    else{
        i--;
        messageBox.style.filter="alpha(opacity="+i+")";//ˢ�¿ɼ��ȣ��ɼ���Խ��Խ��
        setTimeout("Close()",10);//�ݹ�
    }
    return;
}

