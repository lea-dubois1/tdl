async function getAllTasks() {

    // Fetch all tasks from the database
    const response = await fetch('back.php?recup=1');
    const jsonTaches = await response.json();

    return jsonTaches;
    
}

async function addTask(formData) {

    // Add the task to the database
    const response = await fetch("back.php?add=1", {method: "POST", body: formData,});
    const result = await response.text();

    return result;

}

async function displayTask() {

    jsonTaches = await getAllTasks();          // Get the tasks from the database

    for (let i = 0; i < jsonTaches.length; i++) {
        const element = jsonTaches[i];    


        //_________________________ TO DO _________________________//

        /*********** Create a div to put each task ************/
        const oneTaskDiv = document.createElement("div");
        oneTaskDiv.setAttribute("class", "uneTacheLigne");

        const checkboxNom = 'checkbox' + i
        
        if(element['isChecked'] == 0) {

            toDoTasks.appendChild(oneTaskDiv);

            /**************** Create the checkbox *****************/
            const checkboxVide = document.createElement("input");
            checkboxVide.setAttribute("type", "checkbox");
            checkboxVide.setAttribute("name", element['id']);
            checkboxVide.setAttribute("class", 'checkboxVide');
            checkboxVide.setAttribute("id", checkboxNom);
            //checkboxVide.setAttribute("class", 'checkbox');
            oneTaskDiv.appendChild(checkboxVide);

            /****************** Create the title ******************/
            const titreTacheListe = document.createElement("p");
            titreTacheListe.innerHTML = element['content'];
            oneTaskDiv.appendChild(titreTacheListe);

            /************* Create the completion date *************/
            const dateTacheListe = document.createElement("p");
            dateTacheListe.innerHTML = "Creation date :" + element['creationDate'];
            oneTaskDiv.appendChild(dateTacheListe);
        }



        //_______________________ COMPLETED _______________________//

        /*********** Create a div to put each task ************/
        const oneTaskDivCompl = document.createElement("div");
        oneTaskDivCompl.setAttribute("class", "uneTacheLigne");

        if(element['isChecked'] == 1) {

            completedTasks.appendChild(oneTaskDivCompl);

            /**************** Create the checkbox *****************/
            const checkboxChecked = document.createElement("input");
            checkboxChecked.setAttribute("type", "checkbox");
            checkboxChecked.setAttribute("name", element['id']);
            checkboxChecked.setAttribute("class", 'checkboxChecked');
            checkboxChecked.setAttribute("id", checkboxNom);
            checkboxChecked.checked = true;
            //checkboxVide.setAttribute("class", 'checkbox');
            oneTaskDivCompl.appendChild(checkboxChecked);

            /************* Create the creation date *************/
            const CreaDateTacheListe = document.createElement("p");
            CreaDateTacheListe.innerHTML = "Creation date :" + element['creationDate'];
            oneTaskDivCompl.appendChild(CreaDateTacheListe);

            /************* Create the completion date *************/
            const compDateTacheListe = document.createElement("p");
            compDateTacheListe.innerHTML = "Completion date :" + element['completionDate'];
            oneTaskDivCompl.appendChild(compDateTacheListe);
        }

        /***************** Create suppr button ****************/
        const supprButton = document.createElement("button");
        supprButton.setAttribute("name", element['id']);
        supprButton.setAttribute("class", "suppr");
        supprButton.innerText = "Supprimer";
        oneTaskDiv.appendChild(supprButton);
    }
}

async function checkTask() {

    await displayTask();

    var elementsVides = document.querySelectorAll('.checkboxVide');
    var i;

    const form = document.getElementById('toDoTasks')

    for(i = 0; i < elementsVides.length; i++) { 

        console.log(elementsVides[i]);

        let jsonElement = JSON.stringify({'idTask': elementsVides[i].name});
        console.log(jsonElement)

        elementsVides[i].addEventListener('click', (e) => {

            whenClickToDo(jsonElement);


        })

        // let promise = await fetch('back.php?check=1', {method: "POST", body: idElement});
        // let response = await promise.text();
        
    }
}

function whenClickToDo(jsonElement) {

    fetch('back.php?check=1', {
        method: "POST", 
        body: jsonElement
    })
    .then((response) => {
        console.log(response.text());
    })

}




const toDoTasks = document.getElementById('toDoTasks');
const completedTasks = document.getElementById('completedTasks');
const formAddTask = document.getElementById('formAddTask');
const checkboxChecked = document.getElementsByClassName('checkboxChecked');
const checkboxVide = document.getElementsByClassName('checkboxVide');

checkTask();

formAddTask.addEventListener('submit', (e) => {

    e.preventDefault();
    toDoTasks.innerHTML = "";

    const formData = new FormData(formAddTask);
    formData.forEach((value, key) => {
        console.log(key + ':' + value);
    });

    console.log(formData)

    addTask(formData);

    displayTask()

});
    
(async () => {
    await displayTask();

    const elementsVides = document.querySelectorAll('.checkboxVide');
    const form = document.getElementById('toDoTasks')
    const formDataCheck = new FormData(toDoTasks);

    formDataCheck.forEach((value, key) => {
        console.log(key + ':' + value);
    });
    

    for(let i = 0; i < elementsVides.length; i++) {

        elementsVides[i].addEventListener('click', (e) => {

            fetch('back.php?check=1', {
                method: "POST", 
                body: formDataCheck
            })
            .then((response) => {
                console.log(response.text());
            })
        })

        // let promise = await fetch('back/taskCheckBack.php', {method: "POST", body: idElement});
        // let response = await promise.text();
    
    }
})
