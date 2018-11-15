const userView = (user) => {
  return `
    <h1>${ user.login }</h1>
    <img class="avatar" src="${ user.avatar_url }">
  `;
}

const reposView = (repos) => {
  let html = "";
  html += "<ul>";
  for (repo of repos) {
    html += `<li><a href="${ repo.html_url }">${ repo.full_name }</a></li>`;
  }
  html += "</ul>";
  return html;
}

//
// VERSION ALTERNATIVE
//

// const userView = (user) => `
//   <h1>${ user.login }</h1>
//   <img class="avatar" src="${ user.avatar_url }">
// `;

// const reposView = (repos) =>
//   `<ul>${ repos.map(repoView).join('') }</ul>`;

// const repoView = (repo) =>
//   `<li><a href="${ repo.html_url }">${ repo.full_name }</a></li>`;

const search = async (username) => {
  const url = `https://api.github.com/users/${ username }`;

  // 'await' met la fonction 'search' en pause pendant que le promesse
  // est résolue. Ensuite, la valeur promise est assignée à la variable
  // à gauche puis l'exécution de 'search' se poursuit.
  const resp = await fetch(url);
  const user = await resp.json();

  const bioElem = document.querySelector('section#bio');
  bioElem.innerHTML = userView(user)
  
  const respRepo = await fetch(user.repos_url);
  const repos = await respRepo.json();

  const reposElem = document.querySelector('section#repos');
  reposElem.innerHTML = reposView(repos)
};

const doSearch = (event) => {
  // event.preventDefault() empêche le fureteur d'exécuter son
  // comportement par défaut. Dans le cas de la soumission d'un
  // formulaire, le comportement par défaut du fureteur est de
  // faire une requête HTTP. Nous voulons rester sur la même page
  // alors on empêche ce comportement.
  event.preventDefault();
  const inputEl = document.querySelector('input');
  const username = inputEl.value;
  if (username === "") {
    // une meilleure option serait de changer la classe de 'inputEl'
    // en modifiant sa propriétée 'inputEl.className'.
    inputEl.style.border = "3px solid red";
  } else {
    search(username);
  }
};

const main = () => {
  const form = document.querySelector('form#search');
  form.addEventListener('submit', doSearch);
}

// L'événement 'DOMContentLoaded' est lancé lorsque
// la page HTML est entièrement chargée et prête à être
// lue et modifiée.
document.addEventListener("DOMContentLoaded", main);
