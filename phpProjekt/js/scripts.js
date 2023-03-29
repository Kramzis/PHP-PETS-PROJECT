/*!
* Start Bootstrap - Agency v7.0.11 (https://startbootstrap.com/theme/agency)
* Copyright 2013-2022 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-agency/blob/master/LICENSE)
*/

window.addEventListener('DOMContentLoaded', event => {

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        $('body').scrollspy({ target: '#mainNav', offset: 74 });
    };
    
    readAnimals();
});

async function readAnimals()
{
  const sectionGallery = document.querySelector('#zawartosc_galerii');
  const sectionModals = document.querySelector('#modals');
  const response = await fetch('assets/animals.json');
  const animals = await response.json();
  outputGallery = "";
  outputModals ="";
  
  for(i=0; i < animals.length; i+=3)
    {
        outputGallery += '\n<div class="row mt-3">';
        for(k=0; k<3 && i+k<animals.length;k++)
        {
            animal = animals[i+k];
            outputGallery += toAnimal(animal.name, animal.age, animal.description, animal.picture);
            outputModals += toAnimalModal(animal.name, animal.age, animal.description, animal.picture);
        }
        outputGallery += '\n</div>';
    }
    
  sectionGallery.innerHTML = outputGallery;
  sectionModals.innerHTML = outputModals;
  
}

function toAnimal(name, age, desc, picture)
{
    addon = "miesięcy";
    if(age == 1)
        addon = 'miesiąc';
    if(age < 5)
        addon = 'miesiące';
    
    output = '\n<div class="col-lg-4">\n<div class="card">\n<img  src="';
    output += picture;
    output += '" class="card-img-top" alt="animal_img"/>\n<div class="card-body">\n';
    output += '<h5 class="card-title">' + name;
    output += '</h5>\n<p class="card-sub-title">Wiek: ' + age + ' ' + addon + '</p>';
    output += '\n<p class="card-text"> ' + desc + '</p>\n';
    output += '<button type="button" class="btn btn-primary text-dark" data-toggle="modal" data-target="#animalModal_' + name + '">Podgląd</button>';
    output += '</div>\n</div>\n</div>\n';
    return output;
}

function toAnimalModal(name, age, desc, picture)
{
    addon = "miesięcy";
    if(age == 1)
        addon = 'miesiąc';
    if(age < 5)
        addon = 'miesiące';
    
    output = '<div class="modal fade" id="animalModal_' + name + '" tabindex="-1" role="dialog"';
    output +='aria-labelledby="exampleModalLabel" aria-hidden="true">';
    output +='<div class="modal-dialog modal-lg" role="document"> <div class="modal-content">';
    output +='<div class="modal-body"><div class="text-center">';
    output +='<img class="img-fluid" src="' + picture + '"><h2>' + name + '</h2>';
    output +='<p>Wiek: ' + age + ' ' + addon + '</p><p>' + desc;
    output +='</p><button type="button" class="btn btn-primary text-dark" data-dismiss="modal">';
    output +='Zamknij podgląd</button></div></div></div></div></div>';
    return output;
}

function saveMessageForm()
{
    formElement  = document.querySelector('#mess_form');
    if(!formElement.reportValidity()) // check if form is valid
        return;
    
    key = "msg_" + (localStorage.length+1);
    saveMessage(key);
    
    //zmień nazwę przycisku, żeby dać informację o pomyślnym wysłaniu
    buttonRespond('#msg_btn', 1000, "Wiadomość wysłana");
    
    clearForm();
    
    edytor(); 
    edytor(); // odnawia listę kluczy
}

function saveMessage(key)
{
    const name = document.querySelector('#msg_name').value;
    const mail = document.querySelector('#msg_mail').value;
    const message = document.querySelector('#msg_message').value;
    
    var messageForm = {
        'name': name,
        'mail': mail,
        'message': message
    };
    
    value = JSON.stringify(messageForm);
    
    localStorage.setItem(key, value);
}

function readMessage()
{
    const key = document.querySelector('#msg_key').value;
    const debug = document.querySelector('#msg_debug');
    
    json = localStorage.getItem(key);
    
    var form = JSON.parse(json);

    document.querySelector('#msg_name').value = form.name;
    document.querySelector('#msg_mail').value = form.mail;
    document.querySelector('#msg_message').value = form.message;
}

function editMessage()
{
    const key = document.querySelector('#msg_key').value;
    saveMessage(key);
    buttonRespond('#msg_debug', 1000, "Wiadomość zapisana");
}

function deleteMessage()
{
    const key = document.querySelector('#msg_key').value;
    
    localStorage.removeItem(key);
    buttonRespond('#msg_debug', 1000, "Wiadomość usunięta");
    
    
    clearForm();
    
    edytor();
    edytor();
}

function edytor()
{
    const section = document.querySelector('#edycja');
    html = '<select id="msg_key" name="key">';
    
    for(i=0; i<localStorage.length;i++)
    {
        key = localStorage.key(i);
        if(key.includes("msg"))
            html += '<option value="' + key + '">' + key + '</option>';
    }
    html += '</select>' +
        '<label class="form-label" for="msg_key">Klucz</label>' +
        '<p id="msg_debug"></p>' +
        '<div class="col">' +
        '    <button type="button" onclick="readMessage()" class="btn btn-secondary text-dark btn-block mb-4">Wyświetl</button>' +
        '    <button type="button" onclick="editMessage()" class="btn btn-secondary text-dark btn-block mb-4">Edytuj</button>' +
        '    <button type="button" onclick="deleteMessage()" class="btn btn-secondary text-dark btn-block mb-4">Usuń</button>' +
        '</div>';

    if(section.innerHTML == "")
        section.innerHTML = html;
    else
        section.innerHTML = "";
}


function clearForm()
{
    //wyczyść pola aby dać informację o wysłaniu wiadomości
    document.querySelector('#msg_name').value = "";
    document.querySelector('#msg_mail').value = "";
    document.querySelector('#msg_message').value = "";
    
}

function buttonRespond(id, time, message)
{
    const temp = document.querySelector(id).innerHTML;
    
     document.querySelector(id).innerHTML = message;
     
    setTimeout(() => {
        document.querySelector(id).innerHTML = temp;
    }, time);
}