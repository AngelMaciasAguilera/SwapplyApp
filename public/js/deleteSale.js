/*-------------------------------------------------------------- DELETE THE THUMBNAIL ---------------------------------------------------------------*/
let deleteBtns = document.querySelectorAll('.deleteSaleBtn');

let confirmDeleteBtn = document.getElementById("confirm-delete");
let formToDelete = document.getElementById("formToDelete");
let urlToConfirmDelete = "";

for (const deleteBtn of deleteBtns) {
    deleteBtn.addEventListener("click", () => {
        document.getElementById('deleteSaleModalLabel').textContent = "Delete sentence";
        document.getElementById('deleteSaleModalBody').textContent = "Are you sure you want to delete this sale? ";

        confirmDeleteBtn.dataset.id = deleteBtn.dataset.id;

        urlToConfirmDelete = "/" + deleteBtn.dataset.id;
    })
}


confirmDeleteBtn.addEventListener("click", (event)=>{
    formToDelete.action = confirmDeleteBtn.dataset.href + urlToConfirmDelete;
    formToDelete.submit();
});
