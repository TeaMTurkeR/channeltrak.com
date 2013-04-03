function submitForm(element){
    element.type = 'hidden';

    while(element.className != 'form')
        element = element.parentNode;
        
    var form = document.getElementById('update');
    
    var inputs = element.getElementsByTagName('input');
    while(inputs.length > 0) 
        form.appendChild(inputs[0]);
        
    var selects = element.getElementsByTagName('select');
    while(selects.length > 0) 
        form.appendChild(selects[0]);
        
    var textareas = element.getElementsByTagName('textarea');
    while(textareas.length > 0) 
        form.appendChild(textareas[0]);
    
    form.submit();
};