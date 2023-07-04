window.toastLiveExample = document.getElementById('liveToast');
window.serializeArrayIncludingDisabledFields = function(form) {
    var disabled = form.find(':input:disabled').removeAttr('disabled');
    // serialize the form
    var serialized = form.serializeArray();
    // re-disabled the set of inputs that you previously enabled
    disabled.attr('disabled','disabled');
    return serialized.reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});
}
window.removeAccents = function(str) {
    var AccentsMap = [
        "aàảãáạăằẳẵắặâầẩẫấậ",
        "AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
        "dđ", "DĐ",
        "eèẻẽéẹêềểễếệ",
        "EÈẺẼÉẸÊỀỂỄẾỆ",
        "iìỉĩíị",
        "IÌỈĨÍỊ",
        "oòỏõóọôồổỗốộơờởỡớợ",
        "OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
        "uùủũúụưừửữứự",
        "UÙỦŨÚỤƯỪỬỮỨỰ",
        "yỳỷỹýỵ",
        "YỲỶỸÝỴ"    
    ];
    for (var i=0; i<AccentsMap.length; i++) {
        var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
        var char = AccentsMap[i][0];
        str = str.replace(re, char);
    }
    str = str.replace(/\s/g,'');
    str = str.replace(/-/g,'');
    return str;
}
window.showToast = function(){
    const toastLiveExample = document.getElementById('liveToast'); 
    const toast = new coreui.Toast(toastLiveExample);
    toast.show()
}
window.compare = function (a, b) {
    return JSON.stringify(a) === JSON.stringify(b);
}
// Example starter JavaScript for disabling form submissions if there are invalid fields
window.validateEmail = (email) => {
    return email.match(
      /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
  };