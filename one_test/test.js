'use strict'

const consoleLog = document.getElementById('console_two');
const consoleBase = document.getElementById('console_one');

const checkSpecialsChars = (find) => {
    let specialChars = "<>@!#$%^&*()_+[]{}?:;";
    return specialChars.search(find) == -1 ? true : false;
}

const detectIndex = function(str) {
    return [...str].reduce((inObj, iTem, i) => {
        let find = iTem.toString();
        checkSpecialsChars(find) ? inObj.normal.push(i) : inObj.specials.push(i);
        return inObj;
    }, { normal: [], specials: [] })
};


function revertCustom(Array) {
    let storeObjs = detectIndex(Array);
    return [...Array].reduce((rOrder, a) => {
        let find = a.toString();
        checkSpecialsChars(find) ? rOrder[storeObjs.normal.pop()] = a : rOrder[storeObjs.specials.shift()] = a;
        return rOrder;
    }, []).join(',');
}


(function () {
    const Objects = ['n', 2, '&', 'a', 'l', 9, '$', 'q', 47, 'i', 'a', 'j', 'b', 'z', '%', 8];
    consoleBase.innerText = JSON.stringify(Objects);
    consoleLog.innerText = JSON.stringify(revertCustom(Objects).split(','));
})();