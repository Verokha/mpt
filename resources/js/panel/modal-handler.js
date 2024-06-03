import * as bootstrap from "bootstrap";
const modalAccept = new bootstrap.Modal(
    document.getElementById("modal-accept"),
    { backdrop: "static" }
);
const modalReject = new bootstrap.Modal(
    document.getElementById("modal-reject"),
    { backdrop: "static" }
);
const modalConfirm = new bootstrap.Modal(
    document.getElementById("modal-confirm"),
    { backdrop: "static" }
);
const modalResult = new bootstrap.Modal(
    document.getElementById("modal-result"),
    { backdrop: "static" }
);

document.querySelectorAll(".accept").forEach((item) => {
    item.addEventListener("click", (e) => {
        openModal(e.target, "acceptAction", modalAccept);
    });
});
document.getElementById("acceptAction").addEventListener("click", async (e) => {
    await sendData(
        "accept",
        e.target.getAttribute("item-id"),
        JSON.stringify({}),
        modalAccept
    );
});

document.querySelectorAll(".reject").forEach((item) => {
    item.addEventListener("click", (e) => {
        openModal(e.target, "rejectAction", modalReject);
    });
});
document.getElementById("rejectAction").addEventListener("click", async (e) => {
    const itemId = e.target.getAttribute("item-id");
    const cause = document.getElementById("cause").value;
    if (cause) {
        document
            .getElementById("modal-reject")
            .querySelector("button.btn-close")
            .classList.toggle("d-none");
        await sendData(
            "reject",
            itemId,
            JSON.stringify({ cause }),
            modalReject
        );
    }
});

document.querySelectorAll(".confirm").forEach((item) => {
    item.addEventListener("click", (e) => {
        openModal(e.target, "acceptConfirm", modalConfirm);
    });
});
document
    .getElementById("acceptConfirm")
    .addEventListener("click", async (e) => {
        await sendData(
            "confirm",
            e.target.getAttribute("item-id"),
            JSON.stringify({}),
            modalConfirm
        );
    });

const openModal = (target, buttonId, modal) => {
    const itemId = target.getAttribute("item-id");
    window.location.href = `#card-${itemId}`;
    document.getElementById(buttonId).setAttribute("item-id", itemId);
    modal.show();
};

const sendData = async (type, itemId, body, currentModal) => {
    toggleButtons(`modal-${type}`);
    const response = await fetch(`/panel/${type}/${itemId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json;charset=utf-8",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: body,
    });

    let result = await response.json();
    currentModal.hide();
    modalResult.show();
    document.getElementById("modal-result-label").textContent = result.title;
    document.getElementById("resultMessage").textContent = result.message;
};

const toggleButtons = (modalId) => {
    document
        .getElementById(modalId)
        .querySelectorAll(".action_select")
        .forEach((item) => {
            item.classList.toggle("d-none");
        });
    document
        .getElementById(modalId)
        .querySelector(".action_load")
        .classList.toggle("d-none");
};

document.getElementById("button-find").addEventListener("click", (e) => {
    const searchValue = e.target.previousElementSibling.value;
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set("search", searchValue);
    window.location.search = urlParams;
});

const clearFind = document.getElementById("button-clear-find");
if (clearFind) {
    clearFind.addEventListener("click", () => {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete("search");
        window.location.search = urlParams;
    });
}
