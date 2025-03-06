addEventsToInputs();

function addEventsToInputs() {
    var taskInputs = document.getElementsByClassName("toDo__input");
    for (var i = 0; i < taskInputs.length; i++) {
        taskInputs[i].onkeyup = function (event) {
            newTask(event);  // Call correct function
        }
    }
}

function newTask(event) {
    if (event.key === "Enter") {
        var tasks = event.target.parentElement.parentElement.childeren[1].childeren[0];
        // Create a new task
        var newTask = document.createElement("li");
        newTask.innerText = event.target.value;
        newTask.classList = "toDo__task";
        newTask.dataset.running = "false";  // Ensure dataset is set correctly
        tasks.appendChild(newTask);  // Append to the correct list
        
        // Clear the input
        event.target.value = "";
        
        newTask.onclick = function (event) {
            setOrClearTimer(event);
        }
    }
}

// Function to toggle task state between active and done
function setOrClearTimer(event) {
    console.log("ik ben geklikt");
    if (event.target.dataset.running === "false") {
        event.target.classList.toggle("toDo__task--done");
        event.target.dataset.running = "true";  // Ensure 'running' is set properly
        event.target.style.background = "blue";

        // Create a unique timeout for each task
        event.target.timeoutId = setTimeout(function () {
            toDone(event);
        }, 3000);
    } else if (event.target.dataset.running === "true") {
        event.target.classList.toggle("toDo__task--done");
        clearTimeout(event.target.timeoutId);  // Clear the correct timeout
        event.target.dataset.running = "false";
    }
}

function toDone(event) {
    var doneTask = document.createElement("li");
    doneTask.classList = "toDo__task toDo__task--done";
    doneTask.innerText = event.target.innerText;
    
    // Append to the 'done' section
    document.getElementById("js--done").appendChild(doneTask);
    
    // Remove the original task
    event.target.remove();
}

var fab = document.getElementById("js--fab");
fab.onclick = function () {
    makeNewCard();
}

function makeNewCard() {
    /* make the card */
    var newTodo = document.createElement("article");
    newTodo.classList = "toDo";

    /* make the header */
    var newHeader = document.createElement("header");
    newHeader.classList = "toDo__header";

    /* make the heading */
    var newHeading = document.createElement("h2");
    newHeading.classList = "toDo__heading";
    newHeading.innerText = "test";

    /* make the section */
    var newSection = document.createElement("section");
    newSection.classList = "toDo__body";

    /* make the UL */
    var newList = document.createElement("ul");
    newList.classList = "toDo__tasks";  // Removed ID, using class instead for multiple lists

    /* make the footer */
    var newFooter = document.createElement("footer");
    newFooter.classList = "toDo__footer";

    /* make the input */
    var newInput = document.createElement("input");
    newInput.classList = "toDo__input";
    newInput.type = "text";
    newInput.placeholder = "Enter a task...";
    newInput.id = "js--input";  // This ID can stay, but be careful if you create multiple cards

    newFooter.appendChild(newInput);
    newSection.appendChild(newList);
    newHeader.appendChild(newHeading);
    newTodo.appendChild(newHeader);
    newTodo.appendChild(newSection);
    newTodo.appendChild(newFooter);

    document.getElementsByTagName("body")[0].appendChild(newTodo);

    // Re-bind input event for the newly created input field
    addEventsToInputs();
}
