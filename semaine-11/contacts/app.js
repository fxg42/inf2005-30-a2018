const onClickButton = (event) => {
  console.log('click!');
};

const main = async () => {
  const button = document.querySelector('button');
  button.addEventListener('click', onClickButton);

  const resp = await fetch('contacts.php');
  const contacts = await resp.json();
  
  const titre = document.querySelector('#titre');
  titre.innerHTML = contacts[0].nom;
}

document.addEventListener("DOMContentLoaded", main);
