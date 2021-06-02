const findBtn = document.getElementById('find');
const breedImage = document.getElementById('image');
const screenLock = document.querySelector('.screenlock');
const log = document.querySelector('.log');

async function validateDogbreed(breed) {
    res = await fetch(`https://dog.ceo/api/breed/${breed}/list`);
    return await res ? res.json() : false;
}

async function getImage(breed) {
    res = await fetch(`https://dog.ceo/api/breed/${breed}/images`);
    let image = await res.json();
    return image.message[0];
}

async function findDogapi() {
    const breed = document.querySelector('.input').value;
    const title = document.querySelector('.title');
    const listContainer = document.querySelector('.list');
    if (breed != '') {
        let dog = await validateDogbreed(breed);
        if (dog.message != 'Breed not found (master breed does not exist)') {
            breedImage.src = await getImage(breed);
            let list = document.createElement('ol');
            screenLock.classList.remove('screenlock');
            listContainer.innerHTML = '';
            [...dog.message].map(subBreed => {
                let listElement = document.createElement('li');
                listElement.textContent = subBreed;
                list.appendChild(listElement);
            });

            listContainer.appendChild(list);
            title.innerText = breed;
            log.innerText = '';
        } else {
            screenLock.classList.add('screenlock');
            log.innerText = (dog.message);
        }
    } else {
        alert('Blank entry detected, type the word to search');
    }

}

findBtn.addEventListener('click', function () {
    findDogapi();
});