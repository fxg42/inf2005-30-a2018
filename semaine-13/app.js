// La classe Observable regroupe les fonctionnalités de publisher/subscriber.
// Elle maintient des listes de fonctions à appeler lorsque certains événements
// surviennent.

class Observable {
  constructor() {
    this.listeners = { };
  }

  // La fonction `fn` est ajoutée à la liste de "listeners" associée au nom d'un
  // événement en particulier.

  addEventListener(eventName, fn) {
    this.listeners[eventName] = this.listeners[eventName] || [ ];
    this.listeners[eventName].push(fn);
  }

  // Parcours la liste de fonctions "listeners" associée à un événement donnée
  // et appelle ces fonctions.

  notify(eventName) {
    (this.listeners[eventName] || [ ]).forEach(fn => fn.call());
  }
}

// La classe ApplicationModel regroupe toutes les données brutes de
// l'application: la liste d'utilisateurs et l'utilisateur actuellement
// sélectionné.

class ApplicationModel extends Observable {
  constructor() {
    super();
    this.userCollection = [ ];
    this.selectedUser = null;
  }

  // Permet d'ajouter un utilisateur à la liste d'utilisateur. Lors de l'ajout
  // d'un nouvel utilisateur, la fonction l'ajoute à la liste puis notifie
  // les "listeners" que la liste a changée. Elle change aussi l'utilisateur
  // actuellement sélectionné puis notifie les vues de cet autre changement

  addUser(user) {
    this.userCollection.push(user);
    this.notify('change:users');

    this.selectedUser = user;
    this.notify('change:selectedUser');
  }

  // Permet de changer l'utilisateur actuellement sélectionné. Le code de login
  // est passé en paramètre. La fonction trouve l'utilisateur correspondant dans
  // sa liste d'utilisateurs, change la valeur de l'utilisatieur sélectionné
  // puis notifie les vues de ce changement.

  setSelectedUser(login) {
    this.selectedUser = this.userCollection.find(u => u.login === login);
    this.notify('change:selectedUser');
  }
}

// La classe UserCollectionComponent représente la vue et le contrôleur associés
// à la liste d'utilisateurs affiché du côté gauche de l'écran.

class UserCollectionComponent {

  // Le constructeur reçoit l'élément HTML dans lequel la vue doit être affichée
  // et une référence vers le modèle de l'application.

  constructor(el, model) {
    this.el = el;
    this.model = model;

    // La composante s'abonne à l'événement du modèle indiquant que la liste des
    // utilisateurs a changé. Elle réagit en appelant la fonction `render`.

    this.model.addEventListener('change:users', () => {
      this.render();
    });

    // La composante s'abonne aussi à l'événement du modèle qui indique que
    // l'utilisateur sélectionné a changé. Elle réagit en appelant la fonction
    // `highlight`.

    this.model.addEventListener('change:selectedUser', () => {
      this.highlight();
    });

    // La composante s'abonne aussi à l'événement utilisateur provenant de la
    // vue indiquant que l'utilisateur a cliqué sur quelque chose. La composante
    // réagit en appelant la fonction `onSectionClick`.

    this.el.addEventListener('click', (evt) => {
      this.onSectionClick(evt);
    });
  }

  // Appelée lors d'un clic sur un des utilisateur de la liste, cette fonction
  // "contrôleur" détermine d'abord l'élément HTML qui a été cliqué puis en
  // extrait l'identifiant de l'utilisateur. Elle modifie ensuite la modèle en
  // appelant sa méthode `setSelectedUser`.

  onSectionClick(evt) {
    const login = evt.target.closest('li').attributes['data-userlogin'].value;
    this.model.setSelectedUser(login);
  }

  // Appelée lorsque l'utilisateur sélectionnée est modifié, cette fonction
  // retire la classe `selected` de tous les items de la liste puis l'ajoute
  // à l'item contenant l'utilisateur sélectionné.

