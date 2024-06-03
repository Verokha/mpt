const formRunner = () => {
    const form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", (e) => {
            const actionButton = document.querySelector(".action_button");
            const loaderButton = document.querySelector(".loader_button");
            if (actionButton && loaderButton) {
                actionButton.classList.toggle("d-none");
                loaderButton.classList.toggle("d-none");
            }
        });
    }
};

formRunner();
