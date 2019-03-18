// store items in object -> localstore
let data = (localStorage.getItem('packingList')) ? JSON.parse(localStorage.getItem('packingList')):{
    //two different arrays:
    todo: [],
    completed: []
};

// if json.parse => javascript object, without it's just a string
// check what is in localstorage:
//console.log(JSON.parse(localStorage.getItem('todoList')));

// Remove and complete icons in SVG format
let removeSVG = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 22 22" style="enable-background:new 0 0 22 22;" xml:space="preserve"><rect class="noFill" width="22" height="22"/><g><g><path class="fill" d="M16.1,3.6h-1.9V3.3c0-1.3-1-2.3-2.3-2.3h-1.7C8.9,1,7.8,2,7.8,3.3v0.2H5.9c-1.3,0-2.3,1-2.3,2.3v1.3c0,0.5,0.4,0.9,0.9,1v10.5c0,1.3,1,2.3,2.3,2.3h8.5c1.3,0,2.3-1,2.3-2.3V8.2c0.5-0.1,0.9-0.5,0.9-1V5.9C18.4,4.6,17.4,3.6,16.1,3.6z M9.1,3.3c0-0.6,0.5-1.1,1.1-1.1h1.7c0.6,0,1.1,0.5,1.1,1.1v0.2H9.1V3.3z M16.3,18.7c0,0.6-0.5,1.1-1.1,1.1H6.7c-0.6,0-1.1-0.5-1.1-1.1V8.2h10.6V18.7z M17.2,7H4.8V5.9c0-0.6,0.5-1.1,1.1-1.1h10.2c0.6,0,1.1,0.5,1.1,1.1V7z"/></g><g><g><path class="fill" d="M11,18c-0.4,0-0.6-0.3-0.6-0.6v-6.8c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6v6.8C11.6,17.7,11.4,18,11,18z"/></g><g><path class="fill" d="M8,18c-0.4,0-0.6-0.3-0.6-0.6v-6.8c0-0.4,0.3-0.6,0.6-0.6c0.4,0,0.6,0.3,0.6,0.6v6.8C8.7,17.7,8.4,18,8,18z"/></g><g><path class="fill" d="M14,18c-0.4,0-0.6-0.3-0.6-0.6v-6.8c0-0.4,0.3-0.6,0.6-0.6c0.4,0,0.6,0.3,0.6,0.6v6.8C14.6,17.7,14.3,18,14,18z"/></g></g></g></svg>';
let completeSVG = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 22 22" style="enable-background:new 0 0 22 22;" xml:space="preserve"><rect y="0" class="noFill" width="22" height="22"/><g><path class="fill" d="M9.7,14.4L9.7,14.4c-0.2,0-0.4-0.1-0.5-0.2l-2.7-2.7c-0.3-0.3-0.3-0.8,0-1.1s0.8-0.3,1.1,0l2.1,2.1l4.8-4.8c0.3-0.3,0.8-0.3,1.1,0s0.3,0.8,0,1.1l-5.3,5.3C10.1,14.3,9.9,14.4,9.7,14.4z"/></g></svg>';

renderToDoList();

// if user clicked on add button
document.getElementById('add').addEventListener('click', function () {
    let value = document.getElementById('item').value;
    // empty string is always false
    if (value) {
        addItem(value);
    }
});

document.getElementById('item').addEventListener('keydown', function (e) {
    let value = this.value; // current user input

    console.log(value);
    if (e.code === 'Enter' && value) {
        addItem(value);
    }
});

function addItem(value) {
    addItemToDOM(value);
    // reset the input field
    document.getElementById('item').value = '';

    data.todo.push(value); // push the value in object
    dataObjectUpdated();
}

// display the items in localstorage directly in todolist
function renderToDoList() {
    if (!data.todo.length && !data.completed.length) return; // if its empty, then return

    for (let i = 0; i < data.todo.length; i++) {
        let value = data.todo[i];
        addItemToDOM(value);
    }

    for (let j = 0; j < data.completed.length; j++) {
        let value= data.completed[j];
        addItemToDOM(value, true);
    }
}

function dataObjectUpdated() {
    console.log(JSON.stringify(data));
    localStorage.setItem('packingList', JSON.stringify(data));
}

function addItemToDOM(text, completed) {
    let list = (completed) ? document.getElementById('completed'):document.getElementById('todo');

    let item = document.createElement('li');
    item.innerText = text;

    let buttons = document.createElement('div');
    buttons.classList.add('buttons');

    let remove = document.createElement('button');
    remove.classList.add('remove');
    remove.innerHTML = removeSVG;

    // if user clicked the remove button -> remove item
    remove.addEventListener('click', removeItem);

    let complete = document.createElement('button');
    complete.classList.add('complete');
    complete.innerHTML = completeSVG;

    // if user clicked complete button -> completing the item
    complete.addEventListener('click', completeItem);

    buttons.appendChild(remove);
    buttons.appendChild(complete);
    item.appendChild(buttons);

    // item add at first position
    list.insertBefore(item, list.childNodes[0]);
}

function removeItem() {
    // this -> button, parentnode to grab 'li'
    let item = this.parentNode.parentNode;
    let parent = item.parentNode; // 'ul' => parent id, id=completed, id=todo
    let id = parent.id;
    let value = item.innerText; // gives the user content of input

    let index = findIndex(value);

    if (id === 'todo') {
        data.todo.splice(index, 1); // remove one based on that index
    }
    else {
        data.completed.splice(index, 1); // remove one based on that index
    }

    dataObjectUpdated();
    parent.removeChild(item);
}

function findIndex(value) {
    let index = -1;

    for (let i = 0; i < data.todo.length; i++) {
        let elem = data.todo[i];

        if (elem === value.toLowerCase()) {
            index = i;
        }
    }
    return index;
}

// function for the complete button => toggle button
function completeItem() {
    let item = this.parentNode.parentNode;
    let parent = item.parentNode;
    let id = parent.id; // id which is set above in 'ul'
    let value = item.innerText; // gives the user content of input

    let index = findIndex(value);

    if (id === 'todo') {
        data.todo.splice(index, 1); // remove one based on that index
        data.completed.push(value);
    }
    else {
        data.completed.splice(index, 1); // remove one based on that index
        data.todo.push(value);
    }

    dataObjectUpdated();

    // check if item should be added to completed or re-added to the todo list
    let target = (id === 'todo') ? document.getElementById('completed'):document.getElementById('todo');

    parent.removeChild(item);
    target.insertBefore(item, target.childNodes[0]); // if item is completed, switch to the end of the list
}

/*
 * Multi Media Project 1 at the University of Applied Science Salzburg (MultiMedia Technology) by Tra Nguyen.
 */