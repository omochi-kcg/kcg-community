"use strict";
{
    const addTagButton = document.getElementById("add-button");
    if (document.querySelectorAll("[name='tags[]']").length === 4) {
        addTagButton.remove();
    }

    addTagButton.addEventListener("click", () => {
        const input = document.createElement("input");
        input.name = `tags[]`;
        input.type = "text";
        input.className =
            "block w-2/3 my-1 placeholder-gray-300 border-gray-300 rounded-md shadow-sm md:w-1/2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50";
        input.value = input.value.trim();
        const tagLabel = document.getElementById("tag");
        tagLabel.appendChild(input);
        if (document.querySelectorAll("[name='tags[]']").length >= 4) {
            addTagButton.remove();
        }
    });
}
