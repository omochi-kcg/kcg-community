"use strict";
{
    const deleteForms = document.querySelectorAll(".delete");
    deleteForms.forEach((deleteForm) => {
        deleteForm.addEventListener("submit", (e) => {
            e.preventDefault();
            if (!confirm("本当に削除してもよろしいですか？")) {
                return;
            }
            e.target.submit();
        });
    });
}
