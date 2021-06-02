const consoleLog = document.getElementById('console_two');
const consoleBase = document.getElementById('console_one');

function getPosition(keepPositions, item, type) {
    const Result = keepPositions.filter(r => r.word == item);
    const set = Result.length > 0 ? Result[0] : 0;
    if (set.word !== undefined && set.position !== undefined) {
        return type == true ? set.position : set.word;
    }
}

function reverseObjects(Objects, keepPositions) {
    let newObjects = [];
    Objects = Objects.reverse();
    [...Objects].map(async (r, i) => {
        let u = getPosition(keepPositions, r, false);
        let nIndex = getPosition(keepPositions, r, true);
        r == u && r !== undefined ? newObjects[nIndex - 1] = u.toString() : newObjects[i] = r.toString();
    });
    return newObjects.filter(x => x);
}


(function () {
    const keep = [{
            "word": "%",
            "position": 14
        },
        {
            "word": "$",
            "position": 6
        },
        {
            "word": "&",
            "position": 2
        }
    ];
    const Objects = ['n', 2, '&', 'a', 'l', 9, '$', 'q', 47, 'i', 'a', 'j', 'b', 'z', '%', 8];
    const rs = reverseObjects(Objects, keep);
    consoleBase.innerText = JSON.stringify(Objects);
    consoleLog.innerText = JSON.stringify(rs);
})();