  highlight() {
    const candidate = this.model.selectedUser.login;
    this.el.querySelectorAll(`li`).forEach(el => el.classList.remove('selected'));
    this.el.querySelector(`li[data-userlogin=${candidate}]`).classList.add('selected');
  }

  // Appelée lorsque la liste d'utilisateurs est modifiée, cette fonction
  // construit le HTML correspondant puis l'installe dans l'élément de la
  // composante.

  render() {
    this.el.innerHTML = `
      <ul>
        ${ this.model.userCollection.map(this.renderUser).join('') }
      </ul>
    `;
  }

  renderUser(user) {
    return `
      <li data-userlogin="${ user.login }">
        <h1>${ user.login }</h1>
        <img src="${ user.avatar_url }">
        <p>${ user.bio || user.name || user.company || user.location || user.created_at }</p>
      </li>
    `;
  }
}

// La classe UserDetailsComponent représente la vue et le contrôleur associés
// aux détails de l'utilisateur actuellement sélectionné. 

class UserDetailsComponent {
  constructor(el, model) {
    this.el = el;
    this.model = model;

    // la composante s'abonne à l'événement du modèle indiquant que
    // l'utilisateur sélectionné a été modifié. Elle réagit en appelant la
    // fonction `render`.

    this.model.addEventListener('change:selectedUser', () => {
      this.render();
    });
  }

  // Appelée lorsque l'utilisateur a été modifiée, cette fonction construit le
  // HTML correspondant aux détails de cet utilisateur puis l'install dans
  // l'élément de la composante.

  render() {
    const user = this.model.selectedUser;
    this.el.innerHTML = `
      <h1>${user.name || user.login}</h1>
      ${ user.location ? `<div class='location'>${ user.location }</div>` : ""}
      ${ user.company ? `<div class='company'>${ user.company }</div>` : ""}
      <div class='joinedon'>Joined on ${ user.created_at.slice(0,10) }</div>
    `;
  }
}

// La classe SearchComponent représente la vue et le contrôleur associés à la
// barre de recherche en haut de la page.

class SearchComponent {
  constructor(el, model) {
    this.el = el;
    this.model = model;

    // La composante s'abonne à l'événement 'submit' provenant du formulaire
    // contenu dans la page. Elle réagit en appelant la fonction `onSubmit`.

    this.el.querySelector('form').addEventListener('submit', (evt) => {
      this.onSubmit(evt);
    });
  }

  // Appelée lors d'une soumission du formulaire de recherche, cette fonction
  // "contrôleur" commence en annulant le comportement par défaut du fureteur
  // (qui ferait un requête au serveur). Elle lit ensuite la valeur inscrite
  // dans la boite de recherche puis s'en sert pour obtenir des données
  // provenant de Github. Lorsque les données sont reçues, la fonction modifie
  // le modèle en ajoutant l'utilisateur reçu à la liste d'utilisateurs.

  async onSubmit(evt) {
    evt.preventDefault();

    const login = this.el.querySelector('input').value;
    const url = `https://api.github.com/users/${ login }`;
    const resp = await fetch(url);
    const user = await resp.json();
    
    this.model.addUser(user);

    this.el.querySelector('input').value = '';
  }
}

// La fonction `main` est appelée au chargement de l'application. Elle construit
// une instance du modèle ainsi qu'une instance de chaque composante. Ensuite,
// elle obtient un premier utilisateur et l'ajoute au modèle.

const main = async () => {
  const model = new ApplicationModel();
  const userCollection = new UserCollectionComponent(document.querySelector('#userCollection'), model);
  const userDetails = new UserDetailsComponent(document.querySelector('#userDetails'), model);
  const search = new SearchComponent(document.querySelector('#search'), model);
  
  const username = 'fxg42';
  const url = `https://api.github.com/users/${ username }`;
  const resp = await fetch(url);
  const user = await resp.json();

  model.addUser(user);
}

document.addEventListener("DOMContentLoaded", main);
