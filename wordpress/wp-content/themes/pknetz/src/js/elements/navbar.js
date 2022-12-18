if (document.querySelector(".pkn-nav-mobile-toggle")) {
    document
        .querySelector(".pkn-nav-mobile-toggle")
        .addEventListener("click", function (e) {
            e.target.closest(".pkn-nav-mobile-toggle").classList.toggle("pkn-nav-mobile-toggle__open");
            const mobilenavContent = document.querySelector(".pkn-nav-mobile-lower-content");
            mobilenavContent.classList.toggle(".pkn-nav-mobile-lower-content__open");
            if (!mobilenavContent.classList.contains(".pkn-nav-mobile-lower-content__open")) {
                mobilenavContent.style.maxHeight = "0px";
            }
            else {
                mobilenavContent.style.maxHeight = mobilenavContent.scrollHeight + "px";
            }
        });
}

if (document.querySelector(".pkn-children-nav-mobile-open")) {
    document
        .querySelector(".pkn-children-nav-mobile-open")
        .addEventListener("click", function (e) {
            e.target.closest(".pkn-children-nav-mobile-open").classList.toggle("pkn-children-nav-mobile-open__open");
            const childrenNavContent = document.querySelector(".pkn-children-nav-mobile-content-wrapper");
            childrenNavContent.classList.toggle(".pkn-children-nav-mobile-content-wrapper__open");
            if (!childrenNavContent.classList.contains(".pkn-children-nav-mobile-content-wrapper__open")) {
                childrenNavContent.style.maxHeight = "0px";
            }
            else {
                childrenNavContent.style.maxHeight = childrenNavContent.querySelector(".pkn-children-nav-mobile-content").offsetHeight + "px";
            }
        });
}