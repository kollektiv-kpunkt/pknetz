import Choices from "choices.js";
import "choices.js/public/assets/styles/choices.min.css";

if (document.querySelector(".pkn-article-list-categories")) {
  document.querySelectorAll(".pkn-article-list-categories select").forEach((select) => {
    const choices = new Choices(select, {
      searchEnabled: false,
      itemSelectText: "",
      noChoicesText: 'Alles ausgewählt',
    });
  });
}

if (document.querySelector(".pkn-article-list-filters-button-apply")) {
  document.querySelectorAll(".pkn-article-list-filters-button-apply").forEach((button) => {
    button.addEventListener("click", () => {
      searchPosts(button);
    });
  });
}

function searchPosts(button) {
  const DOMfilters = button.closest(".pkn-article-list-filters-outer");
  const filters = {};
  (DOMfilters.querySelector(".pkn-article-list-searchbar input").value) ? filters.query = DOMfilters.querySelector(".pkn-article-list-searchbar input").value : null;
  if (DOMfilters.querySelector(".pkn-article-list-categories .choices__list--multiple .choices__item")) {
    filters.terms = [];
    DOMfilters.querySelectorAll(".pkn-article-list-categories .choices__list--multiple .choices__item").forEach((item) => {
      filters.terms.push(item.dataset.value);
    });
    filters.terms = filters.terms.join(",");
    filters.taxonomy = DOMfilters.querySelector(".pkn-article-list-categories select").dataset.taxonomy;
  }

  const url = new URL(window.location.href);
  const params = new URLSearchParams();
  Object.keys(filters).forEach(function (key) {
    params.set(key, filters[key]);
  })
  url.search = params.toString();
  window.location = url;
}

if (document.querySelector(".pkn-article-list-show-mobile-filter")) {
  document.querySelectorAll(".pkn-article-list-show-mobile-filter").forEach((button) => {
    button.addEventListener("click", () => {
      let filterContainer = button.previousElementSibling;
      filterContainer.classList.toggle("pkn-article-list-filters-mobile-container--open");
      button.classList.toggle("pkn-article-list-show-mobile-filter--open");
      if (!filterContainer.classList.contains("pkn-article-list-filters-mobile-container--open")) {
        filterContainer.style.maxHeight = null;
      } else {
        filterContainer.style.maxHeight = filterContainer.querySelector(".pkn-article-list-filters-height").offsetHeight + "px";
      }
    });
  });
}

if (document.querySelector(".pkn-article-inner")) {
  document.querySelectorAll(".pkn-article-inner").forEach((article) => {
    article.addEventListener("click", () => {
      article.querySelector(".pkn-article-read-more").click();
    });
  });
}