# Révision

## JavaScript

- Structures de données JS: objects {}, Array : []
- "Truthy" vs "Falsy"
- == vs ===
- les fonctions sont des expressions...

    const x = 12;
    const f = () => {}
    const g = (function () {})

## Ajax

- async/await fetch

    const resp = await fetch(url);
    const json = await resp.json();
    const contenuTexte = await resp.text();
    const binaire = await resp.blob();

## DOM

### Sélection de noeuds HTML dans le DOM

    document.querySelector(selecteurCSS)
    document.querySelectorAll(selecteurCSS)

### Lecture et modification des propriétés d'un noeud

    .innerHTML
    .setAttribute, .getAttribute, .hasAttribute
    .addClass, removeClass, .toggleClass

### Souscription à des événements sur un noeud

    click, submit, DOMContentLoaded

    .addEventListener(nom-de-levenement, func) // bubbling
    .addEventListener(nom-de-levenement, func, true) // capture

### Navigation dans le DOM à partir du noeud qui a déclenché l'événement

    evt.target
    evt.target.closest(selecteurCSS) // recherche vers le haut
    evt.target.querySelector(selecteurCSS) // recherche vers le bas

### Exécution différée d'une fonction

    const timerTimeout  = setTimeout(func, ms) // exécute func après un certain nombre de ms
    const timerInterval = setInterval(func, ms) // exécute func à toutes les ms

    clearTimeout(timerTimeout); // annule l'exécution différée
    clearInterval(timerInterval); // annule l'exécution périodique

### Change l'adresse de la page

    window.location = url;

## JSON

- format sérialisation de donnée
- format texte
- objects { }, array [], nombre, strings, true, false, null

## CSS

- box model

## Question récapitulative

- HTML
- PHP
- JavaScript







